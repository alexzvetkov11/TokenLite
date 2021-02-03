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
class KycIdentity extends Model
{
    /*
     * Table Name
     */
    protected $table = 'kyc_identity';

    const KYCI_STATUS = ['pending', 'approved', 'missing', 'rejected'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    const WALLETS = ['ethereum' => 'Ethereum', 'bitcoin' => 'Bitcoin', 'binance' => 'Binance', 'litecoin' => 'Litecoin', 'ripple'=> 'Ripple',
                     'stellar'=> 'Stellar', 'tether'=> 'Tether', 'waves' => 'WAVES', 'dash' => 'DASH', 'tron' => 'TRON'];

    // protected $fillable = [
    //     'user_id',	'first_middle_names',	'last_name',	'gender_id',	'dob',	'country_of_birth',	'place_of_birth',	'citizenship',	'nationality_id',	
    //     'document_type',	'document_issue_date',	'document_expiry_date',	'document',	'document2',	'document3',	'document4',	'notes',	'reviewed_by',	
    //     'reviewed_at',	'status'
    // ];
    protected $fillable = [
        'user_id', 'first_middle_names', 'last_name',
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


    public static function AdvancedFilter($request)
    {
        if($request->s){
            $kycs = KycIdentity::whereNotIn('status', ['deleted'])->where(function($q) use ($request){
                        $id_num = (int)(str_replace(config('icoapp.user_prefix'), '', $request->s));
                        
                        $q->orWhere('user_id', $id_num)->orWhere('first_middle_names', 'like', '%'.$request->s.'%')->orWhere('last_name', 'like', '%'.$request->s.'%');
                    });
            return $kycs;
        }

        if ($request->filter) {
            $kycs = KycIdentity::whereNotIn('status', ['deleted'])->where( self::keys_in_filter($request->only(['state', 'doc'])) )
                        ->when($request->search, function($q) use ($request){
                            $where  = (isset($request->by) && $request->by=='name') ? 'first_middle_names' : 'user_id';
                            $search = ($where=='user_id') ? (int)(str_replace(config('icoapp.user_prefix'), '', $request->search)) : $request->search;
                            if($where=='name') {
                                $q->where('first_middle_names', 'like', '%'.$search.'%')->orWhere('last_name', 'like', '%'.$search.'%');
                            } else {
                                $q->where($where, $search);
                            }
                        });
            return $kycs;
        }
        return $this;
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
    public static function kyc_fields($name = '')
    {
        $fields = [
            'kyc_opt_hide' => 0,
            'kyc_public' => 1,
            'kyc_before_email' => 0,
            'kyc_firstname' => array('show' => 1, 'req' => 1),
            'kyc_lastname' => array('show' => 1, 'req' => 1),
            'kyc_email' => array('show' => 1, 'req' => 1),
            'kyc_phone' => array('show' => 1, 'req' => 0),
            'kyc_dob' => array('show' => 1, 'req' => 0),
            'kyc_gender' => array('show' => 1, 'req' => 1),
            'kyc_country' => array('show' => 1, 'req' => 1),
            'kyc_state' => array('show' => 1, 'req' => 1),
            'kyc_city' => array('show' => 1, 'req' => 1),
            'kyc_zip' => array('show' => 1, 'req' => 1),
            'kyc_address1' => array('show' => 1, 'req' => 1),
            'kyc_address2' => array('show' => 1, 'req' => 0),
            'kyc_telegram' => array('show' => 1, 'req' => 0),
            'kyc_document_passport' => 1,
            'kyc_document_nidcard' => 1,
            'kyc_document_driving' => 1,
            'kyc_wallet' => array('show' => 1, 'req' => 1),
            'kyc_wallet_custom' => array('cw_name' => null, 'cw_text' => null),
            'kyc_wallet_note' => __('Address should be ERC20-compliant.'),
            'kyc_wallet_opt' => array('wallet_opt' => ['ethereum', 'bitcoin', 'litecoin']),
            
            
            "kyc_country_birth" => array('show' => 1, 'req' => 1),
            "kyc_birthPlace" => array('show' => 1, 'req' => 1),
            "kyc_nationality" =>array('show' => 1, 'req' => 1),
            "kyc_nationalityId" =>array('show' => 1, 'req' => 1),
            
            "kyc_address_1" => array('show' => 1, 'req' => 1),
            "kyc_Building" => array('show' => 1, 'req' => 1),
            "kyc_Floor" =>array('show' => 1, 'req' => 1),

        ];
        if ($name == '') {
            return $fields;
        } else {
            return in_array($name, $fields);
        }
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
