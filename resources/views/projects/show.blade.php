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
                
                <hr>

                <h4>Edit Penawaran</h4>

                <form action="{{ route('bids.update', $bid->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <p>
                        <label>Harga Penawaran (Rp)</label><br>
                        <input type="number" name="price"
                            value="{{ $bid->price }}"
                            min="0" required
                            style="width: 100%; padding: 10px;">
                    </p>

                    <p>
                        <label>Durasi Pengerjaan (Hari)</label><br>
                        <input type="number" name="duration"
                            value="{{ $bid->duration }}"
                            min="1" required
                            style="width: 100%; padding: 10px;">
                    </p>

                    <p>
                        <label>Proposal</label><br>
                        <textarea name="proposal" rows="3" required
                            style="width: 100%; padding: 10px;">{{ $bid->proposal }}</textarea>
                    </p>

                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                </form>

                <form action="{{ route('bids.destroy', $bid->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus penawaran ini?')"
                    style="margin-top: 10px;">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Hapus Penawaran
                    </button>
                </form>

            </div>
        @empty
            <p>Belum ada penawaran untuk proyek ini.</p>
        @endforelse

    </div>

    <hr>

    <h3>Ajukan Penawaran</h3>

    @if ($errors->any())
        <div class="alert" style="background: #f8d7da; color: #842029;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($project->status === 'open')
        <form action="{{ route('bids.store', $project->id) }}" method="POST">
            @csrf

            <p>
                <label>Developer</label><br>
                <select name="developer_id" required style="width: 100%; padding: 10px;">
                    <option value="">Pilih Developer</option>
                    @foreach (\App\Models\User::where('role', 'developer')->get() as $developer)
                        <option value="{{ $developer->id }}">
                            {{ $developer->name }}
                        </option>
                    @endforeach
                </select>
            </p>

            <p>
                <label>Harga Penawaran (Rp)</label><br>
                <input type="number" name="price" min="0" required
                    style="width: 100%; padding: 10px;">
            </p>

            <p>
                <label>Durasi Pengerjaan (Hari)</label><br>
                <input type="number" name="duration" min="1" required
                    style="width: 100%; padding: 10px;">
            </p>

            <p>
                <label>Proposal</label><br>
                <textarea name="proposal" rows="4" required
                    style="width: 100%; padding: 10px;"></textarea>
            </p>

            <button type="submit" class="btn btn-primary">
                Kirim Penawaran
            </button>
        </form>
    @else
        <p>Proyek ini sudah tidak menerima penawaran.</p>
    @endif
</div>


@endsection