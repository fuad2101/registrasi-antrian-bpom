<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAntrianRequest;
use App\Http\Requests\UpdateAntrianRequest;
use Illuminate\Http\Request;


class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('antrian.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('antrian.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $today = now()->format('Y-m-d');
        $last = Antrian::whereDate('created_at', $today)->latest()->first();
        $nextNumber = $last ? intval(substr($last->nomor_antrian, -3)) + 1 : 1;
        $nomor = 'A' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        $status = $request->input('status', 'waiting');

        $antrian = Antrian::create([
            'user_id' => Auth::user()->id,
            'status' => $status,
            // 'nomor_antrian' => $nomor,
        ]);

        return view('antrian.show', [
            'antrian' => $nomor,
            // 'nomor' => $nomor,
        ]);

        // return redirect()->route('antrian.post')->with('success', 'Antrian berhasil diambil. Nomor Antrian: ' . $nomor);

        $user = Auth::user();
        // $user->notify(new AntrianBaru($antrian));
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
    public function download()
    {
        // $antrian = Antrian::findOrFail($id);
        $pdf = Pdf::loadView('antrian.pdf.antrian');
        // $pdf = Pdf::loadView('antrian.pdf.antrian', compact('antrian'));
        return $pdf->download('antrian');
        // return $pdf->download('antrian-'.$antrian->nomor_antrian.'.pdf');
    }
}
