<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'pin',
        'first_name',
        'last_name',
        'middle_name',
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
        'password' => 'hashed',
    ];

    /**
     * @throws \Exception
     */
    public static function login(string $pin, string $password): string
    {
        /*** @var User $user */
        $user = User::where('pin', $pin)->first();

        if (!$user) {
            throw new \Exception('Неверный логин или пароль', 401);
        }

        if (!Hash::check($password, $user->password)) {
            throw new \Exception('Неверный логин или пароль', 401);
        }

        return (string)$user->createToken('authToken')->plainTextToken;
    }

    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getAuthIdentifierName(): string
    {
        return 'pin';
    }

    public function reputations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Reputation::class,'user_id');
    }

    public function publishers()
    {
        return $this->hasMany(Publish::class);
    }
}
