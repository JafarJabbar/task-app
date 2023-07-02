<?php
namespace App\Interfaces;
interface TaskRepositoryInterface{
    public function getTasksList(int $project_id,string $keyword);
    public function addTask(array $form_data);
    public function editTask(int $id,array $form_data);
    public function deleteTask(int $id);
    public function reorderTasks(array $list);
}
