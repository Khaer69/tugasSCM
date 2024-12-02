@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    +Tambah Data
                </button>
                {{-- <h3 class="card-title mx-5">Data User</h3> --}}
            </div>
            <div class="card-body">
                <table id="dataTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->roles->pluck('name')->first() }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editModal" onclick="editData({{ $user->id }})">
                                    +Edit Data
                                </button>
                                <button type="button" class="btn btn-danger" onclick="alertHapus({{ $user->id }})">
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
{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.store') }}" method="Post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}


                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kontak" class="form-label">Kontak</label>
                        <input type="kontak" name="kontak" class="form-control @error('kontak') is-invalid
                    
                @enderror" id="kontak" placeholder="Masukkan kontak">
                        @error('kontak')
                        <div class="invalid-feedback">
                            {{ $errors->first('kontak') }}


                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Alamat</label>
                        <input type="lokasi" name="lokasi" class="form-control @error('lokasi') is-invalid
                    
                @enderror" id="lokasi" placeholder="Masukkan lokasi">
                        @error('lokasi')
                        <div class="invalid-feedback">
                            {{ $errors->first('lokasi') }}


                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid
                    
                @enderror" id="email" placeholder="Masukkan Email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}


                        </div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Masukkan Password">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role Pengguna</label>
                        <select class="form-select" aria-label="Default select example" name="role">
                            <option value="" selected>Pilih Role</option>
                            @foreach ($role as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach

                        </select>
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
{{-- End Modal --}}

{{-- Edit Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.update') }}" method="Post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="hidden" class="form-control form-control-solid" id="idEdit" name="id" required />
                        <input type="text" name="name" class="form-control" id="nameEdit" placeholder="Masukkan Nama">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}


                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid
                    
                @enderror" id="emailEdit" placeholder="Masukkan Email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}


                        </div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="passwordEdit"
                            placeholder="Masukkan Password">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role Pengguna</label>
                        <select class="form-select" aria-label="Default select example" name="role" id="roleEdit">
                            <option value="" selected>Pilih Role</option>
                            @foreach ($role as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach

                        </select>
                    </div> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- End Edit --}}
@endsection
@section('script')
<script>
    $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $(document).ready(function() {
            $('#selectRole').select2();
        });


  function editData(id) {
        var _token = "{{ csrf_token() }}";
        $.ajax({
            url: "{{ route('user.edit') }}",
            method: "POST",
            data: {
                _token: _token,
                id: id
            },
            success: function(data) {
                console.log(data);
                $('#idEdit').val(data.id);
                $('#nameEdit').val(data.name);
                $('#emailEdit').val(data.email);
                $('#passwordEdit').val(data.password);

                if ($('#roleEdit option[value="' + data.role + '"]').length > 0) {
                 $('#roleEdit').val(data.role);
                } else {
              $('#roleEdit').val(''); // Default ke "Pilih Role" jika role tidak ditemukan
                }
               

            },
            error: function() {}
        })
    } 
    
    
    function alertHapus(id) {
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
            url: "{{ route('user.delete') }}",
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