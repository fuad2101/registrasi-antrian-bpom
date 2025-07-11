<h2>Nomor Antrian</h2>

<p>{{$antrian}}</p>
<form action="{{}}" method="get" >
    @csrf
    <button class="btn btn-primary" type="submit">Download</button>
</form>
{{-- <p>{{ $antrian->created_at->format('d-m-Y H:i') }}</p> --}}
