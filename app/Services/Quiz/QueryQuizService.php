<?php


namespace App\Services\Quiz;


interface QueryQuizService
{
    public function index(array $languageLevels);
    public function show(int $id);
    public function getById(int $id);
    public function destroy(int $id);
}
