<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
  /**
   * Haalt alle rollen op
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index(){

    $roles = Role::all();

    return view('admin.roles.index', compact('roles'));
  }

  /**
   * Haalt alle rechten op
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function create(){

    $permissions = Permission::all();

    return view('admin.roles.create', compact('permissions'));
  }

  /**
   * Store
   *
   * Maakt een nieuwe rol
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request){

     Validator::make($request->all(), [
      'name' => 'required|max:50|unique:permissions',
      'description' => 'max:150',
      'display_name' => 'required|max:50|unique:permissions',
      'permissions' => 'required',
    ])->validate();

    $role = new Role();
    $role->name         = $request->name;
    $role->display_name = $request->display_name;
    $role->description  = $request->description;
    $role->save();

    foreach ($request->permissions as $id){

      $permission = Permission::findOrfail($id);
      $role->attachPermission($permission);

    }

    return redirect()
      ->back(route('admin.roles'))
      ->with('message', 'Role succesfully added');

  }

  public function edit(Role $role){

    foreach ($role->permissions as $role_permission){
      $role_permissions[] = $role_permission->id;
    }

    $permissions = Permission::all();

    return view('admin.roles.edit',compact('role','role_permissions','permissions'));
  }

  public function update(Request $request, Role $role){

    Validator::make($request->all(), [
      'name' => 'required|max:50|unique:roles,name,'.$role->id,
      'description' => 'required|max:150',
      'display_name' => 'required|max:50|unique:roles,display_name,'.$role->id,
      'permissions' => '',
    ])->validate();

    $role->name         = $request->name;
    $role->display_name = $request->display_name;
    $role->description  = $request->description;
    $role->save();

    DB::table('permission_role')->where('role_id',$role->id)->delete();

    if (!empty($request->permissions)){
    foreach ($request->permissions as $id){

      if (!DB::table('permission_role')->where('role_id',$role->id)->where('permission_id', $id)->exists()) {
        $role->attachPermission(Permission::findOrfail($id));
      }
    }
  }

    return redirect()
      ->route('admin.role.edit',$role->id)
      ->with('message', 'Role succesfully edited');
  }

  public function destroy(Role $role){

    $role->delete();

    return redirect()
      ->route('admin.roles')
      ->with('message', 'Role succesfully deleted');
  }

}
