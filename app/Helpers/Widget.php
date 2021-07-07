<?php
namespace App\Helpers;

use App\Models\Project;
use App\Models\Task;

class Widget
{
    public static function calculateProjectProgressPercent($projectId){
        $task = Task::where('project_id', $projectId)->count();
        $taskCompleted = Task::where('project_id', $projectId)->where('status', 'completed')->count();
        $total = ($taskCompleted != 0) ? ($taskCompleted / $task) * 100 : 0;
        
        Project::where('id', $projectId)->update(['progress_percent' => $total]);
    }
}