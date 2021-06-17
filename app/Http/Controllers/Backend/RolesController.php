<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesController extends Controller
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
        if (is_null($this->user) || !$this->user->can('role.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }       
        $roles = Role::all();
        return view('backend.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('role.create')){
            abort(403, 'Unauthorized Access');
        }
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.roles.create', compact('all_permissions', 'permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('role.create')){
            abort(403, 'Unauthorized Access');
        }
        $request->validate([
            'name' => 'required|unique:roles|max:50',
        ],
        [
            'name.required' => 'Please give a role name',
        ]
    );

        $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);

        // $role = DB::table('roles')->where('name', $request->name)->first();
        $permissions = $request->input('permissions');

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }

        return redirect()->back()->with('success','Role has been Created!');
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
        if(is_null($this->user) || !$this->user->can('role.edit')){
            abort(403, 'Unauthorized Access');
        }
        $role = Role::findById($id , 'admin');
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.roles.edit', compact('role','all_permissions', 'permission_groups'));
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
        if(is_null($this->user) || !$this->user->can('role.edit')){
            abort(403, 'Unauthorized Access');
        }
        $request->validate([
            'name' => 'required|max:50|unique:roles,name,'. $id
        ],
        [
            'name.required' => 'Please give a role name',
        ]
    );

        $role = Role::findById($id, 'admin');
        $permissions = $request->input('permissions');

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }

        return redirect()->back()->with('success','Role has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('role.delete')){
            abort(403, 'Unauthorized Access');
        }
        $role = Role::findById($id, 'admin');
        if(!is_null($role)){
            $role->delete();
        }
        return redirect()->back()->with('error', 'Deleted Role');
    }
}
