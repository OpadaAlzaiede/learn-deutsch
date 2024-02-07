<?php

namespace App\Http\Controllers\Issues;

use App\Http\Controllers\Controller;
use App\Http\Requests\Issues\WordIssueRequest;
use App\Http\Resources\WordResource;
use App\Models\Issue;
use App\Models\Word;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WordIssueController extends Controller
{
    /**
     * Show the form for showing the specified resource.
     */
    public function create(string $id)
    {
        $word = Word::find($id);

        return Inertia::render('Issues/Words/Create', [
            'word' => WordResource::make($word->load(['user', 'languageLevel', 'type']))
        ]);
    }

    /**
     * Store issue about the specified resource.
     */
    public function store(WordIssueRequest $request, string $id)
    {
        Issue::create([
            'issueable_type' => Word::class,
            'issueable_id' => $id,
            'issue_title' => $request->input('issue_title'),
            'suggested_solution' => $request->input('suggested_solution'),
            'user_id' => Auth::id(),
            'date' => Carbon::now()
        ]);

        session()->flash('message', 'created successfully');
        session()->flash('success', true);

        return to_route('words.index');
    }
}
