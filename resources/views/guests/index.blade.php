@extends('layout.main') 
@push('scripts') 
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
@endpush    
@section('title', 'Daftar Tamu UPT TIK UNS')
@section('container')
<div class="container">
  <div class="row">
    <div class="col-10">
      <h1 class="mt-3">Daftar Tamu UPT TIK UNS</h1>
      <a class="btn btn-success my-3" data-toggle="modal" data-target="#modal-tambah">Tambah Data Tamu</a>

      {{-- ALERT --}}
      @if (session('tambah'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('tambah') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @elseif (session('update'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{ session('update') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      @elseif (session('hapus'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('hapus') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      @endif
      {{-- END ALERT --}}

      {{-- MODAL TAMBAH DATA --}}
      <div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="tambahModalLabel">Form Tambah Tamu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="/guests">
                @csrf
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan nama" name="nama" value="{{old('nama')}}">
                  @error('nama')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="unit">Unit/Instansi</label>
                  <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" placeholder="Masukkan unit" name="unit" value="{{old('unit')}}">
                  @error('unit')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="description">Keterangan</label>
                  <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Keterangan kegiatan" name="description" value="{{old('description')}}">
                  @error('description')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Tambah Data</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      {{-- END MODAL TAMBAH DATA --}}

      {{-- MODAL DETAIL --}}
      <div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detail Buku Tamu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h5 id="detail-nama"></h5>
              <h6 id="detail-unit" class="mb-2 text-muted"></h6>
              <p id="detail-tanggal"></p>
              <p id="detail-description"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      
      {{-- END MODAL DETAIL --}}

      {{-- MODAL EDIT DATA --}}
      {{-- <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="tambahModalLabel">Form Edit Tamu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="/guests/{{$guest->id}}">
                @method('put')
                @csrf
                <div class="form-group">
                  <label for="edit-nama">Nama</label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" id="edit-nama" placeholder="Masukkan nama" name="nama">
                  @error('nama')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="edit-unit">Unit/Instansi</label>
                  <input type="text" class="form-control @error('unit') is-invalid @enderror" id="edit-unit" placeholder="Masukkan unit" name="unit">
                  @error('unit')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="edit-description">Keterangan</label>
                  <input type="text" class="form-control @error('description') is-invalid @enderror" id="edit-description" placeholder="Keterangan kegiatan" name="description">
                  @error('description')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
<<<<<<< HEAD
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Update Data</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
=======
                @endif
                <table class="table display" id="guest-datatable" style="width:100%">
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
                              {{-- tombol detail --}}
                                <a id="detail" class="btn btn-primary" data-toggle="modal" data-target="#modal-detail"
                                data-nama = "{{$guest->nama}}"
                                data-unit = "{{$guest->unit}}"
                                data-tanggal = "{{$guest->created_at}}"
                                data-description = "{{$guest->description}}"
                                >Details</a>

                                {{-- tombol edit --}}
                                <a id="edit" class="btn btn-success edit" data-toggle="modal" data-target="#modal-edit"
                                data-id = "{{ $guest->id }}"
                                data-nama = "{{$guest->nama}}"
                                data-unit = "{{$guest->unit}}"
                                data-description = "{{$guest->description}}">Edit</a>

                                {{-- tombol hapus --}}
                                <form action="/guests/{{$guest->id}}" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                  @method('delete')
                                  @csrf
                                  <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        @endforeach

                        {{-- MODAL DETAIL --}}
                        <div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Buku Tamu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h5 id="detail-nama"></h5>
                                <h6 id="detail-unit" class="mb-2 text-muted"></h6>
                                <p id="detail-tanggal"></p>
                                <p id="detail-description"></p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- END MODAL DETAIL --}}
                        
                        {{-- MODAL EDIT DATA --}}
                        <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="tambahModalLabel">Form Tambah Tamu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="/guests" method="post" id="editForm">
                                  @method('PUT')
                                  @csrf
                                  
                                  <div class="form-group">
                                    <label for="enama">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="enama" placeholder="Masukkan nama" name="enama">
                                    @error('enama')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                    @enderror
                                  </div>
        
                                  <div class="form-group">
                                    <label for="eunit">Unit/Instansi</label>
                                    <input type="text" class="form-control @error('eunit') is-invalid @enderror" id="eunit" placeholder="Masukkan unit" name="eunit">
                                    @error('eunit')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                    @enderror
                                  </div>
        
                                  <div class="form-group">
                                    <label for="edescription">Keterangan</label>
                                    <input type="text" class="form-control @error('edescription') is-invalid @enderror" id="edescription" placeholder="Keterangan kegiatan" name="edescription">
                                    @error('edescription')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                    @enderror
                                  </div>
        
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update Data</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
        
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- END MODAL EDIT DATA --}}
                        
                        
                    </tbody>
                </table>



              </div>
>>>>>>> 5ffa86b53eb288be59f9091af8bf6e7fbc7731a1
            </div>
          </div>
        </div>
      </div> --}}
      {{-- END MODAL EDIT DATA --}}

      {{-- DATATABLE --}}
      <table class="table display" id="guest" style="width:100%">
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
                      <a id="detail" class="btn btn-primary" data-toggle="modal" data-target="#modal-detail"
                      data-nama = "{{$guest->nama}}"
                      data-unit = "{{$guest->unit}}"
                      data-tanggal = "{{$guest->created_at}}"
                      data-description = "{{$guest->description}}"
                      >Details</a>
                      {{-- <a id="edit" class="btn btn-success" data-toggle="modal" data-target="#modal-edit"
                      data-nama = "{{$guest->nama}}"
                      data-unit = "{{$guest->unit}}"
                      data-description = "{{$guest->description}}">Edit</a> --}}
                      <a href="/guests/{{$guest->id}}/edit" class="btn btn-warning">Edit</a>
                      <form action="/guests/{{$guest->id}}" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus</button>
                      </form>
                  </td>
              </tr>
              @endforeach              
          </tbody>
      </table>
      {{-- END DATATABLE --}}
      
    </div>
  </div>

</div>

<script>
  $('.alert').alert('')
</script>

{{-- DATATABLE --}}
<script>
    $(document).ready(function() {
    $('#guest-datatable').DataTable();
} );
</script>


{{-- MODAL DETAIL --}}
<script>
  $(document).ready(function(){
    $(document).on('click', '#detail', function(){
      var nama = $(this).data('nama');
      var unit = $(this).data('unit');
      var tanggal = $(this).data('tanggal');
      var description = $(this).data('description');

      $('#detail-nama').text(nama);
      $('#detail-unit').text(unit);
      $('#detail-tanggal').text(tanggal);
      $('#detail-description').text(description);
    })
  });
</script>
@endsection

{{-- MODAL EDIT --}}
{{-- <script>
  $(document).ready(function(){
    $(document).on('click', '#edit', function(){
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var unit = $(this).data('unit');
      var description = $(this).data('description');

      $('#enama').val(nama);
      $('#eunit').val(unit);
      $('#edescription').val(description);

      $('#editForm').attr('action', '/guests/'+id);

    })
  });
</script> --}}