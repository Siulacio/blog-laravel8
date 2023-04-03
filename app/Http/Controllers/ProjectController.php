<?php

namespace App\Http\Controllers;

use App\Actions\DeleteProjectAction;
use App\Actions\UpsertProjectAction;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\ViewModels\GetProjectViewModel;
use App\ViewModels\UpsertProjectViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    public function index(GetProjectViewModel $viewModel): View
    {
        return view('projects.index', [
            'projects' => $viewModel->projects(),
        ]);
    }

    public function create(): View
    {
        $viewModel = new UpsertProjectViewModel();
        return view('projects.form', $viewModel->toArray()['form_data']);
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        UpsertProjectAction::execute(auth()->user(), $request);
        return redirect(route('projects.index'))
            ->with('success', __('¡Proyecto creado!'));
    }

    public function edit(Project $project): View
    {
        $viewModel = new UpsertProjectViewModel($project);
        return view('projects.form', $viewModel->toArray()['form_data']);
    }

    public function update(ProjectRequest $request): RedirectResponse
    {
        UpsertProjectAction::execute(auth()->user(), $request);
        return redirect(route('projects.index'))
            ->with('success', __('¡Proyecto actualizado!'));
    }

    public function destroy(int $id): RedirectResponse
    {
        DeleteProjectAction::execute($id);
        return back()->with('success', __('¡Proyecto eliminado!'));
    }
}
