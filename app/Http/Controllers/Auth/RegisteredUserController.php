<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('frontend.signup');
    }
    public function registerdoctor(): View
    {
        return view('frontend.doctorsignup');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users,email',
                'password' => ['required', 'confirmed', 'min:6'],
                // 'toc' => 'required',
            ]);
    
            $user = User::create([
                'first_name' => $request->name, // Fixed from $request->first_name to $request->name
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => User::PATIENT,
                'email_verified_at'=> now(),
                'language' => getSettingValue('language'),
            ]);
    
            $user->patient()->create([
                'patient_unique_id' => mb_strtoupper(Patient::generatePatientUniqueId()),
            ]);
    
            $user->assignRole('patient');
    
            // $user->sendEmailVerificationNotification();
    
            Flash::success(__('messages.flash.your_reg_success'));
    
            return redirect('login');
    
        } catch (\Exception $e) {
            \Log::error('Registration Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            dd($e);
            Flash::error(__('messages.flash.registration_failed'));
    
            return back()->withInput();
        }
    }

    public function doctorstore(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users,email',
            'password' => ['required', 'confirmed', 'min:6'],
            // 'toc' => 'required',
        ]);

        $user = User::create([
            'first_name' => $request->name, // Fixed from $request->first_name to $request->name
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => User::DOCTOR,
            'email_verified_at'=> now(),
            'language' => getSettingValue('language'),
        ]);

        $doctor = new Doctor();
        $doctor->user_id = $user->id;
        $doctor->save();

        $user->assignRole('doctor');

        // $user->sendEmailVerificationNotification();

        Flash::success(__('messages.flash.your_reg_success'));

        return redirect('login');

    } 
}
