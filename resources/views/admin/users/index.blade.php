
@extends('layouts.app')

@section('title', 'Manajemen Pengguna - Garuda Hub')

@section('content')
<div class="page-header">
    <div>
        <h1>Manajemen Pengguna</h1>
        <p>Kelola pengguna yang terdaftar di Garuda Hub.</p>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Pengguna</h3>
        <p>{{ $totalUsers }}</p>
    </div>
    <div class="stat-card">
        <h3>Klien</h3>
        <p>{{ $totalClients }}</p>
    </div>
    <div class="stat-card">
        <h3>Developer</h3>
        <p>{{ $totalDevelopers }}</p>
    </div>
    <div class="stat-card">
        <h3>Admin</h3>
        <p>{{ $totalAdmins }}</p>
    </div>
</div>

<div class="card">
    <form method="GET" action="{{ route('admin.users.index') }}" class="search-form">
        <input
            type="text"
            name="search"
            placeholder="Cari nama atau email..."
            value="{{ $search }}"
        >

        <select name="role">
            <option value="">Semua Role</option>
            <option value="klien" {{ $role === 'klien' ? 'selected' : '' }}>Klien</option>
            <option value="developer" {{ $role === 'developer' ? 'selected' : '' }}>Developer</option>
            <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>

        <button type="submit" class="btn btn-primary">Cari</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Reset</a>
    </form>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $users->firstItem() + $loop->index }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                        <td>
                            @if ($user->role !== 'admin')
                                <form
                                    action="{{ route('admin.users.destroy', $user) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Tidak ada pengguna ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
</div>
@endsection