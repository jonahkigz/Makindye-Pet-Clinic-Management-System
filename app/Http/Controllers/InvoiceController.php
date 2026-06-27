<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Owner;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('owner')->latest()->get();
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('invoices.create', [
            'owners' => Owner::orderBy('full_name')->get(),
            'appointments' => Appointment::with('pet')->latest()->get(),
            'services' => Service::orderBy('name')->get(),
            'products' => Product::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'owner_id' => 'required',
            'appointment_id' => 'nullable',
            'item_name.*' => 'required',
            'quantity.*' => 'required|numeric|min:1',
            'unit_price.*' => 'required|numeric|min:0',
        ]);

        $total = 0;

        foreach ($request->item_name as $i => $name) {
            $total += $request->quantity[$i] * $request->unit_price[$i];
        }

        $invoice = Invoice::create([
            'owner_id' => $request->owner_id,
            'appointment_id' => $request->appointment_id,
            'invoice_number' => 'INV-' . date('YmdHis'),
            'total_amount' => $total,
            'paid_amount' => 0,
            'status' => 'unpaid',
        ]);

        foreach ($request->item_name as $i => $name) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'item_name' => $name,
                'quantity' => $request->quantity[$i],
                'unit_price' => $request->unit_price[$i],
                'subtotal' => $request->quantity[$i] * $request->unit_price[$i],
            ]);
        }

        return redirect()->route('invoices.show', $invoice)->with('success', 'Invoice created.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['owner', 'appointment.pet', 'items', 'payments']);
        return view('invoices.show', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return back()->with('success', 'Invoice deleted.');
    }
}