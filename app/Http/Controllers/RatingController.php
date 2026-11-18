<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Project $project)
    {
        // Hanya klien pemilik proyek yang boleh memberikan rating
        abort_unless(
            (int) $project->client_id === (int) auth()->id(),
            403,
            'Kamu tidak memiliki akses untuk memberikan rating.'
        );

        // Proyek harus sudah selesai
        if (!$project->completed_at) {
            return back()->withErrors([
                'rating' => 'Proyek belum diselesaikan.'
            ]);
        }

        // Pastikan terdapat developer pemenang
        $winner = $project->bids()
            ->where('is_winner', true)
            ->first();

        if (!$winner) {
            return back()->withErrors([
                'rating' => 'Developer pemenang tidak ditemukan.'
            ]);
        }

        // Satu proyek hanya boleh memiliki satu rating
        if ($project->rating()->exists()) {
            return back()->withErrors([
                'rating' => 'Rating untuk proyek ini sudah diberikan.'
            ]);
        }

        $validated = $request->validate([
            'score' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:2000',
        ]);

        Rating::create([
            'project_id' => $project->id,
            'client_id' => auth()->id(),
            'developer_id' => $winner->developer_id,
            'score' => $validated['score'],
            'review' => $validated['review'] ?? null,
        ]);

        return redirect()
            ->route('projects.show', $project->id)
            ->with('success', 'Rating berhasil diberikan kepada developer.');
    }
}