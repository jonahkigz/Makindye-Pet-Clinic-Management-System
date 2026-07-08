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
                    'medical-records' => MedicalRecord::count(),
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

    $vetId = $user->id;

    return view('dashboard.vet', array_merge($baseData, [

        'stats' => [
    'all_appointments' => Appointment::whereNotIn('status', ['Completed', 'Cancelled'])
        ->count(),

    'unassigned_appointments' => Appointment::whereNull('vet_id')
        ->whereNotIn('status', ['Completed', 'Cancelled'])
        ->count(),

    'my_appointments' => Appointment::where('vet_id', $vetId)
        ->whereNotIn('status', ['Completed', 'Cancelled'])
        ->count(),

    'completed_cases' => Appointment::where('vet_id', $vetId)
        ->where('status', 'Completed')
        ->count(),

    'completed_consultations' => MedicalRecord::where('vet_id', $vetId)
        ->count(),

    'monthly_records' => MedicalRecord::where('vet_id', $vetId)
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count(),

    'total_records' => MedicalRecord::where('vet_id', $vetId)->count(),

    'total_patients' => Pet::whereHas('appointments', function ($query) use ($vetId) {
        $query->where('vet_id', $vetId);
    })->distinct()->count(),
],

        'appointments' => Appointment::with(['pet.owner', 'owner', 'vet'])
            ->where(function ($query) use ($vetId) {
                $query->where('vet_id', $vetId)
                      ->orWhereNull('vet_id');
            })
            ->latest()
            ->take(8)
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

                    'monthly_revenue' => Payment::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->sum('amount'),
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
    ? Pet::with(['owner', 'species', 'breed', 'appointments', 'medicalRecords'])
        ->where('owner_id', $owner->id)
        ->latest()
        ->get()
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
