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
class Jurisdictions extends Model
{
    /*
     * Table Name
     */
    protected $table = 'jurisdictions';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function check_lang()
    {
        return $this->belongsTo("App\Models\Language", "language_id", "id");
    }
    public function check_currency()
    {
        return $this->belongsTo("App\Models\Currency", "currency_id", "id");
    }
    public function check_country()
    {
        return $this->belongsTo("App\Models\Countries", "country_id", "id");
    }
}
