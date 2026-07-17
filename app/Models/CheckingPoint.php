<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckingPoint extends Model
{
    protected $fillable = [
        'name',
        'incharge_name',
        'police_station',
        'is_active',
        'created_by'
    ];

    public function vehicleChecks()
    {
        return $this->hasMany(VehicleCheck::class);
    }
}
