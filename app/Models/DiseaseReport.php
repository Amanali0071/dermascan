<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DiseaseReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'report_number',
        'disease',
        'diagnosis',
        'recommendations',
        'pdf_path'
    ];

    /**
     * Generate a unique report number
     * 
     * @return string
     */
    public static function generateUniqueReportNumber(): string
    {
        $prefix = 'REP-';
        $year = date('Y');
        $month = date('m');
        $random = Str::upper(Str::random(4));
        
        $reportNumber = $prefix . $year . $month . '-' . $random;
        
        // Check if the generated number already exists
        while (self::where('report_number', $reportNumber)->exists()) {
            $random = Str::upper(Str::random(4));
            $reportNumber = $prefix . $year . $month . '-' . $random;
        }
        
        return $reportNumber;
    }

    /**
     * Get the patient that owns the report
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}