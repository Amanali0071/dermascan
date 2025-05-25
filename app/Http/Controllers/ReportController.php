<?php

namespace App\Http\Controllers;

use App\Models\DiseaseReport;
use App\Models\Patient;
use Barryvdh\DomPDF\Facade\Pdf;
use Http;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{

    public function modelRequest(Request $request)
    {
        set_time_limit(300);
        if ($request->has('images')) {
            $image = $request->images[0];
            // dd($image, $request->all());

            // 1. Send image to FastAPI model
            $response = Http::attach(
                'image',
                file_get_contents($image),
                $image->getClientOriginalName()
            )->post('http://127.0.0.1:5000/predict');

            $result = $response->json();

            if (isset($result['predictions']) && count($result['predictions']) > 0) {
                // $disease = 'testing';
                $disease = $result['predictions'][0]['label'];
                $annotated_image = $result['annotated_image_base64'];
                $imageBinary = base64_decode($annotated_image);
                $fileName = 'annotated_' . time() . '.jpg';
                $relativeImagePath = 'uploads/annotated_images/' . $fileName;
                $absoluteImagePath = public_path($relativeImagePath);

                // Save annotated image
                file_put_contents($absoluteImagePath, $imageBinary);
                // dd('');
                // Check user type
                $is_premium = auth()->check() && auth()->user()->is_premium;
                $prompt = $is_premium
                    ? "Generate a detailed health report for the disease '{$disease}'. Include:
                    - A clear and concise medical description
                    - Common symptoms
                    - Causes and risk factors
                    - At least 5 preventive measures
                    - Recommended diagnostic tests
                    - Suggested treatments and medications (if applicable)
                    - Lifestyle or dietary recommendations
                    Use proper formatting with section headings to make it readable."
                    : "Give a short medical description and 2–3 basic preventive measures for a disease called '{$disease}'. Format it simply with headings like Description and Precautions.";

                // 2. Call Gemini
                $geminiResponse = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=AIzaSyCuLT1O7XWDwGFxesRLhDYOQ_fzicCVQ3Q', [
                            'contents' => [
                                [
                                    'parts' => [
                                        ['text' => $prompt]
                                    ]
                                ]
                            ]
                        ]);

                $aiText = $geminiResponse['candidates'][0]['content']['parts'][0]['text'] ?? 'No data received.';

                // Format the response text
                $aiText = preg_replace('/\*\*(.*?)\*\*/s', '<strong>$1</strong>', $aiText);
                $aiText = preg_replace('/(?<!\*)\*(?!\*)(.*?)\*(?!\*)/s', '<em>$1</em>', $aiText);
                $aiText = str_replace(['**', '*'], '', $aiText);
                $aiText = nl2br($aiText);

                // 3. Store report
                $patientId = auth()->id() ?? 1;
                $reportNumber = DiseaseReport::generateUniqueReportNumber();
                // dd($reportNumber);
                $report = DiseaseReport::create([
                    'patient_id' => $patientId,
                    'report_number' => $reportNumber,
                    'disease' => $disease,
                    'diagnosis' => $aiText,
                    'recommendations' => null
                ]);

                // ✅ Use annotated image path for PDF
                // $pdfImagePath = asset('uploads/patients/XMpFycyTTweHjtVBjCM9LRtx9iPTKigTXdKeiqbl.jpg');
                $pdfImagePath = 'file://' . $absoluteImagePath;

                // 4. Generate PDF
                $pdf = Pdf::loadView('pdf.disease_report', [
                    'report' => $report,
                    'disease' => $disease,
                    'info' => $aiText,
                    'image' => $pdfImagePath, // use the annotated image path
                    'date' => Carbon::parse($report->created_at)->format('d M Y'),
                ]);

                $pdfName = 'Disease_Report_' . $reportNumber . '.pdf';
                $pdfPath = 'reports/' . $pdfName;
                $fullPath = public_path($pdfPath);
                if (!file_exists(public_path('reports'))) {
                    mkdir(public_path('reports'), 0777, true);
                }
                file_put_contents($fullPath, $pdf->output());
                // dd($fullPath, $pdfPath);
        
                $report->update(['pdf_path' => public_path($pdfPath)]);

                // 5. Return the PDF (inline view)
                // 
                // download 
                // return response()->download($fullPath, $pdfName);
                return response()->file($fullPath, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . $pdfName . '"'
                ]);
                
            } else {
                return response()->json(['error' => 'No disease Detected.'], 500);
            }
        }

        return response()->json(['error' => 'No image uploaded.'], 400);
    }


    public function patientReports()
    {
        return view('patientreports.scannedreport');
    }

    public function searchReports(Request $request)
    {
        $search = $request->input('search', '');
        // Query to search reports based on report number or other criteria
        $reports = DiseaseReport::where('report_number', $search)
            ->orderBy('created_at', 'desc')
            ->get();

        $formattedReports = $reports->map(function ($report) {
            // dd('');
            return [
                'id' => $report->id,
                'report_number' => $report->report_number,
                'patient_name' => @$report->patient->user->first_name . ' ' . @$report->patient->user->last_name,
                'date' => Carbon::parse($report->created_at)->format('d M Y'),
                'disease' => $report->disease,
                'download_url' => route('patient.reports.download', $report->id)
            ];
        });
        return response()->json([
            'success' => true,
            'data' => $formattedReports
        ]);
    }

    public function downloadReport($id)
    {
        // Get report data
        $report = DiseaseReport::find($id);

        if (!$report) {
            return response()->json(['error' => 'Report not found'], 404);
        }

        // Check if we already have a PDF file
        if ($report->pdf_path && file_exists(public_path($report->pdf_path))) {
            return response()->download(
                public_path($report->pdf_path),
                'patient_report_' . $report->report_number . '.pdf'
            );
        }

        // If no PDF exists, generate a new one
        $pdf = PDF::loadView('pdf.patient_report', [
            'report' => $report,
            'date' => Carbon::parse($report->created_at)->format('d M Y'),
        ]);

        return $pdf->download('patient_report_' . $report->report_number . '.pdf');
    }
}


