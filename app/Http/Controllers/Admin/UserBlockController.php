<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserBlockController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(int $id)
    {

        $this->userService->toggleBlockStatus($id);

        session()->flash('message', 'user status changed successfully.');
        session()->flash('success', true);

        return to_route('users.index');
    }
}
