<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(): View
    {
        $projects = Project::with("user")->paginate(10);
        return view("projects.index", compact("projects"));
    }

    public function create(): View
    {
        $project = new Project();
        $title = __("Crear proyecto");
        $textButton = __("Crear");
        $route = route("projects.store");
        return view("projects.create", compact("title", "textButton", "route", "project"));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            "name" => "required|max:140|unique:projects",
            "description" => "nullable|string|min:10"
        ]);

        Project::create($request->only("name", "description"));

        return redirect(route("projects.index"))
            ->with("success", __("¡Proyecto creado!"));
    }

    public function edit(Project $project): View
    {
        $update = true;
        $title = __("Editar proyecto");
        $textButton = __("Actualizar");
        $route = route("projects.update", ["project" => $project]);
        return view("projects.edit", compact("update","title", "textButton", "route", "project"));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $this->validate($request, [
           "name" => "required|unique:projects,name," . $project->id,
           "description" => "nullable|string|min:10"
        ]);

        $project->fill($request->only("name", "description"))->save();

        return back()->with("success", __("¡Proyecto actualizado!"));
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();
        return back()->with("success", __("¡Proyecto eliminado!"));
    }
}
