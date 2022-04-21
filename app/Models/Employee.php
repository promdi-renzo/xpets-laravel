<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    public const VAL = [
        "full_name" => ["required", "string", "min:5"],
        "email" => ["required", "string", "email", "unique:employees"],
        "password" => ["required", "min:5", "confirmed"],
        "pictures" => ["required", "image", "mimes:jpg,png,jpeg,gif", "max:5048"],
    ];

    protected $dates = ["deleted_at"];

    protected $table = "employees";

    protected $primaryKey = "id";

    protected $guarded = ["id"];

    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["full_name", "email", "password", "pictures"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];
}
