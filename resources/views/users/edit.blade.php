@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User: {{ $user->name }}</h1>
    <hr>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru (opsional)</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            <div class="form-text">Kosongkan jika tidak ingin mengubah password.</div>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" onchange="toggleKelas(this.value)">
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="tu" {{ old('role', $user->role) == 'tu' ? 'selected' : '' }}>Tata Usaha</option>
                <option value="wali_kelas" {{ old('role', $user->role) == 'wali_kelas' ? 'selected' : '' }}>Wali Kelas</option>
            </select>
            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3" id="kelas-container" style="display:{{ old('role', $user->role) == 'wali_kelas' ? 'block' : 'none' }};">
            <label for="kelas_id" class="form-label">Pilih Kelas (untuk Wali Kelas)</label>
            <select class="form-select @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id">
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ old('kelas_id', $user->kelas_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
            @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    function toggleKelas(role) {
        const kelasContainer = document.getElementById('kelas-container');
        if (role === 'wali_kelas') {
            kelasContainer.style.display = 'block';
        } else {
            kelasContainer.style.display = 'none';
        }
    }
</script>
@endsection