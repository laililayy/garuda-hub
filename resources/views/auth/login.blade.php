@extends('layouts.app')

@section('title', 'Login - Garuda Hub')

@section('content')
<div class="project-card">
    <h1>Login Garuda Hub</h1>
    <p>Masuk ke akun Garuda Hub kamu.</p>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
        @csrf

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

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
</div>
@endsection