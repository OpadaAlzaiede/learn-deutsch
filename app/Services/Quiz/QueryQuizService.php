<?php


namespace App\Services\Quiz;


interface QueryQuizService
{
    public function index();
    public function show(string $id);
}
