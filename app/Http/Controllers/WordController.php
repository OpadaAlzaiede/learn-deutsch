<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWordRequest;
use App\Http\Resources\LanguageLevelResource;
use App\Http\Resources\TypeResource;
use App\Models\LanguageLevel;
use App\Models\Type;
use App\Models\Word;
use App\Services\LanguageLevelService;
use App\Services\TypeService;
use App\Services\WordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class WordController extends Controller
{
    protected $languageLevelService;
    protected $typeService;
    protected $wordService;

    public function __construct(LanguageLevelService $languageLevelService, TypeService $typeService, WordService $wordService)
    {
        $this->languageLevelService = $languageLevelService;
        $this->typeService = $typeService;
        $this->wordService = $wordService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $language_levels = $this->languageLevelService->index();
        $types = $this->typeService->index();

        return Inertia::render('Words/Index', [
            'words' => $this->wordService->index(
                $request->only('language_levels'),
                $request->only('types'),
                $request->input('keyword')
            ),
            'types' => TypeResource::collection($types),
            'language_levels' => LanguageLevelResource::collection($language_levels),
            'filters' => $request->only(['language_levels', 'types', 'keyword'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
         return Inertia::render('Words/Create', [
            'language_levels' => $this->languageLevelService->index(),
            'types' => $this->typeService->index()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWordRequest $request)
    {
        if ($request->user()->cannot('create', Word::class)) {

            abort(403);
        }

        $this->wordService->store($request->validated());

        session()->flash('message', 'created successfully, the translation will be added soon.');
        session()->flash('success', true);

        return to_route('words.index');
    }
}
