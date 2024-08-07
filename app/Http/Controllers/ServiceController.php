<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer tous les services
        $services = Service::all();
        // Passer les services à la vue
        return view('dash.service', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $service = Service::create($request->all());

        if ($request->ajax()) {
            return response()->json($service);
        }

        return redirect()->route('service.index')->with('success', 'Service ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $service->update($request->all());

        if ($request->ajax()) {
            return response()->json($service);
        }

        return redirect()->route('service.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('service.index');
    }
}
