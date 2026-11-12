<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{
    public function store(Request $request, Project $project)
    {
        if ($project->status !== 'terbuka') {
            return back()->withErrors([
                'project' => 'Proyek ini sudah tidak menerima penawaran.'
            ]);
        }

        $developerId = auth()->id();

        $alreadyBid = Bid::where('project_id', $project->id)
            ->where('developer_id', $developerId)
            ->exists();

        if ($alreadyBid) {
            return back()->withErrors([
                'project' => 'Kamu sudah mengirim penawaran untuk proyek ini.'
            ]);
        }

        $validated = $request->validate([
            'price' => 'required|numeric|gt:0',
            'duration' => 'required|integer|min:1',
            'proposal' => 'required|string',
        ]);

        Bid::create([
            'project_id' => $project->id,
            'developer_id' => $developerId,
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'proposal' => $validated['proposal'],
        ]);

        return redirect()
            ->route('projects.show', $project->id)
            ->with('success', 'Penawaran berhasil dikirim.');
    }

    public function update(Request $request, Bid $bid)
    {
        abort_unless((int) $bid->developer_id === (int) auth()->id(), 403);

        $validated = $request->validate([
            'price' => 'required|numeric|gt:0',
            'duration' => 'required|integer|min:1',
            'proposal' => 'required|string',
        ]);

        $bid->update($validated);

        return redirect()
            ->route('projects.show', $bid->project_id)
            ->with('success', 'Penawaran berhasil diperbarui.');
    }

    public function destroy(Bid $bid)
    {
        abort_unless((int) $bid->developer_id === (int) auth()->id(), 403);

        $projectId = $bid->project_id;
        $bid->delete();

        return redirect()
            ->route('projects.show', $projectId)
            ->with('success', 'Penawaran berhasil dihapus.');
    }

    public function selectWinner(Project $project, Bid $bid)
    {
        if (
            auth()->user()->role !== 'admin' &&
            (int) $project->client_id !== (int) auth()->id()
        ) {
            abort(403, 'Kamu tidak memiliki akses ke proyek ini.');
        }

        if ((int) $bid->project_id !== (int) $project->id) {
            abort(404, 'Penawaran tidak ditemukan pada proyek ini.');
        }

        if ($project->status !== 'terbuka') {
            return back()->withErrors([
                'project' => 'Proyek ini sudah ditutup.'
            ]);
        }

        DB::transaction(function () use ($project, $bid) {
            Bid::where('project_id', $project->id)
                ->update(['is_winner' => false]);

            $bid->update(['is_winner' => true]);

            $project->update(['status' => 'ditutup']);
        });

        return redirect()
            ->route('projects.show', $project->id)
            ->with('success', 'Pemenang berhasil dipilih. Proyek sekarang ditutup.');
    }
}