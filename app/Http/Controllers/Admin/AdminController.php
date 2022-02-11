<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    use DeleteModelTrait, StorageImageTrait;
    private $admin;
    private $role;
    public function __construct(Admin $admin, Role $role)
    {
        $this->admin = $admin;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = $this->admin->latest()->paginate(10);
        return view('admin.src.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->role->all();
        return view('admin.src.admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $dataImage = $this->storeImageUpload($request, 'image', 'admin');
            if ($dataImage) {
                $data['image'] = $dataImage['image'];
            } else {
                $data['image'] = 'default.jpg';
            }

            // dd($data);
            $admin = $this->admin->create( $data);
            $admin->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('admin.admins.index')->with([
                'alert-type' => 'success',
                'message' => 'Thêm thành công'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
        }
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
    public function edit(Admin $admin)
    {
        $roles = $this->role->all();
        $roleOfAdmin = $admin->roles;
        return view('admin.src.admin.edit', compact('admin', 'roles', 'roleOfAdmin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
                if ($admin->image) {
                    unlink("upload/admin/" . $admin->image);
                }
                $dataImage = $this->updateImageUpload($request, 'image', 'admin');
                if (!empty($dataImage)) {
                    $data['image'] = $dataImage['image'];
                } else {
                    $data['image'] = $admin->image;
                }
            }
            $admin->update($data);
            $admin->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('admin.admins.index')->with([
                'alert-type' => 'success',
                'message' => 'Cập nhật thành công'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        return $this->deleteModelTrait($admin);
    }
}
