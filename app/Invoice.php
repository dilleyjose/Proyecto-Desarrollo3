<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'client_id', 'user_id','identity_card','amount','create_at'
    ];

    public function client(){
        return $this->belongsTo('App\Client','client_id','id');
    }

    public function items(){
    	return $this->hasMany(itemInvoice::class);
    }
}
