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
use App\Models\BusinessActivities;
use App\Models\ActivitiesClass;
use App\Models\ActivitiesDivision;
use App\Models\ActivitiesGroup;
use App\Models\ActivitiesSubclass;
use App\Models\Jurisdictions;
use App\Models\EntityTypes;
use App\Models\Setting;
use App\Models\OfficeServices;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Builder\Function_;

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
        return view('user.entities', compact('entity', 'pagi', 'is_page'));
    }

    public function addentities_index()
    {

        $juris_actived = Jurisdictions::where('jur_status', 'active')->orderby('jurisdiction_name', 'ASC')->get();
        $juris = Jurisdictions::orderby('jur_status', 'ASC')->orderby('jurisdiction_name', 'ASC')->get();
        $entype = EntityTypes::orderby('entity_type_name', 'ASC')->get();

        return view('user.entities-add', compact('juris_actived', 'juris', 'entype' ));
    }
    public function entities_add(Request $request)
    {
        try{
            if ( $request->type=="incorporate"){

                $entities = new Entity;
                $entities->jurisdiction = $request->jurisdiction2;
                $entities->entity_type = $request->entype2;
                $entities->entity_name = $request->entity_name2;
                $entities->registration = $request->registration;
                $entities->document = $request->document_one;
                $entities->onboarding = $request->onboarding;
                // $entities->save();

                $business = BusinessActivities::get();
                $divisions = ActivitiesDivision::get();
                $groups = ActivitiesGroup::get();
                $classes = ActivitiesClass::get();
                $subclasses = ActivitiesSubclass::get();
                return view('user.entities-template1', compact('business', 'entities', 'divisions', 'groups', 'classes', 'subclasses'));

            } else if ($request->type=="exist") {

                if ($request->type =='other' ){
                    exit('other');
                    $ret['msg'] = 'error';
                    $ret['message'] =__("didn't make this part");
                    return back()->with( [$ret['msg']=> $ret['message'] ]);
                } else {
                    $entities = new Entity;
                    $entities->entity_name = $request->entity_name1;
                    $entities->entity_type = $request->entype1;
                    $entities->jurisdiction = $request->jurisdiction1;
                    $entities->onboarding = "full_functionality";
                    $entities->start_date = _date($request->start_date, 'Y-m-d');
                    // $entities->save();

                    $business = BusinessActivities::get();
                    $divisions = ActivitiesDivision::get();
                    $groups = ActivitiesGroup::get();
                    $classes = ActivitiesClass::get();
                    $subclasses = ActivitiesSubclass::get();

                    return view('user.entities-template1', compact('business', 'entities', 'divisions', 'groups', 'classes', 'subclasses'));
                }
            }
        } catch (\Exception $e){
            $ret['msg'] = 'error';
            $ret['message'] =__("didn't make this part");
            return back()->with( [$ret['msg']=> $ret['message'] ]);
        }

    }

    public function change_business_activities(Request $request)
    {
        try{
            if ( $request->type == "add"){
                $busi = new BusinessActivities;
                $busi->entity_id = $request->entities;
                $busi->division_id = $request->division;
                $busi->group_id= $request->group;
                $busi->class_id = $request->class;
                $busi->subclass_id = $request->subclass;
                $busi->percent = $request->percent;
                // $busi->save();

                $business = BusinessActivities::get();
                $divisions = ActivitiesDivision::get();
                $groups = ActivitiesGroup::get();
                $classes = ActivitiesClass::get();
                $subclasses = ActivitiesSubclass::get();
                $entities = Entity::where('id', $request->entities)->first();
                $ret['msg'] = 'success';
                $ret['message'] =__("Business Activities Successfully Changed");
                return view('user.entities-template1', compact('business', 'entities', 'divisions', 'groups', 'classes', 'subclasses'));
            } else {
                $busi = BusinessActivities::where('id', $request->id)->first();
                $busi->entity_id = $request->entities;
                $busi->division_id = $request->division;
                $busi->group_id= $request->group;
                $busi->class_id = $request->class;
                $busi->subclass_id = $request->subclass;
                $busi->percent = $request->percent;
                // $busi->save();

                $business = BusinessActivities::get();
                $divisions = ActivitiesDivision::get();
                $groups = ActivitiesGroup::get();
                $classes = ActivitiesClass::get();
                $subclasses = ActivitiesSubclass::get();
                $entities = Entity::where('id', $request->entities)->first();
                $ret['msg'] = 'success';
                $ret['message'] =__("Business Activities Successfully Changed");
                return view('user.entities-template1', compact('business', 'entities', 'divisions', 'groups', 'classes', 'subclasses'));
            }

        } catch(\Exception $e){
            echo $e->getMessage();
            $ret['msg'] = 'error';
            $ret['message'] =__("didn't make this part");
            return response()->json($ret);
        }
    }


    public function add_purpose_activities(Request $request)
    {
        // $entities = Entity::where("id", $request->entities)->first();
        $offices = OfficeServices::get();
        return view('user.entities-template2', compact('offices'));
    }

    public function add_domiciliation(Request $request)
    {
        // $entities = Entity::where("id", $request->entities)->first();
        return view('user.entities-share-capital');
    }
}
