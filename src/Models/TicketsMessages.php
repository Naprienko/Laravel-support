<?php

namespace Ingvar\Support\Models;

use Illuminate\Database\Eloquent\Model;

class TicketsMessages extends Model
{
    protected $table = 'tickets_messages';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
