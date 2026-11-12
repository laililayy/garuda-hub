@extends('layouts.app')

@section('title', 'Dashboard - Garuda Hub')

@section('content')

<div class="page-header">
    <div>
        <h1>Dashboard Garuda Hub</h1>
        <p>Selamat datang, {{ auth()->user()->name }}!</p>
    </div>

    <span>{{ ucfirst(auth()->user()->role) }}</span>
</div>

@if (auth()->user()->role === 'klien')

    <h2>Dashboard Klien</h2>
    <p>Pantau proyek dan penawaran yang masuk.</p>

    <div class="project-info">
        <p>Total Proyek: <strong>{{ $totalProjects }}</strong></p>
        <p>Proyek Terbuka: <strong>{{ $openProjects }}</strong></p>
        <p>Proyek Ditutup: <strong>{{ $closedProjects }}</strong></p>
    </div>

    <a href="{{ route('projects.create') }}" class="btn btn-primary">
        + Buat Proyek
    </a>

    <h3>Proyek Saya</h3>

    @forelse ($projects as $project)
        <div class="project-card">
            <h3>{{ $project->title }}</h3>
            <p>Kategori: {{ $project->category }}</p>
            <p>Status: {{ ucfirst($project->status) }}</p>
            <p>Jumlah Penawaran: {{ $project->bids_count }}</p>

            <a href="{{ route('projects.show', $project->id) }}"
               class="btn btn-primary">
                Lihat Detail
            </a>
        </div>
    @empty
        <p>Belum ada proyek yang dibuat.</p>
    @endforelse

@elseif (auth()->user()->role === 'developer')

    <h2>Dashboard Developer</h2>
    <p>Pantau penawaran dan proyek yang tersedia.</p>

    <div class="project-info">
        <p>Total Penawaran: <strong>{{ $totalBids }}</strong></p>
        <p>Penawaran Menang: <strong>{{ $winningBids }}</strong></p>
        <p>Proyek Terbuka: <strong>{{ $openProjects }}</strong></p>
    </div>

    <a href="{{ route('projects.index') }}" class="btn btn-primary">
        Cari Proyek
    </a>

    <h3>Penawaran Saya</h3>

    @forelse ($bids as $bid)
        <div class="project-card">
            <h3>{{ $bid->project->title }}</h3>
            <p>Harga: Rp{{ number_format((float) $bid->price, 0, ',', '.') }}</p>
            <p>Durasi: {{ $bid->duration }} hari</p>
            <p>Status:
                {{ $bid->is_winner ? 'Pemenang' : 'Belum dipilih' }}
            </p>

            <a href="{{ route('projects.show', $bid->project_id) }}"
               class="btn btn-primary">
                Lihat Proyek
            </a>
        </div>
    @empty
        <p>Kamu belum mengirim penawaran.</p>
    @endforelse

@else

    <h2>Dashboard Admin</h2>
    <p>Ringkasan aktivitas Garuda Hub.</p>

    <div class="project-info">
        <p>Total Pengguna: <strong>{{ $totalUsers }}</strong></p>
        <p>Total Klien: <strong>{{ $totalClients }}</strong></p>
        <p>Total Developer: <strong>{{ $totalDevelopers }}</strong></p>
        <p>Total Proyek: <strong>{{ $totalProjects }}</strong></p>
        <p>Proyek Terbuka: <strong>{{ $openProjects }}</strong></p>
        <p>Proyek Ditutup: <strong>{{ $closedProjects }}</strong></p>
        <p>Total Penawaran: <strong>{{ $totalBids }}</strong></p>
    </div>

    <a href="{{ route('projects.index') }}" class="btn btn-primary">
        Kelola Proyek
    </a>

    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
    Manajemen Pengguna
    </a>

@endif

@endsection