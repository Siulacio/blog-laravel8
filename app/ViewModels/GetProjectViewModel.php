<?php

namespace App\ViewModels;

use App\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;

final class GetProjectViewModel extends ViewModel
{
    public function projects(): LengthAwarePaginator
    {
        return Project::with('user:id,name')->latest()->paginate();
    }

}
