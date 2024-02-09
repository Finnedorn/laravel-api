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
            // il meteodo str trasforma col metood slug converte la stringa che passi in una versiona da essere usata nella url
            $newProject->slug = Str::slug($project['project_title'], '-');
            $newProject->project_title = $project['project_title'];
            $newProject->repo_name = $project['repo_name'];
            $newProject->repo_link = $project['link'];
            $newProject->description = $project['description'];
            $newProject->save();

            $newProject->technologies()->sync($project['technologies']);
        }
    }
}
