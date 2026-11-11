<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BidController extends Controller
{
    // Menyimpan penawaran baru
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'developer_id' => [
                'required',
                Rule::exists('users', 'id')->where('role', 'developer'),
            ],
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'proposal' => 'required|string',
        ]);

        if ($project->status !== 'open') {
            return back()->withErrors([
                'project' => 'Proyek ini tidak menerima penawaran.',
            ]);
        }

        Bid::create([
            'project_id' => $project->id,
            'developer_id' => $validated['developer_id'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'proposal' => $validated['proposal'],
        ]);

        return redirect()
            ->route('projects.show', $project->id)
            ->with('success', 'Penawaran berhasil dikirim.');
    }

    // Memperbarui penawaran
    public function update(Request $request, Bid $bid)
    {
        $validated = $request->validate([
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'proposal' => 'required|string',
        ]);

        $bid->update($validated);

        return redirect()
            ->route('projects.show', $bid->project_id)
            ->with('success', 'Penawaran berhasil diperbarui.');
    }

    // Menghapus penawaran
    public function destroy(Bid $bid)
    {
        $projectId = $bid->project_id;

        $bid->delete();

        return redirect()
            ->route('projects.show', $projectId)
            ->with('success', 'Penawaran berhasil dihapus.');
    }
}