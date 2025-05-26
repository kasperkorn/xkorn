<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floodgate extends Model
{
    use HasFactory;

    protected \$table = 'floodgates';
    protected \$primaryKey = 'id';
    public \$incrementing = false;
    protected \$keyType = 'string';

    protected \$fillable = [
        'id',
        'location',
        'water_flow_rate',
        'status',
        'pump_status',
    ];
}
