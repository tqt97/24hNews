<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    private $admin;
    private $role;
    public function __construct(Admin $admin, Role $role)
    {
        $this->admin = $admin;
        $this->role = $role;
    }

    public function index()
    {
        $admins = $this->admin->latest()->paginate(10);
        return view('admin.admin.index', compact('admins'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('admin.admin.create', compact('roles'));
    }

    public function store(StoreAdminRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => bcrypt($request->password),
            ];
            $dataImage = $this->admin->storeImageUpload($request, 'image', 'admin');
            if ($dataImage) {
                $data['image'] = $dataImage['image'];
            } else {
                $data['image'] = 'default.jpg';
            }
            $admin = $this->admin->create($data);
            $admin->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('admin.admins.index')->with($admin->alertSuccess('store'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
        }
    }
    public function show($id)
    {
        //
    }
    public function edit(Admin $admin)
    {
        $roles = $this->role->all();
        $roleOfAdmin = $admin->roles;
        return view('admin.admin.edit', compact('admin', 'roles', 'roleOfAdmin'));
    }
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ];
            if ($request->password) {
                $request->validate([
                    'password' => 'required',
                    'password_confirm' => 'same:password',
                ]);
                $data['password'] = bcrypt($request->password);
            }
            if ($request->hasFile('image')) {
                // if ($admin->image) {
                //     unlink("upload/admin/" . $admin->image);
                // }
                $dataImage = $admin->storeImageUpload($request, 'image', 'admin');
                if (!empty($dataImage)) {
                    $data['image'] = $dataImage['image'];
                } else {
                    $data['image'] = $admin->image;
                }
            }
            // dd($data);
            $admin->update($data);
            $admin->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('admin.admins.index')->with($admin->alertSuccess('update'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
        }
    }
    public function destroy(Admin $admin)
    {
        return $admin->destroyModel($admin);
    }
}
