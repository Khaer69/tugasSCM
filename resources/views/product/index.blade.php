@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex">
                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Tambah Data
                </button>
                <h3 class="card-title">Data Product</h3>
            </div>
            <div class="card-body">
                <table id="dataKategori" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-left">No</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Product</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Tanggal Di Buat</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('/uploads/products/'. $k->image) }}" alt="" width="100px;"> </td>
                            <td>{{ $k->kategori->nama }}</td>
                            <td>{{ $k->name }}</td>
                            <td>{{ $k->quantity }}</td>
                            <td>{{ number_format($k->harga) }}</td>
                            <td class="text-center">{{ date('d-m-Y', strtotime($k->created_at)) }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" 
                                data-bs-target="#editProduct" onclick="EditProduct({{ $k->id }})">
                                  Edit
                                </button>
                                <button type="button" class="btn btn-danger"
                                 onclick="hapusProduct({{ $k->id }})">
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Kategori Product</label>
              <select class="form-select" aria-label="Default select example" name="kategori_id">
                <option selected value="">Pliih Kategori</option>
                @foreach ($kategori as  $k)
                <option value="{{ $k->id }}">{{ $k->nama }}</option>
              
                @endforeach
               
              </select>
            </div>

            <div class="mb-3"> 
                <label for="text" class="form-label">Image Product</label>
                <img id="imagePreview" src="" alt="Preview Image" style="max-width: 100%; height: auto; margin-bottom: 10px; display: none;">
    
                <input type="file" name="image" class="form-control" id="image">
            </div>
            <div class="mb-3"> 
                <label for="text" class="form-label">Nama Product</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Product">
            </div>
            <div class="mb-3">
                <textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="floatingTextarea"></textarea>
               
            </div>
            <div class="mb-3"> 
                <label for="text" class="form-label">Jumlah Product</label>
                <input type="number" name="quantity" class="form-control" id="jumlah" placeholder="Enter Jumlah">
            </div>
            <div class="mb-3">
                <label for="Harga" class="form-label">Harga Produk</label>
                <input 
                    type="text" 
                    name="harga" 
                    class="form-control" 
                    id="HargaProduk" 
                    placeholder="Enter Harga Produk">
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
  <div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editDataLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Kategori Product</label>
                  <select class="form-select" aria-label="Default select example" name="kategori_id">
                    <option selected value="">Pliih Kategori</option>
                    @foreach ($kategori as  $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                  
                    @endforeach
                   
                  </select>
                </div>
    
                <div class="mb-3"> 
                    <label for="text" class="form-label">Image Product</label>
                    <img id="imagePreview" src="" alt="Preview Image" style="max-width: 100%; height: auto; margin-bottom: 10px; display: none;">
        
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <div class="mb-3"> 
                    <label for="text" class="form-label">Nama Product</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama Product">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="deskripsi"></textarea>
                   
                </div>
                <div class="mb-3"> 
                    <label for="text" class="form-label">Jumlah Product</label>
                    <input type="number" name="quantity" class="form-control" id="jumlah" placeholder="Enter Jumlah">
                </div>
                <div class="mb-3">
                    <label for="Harga" class="form-label">Harga Produk</label>
                    <input 
                        type="text" 
                        name="harga" 
                        class="form-control" 
                        id="HargaProduk" 
                        placeholder="Enter Harga Produk">
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
  {{-- end --}}
@endsection

@section('script')
<script>
    document.getElementById('HargaProduk').addEventListener('input', function(e) {
    let value = e.target.value.replace(/[^0-9]/g, ''); // Hanya angka
    e.target.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Tambahkan format ribuan
});

document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0]; // Ambil file yang dipilih
    const preview = document.getElementById('imagePreview'); // Ambil elemen img untuk preview

    if (file) {
        const reader = new FileReader(); // Inisialisasi FileReader
        reader.onload = function(e) {
            preview.src = e.target.result; // Set source dari gambar preview
            preview.style.display = 'block'; // Tampilkan elemen gambar
        };
        reader.readAsDataURL(file); // Baca file sebagai Data URL
    } else {
        preview.src = ''; // Kosongkan src jika tidak ada file
        preview.style.display = 'none'; // Sembunyikan gambar
    }
});

    $(document).ready(function() {
            $('#dataKategori').DataTable();
        });

      


  function EditProduct(id) {
        var _token = "{{ csrf_token() }}";
        $.ajax({
            url: "{{ route('product.edit') }}",
            method: "POST",
            data: {
                _token: _token,
                id: id
            },
            success: function(data) {
                console.log(data);
                $('#editId').val(data.id);
                $('#name').val(data.name);
                $('#kategori_id').val(data.kategori_id);
                $('#jumlah').val(data.quantity);
                $('#deskripsi').val(data.deskripsi);
             
              

                
               

            },
            error: function() {}
        })
    } 
    
    
    function hapusProduct(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus Product",
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
            url: "{{ route('product.delete') }}",
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