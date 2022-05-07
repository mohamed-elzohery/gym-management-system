<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ForgetPassword extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'mail',
        'code',
        'send-code_at',
    ];
}
