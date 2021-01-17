@extends('layout.main')

@section('title', 'Detail Tamu')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-3">Detail Mahasiswa</h1>
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{$guest->nama}}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">{{$guest->unit}}</h6>
                  <p class="card-text">{{$guest->tanggal}}</p>
                  <p class="card-text">{{$guest->description}}</p>

                  <a href="{{$guest->id}}/edit" class="btn btn-primary">Edit</a>

                  <form action="/guests/{{$guest->id}}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus</button>
                  </form>
                  <a href="/guests" class="card-link">Kembali</a>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection