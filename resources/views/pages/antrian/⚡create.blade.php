<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <form wire:submit.prevent="submit">
        <x-wirekit::form style="max-width: 24rem;">
            <x-wirekit::stack gap="md">
                <x-wirekit::input name="email" label="Nama Lengkap" placeholder="Your email address" />
                <x-wirekit::select
                    label="Role"
                name="role"
                placeholder="Jenis Layanan"
                :options="['1' => 'Informasi Dan Konsultasi', '2' => 'Layanan Registrasi', '3' => 'Layanan Pengaduan']"
            />
            <x-wirekit::input name="email" label="Hal yang Dibutuhkan" placeholder="Your email address" />
            <x-wirekit::button type="submit" wire:loading.remove>Daftar Antrian</x-wirekit::button>
            <x-wirekit::button wire:loading wire:target="submit" type="submit">Loading...</x-wirekit::button>
            </x-wirekit::stack>
        </x-wirekit::form>
    </form>
</div>
