<?php

namespace App\Http\Controllers\Issues;

use App\Http\Controllers\Controller;
use App\Http\Requests\Issues\WordIssueRequest;
use App\Http\Resources\WordResource;
use App\Models\Word;
use App\Services\IssueService;
use App\Services\WordService;
use Inertia\Inertia;

class WordIssueController extends Controller
{
    protected $wordService;
    protected $issueService;

    public function __construct(WordService $wordService, IssueService $issueService)
    {
        $this->wordService = $wordService;
        $this->issueService = $issueService;
    }

    /**
     * Show the form for showing the specified resource.
     */
    public function create(int $id)
    {
        $word = $this->wordService->find($id);

        return Inertia::render('Issues/Words/Create', [
            'word' => WordResource::make($word->load(['user', 'languageLevel', 'type']))
        ]);
    }

    /**
     * Store issue about the specified resource.
     */
    public function store(WordIssueRequest $request)
    {
        $user = auth()->user();

        if($user->issues()
            ->where('issueable_type', Word::class)
            ->where('issueable_id', $request->input('word_id'))
            ->exists()
        ) {

            session()->flash('message', 'you have already submitted an issue on this word.');
            session()->flash('success', false);
        } else {

            $this->issueService->create($request->validated());

            session()->flash('message', 'issue created successfully');
            session()->flash('success', true);
        }

        return to_route('words.index');
    }
}
