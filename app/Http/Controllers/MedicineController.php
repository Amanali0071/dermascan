<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Models\AdminMedicineModel;
use App\Models\Medicine;
use App\Models\PurchasedMedicine;
use App\Models\SaleMedicine;
use App\Repositories\MedicineRepository;
use Exception;
use File;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Response;

class MedicineController extends AppBaseController
{
    /** @var MedicineRepository */
    private $medicineRepository;

    public function __construct(MedicineRepository $medicineRepo)
    {
        $this->medicineRepository = $medicineRepo;
    }

    /**
     * Display a listing of the Medicine.
     *
     * @param  Request  $request
     * @return Factory|View|Response
     *
     * @throws Exception
     */
    public function index(): View
    {
        $medicines = AdminMedicineModel::all();
        return view('medicines.index', compact('medicines'));
    }

    /**
     * Show the form for creating a new Medicine.
     *
     * @return Factory|View
     */
    public function create(): View
    {
        return view('medicines.create');
    }

    /**
     * Store a newly created Medicine in storage.
     *
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/medicines'), $imageName);
            $data['image'] = 'uploads/medicines/' . $imageName;
        }
        $medicine = new AdminMedicineModel();
        $medicine->name = $data['name'] ?? null;
        $medicine->brand = $data['brand'] ?? null;
        $medicine->quantity = $data['quantity'] ?? null;
        $medicine->price = $data['price'] ?? null;
        $medicine->description = $data['description'] ?? null;
        if (isset($data['image'])) {
            $medicine->image = $data['image'];
        }
        $medicine->save();

        Flash::success(__('messages.medicine.medicine') . ' ' . __('messages.medicine.saved_successfully'));
        return redirect(route('medicines.index'));
    }

    /**
     * Display the specified Medicine.
     *
     * @return Factory|View
     */
    public function show(Medicine $medicine): View
    {
        $medicine->brand;
        $medicine->category;

        return view('medicines.show')->with('medicine', $medicine);
    }

    /**
     * Show the form for editing the specified Medicine.
     *
     * @return Factory|View
     */
    public function edit($id, Request $request): View
    {
        $medicine = AdminMedicineModel::find($id);
        return view('medicines.edit', compact('medicine'));
    }

    /**
     * Update the specified Medicine in storage.
     *
     * @return RedirectResponse|Redirector
     */
    public function update($id, Request $request): RedirectResponse
    {

        $medicine = AdminMedicineModel::find($id);
        $data = $request->all();

        $uploadPath = public_path('uploads/medicines');

        if ($request->hasFile('image')) {
            // Check if the directory exists
            if (!File::exists($uploadPath)) {
                // Create the directory with appropriate permissions
                File::makeDirectory($uploadPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move($uploadPath, $imageName);

            $data['image'] = 'uploads/medicines/' . $imageName;
        }

        $medicine->update($data);


        Flash::success(__('messages.medicine.medicine') . ' ' . __('messages.medicine.updated_successfully'));

        return redirect(route('medicines.index'));
    }

    /**
     * Remove the specified Medicine from storage.
     *
     *
     * @throws Exception
     */
    public function destroy($id): JsonResponse
    {
        $medicine = AdminMedicineModel::find($id);
        //image delete
        if (file_exists(public_path($medicine->image))) {
            unlink(public_path($medicine->image));
        }
        $medicine->delete();
        return $this->sendSuccess(__('messages.medicine.medicine') . ' ' . __('messages.medicine.deleted_successfully'));
    }

    /**
     * @throws \Gerardojbaez\Money\Exceptions\CurrencyException
     */
    public function showModal(Medicine $medicine): JsonResponse
    {
        $medicine->load(['brand', 'category']);

        $currency = $medicine->currency_symbol ? strtoupper($medicine->currency_symbol) : strtoupper(getCurrentCurrency());
        $medicine = [
            'name' => $medicine->name,
            'brand_name' => $medicine->brand->name,
            'category_name' => $medicine->category->name,
            'salt_composition' => $medicine->salt_composition,
            'side_effects' => $medicine->side_effects,
            'created_at' => $medicine->created_at,
            'selling_price' => getCurrencyFormat(getCurrencyCode(), $medicine->buying_price),
            'buying_price' => getCurrencyFormat(getCurrencyCode(), $medicine->buying_price),
            'updated_at' => $medicine->updated_at,
            'description' => $medicine->description,
            'quantity' => $medicine->quantity,
            'available_quantity' => $medicine->available_quantity,
        ];

        return $this->sendResponse($medicine, __('messages.medicine.medicine_retrieved_successfully'));
    }

    public function checkUseOfMedicine(Medicine $medicine)
    {

        $SaleModel = [
            SaleMedicine::class,
            PurchasedMedicine::class,
        ];
        $result['result'] = canDelete($SaleModel, 'medicine_id', $medicine->id);
        $result['id'] = $medicine->id;

        if ($result) {

            return $this->sendResponse($result, __('messages.medicine_bills.the_medicine_already_in_use'));
        }

        return $this->sendResponse($result, __('messages.medicine.no_use'));

    }
    public function checkout()
    {
        return view('frontend.checkout');
    }
}
