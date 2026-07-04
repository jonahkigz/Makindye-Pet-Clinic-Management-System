<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\MedicalRecord;
use App\Models\Owner;
use App\Models\Payment;
use App\Models\Pet;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $role = $user->role ?? 'Pet Owner';

        $baseData = [
            'user' => $user,
            'role' => $role,
        ];

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */
        if ($role === 'Administrator') {

            $dateField = $this->getAppointmentDateField();

            $monthlyRevenue = Payment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->pluck('total', 'month');

            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            $revenueData = [];
            $appointmentData = [];

            foreach (range(1, 12) as $m) {
                $revenueData[] = $monthlyRevenue[$m] ?? 0;

                $appointmentData[] = Appointment::whereMonth($dateField, $m)
                    ->whereYear($dateField, date('Y'))
                    ->count();
            }

            return view('dashboard.admin', array_merge($baseData, [

                'stats' => [
                    'today_appointments' => Appointment::whereDate($dateField, today())->count(),
                    'registered_pets' => Pet::count(),
                    'owners' => Owner::count(),
                    'users' => User::count(),
                    'medical_records' => MedicalRecord::count(),
                    'products' => Product::count(),
                    'low_stock' => Product::whereColumn('quantity', '<=', 'reorder_level')->count(),
                    'monthly_revenue' => Payment::whereMonth('created_at', now()->month)->sum('amount'),
                    'total_revenue' => Payment::sum('amount'),
                    'pending_invoices' => Invoice::where('status', 'unpaid')->count(),
                    'services' => Service::count(),
                ],

                'appointments' => Appointment::with(['owner', 'pet', 'vet'])
                    ->latest()
                    ->take(5)
                    ->get(),

                'payments' => Payment::with(['invoice.owner'])
                    ->latest()
                    ->take(5)
                    ->get(),

                'months' => $months,
                'revenueData' => $revenueData,
                'appointmentData' => $appointmentData,
            ]));
        }

        /*
        |--------------------------------------------------------------------------
        | VETERINARIAN
        |--------------------------------------------------------------------------
        */
        if ($role === 'Veterinarian') {

            $dateField = $this->getAppointmentDateField();

            return view('dashboard.vet', array_merge($baseData, [

                'stats' => [
                    'today_appointments' => Appointment::whereDate($dateField, today())->count(),
                    'total_appointments' => Appointment::count(),
                    'total_patients' => Pet::count(),
                    'medical_records' => MedicalRecord::count(),
                ],

                'appointments' => Appointment::with(['pet', 'owner', 'vet'])
                    ->whereDate($dateField, today())
                    ->latest()
                    ->get(),

                'medicalRecords' => MedicalRecord::with(['pet', 'appointment', 'vet'])
                    ->latest()
                    ->take(10)
                    ->get(),
            ]));
        }

        /*
        |--------------------------------------------------------------------------
        | RECEPTIONIST
        |--------------------------------------------------------------------------
        */
        if ($role === 'Receptionist') {

            $dateField = $this->getAppointmentDateField();

            return view('dashboard.receptionist', array_merge($baseData, [

                'stats' => [
                    'today_appointments' => Appointment::whereDate($dateField, today())->count(),
                    'pets' => Pet::count(),
                    'owners' => Owner::count(),
                ],

                'appointments' => Appointment::with(['pet', 'owner', 'vet'])
                    ->whereDate($dateField, today())
                    ->latest()
                    ->get(),
            ]));
        }

        /*
        |--------------------------------------------------------------------------
        | PET OWNER
        |--------------------------------------------------------------------------
        */
        if ($role === 'Pet Owner') {

            $owner = Owner::where('user_id', $user->id)->first();

            return view('dashboard.owner', array_merge($baseData, [

                'stats' => [
                    'my_pets' => $owner ? Pet::where('owner_id', $owner->id)->count() : 0,
                    'my_appointments' => $owner ? Appointment::where('owner_id', $owner->id)->count() : 0,
                    'my_invoices' => $owner ? Invoice::where('owner_id', $owner->id)->count() : 0,
                ],

                'myPets' => $owner
                    ? Pet::where('owner_id', $owner->id)->latest()->get()
                    : collect(),

                'myAppointments' => $owner
                    ? Appointment::with(['pet', 'vet'])
                        ->where('owner_id', $owner->id)
                        ->latest()
                        ->get()
                    : collect(),

                'myInvoices' => $owner
                    ? Invoice::where('owner_id', $owner->id)
                        ->latest()
                        ->get()
                    : collect(),

                'medicalHistory' => $owner
                    ? MedicalRecord::with(['pet', 'appointment', 'vet'])
                        ->whereHas('pet', function ($q) use ($owner) {
                            $q->where('owner_id', $owner->id);
                        })
                        ->latest()
                        ->get()
                    : collect(),
            ]));
        }

        abort(403, 'Unauthorized role access');
    }

    private function getAppointmentDateField()
    {
        return Schema::hasColumn('appointments', 'scheduled_at')
            ? 'scheduled_at'
            : 'created_at';
    }
}
