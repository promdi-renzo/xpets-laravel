<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    public const VAL = [
        "full_name" => ["required", "min:8"],
        "number" => ["required", "min:9"],
        "pictures" => ["required", "image", "mimes:jpg,png,jpeg,gif", "max:5048"],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "customers";

    protected $primaryKey = "id";

    protected $guarded = ["id"];

}
