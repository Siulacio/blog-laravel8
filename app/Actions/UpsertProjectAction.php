<?php

namespace App\Actions;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

final class UpsertProjectAction
{
    public static function execute(User $user, Request $request): void
    {
        Project::updateOrCreate(
            [
                'id' => request()->route('project'),
            ],
            [
                'user_id' => $user->id,
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ],
        );
    }

}
