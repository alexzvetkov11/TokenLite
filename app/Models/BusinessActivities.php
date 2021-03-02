<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessActivities extends Model
{
    protected $table = 'entities_business_activities';
    // protected $fillable = [
    //     'article_label', 'statue_type',
    // ];

    public function __construct()
    {
        //
    }

    public function get_entity(){
        return $this->belongsTo('App\Models\Entity', 'entity_id', 'id');
    }
    public function get_branch(){
        return $this->belongsTo('App\Models\EntityBranches', 'branch_id', 'id');
    }
    public function get_division(){
        return $this->belongsTo('App\Models\ActivitiesDivision', 'division_id', 'id');
    }
    public function get_group(){
        return $this->belongsTo('App\Models\ActivitiesGroup', 'group_id', 'id');
    }
    public function get_class(){
        return $this->belongsTo('App\Models\ActivitiesClass', 'class_id', 'id');
    }
    public function get_subclass(){
        return $this->belongsTo('App\Models\ActivitiesSubclass', 'subclass_id', 'id');
    }

}
