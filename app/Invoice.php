<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'client_id', 'user_id','identity_card','amount'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client','client_id','id');
    }
}
