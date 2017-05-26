<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
    //
    protected $table = "conversations";

    protected $fillable = ['user_one', 'user_two', 'status'];
}
