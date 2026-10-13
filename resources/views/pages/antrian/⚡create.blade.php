<?php

use Livewire\Component;
use App\Models\Antrian;

new class extends Component
{
    public $email = '';
    public $layanan_id = '';
    public $deskripsi = '';

    public function submit()
    {
        // Handle form submission logic here
        // For example, you can validate the input and save it to the database
        $validated = $this->validate([
            'email' => 'required|email',
            'layanan_id' => 'required',
            'deskripsi' => 'required',
        ]);

        // Save the data to the database or perform any other action
        Antrian::create([
            'user_id' => auth()->id(),
            'status' => 'menunggu',
            'deskripsi' => $validated['deskripsi'],
            'nomor_antrian'=> '001',
            'layanans_id'=> $validated['layanan_id'],
        ]);

        // Optionally, you can reset the form fields after submission
        $this->reset(['email', 'layanan_id', 'deskripsi']);
    }
};
?>

<div>
    <form wire:submit.prevent="submit">
        <x-wirekit::form style="max-width: 24rem;">
            <x-wirekit::stack gap="md">
                <x-wirekit::input wire:model="email" name="email" label="Nama Lengkap" placeholder="Your email address" />
                <x-wirekit::select
                    wire:model="layanan_id"
                    label="Jenis Layanan"
                    name="layanan_id"
                    placeholder="Jenis Layanan"
                    :options="['1' => 'Informasi Dan Konsultasi', '2' => 'Layanan Registrasi', '3' => 'Layanan Pengaduan']"
                />
                <x-wirekit::input wire:model="deskripsi" name="deskripsi" label="Hal yang Dibutuhkan" placeholder="Tuliskan hal apa yang ingin anda tanyakan" />
                <x-wirekit::button type="submit" wire:loading.remove>Daftar Antrian</x-wirekit::button>
                <x-wirekit::button wire:loading wire:target="submit" type="submit">Loading...</x-wirekit::button>
                </x-wirekit::stack>
        </x-wirekit::form>
    </form>
</div>
