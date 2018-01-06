<?php

namespace App\Models;

use App\Models\Relations\UserRelation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $confirmation_code
 * @property string $confirmed
 *
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{

    public const STATUS_CONFIRMED = 1;
    public const STATUS_UNCONFIRMED = 0;

    use HasApiTokens, Notifiable, UserRelation, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'confirmation_code', 'confirmed', 'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'confirmation_code',
        'confirmed',
        'created_at',
        'updated_at'
    ];

    /**
     * @param User $user
     * @return bool
     */
    public function hasSubscriber(self $user): bool
    {
        return $this->subscribers()->where('subscriber_id', $user->id)->exists();
    }

}
