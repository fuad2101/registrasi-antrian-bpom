<?php

use Livewire\Component;
use App\Models\Antrian;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailAntrian;

new class extends Component
{
    public $nama;
    public $layanan;
    public $deskripsi;

    public function save()
    {
        $validatedData = $this->validate([
            'nama' => 'required|string|max:255',
            'layanan' => 'required|string',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $antrian = Antrian::create([
            'user_id' => auth()->id(),
            'status' => 'menunggu',
            'nomor_antrian' => Antrian::generateNomorAntrian($validatedData['layanan']),
            'deskripsi' => $validatedData['deskripsi'],
            'layanans_id' => $validatedData['layanan'],
        ]);

        
        Mail::to(auth()->user())->send(new EmailAntrian($antrian));

        $this->reset(['nama', 'layanan', 'deskripsi']);

        return redirect()->route('antrian.ambil');
        session()->flash('message', 'Antrian berhasil diambil!');
    }
};
