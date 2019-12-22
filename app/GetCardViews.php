<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GetCardViews extends Model
{
    protected $table = 'cardview';
    protected $primaryKey = 'view_id';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
