<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use DeleteModelTrait, StorageImageTrait;
    private $user;
    private $role;
    public function __construct(Admin $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->latest()->paginate(10);
        return view('admin.src.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->role->all();
        return view('admin.src.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'password' => bcrypt($request->password),
            ];
            $dataImage = $this->storeImageUpload($request, 'image', 'user');
            if ($dataImage) {
                $data['image'] = $dataImage['image'];
            } else {
                $data['image'] = 'default.jpg';
            }
            $user = $this->user->create($request->validated() + $data);
            $user->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('admin.user.index')->with([
                'alert-type' => 'success',
                'message' => 'Thêm người dùng thành công'
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
    public function edit(Admin $user)
    {
        $roles = $this->role->all();
        $rolesOfUser = $user->roles;
        return view('admin.src.user.edit', compact('user', 'roles', 'rolesOfUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, Admin $user)
    {
        try {
            DB::beginTransaction();
            $data = [];
            if ($request->password) {
                $request->validate([
                    'password' => 'required',
                    'password_confirm' => 'same:password',
                ]);
                $data['password'] = bcrypt($request->password);
            }
            if ($request->hasFile('image')) {
                if ($user->image) {
                    unlink("upload/user/" . $user->image);
                }
                $dataImage = $this->updateImageUpload($request, 'image', 'user');
                if (!empty($dataImage)) {
                    $data['image'] = $dataImage['image'];
                } else {
                    $data['image'] = $user->image;
                }
            }
            $user->update($data + $request->validated());
            $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('admin.user.index')->with([
                'alert-type' => 'success',
                'message' => 'Cập nhật người dùng thành công'
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
    public function destroy(Admin $user)
    {
        return $this->deleteModelHasImageTrait($user, 'user');
    }
}
