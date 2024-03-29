<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quizzes\StartNewQuizRequest;
use App\Http\Resources\LanguageLevelResource;
use App\Services\LanguageLevelService;
use App\Services\Quiz\QueryQuizService;
use App\Services\Quiz\QuizService;
use App\Services\Quiz\WriteQuizService;
use App\Services\TypeService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class QuizController extends Controller
{
    protected $languageLevelService;
    protected $typeService;
    protected $writeQuizService;
    protected $queryQuizService;
    protected $quizService;

    public function __construct(
        LanguageLevelService $languageLevelService,
        WriteQuizService $writeQuizService,
        QueryQuizService $queryQuizService,
        QuizService $quizService,
        TypeService $typeService
    )
    {
        $this->languageLevelService = $languageLevelService;
        $this->writeQuizService = $writeQuizService;
        $this->queryQuizService = $queryQuizService;
        $this->quizService = $quizService;
        $this->typeService = $typeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $languageLevels = $this->languageLevelService->index();
        $quizzes = $this->queryQuizService->index($request->only('language_levels'));

        session()->put('quizzes_url', \request()->fullUrl());

        return Inertia::render('Quizzes/Index', [
            'quizzes' => $quizzes,
            'language_levels' => LanguageLevelResource::collection($languageLevels),
            'filters' => $request->only(['language_levels'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $languageLevels = $this->languageLevelService->index();
        $maximumNumberOfWords = config('quiz.maximum_number_of_words_allowed', 20);

        return Inertia::render('Quizzes/Create', [
            'language_levels' => $languageLevels,
            'maximumNumberOfWords' => $maximumNumberOfWords
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StartNewQuizRequest $request)
    {
        $quiz = $this->writeQuizService->store($request->validated());

        $this->quizService->generateQuestions($quiz->id, $quiz->language_level_id, $quiz->number_of_words);

        return to_route('quizzes.questions', [
            'id' => $quiz->id
        ]);
    }

    /**
     * delete a resource in storage.
     */
    public function destroy(int $id)
    {
        $this->writeQuizService->destroy($id);

        session()->flash('message', 'quiz deleted successfully.');
        session()->flash('success', true);

        if(session()->has('quizzes_url')) {

            return redirect(session('quizzes_url'));
        }

        return to_route('quizzes.index');
    }

    /* Cancel the specified quiz */
    public function cancel(int $id)
    {
        $this->writeQuizService->cancel($id);

        return to_route('quizzes.index');
    }

    public function getQuestions(int $quizId): Response {

        $quiz = $this->queryQuizService->getById($quizId);

        $questions = $quiz->questions()
                            ->paginate(3)
                            ->through(fn ($question) => [
                                'id' => $question->id,
                                'word' => $question->word?->word,
                            ]);


        return Inertia::render('Quizzes/Questions', [
            'quizId' => $quizId,
            'questions' => $questions,
            'types' => $this->typeService->index(),
        ]);
    }

    public function submit(Request $request) {

        $quizId = $request->input('quiz_id');
        $quiz = $this->queryQuizService->getById($quizId);

        $solutions = $request->input('solutions');

        $this->quizService->calculateResult($quizId, $solutions);

        $quiz->refresh(); // refreshing the model instance after storing score.

        return Inertia::render('Quizzes/Result', [
            'totalQuestions' => $quiz->number_of_words,
            'correctAnswers' => $quiz->score
        ]);
    }
}
