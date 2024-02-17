<?php


namespace App\Services\Quiz;


interface WriteQuizService
{
    public function store(array $data);
    public function destroy(int $id);
    public function cancel(int $id);
}
