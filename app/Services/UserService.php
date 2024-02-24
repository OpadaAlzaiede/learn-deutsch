<?php


namespace App\Services;


use App\Models\User;
use Carbon\Carbon;

class UserService
{
    public function index(?string $keyword) {

        return User::role(config('roles.user'))
            ->name($keyword)
            ->orderBy('created_at', 'DESC')
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'registered_at' => Carbon::parse($user->created_at)->toDateString(),
                'is_blocked' => $user->is_blocked
            ]);
    }

    public function toggleBlockStatus(int $id) {

        $user = User::findOrFail($id);

        $user->is_blocked = !($user->is_blocked);

        $user->save();
    }
}
