@extends('app')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card mt-5">
           <div class="p-3">
            <h1 class="text-center "> Selamat Datang <span>{{ Auth()->user()->name }}</span></h1>
            <h3 class="text-center">{{ auth()->user()->roles->pluck('name')->first() }}</h3>
           </div>
        </div>
    </div>
</div>
@endsection