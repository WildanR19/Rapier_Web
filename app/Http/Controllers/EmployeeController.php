<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
    	// mengambil semua data pengguna
        $user = User::all();
    	// return data ke view
        return view('admin.employee.index', compact('user', 'user'));
    }

    public function add(){
        return view('admin.employee.add');
    }
}
