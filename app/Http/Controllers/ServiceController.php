<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        Service::create($request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
        ]));

        return redirect()->route('services.index')->with('success', 'Service added.');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $service->update($request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
        ]));

        return redirect()->route('services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Service deleted.');
    }
}