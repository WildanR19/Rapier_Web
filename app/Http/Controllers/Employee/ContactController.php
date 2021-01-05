<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee_detail;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function index()
    {
        $user = User::all();
        $data = [
            'users'     => $user,
        ];
        return view('employee.contacts.index')->with($data);
    }

    public function update($id)
    {
    	$user   = User::find($id);
        $ed     = Employee_detail::where('user_id', $id)->first();
	    return response()->json([
          'data'    => $user,
          'ed'      => $ed
	    ]);
    }

    public function edit(Request $request, $id)
    {
        User::updateOrCreate(
            [ 'id' => $id ],
            [ 'email' => $request->email ],
        );
        Employee_detail::where('user_id', $id)->update([
            'phone' => $request->phone,
        ]);
        Alert::success('Updated', 'Your data has been updated.');
        return response()->json([ 'success' => true ]);
    }
}
