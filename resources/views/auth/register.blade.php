@extends('layouts.app')

@section('title', 'Daftar - Garuda Hub')

@section('content')
<div class="project-card">
    <h1>Daftar Garuda Hub</h1>
    <p>Buat akun untuk mulai menggunakan Garuda Hub.</p>

    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <p>
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                style="width:100%;padding:10px;">
        </p>

        <p>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                style="width:100%;padding:10px;">
        </p>

        <p>
            <label>Password</label>
            <input type="password" name="password" required
                style="width:100%;padding:10px;">
        </p>

        <p>
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required
                style="width:100%;padding:10px;">
        </p>

        <p>
            <label>Daftar Sebagai</label>
            <select name="role" required style="width:100%;padding:10px;">
                <option value="">Pilih Peran</option>
                <option value="klien" {{ old('role') == 'klien' ? 'selected' : '' }}>Klien</option>
                <option value="developer" {{ old('role') == 'developer' ? 'selected' : '' }}>Developer</option>
            </select>
        </p>

        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
</div>
@endsection