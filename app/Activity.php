<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable=['user_id','date','location','note','activity','number_of_hour','file'];
}
