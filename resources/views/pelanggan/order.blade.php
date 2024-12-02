@extends('app')
@section('content')
<div class="row">
    @foreach ($daftarBarang as $key )
    <div class="col-lg-4">
        <div class="card" style="width: 25rem;">
            <img src="{{ asset('/uploads/products/'. $key->image) }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $key->namaProduct }}</h5>
              <p class="card-text">Rp.{{ number_format($key->harga) }}</p>
              <a href="#" class="btn btn-primary">Pesan</a>
            </div>
          </div>
    </div>
    @endforeach
</div>
@endsection
