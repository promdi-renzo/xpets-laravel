<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    public const VAL = [
        "service_name" => ["required", "min:3"],
        "cost" => ["required", "numeric", "min:3"],
        "images" => ["required", "image", "mimes:jpg,png,jpeg,gif", "max:5048"],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "services";

    protected $fillable = ["service_name", "cost", "images"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];

    //public function animal()
    //{
    //  return $this->belongsTo("\App\Models\Animal", "pets_id");
    //}
}
