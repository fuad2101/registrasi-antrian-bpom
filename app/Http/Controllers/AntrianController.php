<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Http\Requests\StoreAntrianRequest;
use App\Http\Requests\UpdateAntrianRequest;
use Barryvdh\DomPDF\Facade\Pdf;


class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = now()->format('Y-m-d');
        $last = Antrian::whereDate('created_at', $today)->latest()->first();
        $nextNumber = $last ? intval(substr($last->nomor_antrian, -3)) + 1 : 1;
        $nomor = 'A' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $antrian = Antrian::create([
            'user_id' => auth()->id(),
            'nomor_antrian' => $nomor,
        ]);

        $user = auth()->user();
        $user->notify(new AntrianBaru($antrian));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAntrianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Antrian $antrian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Antrian $antrian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAntrianRequest $request, Antrian $antrian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Antrian $antrian)
    {
        //
    }

    /**
     * Print the antrian.
     */
    public function download($id)
    {

    $antrian = Antrian::findOrFail($id);
    $pdf = Pdf::loadView('pdf.antrian', compact('antrian'));
    return $pdf->download('antrian-'.$antrian->nomor_antrian.'.pdf');

    }
}
