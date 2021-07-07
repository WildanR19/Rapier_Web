<?php
namespace App\Helpers;
use App\Models\ProjectActivity as ProjectActivityModel;

class ProjectActivity
{
    public static function addToActivity($projectid, $activity)
    {
    	$log = [];
    	$log['project_id'] = $projectid;
    	$log['activity'] = $activity;
    	ProjectActivityModel::create($log);
    }


    public static function activityLists($id)
    {
    	return ProjectActivityModel::where('project_id', $id)->latest()->get();
    }
}