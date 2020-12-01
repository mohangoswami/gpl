<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subCode extends Model
{
    protected $fillable = [
        'class', 'subject', 'link_url', 'start_time', 'end_time', 'day0', 'day1', 'day2', 'day3', 'day4', 'day5', 'day6',
    ];
    public function create_subCode(){
       
      
    }
}
