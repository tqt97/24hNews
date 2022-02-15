<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateInforRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    private $admin;
    public function __construct(Admin $admin)
    {
        $this->admin =  $admin;
    }
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.profile.edit', compact('admin'));
    }
    public function updateInformation(UpdateInforRequest $request, $id)
    {
        $this->admin->findOrFail($id)->update($request->validated());
        return redirect()->back()->with($this->admin->alertSuccess('update'));
    }
    public function updateImage(Request $request, $id)
    {
        $admin = $this->admin->findOrFail($id);
        $admin->update($request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]));
        $admin->save();
        return redirect()->back()->with($this->admin->alertSuccess('update'));
    }
    public function updatePassword(UpdatePasswordRequest $request, $id)
    {
        $admin = $this->admin->findOrFail($id);
        $password = bcrypt($request->password);
        $admin->update([
            'password' => $password,
        ]);
        return redirect()->back()->with($admin->alertSuccess('update'));
    }
}
