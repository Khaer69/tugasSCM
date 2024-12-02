@extends('guest')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card p-3">
            <div class="card-header">
                <h2>Daftar Akun</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid
                            
                        @enderror" id="name" placeholder="Masukkan Nama">
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
                        <div class="input-group">
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control" 
                                id="password" 
                                placeholder="Masukkan Password"
                                required
                            >
                            <button 
                                class="btn btn-outline-secondary" 
                                type="button" 
                                id="togglePassword"
                            >
                                <i class="bi bi-eye-slash" id="passwordIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                class="form-control" 
                                id="password_confirmation" 
                                placeholder="Masukkan password_confirmation"
                                required
                            >
                            <button 
                                class="btn btn-outline-secondary" 
                                type="button" 
                                id="togglepassword_confirmation"
                            >
                                <i class="bi bi-eye-slash" id="passwordIcons"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role Pengguna</label>
                        <select class="form-select" aria-label="Default select example" name="role">
                            <option value="" selected>Pilih Role</option>
                            {{-- @foreach ($role as $role) --}}
                            <option value="{{ $role->nama }}">{{ $role->name }}</option>
                            {{-- @endforeach --}}
                        </select>
                    </div>
                      <div class="row">
                        <div class="col-lg-6 d-flex">
                            <a href="/login" class="btn btn-secondary mx-3">Sudah Punya Akun</a>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                       
                      </div>
                </form>
            </div>
           
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');
    const passwordIcon = document.querySelector('#passwordIcon');

    togglePassword.addEventListener('click', function () {
        // Toggle tipe input antara 'password' dan 'text'
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Ganti ikon
        passwordIcon.classList.toggle('bi-eye');
        passwordIcon.classList.toggle('bi-eye-slash');
    });
</script>
<script>
    const togglePasswords = document.querySelector('#togglepassword_confirmation');
    const passwordFields = document.querySelector('#password_confirmation');
    const passwordIcons = document.querySelector('#passwordIcons');

    togglePasswords.addEventListener('click', function () {
        // Toggle tipe input antara 'password' dan 'text'
        const type = passwordFields.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordFields.setAttribute('type', type);

        // Ganti ikon
        passwordIcons.classList.toggle('bi-eye');
        passwordIcons.classList.toggle('bi-eye-slash');
    });
</script>
@endsection