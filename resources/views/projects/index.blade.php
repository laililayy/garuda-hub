
@extends('layouts.app')

@section('title', 'Daftar Proyek - Garuda Hub')

@section('extra-style')
    .projects-wrapper {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .projects-summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .projects-count {
        color: #64748b;
        font-size: 13px;
    }

    .projects-count strong {
        color: #1e293b;
        font-size: 15px;
    }

    .project-search {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .project-search input {
        flex: 1;
        min-width: 220px;
    }

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .project-item {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 22px;
        display: flex;
        flex-direction: column;
        gap: 17px;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .project-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(15, 23, 42, .07);
    }

    .project-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }

    .project-category {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 7px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .project-title {
        color: #172b4d;
        font-size: 17px;
        font-weight: 700;
        margin: 0;
    }

    .project-description {
        color: #64748b;
        font-size: 13px;
        line-height: 1.7;
        margin: 0;
    }

    .project-client {
        color: #64748b;
        font-size: 12px;
    }

    .project-client strong {
        color: #334155;
    }

    .project-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        padding: 15px 0;
        border-top: 1px solid #eef2f7;
        border-bottom: 1px solid #eef2f7;
    }

    .project-info small {
        display: block;
        color: #94a3b8;
        font-size: 11px;
        margin-bottom: 5px;
    }

    .project-info strong {
        color: #334155;
        font-size: 13px;
    }

    .project-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-top: auto;
    }

    .project-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .project-status.terbuka {
        color: #15803d;
        background: #dcfce7;
    }

    .project-status.ditutup {
        color: #b45309;
        background: #fef3c7;
    }

    .project-status.selesai {
        color: #2563eb;
        background: #dbeafe;
    }

    .project-detail-btn {
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        color: #2563eb;
        padding: 9px 13px;
        border-radius: 8px;
        background: #eff6ff;
        transition: .2s;
    }

    .project-detail-btn:hover {
        background: #dbeafe;
    }

    .project-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 55px 20px;
        background: #fff;
        border: 1px dashed #cbd5e1;
        border-radius: 14px;
    }

    .project-empty h3 {
        color: #334155;
        margin-bottom: 7px;
    }

    .project-empty p {
        color: #94a3b8;
        font-size: 13px;
    }

    @media (max-width: 760px) {
        .projects-grid {
            grid-template-columns: 1fr;
        }

        .project-search {
            width: 100%;
        }

        .project-search input {
            min-width: 100%;
        }
    }
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1>Daftar Proyek</h1>
        <p>Temukan proyek dan peluang kolaborasi di Garuda Hub.</p>
    </div>

    @if (in_array(auth()->user()->role, ['klien', 'admin']))
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            + Tambah Proyek
        </a>
    @endif
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="projects-wrapper">
    <div class="card">
        <form method="GET" action="{{ route('projects.index') }}" class="project-search">
            <input
                type="text"
                name="search"
                placeholder="Cari judul, kategori, atau deskripsi proyek..."
                value="{{ $search }}"
            >

            <button type="submit" class="btn btn-primary">
                Cari Proyek
            </button>

            <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </form>
    </div>

    <div class="projects-summary">
        <div class="projects-count">
            Menampilkan <strong>{{ $projects->count() }}</strong>
            dari <strong>{{ $projects->total() }}</strong> proyek
        </div>
    </div>

    <div class="projects-grid">
        @forelse ($projects as $project)
            @php
                $statusClass = $project->completed_at
                    ? 'selesai'
                    : ($project->status === 'terbuka' ? 'terbuka' : 'ditutup');

                $statusLabel = $project->completed_at
                    ? 'Selesai'
                    : ucfirst($project->status);
            @endphp

            <div class="project-item">
                <div class="project-top">
                    <div>
                        <span class="project-category">
                            {{ $project->category }}
                        </span>

                        <h3 class="project-title">
                            {{ $project->title }}
                        </h3>
                    </div>

                    <span class="project-status {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>
                </div>

                <p class="project-description">
                    {{ \Illuminate\Support\Str::limit($project->description, 115) }}
                </p>

                <div class="project-client">
                    Dipublikasikan oleh
                    <strong>{{ $project->client->name ?? '-' }}</strong>
                </div>

                <div class="project-info">
                    <div>
                        <small>Rentang Anggaran</small>
                        <strong>
                            Rp{{ number_format($project->budget_min, 0, ',', '.') }}
                            - Rp{{ number_format($project->budget_max, 0, ',', '.') }}
                        </strong>
                    </div>

                    <div>
                        <small>Deadline</small>
                        <strong>{{ $project->deadline->format('d M Y') }}</strong>
                    </div>
                </div>

                <div class="project-bottom">
                    <span class="projects-count">
                        Proyek #{{ $project->id }}
                    </span>

                    <a
                        href="{{ route('projects.show', $project->id) }}"
                        class="project-detail-btn"
                    >
                        Lihat Detail →
                    </a>
                </div>
            </div>
        @empty
            <div class="project-empty">
                <h3>Belum Ada Proyek</h3>
                <p>
                    Tidak ditemukan proyek yang sesuai dengan pencarianmu.
                </p>
            </div>
        @endforelse
    </div>

    <div class="pagination">
        {{ $projects->links() }}
    </div>
</div>
@endsection