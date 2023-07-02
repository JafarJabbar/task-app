<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Interfaces\TaskRepositoryInterface;
use App\Models\Projects;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepository;


    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'q' => 'nullable|string|max:128',
            'project_id' => 'nullable|int|exists:projects,id',
        ]);
        $keyword = strip_tags($request->q);
        //fetch data from repository
        $tasks = $this->taskRepository->getTasksList($request->project_id ?? 0, $keyword);
        $projects = Projects::select('id', 'title')->get();
        return view('pages.tasks.index', compact(['tasks', 'keyword', 'projects']));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Projects::select('id', 'title')->get();
        return view('pages.tasks.create', compact(['projects']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $taskRequest)
    {
        return $this->taskRepository->addTask(form_data: ['title' => $taskRequest->title, 'priority' => $taskRequest->priority, 'project_id' => $taskRequest->project_id,]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::where('id', $id)->first();
        if (!$task) {
            return redirect()
                ->back()
                ->withErrors(['error', 'Task not found']);
        }
        $projects = Projects::select('id', 'title')->get();

        return view('pages.tasks.edit', compact(['task', 'projects']));
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
    public function update(TaskRequest $taskRequest, string $id)
    {
        return $this->taskRepository->editTask($id, form_data: [
            'title' => $taskRequest->title,
            'priority' => $taskRequest->priority,
            'project_id' => $taskRequest->project_id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->taskRepository->deleteTask($id);
    }

    public function reorder()
    {
        $tasks = Task::select('title', 'project_id','priority', 'id')->orderBy('priority','ASC')->get();
        return view('pages.tasks.reorder', compact(['tasks']));
    }


    public function reorder_action(Request $request)
    {
        $request->validate([
            'table' => 'required|array',
            'table.*.id' => 'required|int|exists:tasks,id',
            'table.*.priority' => 'required|int',
        ]);
        foreach ($request->table as $item) {
            $content = Task::select('id', 'priority')->where('id', $item['id'])->first();
            $content->priority = $item['priority'];
            $content->save();
        }
        return 'ok';
    }
}
