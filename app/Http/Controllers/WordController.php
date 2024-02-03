<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWordRequest;
use App\Models\LanguageLevel;
use App\Models\Type;
use App\Models\Word;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Words/Index', [
            'words' => Word::paginate(10)
                        ->withQueryString()
                        ->through(fn ($word) => [
                            'id' => $word->id,
                            'word' => $word->word,
                            'ar_translation' => $word->ar_translation,
                            'en_translation' => $word->en_translation,
                            'type' => $word->type?->type,
                            'language_level' => $word->languageLevel?->level,
                            'user' => $word->user?->name
                        ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Words/Create', [
            'language_levels' => LanguageLevel::all(),
            'types' => Type::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWordRequest $request)
    {
        Word::create($request->validated());

        session()->flash('message', 'created successfully');
        session()->flash('success', true);

        return to_route('words.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
