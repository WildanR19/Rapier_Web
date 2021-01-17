<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

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
    
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|string|min:5|max:50',
            'email'     => 'required|email',
            'photo'     => 'nullable|file|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        $profile = User::findOrFail(Auth::user()->id);
        $profile->name      = $request->name;
        $profile->email     = $request->email;
        if($request->hasFile('photo')){
            Storage::disk('public')->delete($profile->profile_photo_path);
            $path = Storage::disk('public')->put('profile-photos', new File(request()->file('photo')));
            $profile->profile_photo_path  = $path;
        }
        $profile->save();
        Alert::success('Success', 'Your data has been updated.');
        return back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password_current'  => 'required',
            'password' => 'required|confirmed|min:6'
        ]);
        $profile = User::findOrFail(Auth::user()->id);
        if (Hash::check($request->password_current, $profile->password)) {
            $profile->password = Hash::make($request->password);
            $profile->save();
        }else{
            Alert::error('Oops...', 'Current password is incorrect!');
        }
        return back();
    }
}
