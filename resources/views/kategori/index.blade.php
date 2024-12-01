@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex">
                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Tambah Data
                </button>
                <h3 class="card-title">Data Kategori</h3>
            </div>
            <div class="card-body">
                <table id="dataKategori" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-left">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Tanggal Di Buat</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoris as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->nama }}</td>
                            <td class="text-center">{{ date('d-m-Y', strtotime($k->created_at)) }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" 
                                data-bs-target="#editData" onclick="EditKategori({{ $k->id }})">
                                  Edit
                                </button>
                                <button type="button" class="btn btn-danger"
                                 onclick="hapusKategori({{ $k->id }})">
                                Hapus
                            </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Kategori</label>
              <input type="text" name="nama" class="form-control" id="nama" placeholder="Enter Kategori Product">
            </div>
            <div class="mb-3">
              <label for="text" class="form-label">Tanggal</label>
              <input type="date" name="created_at" class="form-control" id="text" placeholder="Enter Email">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
          </form>
         
        </div>
      
      </div>
    </div>
  </div>

  {{-- Edit Modal --}}
  <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editDataLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('kategori.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <input type="hidden" id="editId" name="id">
                  <label for="name" class="form-label">Kategori</label>
                  <input type="text" name="nama" class="form-control" id="editNama" placeholder="Enter Kategori Product">
                </div>
                <div class="mb-3">
                  <label for="text" class="form-label">Tanggal</label>
                  <input type="date" name="created_at" class="form-control" id="editTanggal" placeholder="Enter Email">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                  </div>
              </form>
        </div>
       
      </div>
    </div>
  </div>
  {{-- end --}}
@endsection

@section('script')
<script>
    $(document).ready(function() {
            $('#dataKategori').DataTable();
        });

        $(document).ready(function() {
            $('#selectRole').select2();
        });


  function EditKategori(id) {
        var _token = "{{ csrf_token() }}";
        $.ajax({
            url: "{{ route('kategori.edit') }}",
            method: "POST",
            data: {
                _token: _token,
                id: id
            },
            success: function(data) {
                console.log(data);
                $('#editId').val(data.id);
                $('#editNama').val(data.nama);
                var createdAt = new Date(data.created_at).toISOString().split('T')[0];
               // Set nilai pada input
             $('#editTanggal').val(createdAt);
              

                
               

            },
            error: function() {}
        })
    } 
    
    
    function hapusKategori(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus User",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya'
        }).then((result) => {
            if (result.isConfirmed) {
                hapus(id);
            }
        })
    }

    function hapus(id) {
        var _token = "{{ csrf_token() }}";
        $.ajax({
            url: "{{ route('kategori.delete') }}",
            method: "POST",
            data: {
                _token: _token,
                id: id
            },
            beforeSend: function() {
                Swal.fire({
                    title: 'Mohon Tunggu',
                    icon: 'warning',
                    showCancelButton: false,
                    showConfirmButton: false
                });
            },
            success: function(data) {
                console.log(data);
                Swal.fire({
                    title: 'Success',
                    text: data.message,
                    icon: 'success',
                });
                setTimeout(() => {
                    location.reload()
                }, 1000);
            },
            error: function() {}
        })
    }



</script>
@endsection