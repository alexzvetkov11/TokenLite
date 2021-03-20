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
class EntitiesCorporateBodies extends Model
{
    /*
     * Table Name
     */
    protected $table = 'entities_corporate_bodies_shareholders';

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

    public function check_shareclass()
    {
        return $this->belongsTo('App\Models\EntitiesShareClasses', 'share_class_id', 'id');
    }
    public function check_entity()
    {
        return $this->belongsTo('App\Models\Entity', 'entity_id', 'id');
    }
}
