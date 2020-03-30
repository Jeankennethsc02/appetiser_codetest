<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = ['title', 'start', 'end', 'created_at', 'updated_at'];
    
    // protected $hidden = [
    //     'created_at', 'updated_at',
    //     ];

    
}
