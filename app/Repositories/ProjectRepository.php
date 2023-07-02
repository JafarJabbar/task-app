<?php

namespace App\Repositories;



use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Projects;
use App\Models\Task;
use Exception;
use Illuminate\Http\RedirectResponse;

class ProjectRepository implements ProjectRepositoryInterface
{
    private int $limit=50;
    /**
     * @param string $keyword
     * @return mixed
     */
    public function getProjectsList(string $keyword): mixed
    {
        // TODO: Implement getProjectsList() method.
        try {
            return Projects::select('id','title')
            ->where(function ($query) use($keyword){
                if ($keyword){
                    $query->where('title','LIKE',"%{$keyword}%");
                }
            })->paginate($this->limit);
        } catch (Exception $e) {
            if (env('APP_ENV') == 'local') {
                return $e;
            }
            return redirect()
                ->back()
                ->with('error','Undefined error! Please try again.');
        }

    }

    /**
     * @param array $form_data
     * @return mixed
     */
    public function addProject(array $form_data): mixed
    {
        // TODO: Implement addProject() method.
        try {
            Projects::create($form_data);
            return to_route('projects.index')
                ->with('success','Project successfully added');
        } catch (Exception $e) {
            if (env('APP_ENV') == 'local') {
                return $e;
            }
            return redirect()
                ->back()
                ->with('error','Undefined error! Please try again.');
        }

    }

    /**
     * @param int $id
     * @param array $form_data
     * @return RedirectResponse|Exception
     */
    public function editProject(int $id, array $form_data): RedirectResponse|Exception
    {
        // TODO: Implement editProject() method.
        try {
            Projects::whereId($id)->update($form_data);
            return to_route('projects.index')
                ->with('success','Project successfully added');
        } catch (Exception $e) {
            if (env('APP_ENV') == 'local') {
                return $e;
            }
            return redirect()
                ->back()
                ->with('error','Undefined error! Please try again.');
        }

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteProject(int $id)
    {
        // TODO: Implement deleteProject() method.
        try {
            $project =Projects::whereId($id)->first();
            if (Task::select('id')->where('project_id',$project->id)->first()){
                return redirect()
                    ->back()
                    ->with('error','You have a tasks for this project firstly delete relational tasks');
            }
            if (!$project){
                return redirect()
                    ->back()
                    ->with('error','Project not found');
            }
            $project->delete();
            return redirect()
                ->back()
                ->with('success','Project successfully deleted');
        } catch (Exception $e) {
            if (env('APP_ENV') == 'local') {
                return $e;
            }
            return redirect()
                ->back()
                ->with('error','Undefined error! Please try again.');
        }

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getProject(int $id)
    {
        // TODO: Implement getProject() method.
        try {
            $project =Projects::whereId($id)->first();
            if (!$project){
                return redirect()
                    ->back()
                    ->with('error','Project not found');
            }
            return $project;
        } catch (Exception $e) {
            if (env('APP_ENV') == 'local') {
                return $e;
            }
            return redirect()
                ->back()
                ->with('error','Undefined error! Please try again.');
        }



    }
}
