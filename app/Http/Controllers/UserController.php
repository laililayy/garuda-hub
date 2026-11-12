<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $role = $request->query('role');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($role, function ($query, $role) {
                $query->where('role', $role);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalUsers = User::count();
        $totalClients = User::where('role', 'klien')->count();
        $totalDevelopers = User::where('role', 'developer')->count();
        $totalAdmins = User::where('role', 'admin')->count();

        return view('admin.users.index', compact(
            'users',
            'search',
            'role',
            'totalUsers',
            'totalClients',
            'totalDevelopers',
            'totalAdmins'
        ));
    }

    public function destroy(User $user)
    {
        if ((int) $user->id === (int) auth()->id()) {
            return back()->withErrors([
                'user' => 'Kamu tidak dapat menghapus akun sendiri.'
            ]);
        }

        if ($user->role === 'admin') {
            return back()->withErrors([
                'user' => 'Akun admin tidak dapat dihapus melalui panel ini.'
            ]);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
