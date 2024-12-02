@extends('app')
@section('content')
<div class="row">
    @foreach ($dis as $key )
    <div class="col-lg-3 my-2">
       <a href="{{ route('daftar_barang', $key->id) }}" class="text-decoration-none">
        <div class="card">
            <div class="card-body">
              {{ $key->nameUsers }}
            </div>
          </div>
       </a>
    </div>
    @endforeach
</div>



  
@endsection
