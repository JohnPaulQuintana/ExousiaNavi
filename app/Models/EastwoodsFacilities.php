<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EastwoodsFacilities extends Model
{
    use HasFactory;
    public $fillable = ['facilities','operation_time', 'floor'];
}
