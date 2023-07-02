<?php
namespace App\Interfaces;
interface ProjectRepositoryInterface{
    public function getProjectsList(string $keyword);
    public function getProject(int $id);
    public function addProject(array $form_data);
    public function editProject(int $id,array $form_data);
    public function deleteProject(int $id);
}
