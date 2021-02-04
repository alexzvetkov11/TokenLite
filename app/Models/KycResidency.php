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
class KycResidency extends Model
{
    /*
     * Table Name
     */
    protected $table = 'kyc_residency';

    
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
        //
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function checker_info()
    {
        return $this->belongsTo('App\Models\User', 'reviewed_by', 'id');
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

    // public static function kyc_fields($name = '')
    // {
    //     $fields = [
    //         'kyc_opt_hide' => 0,
    //         'kyc_public' => 1,
    //         'kyc_before_email' => 0,
    //         'kyc_firstname' => array('show' => 1, 'req' => 1),
    //         'kyc_lastname' => array('show' => 1, 'req' => 1),
    //         'kyc_email' => array('show' => 1, 'req' => 1),
    //         'kyc_phone' => array('show' => 1, 'req' => 0),
    //         'kyc_dob' => array('show' => 1, 'req' => 0),
    //         'kyc_gender' => array('show' => 1, 'req' => 1),
    //         'kyc_country' => array('show' => 1, 'req' => 1),
    //         'kyc_state' => array('show' => 1, 'req' => 1),
    //         'kyc_city' => array('show' => 1, 'req' => 1),
    //         'kyc_zip' => array('show' => 1, 'req' => 1),
    //         'kyc_address1' => array('show' => 1, 'req' => 1),
    //         'kyc_address2' => array('show' => 1, 'req' => 0),
    //         'kyc_telegram' => array('show' => 1, 'req' => 0),
    //         'kyc_document_passport' => 1,
    //         'kyc_document_nidcard' => 1,
    //         'kyc_document_driving' => 1,
    //         'kyc_wallet' => array('show' => 1, 'req' => 1),
    //         'kyc_wallet_custom' => array('cw_name' => null, 'cw_text' => null),
    //         'kyc_wallet_note' => __('Address should be ERC20-compliant.'),
    //         'kyc_wallet_opt' => array('wallet_opt' => ['ethereum', 'bitcoin', 'litecoin']),
            
            
    //         "kyc_country_birth" => array('show' => 1, 'req' => 1),
    //         "kyc_birthPlace" => array('show' => 1, 'req' => 1),
    //         "kyc_nationality" =>array('show' => 1, 'req' => 1),
    //         "kyc_nationalityId" =>array('show' => 1, 'req' => 1),
            
    //         "kyc_address_1" => array('show' => 1, 'req' => 1),
    //         "kyc_Building" => array('show' => 1, 'req' => 1),
    //         "kyc_Floor" =>array('show' => 1, 'req' => 1),

    //     ];
    //     if ($name == '') {
    //         return $fields;
    //     } else {
    //         return in_array($name, $fields);
    //     }
    // }

    // public static function documents($name=null)
    // {
    //     $names = [
    //         'passport' => __('Passport'),
    //         'nidcard' => __('National ID Card'),
    //         'driving' => __('Driver’s License'),
    //     ];
    //     if($name) {
    //         return isset($names[$name]) ? $names[$name] : null;
    //     }
    //     return $names;
    // }
    /**
     * Search/Filter parametter exchnage with database value
     *
     * @version 1.0.0
     * @since 1.1.0
     * @return void
     */
    
    public function getAll($request)
    {
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
