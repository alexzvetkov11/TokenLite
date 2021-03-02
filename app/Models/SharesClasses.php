<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharesClasses extends Model
{
    protected $table = 'shares_classes';
    // protected $fillable = [
    //     'article_label', 'statue_type',
    // ];

    public function __construct()
    {
        //
    }


    public function check_entity()
    {
        return $this->belongsTo('App\Models\Entity', 'entity_id', 'id');
    }
}
