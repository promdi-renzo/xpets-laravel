<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction_line extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "transaction_line";

    protected $fillable = ["transaction_id", "service_id"];
}
