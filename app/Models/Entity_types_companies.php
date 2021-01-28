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
class Entity_types_companies extends Model
{
    /*
     * Table Name
     */
    protected $table = 'entity_types_companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'members_min',	'members_max',	'share_transferability',	'share_cap_issued_min',	'share_cap_paid_up_min',	
        'share_cap_authorized_paid_up_min_rel',	'shares_issued_min', 'shares_issued_max',	'shares_without_dividend_rights',	'shares_without_voting_rights',	'shares_without_dividend_voting_rights',	'bearer_shares_permitted',	'fractional_shares_permitted',	'directors_min',
        'directors_max',	'local_dir_req',	'local_officer_req',	'local_reg_office_req',	'members_annual_meeting_req',	'member_annual_accounts_approval_deadline_days',	'member_annual_accounts_approval_deadline_adjusted_days',	'filing_members_req',	'filing_directors_req',	'filing_officers_req',	'filing_ubo_req',
        'UBO_THRESHOLD_CAPITAL_RIGHTS',	'UBO_THRESHOLD_VOTING_INTEREST',	'FILING_ANNUAL_ACCOUNTS_REQ',	'FILING_ANNUAL_ACCOUNTS_DEADLINE_DAYS','	FILING_CLASSIFICATION',
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
