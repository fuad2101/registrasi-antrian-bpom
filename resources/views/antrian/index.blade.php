<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Ambil Antrian</title>
</head>
<body>
    <div class="container pt-4">

        <h1>Silahkan Ambil Nomor Antrian</h1>
        <form action="{{route('antrian.post')}}" method="POST" >
            @csrf
            <label for="">Jenis Layanan</label>
            <select name="" id="" class="form-select mb-3" required>
                <option value="informasi_konsultasi">Informasi & Konsultasi</option>
                <option value="sertifikasi">Sertifikasi</option>
                <option value="pengaduan">Pengaduan</option>
            </select>
            <label for="">Nama</label>
            <input type="text" name="" id="" placeholder="Masukkan nama Anda" required class="form-control mb-3">
            <label for="">Nomor Telepon</label>
            <input type="text" name="" id="" placeholder="Masukkan nomor telepon Anda" required class="form-control mb-3">
            <button class="btn btn-success" type="submit">Ambil Antrian</button>
            <button class="btn" type="reset">Reset</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
