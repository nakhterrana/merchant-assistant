<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Helpers\Constants;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    public static function updateOrcreateOnInstall($data)
    {

        $user = self::updateOrCreate(
            ['store_hash' => $data['context']],
            [
                'user_id' => $data['user']['id'],
                'user_email' => $data['user']['email'],
                'password' => $data['access_token'],
                'store_hash' => $data['context'],
                'trial_ends_at' => now()->addDays(Constants::TRIAL_DAYS)
            ]
        );
        return $user;
    }

    public static function updateOrcreateOnLoad($data)
    {
        $user = self::updateOrCreate(
            ['store_hash' => $data['context']],
            [
                'user_id' => $data['user']['id'],
                'user_email' => $data['user']['email'],
                'store_hash' => $data['context'],
                'owner_id' => $data['owner']['id'],
                'owner_email' => $data['owner']['email'],
            ]
        );
        return $user;
    }
}
