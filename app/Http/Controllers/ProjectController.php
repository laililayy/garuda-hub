<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $projects = Project::with('client')
            ->when(auth()->user()->role === 'klien', function ($query) {
                $query->where('client_id', auth()->id());
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('projects.index', compact('projects', 'search'));
    }

    public function create()
    {
        $clients = User::where('role', 'klien')->get();

        return view('projects.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'category' => 'required|string|max:50',
            'budget_min' => 'required|numeric|min:0',
            'budget_max' => 'required|numeric|gte:budget_min',
            'deadline' => 'required|date|after_or_equal:today',
            'status' => ['required', Rule::in(['terbuka', 'ditutup'])],
        ]);

        $validated['client_id'] = auth()->user()->role === 'admin'
            ? $request->validate([
                'client_id' => [
                    'required',
                    Rule::exists('users', 'id')->where('role', 'klien'),
                ],
            ])['client_id']
            : auth()->id();

        Project::create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function show(Project $project)
    {
        $project->load(['client', 'bids.developer']);

        $developers = User::where('role', 'developer')->get();

        return view('projects.show', compact('project', 'developers'));
    }

    public function edit(Project $project)
    {
        $this->authorizeProject($project);

        $clients = User::where('role', 'klien')->get();

        return view('projects.edit', compact('project', 'clients'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeProject($project);

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'category' => 'required|string|max:50',
            'budget_min' => 'required|numeric|min:0',
            'budget_max' => 'required|numeric|gte:budget_min',
            'deadline' => 'required|date',
            'status' => ['required', Rule::in(['terbuka', 'ditutup'])],
        ]);

        if (auth()->user()->role === 'admin') {
            $validated['client_id'] = $request->validate([
                'client_id' => [
                    'required',
                    Rule::exists('users', 'id')->where('role', 'klien'),
                ],
            ])['client_id'];
        }

        $project->update($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $this->authorizeProject($project);

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }

    private function authorizeProject(Project $project): void
    {
        if (
            auth()->user()->role !== 'admin' &&
            (int) $project->client_id !== (int) auth()->id()
        ) {
            abort(403, 'Kamu tidak memiliki akses ke proyek ini.');
        }
    }
}