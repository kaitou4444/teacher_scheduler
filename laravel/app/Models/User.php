<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    protected $fillable = ['username', 'password', 'api_token', 'role', 'full_name', 'email'];

    protected $casts = [
        'role' => 'string',
    ];

    /**
     * Tạo và lưu API token mới cho người dùng
     *
     * @return string
     */
    public function generateApiToken()
    {
        $this->api_token = Str::random(60);
        $this->save();
        return $this->api_token;
    }
}
