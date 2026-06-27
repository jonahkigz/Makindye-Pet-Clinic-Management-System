<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\Owner;
use App\Models\Payment;
use App\Models\Pet;
use App\Models\Product;

class ReportController extends Controller
{
    public function index()
    {
        $stats = [
            'owners' => Owner::count(),
            'pets' => Pet::count(),
            'appointments' => Appointment::count(),
            'products' => Product::count(),
            'total_revenue' => Payment::sum('amount'),
            'pending_invoices' => Invoice::where('status', '!=', 'paid')->count(),
            'low_stock' => Product::whereColumn('quantity', '<=', 'reorder_level')->count(),
        ];

        $recentPayments = Payment::with('invoice.owner')->latest()->take(5)->get();
        $recentAppointments = Appointment::with(['owner', 'pet'])->latest()->take(5)->get();
        $lowStockProducts = Product::whereColumn('quantity', '<=', 'reorder_level')->take(10)->get();

        return view('reports.index', compact(
            'stats',
            'recentPayments',
            'recentAppointments',
            'lowStockProducts'
        ));
    }
}