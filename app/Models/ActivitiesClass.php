<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivitiesClass extends Model
{
    protected $table = 'business_acitivities_class';
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
