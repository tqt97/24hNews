<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'display_name','key_code','parent_id'];


    public function permissionsChildren()
    {
        return $this->hasMany(Permission::class,'parent_id');
    }

    public function formatCreateAt()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d/m/Y');
    }
}
