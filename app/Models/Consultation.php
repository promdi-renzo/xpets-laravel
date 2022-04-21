<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{
    public const VAL = [
        "date" => ["required"],
        "disease_injury" => ["required"],
        "price" => ["required", "numeric", "min:1", "max:10000"],
        "comment" => ["required"],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "consultations";

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}
