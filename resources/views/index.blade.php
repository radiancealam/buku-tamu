<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

    <title>Daftar Tamu UPT TIK UNS</title>
  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 text-center">Daftar Tamu UPT TIK UNS</h1>

                <a class="btn btn-primary my-3" data-toggle="modal" data-target="#modal-tambah">Tambah Data Tamu</a>
                
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
                        <form method="post" action="/">
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
                          <div class="form-group">
                            <label for="nip">NIP / NIM</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" placeholder="Masukkan nip" name="nip" value="{{old('nip')}}">
                            @error('nip')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="phone">No. HP / Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Masukkan phone" name="phone" value="{{old('phone')}}">
                            @error('phone')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>

                          {{-- BUTTON --}}
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- END MODAL TAMBAH DATA --}}

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
                <table class="table display" id="guest-datatable" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Unit</th>
                            <th scope="col">No. Telepon</th>
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
                            <td>{{$guest->phone}}</td>
                            <td>
                              {{-- tombol detail --}}
                                <a id="detail" class="btn btn-primary" data-toggle="modal" data-target="#modal-detail"
                                data-nama = "{{$guest->nama}}"
                                data-unit = "{{$guest->unit}}"
                                data-tanggal = "{{$guest->created_at}}"
                                data-description = "{{$guest->description}}"
                                data-nip = "{{$guest->nip}}"
                                data-phone = "{{$guest->phone}}"
                                >Detail</a>

                                {{-- tombol edit --}}
                                <a id="edit" class="btn btn-success edit" data-toggle="modal" data-target="#modal-edit"
                                data-id = "{{ $guest->id }}"
                                data-nama = "{{$guest->nama}}"
                                data-unit = "{{$guest->unit}}"
                                data-description = "{{$guest->description}}"
                                data-nip = "{{$guest->nip}}"
                                data-phone = "{{$guest->phone}}"
                                >Edit</a>

                                {{-- tombol hapus --}}
                                <form action="/{{$guest->id}}" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                  @method('delete')
                                  @csrf
                                  <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>

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
                                <h6 class="mb-2 text-muted">Unit</h6>
                                <p id="detail-unit"></p>
                                <h6 class="mb-2 text-muted">Tanggal</h6>
                                <p id="detail-tanggal"></p>
                                <h6 class="mb-2 text-muted">NIP / NIM</h6>
                                <p id="detail-nip"></p>
                                <h6 class="mb-2 text-muted">No. Telepon / HP</h6>
                                <p id="detail-phone"></p>
                                <h6 class="mb-2 text-muted">Keperluan</h6>
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
                                <form action="/" method="post" id="editForm">
                                  @method('PUT')
                                  @csrf
                                  
                                  <div class="form-group">
                                    <label for="enama">Nama</label>
                                    <input type="text" class="form-control @error('enama') is-invalid @enderror" id="enama" placeholder="Masukkan nama" name="enama">
                                    @error('enama')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                    @enderror
                                  </div>

                                  <div class="form-group">
                                    <label for="enip">NIP / NIM</label>
                                    <input type="text" class="form-control @error('enip') is-invalid @enderror" id="enip" placeholder="Masukkan nama" name="enip">
                                    @error('enip')
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

                                  <div class="form-group">
                                    <label for="ephone">No. HP / Telepon</label>
                                    <input type="text" class="form-control @error('ephone') is-invalid @enderror" id="ephone" placeholder="Masukkan nama" name="ephone">
                                    @error('ephone')
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
                        
                        @endforeach
                    </tbody>
                </table>



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
      var nip = $(this).data('nip');
      var phone = $(this).data('phone');

      $('#detail-nama').text(nama);
      $('#detail-unit').text(unit);
      $('#detail-tanggal').text(tanggal);
      $('#detail-description').text(description);
      $('#detail-nip').text(nip);
      $('#detail-phone').text(phone);
    })
  });
</script>

{{-- MODAL EDIT --}}
<script>
  $(document).ready(function(){
    $(document).on('click', '#edit', function(){
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var unit = $(this).data('unit');
      var description = $(this).data('description');
      var nip = $(this).data('nip');
      var phone = $(this).data('phone');

      $('#enama').val(nama);
      $('#eunit').val(unit);
      $('#edescription').val(description);
      $('#enip').val(nip);
      $('#ephone').val(phone);

      // Tambahkan ID di action
      $('#editForm').attr('action', '/'+id);
    })
  });
</script>

</body>
</html>