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
class EntityCompaniesPurpose extends Model
{
    /*
     * Table Name
     */
    protected $table = 'entities_companies_purpose';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Search/Filter parametter exchnage with database value
     *
     * @version 1.0.0
     * @since 1.1.0
     * @return void
     */
    public function getAll($request)
    {
        return $this;
    }

    public function check_entities(){
        return $this->belongsTo('App\Models\Entity', 'entity_id', 'id');
    }
}
