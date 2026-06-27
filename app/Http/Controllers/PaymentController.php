<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('invoice.owner')->latest()->get();

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        return view('payments.create', [
            'invoices' => Invoice::where('status', '!=', 'paid')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required',
            'reference' => 'nullable'
        ]);

        $invoice = Invoice::findOrFail($request->invoice_id);

        Payment::create([
            'invoice_id' => $invoice->id,
            'amount' => $request->amount,
            'method' => $request->payment_method,
            'reference' => $request->reference,
        ]);

        $invoice->paid_amount += $request->amount;

        if ($invoice->paid_amount >= $invoice->total_amount) {
            $invoice->status = 'paid';
        } elseif ($invoice->paid_amount > 0) {
            $invoice->status = 'partial';
        }

        $invoice->save();

        return redirect()->route('payments.index')
            ->with('success', 'Payment received successfully.');
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return back()->with('success', 'Payment deleted.');
    }
}