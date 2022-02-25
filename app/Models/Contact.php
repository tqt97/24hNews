<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Contact extends BaseModel
{
    use HasFactory;
protected $fillable = ['name', 'email', 'phone','subject', 'message'];
    public function formatCreateAt()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d/m/Y');
    }
}
