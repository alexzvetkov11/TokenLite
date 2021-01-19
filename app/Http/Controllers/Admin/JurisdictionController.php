<?php

namespace App\Http\Controllers\Admin;

/**
 * KYC Controller
 *
 * @package TokenLite
 * @author Softnio
 * @version 1.1.0
 */
use App\Http\Controllers\Controller;
use App\Models\Jurisdictions;
use Auth;
use Illuminate\Http\Request;
use Validator;

class JurisdictionController extends Controller
{
    public function index(Request $request)
    {
        //$role_data = '';
        $per_page = gmvl('jurisdiction_per_page', 10);
        $order_by = gmvl('jurisdiction_order_by', 'id');
        $ordered = gmvl('jurisdiction_ordered', 'DESC');
        $is_page = (empty($role) ? 'all' : ($role == 'user' ? 'investor' : $role));
        $juris = Jurisdictions::orderby($order_by, $ordered)->paginate($per_page);
        // try {
        //     $juris = Jurisdictions::orderby($order_by, $ordered)->paginate($per_page);
        // } catch (\Exception $e) {
        //     echo $e->getMessage();
        // }
        print("here");
        $pagi = $juris->appends(request()->all());

        return view('admin.jurisdiction', compact('juris', 'pagi', 'is_page'));
    }

    public function editJuris(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "juris_name" => "required|min:2",
            "juris_id" => "required",
        ]);

        if ($validator->fails()) {
            $msg = __('messages.form.wrong');
            $ret['msg'] = 'warning';
            $ret['message'] = $msg;
            return response()->json($ret);
        } else {
            $juris_one = Jurisdictions::where("id", $request['juris_id'])->first();
            $juris_one->jurisdiction_name = $request->juris_name;
            try {
                $juris_one->save(); // returns false
            } catch (\Exception $e) {
                echo $e->getMessage(); // insert query
            }
            $ret['msg'] = 'success';
            $ret['message'] = __('messages.update.success', ['what' => 'Jurisdiction']);

            if ($request->ajax()) {
                return response()->json($ret);
            }
            return back()->with([$ret['msg'] => $ret['message']]);
        }
    }

    public function addJuris(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "juris_name" => "required|min:2",
        ]);
        if ($validator->fails()) {
            $msg = __('messages.form.wrong');
            $ret['msg'] = 'warning';
            $ret['message'] = $msg;
            return response()->json($ret);
        } else {
            try{
                $juris =new Jurisdictions;
                $juris->jurisdiction_name = $request->juris_name;
                $juris->save();
            } catch(\Exception $e){
                echo $e->getMessage();
            }
            $ret['msg'] = 'success';
            $ret['message'] = __('messages.insert.success', ['what' => 'Jurisdiction']);
            if ($request->ajax()) {
                return response()->json($ret);
            }
            return back()->with([$ret['msg'] => $ret['message']]);
            
        }
    }

    public function delJuris($jur_id){
        $juris = Jurisdictions::where('id', $jur_id)->first();
        if ($juris){
            $juris->delete();
            $ret['msg'] = "success";
            $ret['message'] =  __('Jurisdiction Delete Successfully');
        } else{
            $ret['msg'] = 'error';
            $ret['message'] = __('Jurisdiction Not Found');
        }
        return response()->json($ret);
    }
}
