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
class Entity extends Model
{
    /*
     * Table Name
     */
    protected $table = 'entity';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entity_type', 'jurisdiction', 'status',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function check_entype()
    {
        return $this->belongsTo('App\Models\EntityTypes', 'entity_type', 'id');
    }
    public function check_juris()
    {
        return $this->belongsTo('App\Models\Jurisdictions', 'jurisdiction', 'id');
    }
}
