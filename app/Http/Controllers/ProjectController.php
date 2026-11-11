<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    // Menampilkan seluruh proyek
    public function index()
    {
        $projects = Project::with('client')
            ->latest()
            ->paginate(10);

        return view('projects.index', compact('projects'));
    }

    // Menampilkan form tambah proyek
    public function create()
    {
        $clients = User::where('role', 'klien')->get();

        return view('projects.create', compact('clients'));
    }

    // Menyimpan proyek baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => [
                'required',
                Rule::exists('users', 'id')->where('role', 'klien'),
            ],
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'budget_min' => 'required|numeric|min:0',
            'budget_max' => 'required|numeric|gt:budget_min',
            'deadline' => 'required|date|after_or_equal:today',
            'status' => 'required|in:open,closed,completed',
        ]);

        Project::create($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Proyek berhasil ditambahkan.');
    }

    // Menampilkan detail proyek
    public function show(Project $project)
    {
        $project->load(['client', 'bids.developer']);

        return view('projects.show', compact('project'));
    }

    // Menampilkan form edit proyek
    public function edit(Project $project)
    {
        $clients = User::where('role', 'klien')->get();

        return view('projects.edit', compact('project', 'clients'));
    }

    // Memperbarui data proyek
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'client_id' => [
                'required',
                Rule::exists('users', 'id')->where('role', 'klien'),
            ],
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'budget_min' => 'required|numeric|min:0',
            'budget_max' => 'required|numeric|gt:budget_min',
            'deadline' => 'required|date',
            'status' => 'required|in:open,closed,completed',
        ]);

        $project->update($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Proyek berhasil diperbarui.');
    }

    // Menghapus proyek
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }
}