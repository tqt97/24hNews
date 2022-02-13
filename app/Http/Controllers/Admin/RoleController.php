<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;


class RoleController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $roles = $this->role->latest()->paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissionsParent = $this->permission->with('permissionsChildren')->where('parent_id', 0)->get();

        return view('admin.role.create', compact('permissionsParent'));
    }
    public function store(StoreRoleRequest $request)
    {
        $role = $this->role->create($request->validated());

        $role->permissions()->attach($request->permission_id);

        return redirect()->route('admin.roles.index')->with($role->alertSuccess('store'));
    }
    public function show($id)
    {
        //
    }


    public function edit(Role $role)
    {
        $permissionsParent = $this->permission->with('permissionsChildren')->where('parent_id', 0)->get();
        $pemissionsChecked = $role->permissions;
        return view('admin.role.edit', compact('permissionsParent', 'role', 'pemissionsChecked'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        $role->permissions()->sync($request->permission_id);

        return redirect()->route('admin.roles.index')->with($role->alertSuccess('update'));
    }


    public function destroy(Role $role)
    {
        return $role->destroyModel($role);
    }
}
