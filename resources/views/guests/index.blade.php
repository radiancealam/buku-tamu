@extends('layout.main')

@section('title', 'Daftar Tamu UPT TIK UNS')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-10">
            <h1 class="mt-3">Daftar Tamu UPT TIK UNS</h1>

            <a href="/guests/create" class="btn btn-primary my-3">Tambah Data Tamu</a>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guests as $guest)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$guest->created_at}}</td>
                        <td>{{$guest->nama}}</td>
                        <td>{{$guest->unit}}</td>
                        <td>
                            <a href="/guests/{{$guest->id}}" class="btn btn-primary">Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('#example').DataTable();
    } );
</script>

@endsection