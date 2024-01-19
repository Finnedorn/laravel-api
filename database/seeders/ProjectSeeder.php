<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $projects = config('dbprojects.projects');
        foreach($projects as $project){
            $newProject = new Project();
            $newProject->user_id = 1;
            $newProject->slug = Str::slug($project['project_title']);
            $newProject->project_title = $project['project_title'];
            $newProject->repo_name = $project['repo_name'];
            $newProject->repo_link = $project['link'];
            $newProject->description = $project['description'];
            $newProject->save();
        }
    }
}
