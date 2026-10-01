<div>
    <x-wirekit::form wire:submit="save" style="width: 20rem;">
        <x-wirekit::stack gap="md">
            <x-wirekit::input wire:model="nama" label="Nama" placeholder="Your full name" error="Nama wajib diisi" success="Username is available"/>
            <x-wirekit::select
                label="Layanan"
                name="layanan"
                :options="['1' => 'Informasi & Konsultasi', '2' => 'Sertifikasi', '3' => 'Pengaduan']"
                wire:model="layanan"
                placeholder="Pilih layanan"
            />
            <x-wirekit::field label="Apa yang ingin Anda tanyakan?" name="deskripsi" error="Deskripsi wajib diisi">
                <x-wirekit::textarea wire:model="deskripsi" rows="4" hint="500 characters max."/>
            </x-wirekit::field>
            <x-wirekit::button wire:loading.remove type="submit">Ambil antrian</x-wirekit::button>
            <x-wirekit::button loading wire:loading >Memproses data...</x-wirekit::button>
        </x-wirekit::stack>
    </x-wirekit::form>
</div>
