@extends('layouts.app')

@section('title', 'Detail Proyek - Garuda Hub')

@section('content')

    <div class="page-header">
        <div>
            <h1>Detail Proyek</h1>
            <p>Informasi lengkap proyek yang tersedia.</p>
        </div>

        <a href="{{ route('projects.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <div class="project-card">

        <h2>{{ $project->title }}</h2>

        <div class="project-info">
            <p><strong>Klien:</strong> {{ $project->client->name }}</p>
            <p><strong>Kategori:</strong> {{ $project->category }}</p>

            <p>
                <strong>Budget:</strong>
                Rp{{ number_format((float) $project->budget_min, 0, ',', '.') }}
                -
                Rp{{ number_format((float) $project->budget_max, 0, ',', '.') }}
            </p>

            <p>
                <strong>Deadline:</strong>
                {{ $project->deadline->format('d-m-Y') }}
            </p>

            <p><strong>Status:</strong> {{ ucfirst($project->status) }}</p>

            <p>
                <strong>Dibuat pada:</strong>
                {{ $project->created_at->format('d-m-Y H:i') }}
            </p>
        </div>

        <hr>

        <h3>Deskripsi Proyek</h3>
        <p>{{ $project->description }}</p>

        <hr>

        <h3>Daftar Penawaran (Bids)</h3>

        @forelse ($project->bids as $bid)
            <div class="project-card">
                <p><strong>Developer:</strong> {{ $bid->developer->name }}</p>
                <p><strong>Harga Penawaran:</strong> Rp{{ number_format((float) $bid->price, 0, ',', '.') }}</p>
                <p><strong>Durasi:</strong> {{ $bid->duration }} hari</p>
                <p><strong>Proposal:</strong> {{ $bid->proposal }}</p>
                <p>
                    <strong>Status:</strong>
                    {{ $bid->is_winner ? 'Pemenang' : 'Belum dipilih' }}
                </p>
            </div>
        @empty
            <p>Belum ada penawaran untuk proyek ini.</p>
        @endforelse

    </div>

@endsection