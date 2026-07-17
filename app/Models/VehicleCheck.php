<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleCheck extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'checking_point_id',
        'person_name',
        'shift_date',
        'shift_type',
        'vehicle_no',
        'employee_id_no',
        'vehicle_photo',
        'checking_time',
        'remark'
    ];

    protected $casts = [
        'shift_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkingPoint()
    {
        return $this->belongsTo(CheckingPoint::class);
    }
}
