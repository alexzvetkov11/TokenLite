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
use App\Models\EntityTypes;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EntityController extends Controller
{
    public function index(Request $request, $status = '')
    {
        $role_data  = '';
        $per_page   = gmvl('entity_per_page', 10);
        $order_by   = gmvl('entity_order_by', 'entity_type');
        $ordered    = gmvl('entity_ordered', 'DESC');
        $is_page    = (empty($role) ? 'all' : ($role == 'user' ? 'investor' : $role));

        $entity = Entity::orderBy($order_by, $ordered)->paginate($per_page);
        $pagi = $entity->appends(request()->all());
        return view('admin.entity', compact('entity', 'pagi', 'is_page'));
    }
    public function add_entity(Request $request)
    {
        $juris = \DB::table('jurisdictions')->get();
        return view('admin.entityadd')->with('juris', $juris);
    }

    public function addEntities(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "entityname" => "required|min:4",
        ]);
        if ($validator->fails()) {
            $ret['msg'] = "warning";
            $ret['message'] = __('messages.form.wrong');
            return response()->json($ret);
        } else {
            $entype = new EntityTypes;
            if ($request->type == "beni") {
                $entype->jurisdiction_id = $request->jurisdiction;
                $entype->entity_principal_statute = $request->participant_type;
                $entype->entity_type_name = $request->entityname;
                $entype->entity_type_abbrev_long = $request->longabb;
                $entype->entity_type_abbrev_short = $request->shortabb;
                //    $entype->entity_format = $request->abbformat;        
            } else {
                $entype->jurisdiction_id = $request->jurisdiction;
                $entype->entity_type_name = $request->entityname;
                $entype->entity_type_abbrev_long = $request->longabb;
                $entype->entity_type_abbrev_short = $request->shortabb;
                $entype->entity_type_lang = $request->language;
                $entype->entity_principal_statute = $request->participant_type;
                $entype->entity_type_register = $request->register;
                $entype->entity_type_loc_dir_sec = $request->requirement;
                $entype->entity_type_cur = $request->currency;
                $entype->entity_type_share_transfer = $request->transferability;
                $entype->entity_type_share_cap_min = $request->minimum;
                $entype->entity_type_shareholder_max = $request->maximum;
                //    $entype->entity_format = $request->abbformat;
            }
            print($entype);
            
            try {
                $entype->save();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            $ret['msg'] = "success";
            $ret['message'] = __("message.insert.success");
            return redirect()->route('admin.entity');
        }
    }

    public function typedetail(Request $request)
    {
        // $validator = Validator::make( $request->all(), [
        //     "id" => "required",
        // ]);
        // if ($validator->fails()){
        //     $ret['msg']="warning";
        //     $ret['message']= __('messages.form.wrong');
        //     return back()->with([$ret['msg'] => $ret['message']]);
        // } else {
        //     $entity_one = Entity::where('id', $request->id)->first();
        //     dd($entity_one);
        //     exit;
        //     return view('admin.entitydetail')->with('obj', $entity_one);
        // }

        $entity_one = Entity::where('id', $request->id)->first();
        return view('admin.entitydetail')->with('obj', $entity_one);
    }
}
