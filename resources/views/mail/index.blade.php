<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Antrian</title>
    @vite('resources\css\app.css')
</head>
<body>
    <div class="p-4 bg-white rounded-lg shadow-md mx-0 md:mx-auto md:w-1/2 align-middle text-center mt-3">
        <h3 class="text-lg font-bold">Registrasi antrian Berhasil</h3>
        <p>Halo kak registrasi kamu berhasil </p>
        <div class="mt-4 text-left ml-3 border-collapse border border-gray-300 p-4 rounded-lg">
            <p class="font-semibold text-xl">Nomor Antrian: {{ $antrian->nomor_antrian }}</p>
            <p class="font-semibold text-xl">Nama: {{ $antrian->nama }}</p>
            <p class="font-semibold text-xl">Tanggal: {{ $antrian->tanggal }}</p>
            <p class="font-semibold text-xl">Waktu: {{ $antrian->waktu }}</p>
            <p class="font-semibold text-xl">Jenis Layanan: {{ $antrian->jenis_layanan }}</p>
            <p class="font-semibold text-xl">Email: {{ $antrian->email }}</p>
            <p class="font-semibold text-xl">No. HP: {{ $antrian->no_hp }}</p>
            <p class="font-semibold text-xl">Alamat: {{ $antrian->alamat }}</p>
        </div>
        <p class="mt-4">Silahkan datang sesuai dengan waktu layanan kami Senin-Jum'at pukul 07.30-16.00 Wita. Terima kasih</p>
    </div>
</body>
</html>
