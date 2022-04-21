<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    public const VAL = [
        "pet_name" => ["required", "alpha", "min:3"],
        "sex" => ["required", "alpha", "string", "min:3"],
        "classification" => ["required", "alpha", "min:3", "string"],
        "pictures" => ["required", "image", "mimes:jpg,png,jpeg,gif", "max:5048"],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "pets";

    protected $primaryKey = "id";

    protected $guarded = ["id"];

}
