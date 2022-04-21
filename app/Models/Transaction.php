<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "transactions";

    protected $fillable = ["date", "employeee_id"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}
