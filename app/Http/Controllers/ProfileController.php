<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $project = Project::whereHas('members', function(Builder $query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->orderByDesc('created_at')->get();
        $data = [
            'project'   => $project,
        ];
        return view('profile.index')->with($data);
    }
}
