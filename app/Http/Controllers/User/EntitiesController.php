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
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EntitiesController extends Controller
{
    public function index(Request $request, $status = '')
    {
        $role_data  = '';
        $per_page   = gmvl('entity_per_page', 10);
        $order_by   = gmvl('entity_order_by', 'entity_type');
        $ordered    = gmvl('entity_ordered', 'ASC');
        $is_page    = (empty($role) ? 'all' : ($role=='user' ? 'investor' : $role));

        $entity = Entity::orderBy($order_by, $ordered)->paginate($per_page);

        $pagi = $entity->appends(request()->all());
        // print("<pre>");
        // print_r( $entity);
        // print_r($is_page);
        // print("</pre>");
        // exit;
        return view('user.entities', compact('entity', 'pagi', 'is_page'));
    }
    public function add_entities( Request $request){
        return view('user.entitiesadd');
    }
}
