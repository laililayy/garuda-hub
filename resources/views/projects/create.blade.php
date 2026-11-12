@extends('layouts.app')

@section('title', 'Tambah Proyek - Garuda Hub')

@section('content')

<div class="page-header">
    <div>
        <h1>Tambah Proyek</h1>
        <p>Masukkan informasi proyek yang ingin dilelang.</p>
    </div>

    <a href="{{ route('projects.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

<div class="project-card">

    @if ($errors->any())
        <div class="alert" style="background: #f8d7da; color: #842029;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf

        <p>
            <label>Klien</label><br>
            <select name="client_id" required style="width: 100%; padding: 10px;">
                <option value="">Pilih Klien</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}"
                        {{ old('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Judul Proyek</label><br>
            <input type="text" name="title" value="{{ old('title') }}" required
                style="width: 100%; padding: 10px;">
        </p>

        <p>
            <label>Deskripsi</label><br>
            <textarea name="description" rows="5" required
                style="width: 100%; padding: 10px;">{{ old('description') }}</textarea>
        </p>

        <p>
            <label>Kategori</label><br>
            <input type="text" name="category" value="{{ old('category') }}" required
                style="width: 100%; padding: 10px;">
        </p>

        <p>
            <label>Budget Minimum (Rp)</label><br>
            <input type="number" name="budget_min" value="{{ old('budget_min') }}"
                min="0" required style="width: 100%; padding: 10px;">
        </p>

        <p>
            <label>Budget Maksimum (Rp)</label><br>
            <input type="number" name="budget_max" value="{{ old('budget_max') }}"
                min="0" required style="width: 100%; padding: 10px;">
        </p>

        <p>
            <label>Deadline</label><br>
            <input type="date" name="deadline" value="{{ old('deadline') }}"
                min="{{ date('Y-m-d') }}" required style="width: 100%; padding: 10px;">
        </p>

        <p>
            <label>Status</label><br>
            <select name="status" required style="width: 100%; padding: 10px;">
                <option value="terbuka" {{ old('status', 'terbuka') == 'terbuka' ? 'selected' : '' }}>
                    Terbuka
                </option>
                <option value="ditutup" {{ old('status') == 'ditutup' ? 'selected' : '' }}>
                    Ditutup
                </option>
            </select>
        </p>

        <button type="submit" class="btn btn-primary">
            Simpan Proyek
        </button>
    </form>

</div>

@endsection