<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revenue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'price',
        'payment_id',
        'statuses',
        'visa_number',
        'payment_method',
        'user_id',
        'training_package_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainingPackage()
    {
        return $this->belongsTo(TrainingPackage::class);
    }
}
