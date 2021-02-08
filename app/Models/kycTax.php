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
class KycTax extends Model
{
    /*
     * Table Name
     */
    protected $table = 'kyc_tax';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [

    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    public function checker_info()
    {
        return $this->belongsTo('App\Models\User', 'reviewed_by', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    protected static function keys_in_filter($request) {
        $result = [];
        $find = ['state', 'doc'];
        $replace = ['status', 'documentType'];
        foreach($request as $key => $value) {
            $set_key = str_replace($find, $replace, $key);
            $val = trim($value);

            if(!empty($val)) {
                $result[] = array($set_key, '=', $val);
            }
        }
        return $result;
    }

    public static function documents($name=null)
    {
        $names = [
            'passport' => __('Passport'),
            'nidcard' => __('National ID Card'),
            'driving' => __('Driver’s License'),
        ];
        if($name) {
            return isset($names[$name]) ? $names[$name] : null;
        }
        return $names;
    }
}
