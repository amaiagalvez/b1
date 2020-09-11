<?php

namespace Izt\Users\Storage\Eloquent\Models;

use Izt\Users\Notifications\ResetPasswordNotification;
use Izt\Users\Notifications\UserActivationNotification;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Izt\Helpers\Storage\Eloquent\Traits\AbstractTrait;
use Izt\Helpers\Storage\Eloquent\Traits\SecureDeleteTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'lang',
        'role_name',
        'password',
        'show_profile',
        'active',
        'auth_id',
        'avatar',
        'notes',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
        'show_profile' => 'boolean'
    ];

    use AbstractTrait;
    use SecureDeleteTrait;
    use SoftDeletes;

    /* Relations */

    public function sessions()
    {
        return $this->hasMany(Session::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_name', 'name');
    }

    /* Scopes */

    public function scopeOnlyUsers($query)
    {
        return $query->where('id', '>', 1);
    }

    public function scopeActive($query, $value)
    {
        if ($value >= 0 && $value <= 1) {
            return $query->where('active', $value);
        }
        return $query;
    }

    public function scopeLang($query, $value)
    {
        if (!empty(trim($value))) {
            return $query->where('lang', $value);
        }

        return $query;
    }

    public function scopeRoleName($query, $value)
    {
        if (!empty(trim($value))) {
            return $query->where('role_name', $value);
        }

        return $query;
    }

    /* Functions */

    public function isAdmin()
    {
        return $this->role_name === 'admin';
    }

    public function isWebUser()
    {
        return $this->role_name === 'web';
    }

    public function isDeveloper()
    {
        return $this->id === 1;
    }

    public function isActivated()
    {
        return $this->email_verified_at !== null;
    }

    public function canDelete()
    {
        return $this->sessions->count() === 0;
    }

    public function link()
    {
        return route('front.users.show', $this);
    }

    public function getAvatar()
    {
        return $this->avatar ?? '/images/user.png';
    }

    public function showProfile()
    {
        return $this->isWebUser() && $this->show_profile;
    }

    /* Attributes */

    public function setPasswordAttribute($password)
    {
        if (!empty(trim($password))) {
            $this->attributes['password'] = bcrypt($password);
        } else {
            unset($this->attributes['password']);
        }
    }

    public function receivesBroadcastNotificationsOn()
    {
        return 'users.' . $this->id;
    }

    /**
     * @param string $token
     */

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }


    public function sendEmailVerificationNotification()
    {
        $this->notify(new UserActivationNotification());
    }
}
