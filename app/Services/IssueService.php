<?php


namespace App\Services;


use App\Models\Issue;
use App\Models\Word;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class IssueService
{
    public function create(array $data) {

        Issue::create([
            'issueable_type' => Word::class,
            'issueable_id' => $data['word_id'],
            'issue_title' => $data['issue_title'],
            'suggested_solution' => $data['suggested_solution'],
            'user_id' => Auth::id(),
            'date' => Carbon::now()
        ]);
    }
}
