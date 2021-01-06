<?php

namespace App\Http\Controllers\User;
/**
 * KYC Controller
 *
 * @package TokenLite
 * @author Softnio
 * @version 1.1.0
 */
use Auth;
use Validator;
use App\Models\Entity;
use App\Models\Jurisdictions;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EntitiesController extends Controller
{
    public function index(Request $request, $status = '')
    {
        return view('user.entities', compact('entity', 'pagi', 'is_page'));
    }
    public function add_entities( Request $request){
        $juris = Jurisdictions::select('jurisdiction_name')->get();
         
        return view('user.entitiesadd')->with(["juris"=> $juris]);
    }
}
