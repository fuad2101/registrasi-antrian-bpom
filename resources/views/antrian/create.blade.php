<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Ambil Antrian</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @wirekitStyles
    @livewireStyles()
</head>
<body>
    <div class="flex justify-center flex-col items-center pt-4 mx-auto">
        <h3>Silahkan Ambil Nomor Antrian</h3>
        <x-wirekit::form wire:submit="save" style="max-width: 24rem;">
            <x-wirekit::stack gap="md">
                <x-wirekit::input name="email" label="Email" placeholder="Your email address" />
                <x-wirekit::select
                    label="Layanan"
                    name="layanan"
                    hint="Layanan BPOM Mamuju"
                    :options="['1' => 'Informasi & Konsultasi', '2' => 'Sertifikasi', '3' => 'Pengaduan']"
                    wire:model="layanan"
                    placeholder="Pilih layanan"
                />
                <x-wirekit::button type="submit">Ambil antrian</x-wirekit::button>
                <x-wirekit::button wire:loading>Memproses data...</x-wirekit::button>

            </x-wirekit::stack>
        </x-wirekit::form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    @wirekitScripts
    @livewireScripts()

</body>
</html>
