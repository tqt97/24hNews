<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'display_name'];

    public function admins()
    {
        return $this->belongsToMany(Admin::class,'admin_role','role_id', 'admin_id');

    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'role_permission')->withTimestamps();
    }

    public function formatCreateAt()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d-m-Y');
    }
}
