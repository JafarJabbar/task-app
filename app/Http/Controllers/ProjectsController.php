<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    /*
     * Initialize projects repository
     * */
    private ProjectRepositoryInterface $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository=$projectRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'keyword'=>'nullable|string|max:128'
        ]);
        $keyword=strip_tags($request->keyword);

        //fetch data from repository
        $projects = $this->projectRepository->getProjectsList($keyword);

        return view('pages.projects.index',compact(['projects','keyword']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $projectRequest)
    {
        return $this->projectRepository->addProject(form_data: ['title'=>$projectRequest->title]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project=$this->projectRepository->getProject($id);
        return view('pages.projects.edit',compact(['project']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $projectRequest, string $id)
    {

        return $this->projectRepository->editProject($id,form_data: ['title'=>$projectRequest->title]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->projectRepository->deleteProject($id);
    }
}
