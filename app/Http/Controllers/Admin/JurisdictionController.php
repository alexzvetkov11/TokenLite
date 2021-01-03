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
use App\Models\Entity;
use Auth;
use Illuminate\Http\Request;
use Validator;

class JurisdictionController extends Controller
{
    public function index(Request $request)
    {
        $role_data = '';
        $per_page = gmvl('entity_per_page', 10);
        $order_by = gmvl('entity_order_by', 'entity_type');
        $ordered = gmvl('entity_ordered', 'ASC');
        $is_page = (empty($role) ? 'all' : ($role == 'user' ? 'investor' : $role));

        $entity = Entity::orderBy($order_by, $ordered)->paginate($per_page);

        $pagi = $entity->appends(request()->all());
        return view('admin.jurisdiction', compact('entity', 'pagi', 'is_page'));

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
            $entity_one = Entity::where("id", $request['juris_id'])->first();
            $entity_one->jurisdiction = $request->juris_name;
            $entity_one->save();
            exit("here");
            $ret['msg'] = 'success';
            $ret['message'] = __('messages.insert.success');

            if ($request->ajax()) {
                return response()->json($ret);
            }
            return back()->with([$ret['msg'] => $ret['message']]);
        }
    }
}
