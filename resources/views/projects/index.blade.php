@extends('layouts.app')

@section('title', 'Daftar Proyek - Garuda Hub')

@section('content')

    <div class="page-header">
        <div>
            <h1>Daftar Proyek</h1>
            <p>Kelola seluruh proyek yang tersedia di Garuda Hub.</p>
        </div>

        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            + Tambah Proyek
        </a>
    </div>

    @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($projects as $project)

        <div class="project-card">

            <h3>{{ $project->title }}</h3>

            <div class="project-info">
                <p>
                    Kategori: {{ $project->category }}
                </p>

                <p>
                    Klien: {{ $project->client->name }}
                </p>

                <p>
                    Budget:
                    Rp{{ number_format((float) $project->budget_min, 0, ',', '.') }}
                    -
                    Rp{{ number_format((float) $project->budget_max, 0, ',', '.') }}
                </p>

                <p>
                    Deadline: {{ $project->deadline->format('d-m-Y') }}
                </p>

                <p>
                    Status: {{ ucfirst($project->status) }}
                </p>
            </div>

            <p>{{ Str::limit($project->description, 150) }}</p>

            <div class="actions">

                <a href="{{ route('projects.show', $project->id) }}"
                   class="btn btn-primary">
                    Detail
                </a>

                <a href="{{ route('projects.edit', $project->id) }}"
                   class="btn btn-secondary">
                    Edit
                </a>

                <form action="{{ route('projects.destroy', $project->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus proyek ini?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>
                </form>

            </div>

        </div>

    @empty

        <div class="project-card">
            <p>Belum ada proyek yang tersedia.</p>
        </div>

    @endforelse

    <div class="pagination">
        {{ $projects->links() }}
    </div>

@endsection