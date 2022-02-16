<?php

namespace App\Models;

use App\Traits\AlertTrait;
use App\Traits\DeleteModelTrait;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\FilePondMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Admin extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, AlertTrait, DeleteModelTrait, FilePondMedia, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password', 'phone', 'address', 'image', 'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function formatCreateAt()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d/m/Y');
    }
    public function imageUrl()
    {
        return "/upload/admin/" . $this->image;
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    public function checkPermissionAccess($permissionCheck)
    {
        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            $permissions = $role->permissions;
            if ($permissions->contains('key_code', $permissionCheck)) {
                return true;
            }
        }
        return false;
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150);
        // ->useFallbackUrl('/admin/dist/img/anonymous-user.png')
        // ->useFallbackPath(public_path('/admin/dist/img/anonymous-user.png'));
    }
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('admins')
            ->useFallbackUrl('/admin/dist/img/anonymous-user.png')
            ->useFallbackPath(public_path('/admin/dist/img/anonymous-user.png'));
    }
    public function getAdminImageAttribute()
    {
        return $this->getFirstMediaUrl('admins', 'thumb');
    }
}
