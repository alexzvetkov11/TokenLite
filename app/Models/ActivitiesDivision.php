<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivitiesDivision extends Model
{
    protected $table = 'business_acitivities_division';
    // protected $fillable = [
    //     'article_label', 'statue_type',
    // ];

    public function __construct()
    {
        //
    }


    public function getAll()
    {
        return $this;
    }
}
