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
use App\Models\Language;
use App\Models\Currency;
use Auth;
use Illuminate\Http\Request;
use Validator;

class JurisdictionController extends Controller
{
    public function index(Request $request)
    {

        //$role_data = '';
        $per_page = gmvl('jurisdiction_per_page', 10);
        $order_by = gmvl('jurisdiction_order_by', 'jur_id');
        $ordered = gmvl('jurisdiction_ordered', 'DESC');
        $is_page = (empty($role) ? 'all' : ($role == 'user' ? 'investor' : $role));
        $juris = \DB::table("jurisdictions")->select(['*', 'jurisdictions.id as jur_id'])
                    ->join('languages', 'jurisdictions.language_code', '=', 'languages.id')
                    ->join('currencies', 'jurisdictions.main_currency_code', '=', 'currencies.cur_id')
                    ->orderby($order_by, $ordered)->paginate($per_page);
        $pagi = $juris->appends(request()->all());
        
        $languages = Language::orderby('id', 'ASC')->get();
        $currencies = Currency::orderby('cur_id', 'ASC')->get();

        return view('admin.jurisdiction', compact('juris', 'pagi', 'is_page', 'languages', 'currencies'));
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
            $juris_one->language_code = $request->lang_code;
            $juris_one->main_currency_code = $request->cur_code;
            $juris_one->jur_status = ($request->statue_switcher ? 'active' : 'inactive');
            try {
                $juris_one->save(); // returns false
            } catch (\Exception $e) {
                echo $e->getMessage(); // insert query
                exit;
            }
            $ret['msg'] = 'success';
            // $ret['message'] = __('messages.update.success', ['what' => 'Jurisdiction']);
            $ret['message'] = __("Jurisdiction changed successfully!");
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
                $juris_one =new Jurisdictions;
                $juris_one->jurisdiction_name = $request->juris_name;
                $juris_one->language_code = $request->lang_code;
                $juris_one->main_currency_code = $request->cur_code;
                $juris_one->jur_status = ($request->statue_switcher ? 'active' : 'inactive');
                $juris_one->save();
            } catch(\Exception $e){
                echo $e->getMessage();
            }
            $ret['msg'] = 'success';
            // $ret['message'] = __('messages.insert.success', ['what' => 'Jurisdiction']);
            $ret['message'] = __("Jurisdiction added successfully!");
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
