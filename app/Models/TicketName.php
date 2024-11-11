<?php

namespace App\Models;

use App\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketName extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'status' => StatusEnum::class,
        ];
    }


    public function ticket()
    {
        return $this->belongsTo(Tickets::class,  'ticket_id', 'id');
    }
}
