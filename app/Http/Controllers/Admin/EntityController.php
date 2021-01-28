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
        try{
            $role_data  = '';
            $per_page   = gmvl('entity_per_page', 10);
            $order_by   = gmvl('entity_order_by', 'entity_type_name');
            // $order_by= 'entity_type_name';
            $ordered    = gmvl('entity_ordered', 'DESC');
            $is_page    = (empty($role) ? 'all' : ($role == 'user' ? 'investor' : $role));
            $entity = \DB::table('entity_types')->select(['*', 'entity_types.id as entity_type_id'])
                            ->join('jurisdictions', 'entity_types.jurisdiction_id', '=', 'jurisdictions.id')
                            ->join('legal_structures', 'entity_types.legal_structure_id', '=', 'legal_structures.id')
                            ->orderBy($order_by, $ordered)->paginate($per_page);

            $pagi = $entity->appends(request()->all());
            return view('admin.entity', compact('entity', 'pagi', 'is_page'));
        } catch( \Exception $e){
            echo $e->getMessage();
            exit;
        }
    }
    public function add_entity(Request $request)
    {
        $juris = \DB::table('jurisdictions')->get();
        $legals = \DB::table('legal_structures')->orderby('label')->get();
        return view('admin.entity-type-add')->with(['juris'=>$juris, 'legals'=>$legals]);
    }

    public function addEntities(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     "entityname" => "required|min:4",
        // ]);
        // if ($validator->fails()) {
        //     $ret['msg'] = "warning";
        //     $ret['message'] = __('messages.form.wrong');
        //     return response()->json($ret);
        // } else {
        //     $entype = new EntityTypes;
        //     if ($request->type == "beni") {
        //         $entype->jurisdiction_id = $request->jurisdiction;
        //         $entype->principal_statute = $request->participant_type;
        //         $entype->entity_type_name = $request->entityname;
        //         $entype->abbrev_long = $request->longabb;
        //         $entype->abbrev_short = $request->shortabb;
        //         //    $entype->entity_format = $request->abbformat;        
        //     } else {
        //         $entype->jurisdiction_id = $request->jurisdiction;
        //         $entype->entity_type_name = $request->entityname;
        //         $entype->abbrev_long = $request->longabb;
        //         $entype->abbrev_short = $request->shortabb;
        //         // $entype->abbrev_position = $request->language;
        //         $entype->principal_statute = $request->participant_type;
        //         $entype->register_native_name = $request->register;
        //         $entype->formation_notary_req = $request->transferability;
               
        //     }
        //     try {
        //         $entype->save();
        //         $ret['msg'] = "success";
        //         $ret['message'] = __("message.insert.success");
        //     } catch (\Exception $e) {
        //         // echo $e->getMessage();
        //         $ret['msg'] = 'error';
        //         $ret['message'] = __('Jurisdiction Not Found');
        //     }
        //     return redirect()->route('admin.entity');
        // }
        $companies = \DB::table('entity_types_companies')->get();
        return view('admin.entity-types-companies', compact('companies'));
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

    public function deleteEntitytype($id){
        $en = EntityTypes::where('id', $id)->first();
        if ($en){
            $en->delete();
            $ret['msg']="success";
            $ret['message']=__('Entity Type Deleted Successfully');
        } else {
            $ret['msg'] = 'error';
            $ret['message'] = __('Jurisdiction Not Found');
        }
        return response()->json($ret);
    }
}
