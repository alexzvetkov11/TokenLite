<?php

namespace App\Http\Controllers\Admin;
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
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EntitiesController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.entities');
    }
    public function add_entity( Request $request){

    }
}
