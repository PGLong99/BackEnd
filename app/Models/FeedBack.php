<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    protected $table = 'feed_back';
    protected $fillable = ['email', 'subject', 'content'];
}
