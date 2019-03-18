<?php

namespace Tests\Setup;


use App\Project;
use App\Task;
use App\User;

class ProjectFactory
{
    /**
     * @var int
     */
    protected $tasksCount = 0;

    /**
     * @var User
     */
    protected $user;

    /**
     * @param $count
     * @return $this
     */
    public function withTasks($count)
    {
        $this->tasksCount = $count;

        return $this;
    }

    /**
     * @param $user
     * @return $this
     */
    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $project = factory(Project::class)->create([
           'owner_id' => $this->user ?? factory(User::class)
        ]);

        factory(Task::class, $this->tasksCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }

}