<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'isp', 'satisfaction', 'lat', 'long'
    ];

    protected $appends = array('score');

    public function getScoreAttribute()
    {
        return substr($this->satisfaction, 0, 1);
    }

}
