<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class RollAmount extends Model
{

    public function volt()
    {
        return $this->belongsTo(Volt::class,  'volt_id', 'id');
    }
}
