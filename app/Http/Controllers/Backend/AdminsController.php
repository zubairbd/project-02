<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        $admins = Admin::all();
        return view('backend.pages.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $roles  = Role::all();
        return view('backend.pages.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        
        // Validation
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:50|email|unique:admins',
            'username' => 'required|max:50|unique:admins',
            'password' => 'required|min:4|confirmed',
        ]);
        // Create Admin
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->save();

        // Admin Asign
        if($request->roles){
            $admin->assignRole($request->roles);
        }

        return redirect()->back()->with('success','Admin has been Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $admin = Admin::find($id);
        $roles = Role::all();
        return view('backend.pages.admins.edit', compact('admin','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        // Create Admin
        $admin = Admin::find($id);

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:50|unique:admins,email,'. $id,
            'username' => 'required|max:50|unique:admins,username,'. $id
        ]
    );
        
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        if($request->password){
            $admin->password = Hash::make($request->password);
        }
        
        $admin->save();

        $admin->roles()->detach();
        if($request->roles){
            $admin->assignRole($request->roles);
        }

        return redirect()->back()->with('success','Admin has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $admin = Admin::find($id);
        if(!is_null($admin)){
            $admin->delete();
        }
        return redirect()->back()->with('error', 'Admin has been Deleted !!');//
    }
}
