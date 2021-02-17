<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use App\Models\Setting;
use App\Models\Entity;
use App\Models\OfficeServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EntityTypes;
use App\Models\Jurisdictions;

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

    public function addentities()
    {

        $juris_actived = Jurisdictions::where('jur_status', 'active')->orderby('jurisdiction_name', 'ASC')->get();
        $juris = Jurisdictions::orderby('jur_status', 'ASC')->orderby('jurisdiction_name', 'ASC')->get();
        $entype = EntityTypes::orderby('entity_type_name', 'ASC')->get();

        return view('admin.entities-add', compact('juris_actived', 'juris', 'entype' ));
    }

    public function add_entities_post( Request $request )
    {
        $offices = OfficeServices::get();
        return view('admin.entities-template1', compact('offices'));
    }

    public function add_entities_post_next( Request $request )
    {
        $offices = OfficeServices::get();
        return view('admin.entities-template2', compact('offices'));
    }

}
