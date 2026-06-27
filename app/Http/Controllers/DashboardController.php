<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\MedicalRecord;
use App\Models\Owner;
use App\Models\Payment;
use App\Models\Pet;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role ?? 'Administrator';

            $stats = [
    // old dashboard keys
    'today_appointments' => Appointment::whereDate('scheduled_at', today())->count(),
    'registered_pets' => Pet::count(),
    'pet_owners' => Owner::count(),
    'monthly_revenue' => Payment::whereMonth('created_at', now()->month)->sum('amount'),
    'users' => User::count(),
    'low_stock' => Product::whereColumn('quantity', '<=', 'reorder_level')->count(),

    // new RBAC dashboard keys
    'appointments' => Appointment::count(),
    'pets' => Pet::count(),
    'owners' => Owner::count(),
    'products' => Product::count(),
    'medical_records' => MedicalRecord::count(),
    'revenue' => Payment::sum('amount'),
    'pending_invoices' => Invoice::where('status', '!=', 'paid')->count(),
];

        $recentAppointments = Appointment::with(['owner', 'pet'])->latest()->take(5)->get();
        $recentPayments = Payment::with('invoice.owner')->latest()->take(5)->get();

        if ($role === 'Veterinarian') {
            return view('dashboard.vet', compact('stats', 'recentAppointments'));
        }

        if ($role === 'Receptionist') {
            return view('dashboard.receptionist', compact('stats', 'recentAppointments', 'recentPayments'));
        }

        if ($role === 'Pet Owner') {
            return view('dashboard.owner', compact('stats', 'recentAppointments'));
        }

        return view('dashboard', compact('stats', 'recentAppointments', 'recentPayments'));
       
    }
}