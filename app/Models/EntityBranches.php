<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * KYC Model
 *
 *  Manage the User Submitted KYC
 *
 * @package TokenLite
 * @author Softnio
 * @version 1.1
 * @method static orderBy(string $string, string $string1)
 * @method static FindOrFail($id)
 */
class EntityBranches extends Model
{
    /*
     * Table Name
     */
    protected $table = 'entities_branches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function check_entities(){
        return $this->belongsTo('App\Models\Entity', 'entity_id', 'id');
    }


}
