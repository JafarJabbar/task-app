<?php
namespace App\Repositories;



use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\RedirectResponse;

class TaskRepository implements TaskRepositoryInterface
{
    use ResponseAPI;
    /**
     * @param int $project_id
     * @param string $keyword
     * @return mixed
     */
    public function getTasksList(int $project_id=0, string $keyword)
    {
        // TODO: Implement getTasksList() method.
        try {
            return Task::select('id','title','project_id','priority')
                ->where(function ($query) use($keyword,$project_id){
                    if ($keyword){
                        $query->where('title','LIKE',"%{$keyword}%");
                    }
                    if ($project_id){
                        $query->where('project_id',$project_id);
                    }
                })->orderBy('priority','DESC')->get();
        } catch (Exception $e) {
            if (env('APP_ENV') == 'local') {
                return $e;
            }
            return redirect()
                ->back()
                ->withErrors(['error','Undefined error! Please try again.']);
        }

    }

    /**
     * @param array $form_data
     * @return mixed
     */
    public function addTask(array $form_data)
    {
        // TODO: Implement addTask() method.
        try {
            Task::create($form_data);
            return to_route('tasks.index')
                ->with('success','Task successfully added');
        } catch (Exception $e) {
            if (env('APP_ENV') == 'local') {
                return $e;
            }
            return redirect()
                ->back()
                ->withErrors(['error'=>'Undefined error! Please try again.']);
        }

    }

    /**
     * @param int $id
     * @param array $form_data
     * @return mixed
     */
    public function editTask(int $id, array $form_data)
    {
        // TODO: Implement editTask() method.
        try {
            Task::whereId($id)->update($form_data);
            return to_route('tasks.index')
                ->with('success','Task successfully updated');
        } catch (Exception $e) {
            if (env('APP_ENV') == 'local') {
                return $e;
            }
            return redirect()
                ->back()
                ->withErrors(['error'=>'Undefined error! Please try again.']);
        }

    }

    /**
     * @param int $id
     * @return RedirectResponse|Exception
     */
    public function deleteTask(int $id): RedirectResponse|Exception
    {
        // TODO: Implement deleteTask() method.
        try {
            $task =Task::whereId($id)->first();
            if (!$task){
                return redirect()
                    ->back()
                    ->withErrors(['error','Task not found']);
            }
            $task->delete();
            return redirect()
                ->back()
                ->with('success','Task successfully deleted');
        } catch (Exception $e) {
            if (env('APP_ENV') == 'local') {
                return $e;
            }
            return redirect()
                ->back()
                ->withErrors(['error'=>'Undefined error! Please try again.']);
        }


    }

    /**
     * @param array $list
     * @return mixed
     */
    public function reorderTasks(array $list)
    {
        // TODO: Implement reorderTasks() method.
    }
}
