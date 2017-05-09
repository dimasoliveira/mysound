<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
  public function index(){

    $roles = Role::all();

    return view('admin.roles', compact('roles'));
  }

  public function create(){

    $permissions = Permission::all();

    return view('admin.role_add', compact('permissions'));
  }

  public function store(){

    $roles = Role::all();

    return view('admin.roles', compact('roles'));
  }


}
