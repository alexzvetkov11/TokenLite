<?php

namespace App\Models;

use Illuminate\Http\Request;
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
        //
    }

    /**
    * Search/Filter parametter exchnage with database value
    *
    * @version 1.0.0
    * @since 1.1.0
    * @return void
    */
    public function getAll($request) {
        // $result = [];
        // $find = ['state', 'doc'];
        // $replace = ['status', 'documentType'];
        // foreach($request as $key => $value) {
        //     $set_key = str_replace($find, $replace, $key);
        //     $val = trim($value);

        //     if(!empty($val)) {
        //         $result[] = array($set_key, '=', $val);
        //     }
        // }
        return $this;
    }


}
