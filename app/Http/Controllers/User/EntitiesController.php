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
use App\Models\EntityTradingName;
use App\Models\EntityCompaniesPurpose;
use App\Models\Currency;
use App\Models\EntityBranches;
use App\Models\EntityAddresses;
use App\Models\EntitiesDomiciliationOffice;
use App\Models\EntitiesShareClasses;
use App\Models\EntitiesShareRight;

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
        // dd($request->all());
        try{
            if ( $request->type=="incorporate"){

                $entities = new Entity;
                $entities->jurisdiction = $request->jurisdiction2;
                $entities->entity_type = $request->entype2;
                $entities->entity_name = $request->entity_name2;
                $entities->registration = $request->registration;
                $entities->document = $request->document_one;
                $entities->onboarding = $request->onboarding;
                $entities->save();

                $business = BusinessActivities::get();
                $divisions = ActivitiesDivision::get();
                $groups = ActivitiesGroup::get();
                $classes = ActivitiesClass::get();
                $subclasses = ActivitiesSubclass::get();
                // return redirect()->route('user.entities.template1', ['entites_id'=>$entities->id]);
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
                    $entities->save();

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
            $ret['message'] =__("messages.somthing.wrong");
            return back()->with( [$ret['msg']=> $ret['message'] ]);
        }

    }

    public function template1(Request $request){

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
                $busi->save();

                $business = BusinessActivities::get();
                $divisions = ActivitiesDivision::get();
                $groups = ActivitiesGroup::get();
                $classes = ActivitiesClass::get();
                $subclasses = ActivitiesSubclass::get();
                $entities = Entity::where('id', $request->entities)->first();
                $ret['msg'] = 'success';
                $ret['message'] =__("Business Activities Successfully Changed");
                return view('user.entities-template1', compact('business', 'entities', 'divisions', 'groups', 'classes', 'subclasses'));
                // return back()->with( [ $ret['msg']=>$ret['message'] ]);
            } else {
                $busi = BusinessActivities::where('id', $request->id)->first();
                $busi->entity_id = $request->entities;
                $busi->division_id = $request->division;
                $busi->group_id= $request->group;
                $busi->class_id = $request->class;
                $busi->subclass_id = $request->subclass;
                $busi->percent = $request->percent;
                $busi->save();

                $business = BusinessActivities::get();
                $divisions = ActivitiesDivision::get();
                $groups = ActivitiesGroup::get();
                $classes = ActivitiesClass::get();
                $subclasses = ActivitiesSubclass::get();
                $entities = Entity::where('id', $request->entities)->first();
                $ret['msg'] = 'success';
                $ret['message'] =__("Business Activities Successfully Changed");
                // return back()->with( [ $ret['msg']=>$ret['message'] ]);
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
        try{
            $trading = new EntityTradingName;
            $trading->entity_id = $request->entity_id;
            $trading->type= "head";
            $trading->trading_name = $request->trading_name;
            // $trading->save();

            $purpose = new EntityCompaniesPurpose;
            $purpose->entity_id = $request->entity_id;
            $purpose->purpose_type = $request->purpose_type;
            $purpose->activity_description = $request->description;
            if ( isset($request->chB2B) ){
                if ( $request->b2b=='b2bservice') {
                    $purpose->b2b_service = "Y";
                    $purpose->b2b_product = "N";
                } else{
                    $purpose->b2b_service = "N";
                    $purpose->b2b_product = "Y";
                }
            }
            if ( isset($request->chB2C)){
                if ( $request->b2c=='b2cservice') {
                    $purpose->b2c_service = "Y";
                    $purpose->b2c_product = "N";
                } else {
                    $purpose->b2c_service = "N";
                    $purpose->b2c_product = "Y";
                }
            }

            $purpose->products_manufacture = isset($request->manufacture)?"Y": "N" ;
            $purpose->products_import = isset($request->import)?"Y": "N" ;
            $purpose->products_export = isset($request->export)?"Y": "N" ;
            $purpose->products_domestic_trade = isset($request->domestic)?"Y": "N" ;
            $purpose->places_retail = isset($request->outlet)?"Y": "N" ;
            $purpose->places_market = isset($request->market)?"Y": "N" ;
            $purpose->places_street = isset($request->street)?"Y": "N" ;
            $purpose->palces_internet = isset($request->internet)?"Y": "N" ;
            $purpose->places_home = isset($request->home)?"Y": "N" ;
            $purpose->places_mailorder = isset($request->mail)?"Y": "N" ;
            // $purpose->financial_services = isset($request->namely)?"Y": "N" ;
            $purpose->places_other = $request->othername;
            $purpose->places_other_text = $request->txt_namely;
            // $purpose->save();

        }
        catch(\Exception $e){
            echo $e->getMessage();
            $ret['msg'] = 'warning';
            $ret['message'] = __('messages.form.wrong');
            return back()->with([$ret['msg'] => $ret['message']]);
        }

        $entities = Entity::where("id", $request->entity_id)->first();
        $offices = OfficeServices::get();
        $branches = EntityBranches::where("entity_id", $request->entity_id)->get();
        $addresses= [];

        foreach( $branches as $branch )
        {
            $addresses[] = EntityAddresses::where("entity_id", $request->entity_id)->where("branch_id", $branch->id )->first();
        }

        // print("<pre>");
        // print_r($addresses);
        // print("</pre>");
        // exit;

        return view('user.entities-template2', compact('offices', 'entities', 'branches', 'addresses'));
    }

    public function add_domiciliation(Request $request)
    {
        if ($request->regiProvince!='null' || $request->regiTown!='null' || $request->regiPostal!='null' ||
            $request->regiZip!='null' || $request->regiStreet!='null' || $request->regiNumber!='null' || $request->regiUnit!='null' ){
                $address = new EntityAddresses;
                $address->address_type = "registered";
                $address->country = $request->regiCountry;
                $address->state_province = $request->regiProvince;
                // $address->city = $request->regiTown;
                $address->postal_zip = $request->regiPostal . $request->regiZip;
                $address->street_name = $request->regiStreet;
                $address->building_nr = $request->regiNumber;
                $address->building_unit = $request->regiUnit;
                // $address->save();
        }
        if ($request->localProvince!='null' || $request->localCity!='null' || $request->localPostal!='null' ||
            $request->localZip!='null' || $request->localStreet!='null' || $request->localNumber!='null' || $request->localUnit!='null' ){
                $address = new EntityAddresses;
                $address->address_type = "head_office";
                $address->country = $request->localCountry;
                $address->state_province = $request->localProvince;
                // $address->city = $request->localCity;
                $address->postal_zip = $request->localPostal . $request->localZip;
                $address->street_name = $request->localStreet;
                $address->building_nr = $request->localNumber;
                $address->building_unit = $request->localUnit;
                // $address->save();
        }
        if ($request->corProvince!='null' || $request->corCity!='null' || $request->corPostal!='null' ||
            $request->corZip!='null' || $request->corStreet!='null' || $request->corNumber!='null' || $request->corUnit!='null' ){
                $address = new EntityAddresses;
                $address->address_type = "correspondence";
                $address->country = $request->corCountry;
                $address->state_province = $request->corProvince;
                // $address->city = $request->corCity;
                $address->postal_zip = $request->corPostal . $request->corZip;
                $address->street_name = $request->corStreet;
                $address->building_nr = $request->corNumber;
                $address->building_unit = $request->corUnit;
                // $address->save();
        }

        $domiciliation = new EntitiesDomiciliationOffice;
        $domiciliation->obtain_new_office = isset($request->obtain_new) ? "Y" : "N";
        $domiciliation->register_new_office = isset($request->register_new) ? "Y" : "N";
        $domiciliation->registered_office_available = isset($request->registered_office) ? "Y" : "N";
        $domiciliation->phone_number = $request->phone;
        $domiciliation->email_address = $request->email;
        $domiciliation->website = $request->website;
        // $domiciliation->save();

        $shareclasses = EntitiesShareClasses::get();
        $entities = Entity::where("id", $request->entity_id)->first();
        $currencies = Currency::get();

        return view('user.entities-share-capital', compact('currencies', 'entities', 'shareclasses'));
    }
    public function add_branches(Request $request)
    {
        // dd($request->all());
        $entities = Entity::where("id", $request->entity_id)->first();
        $offices = OfficeServices::get();
        $branches = EntityBranches::where("entity_id", $request->entity_id)->get();
        $addresses= [];

        foreach( $branches as $branch )
        {
            $addresses[] = EntityAddresses::where("entity_id", $request->entity_id)->where("branch_id", $branch->id )->first();
        }
        return view('user.entities-template2', compact('offices', 'entities', 'branches', 'addresses'));
    }

    public function add_sharecapital(Request $request)
    {

    }

    public function add_shareclass(Request $request)
    {
        dd($request->all());
        if ( $request->shareoption == "ordinary"){
            $share = new EntitiesShareClasses;
            $share->entity_id = $request->entities;
            $share->par_value = $request->parvalue;
            $share->authorized_shares = $request->authorizedshares;
            $share->save();

            $shareRight = new EntitiesShareRight;
            $shareRight->share_class_id = $share->id;
            $shareRight->rights_voting = isset( $request->chvotingright)? "Y" : "N";
            $shareRight->rights_voting_number = $request->votingRightNumber;
            $shareRight->rights_meetings = isset( $request->chMeetingRight ) ? "Y" : "N";
            $shareRight->rights_reserves = isset( $request->chReserveRight ) ? "Y" : "N";
            $shareRight->rights_conversion = isset( $request->chConversionRight ) ? "Y" : "N";

            $shareRight->rights_pre_emptive = isset( $request->preemption ) ? "Y" : "N";
            $shareRight->rights_pre_emptive_apply = $request->pre_emption_apply ;
        } else {

        }
    }
}
