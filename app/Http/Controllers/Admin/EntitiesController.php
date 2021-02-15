<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use App\Models\Setting;
use App\Models\Entity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EntitiesController extends Controller
{
    public function index(Request $request)
    {
        $role_data  = '';
        $per_page   = gmvl('entity_per_page', 10);
        $order_by   = gmvl('entity_order_by', 'entity_type');
        $ordered    = gmvl('entity_ordered', 'ASC');
        $is_page    = (empty($role) ? 'all' : ($role=='user' ? 'investor' : $role));
        $entity = Entity::orderBy($order_by, $ordered)->paginate($per_page);
        $pagi = $entity->appends(request()->all());
        return view('admin.entities', compact('entity', 'pagi', 'is_page'));
    }

    public function addentities(Request $request){
        return view('admin.entities-add');
    }

    public function add_entities_post( Request $request){
        return view('admin.entities-template');
    }
}
