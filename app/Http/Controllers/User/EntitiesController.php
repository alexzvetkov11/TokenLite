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
use IcoHandler;

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
use App\Models\EntitiesCorporateBodies;
use App\Models\Countries;

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
        $is_page    = (empty($role) ? 'all' : ($role == 'user' ? 'investor' : $role));
        $entity = Entity::orderBy($order_by, $ordered)->paginate($per_page);
        $pagi = $entity->appends(request()->all());
        return view('user.entities', compact('entity', 'pagi', 'is_page'));
    }

    public function addentities_index()
    {

        $juris_actived = Jurisdictions::where('jur_status', 'active')->orderby('jurisdiction_name', 'ASC')->get();
        $juris = Jurisdictions::orderby('jur_status', 'ASC')->orderby('jurisdiction_name', 'ASC')->get();
        $entype = EntityTypes::orderby('entity_type_name', 'ASC')->get();

        return view('user.entities-add', compact('juris_actived', 'juris', 'entype'));
    }
    public function entities_add(Request $request)
    {
        try {
            if ($request->type == "exist") {

                $entities = new Entity;
                $entities->jurisdiction = $request->jurisdiction2;
                $entities->entity_type = $request->entype2;
                $entities->entity_name = $request->entity_name2;
                $entities->registration = $request->registration;
                $entities->document = $request->document_one;
                $entities->onboarding = $request->onboarding;
                $entities->adding_type = "new";
                $entities->entity_type_other = $request->other;
                $entities->status = "In Formation";
                $entities->save();

                if ($request->onboarding == "full_functionality") {
                    $business = BusinessActivities::get();
                    $divisions = ActivitiesDivision::get();
                    $groups = ActivitiesGroup::get();
                    $classes = ActivitiesClass::get();
                    $subclasses = ActivitiesSubclass::get();
                    // return redirect()->route('user.entities.template1', ['entites_id'=>$entities->id]);
                    return view('user.entities-template1', compact('business', 'entities', 'divisions', 'groups', 'classes', 'subclasses'));
                } else {
                    return redirect()->route('user.entities');
                }
            } else if ($request->type == "incorporate") {
                if ($request->type == 'other') {
                    exit('other');
                    $ret['msg'] = 'error';
                    $ret['message'] = __("didn't make this part");
                    return back()->with([$ret['msg'] => $ret['message']]);
                } else {
                    $entities = new Entity;
                    $entities->entity_name = $request->entity_name1;
                    $entities->entity_type = $request->entype1;
                    $entities->jurisdiction = $request->jurisdiction1;
                    $entities->onboarding = "full_functionality";
                    $entities->start_date = _date($request->start_date, 'Y-m-d');
                    $entities->status = "In Formation";
                    $entities->adding_type = "existing";
                    $entities->save();

                    $business = BusinessActivities::get();
                    $divisions = ActivitiesDivision::get();
                    $groups = ActivitiesGroup::get();
                    $classes = ActivitiesClass::get();
                    $subclasses = ActivitiesSubclass::get();

                    return view('user.entities-template1', compact('business', 'entities', 'divisions', 'groups', 'classes', 'subclasses'));
                }
            }
        } catch (\Exception $e) {
            $ret['msg'] = 'error';
            $ret['message'] = __("Something happened wrong");
            echo $e->getMessage();
            exit;
            return back()->with([$ret['msg'] => $ret['message']]);
        }
    }

    public function template1(Request $request)
    {
    }

    public function change_business_activities(Request $request)
    {
        try {
            if ($request->type == "add") {
                $busi = new BusinessActivities;
                $busi->entity_id = $request->entities;
                $busi->division_id = $request->division;
                $busi->group_id = $request->group;
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
                $ret['message'] = __("Business Activities Successfully Changed");
                return view('user.entities-template1', compact('business', 'entities', 'divisions', 'groups', 'classes', 'subclasses'));
                // return back()->with( [ $ret['msg']=>$ret['message'] ]);
            } else {
                $busi = BusinessActivities::where('id', $request->id)->first();
                $busi->entity_id = $request->entities;
                $busi->division_id = $request->division;
                $busi->group_id = $request->group;
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
                $ret['message'] = __("Business Activities Successfully Changed");
                // return back()->with( [ $ret['msg']=>$ret['message'] ]);
                return view('user.entities-template1', compact('business', 'entities', 'divisions', 'groups', 'classes', 'subclasses'));
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            $ret['msg'] = 'error';
            $ret['message'] = __("didn't make this part");
            return response()->json($ret);
        }
    }


    public function add_purpose_activities(Request $request)
    {
        try {
            $trading_names = explode(",", $request->trading_name);

            foreach ($trading_names as $names) {
                $trading = new EntityTradingName;
                $trading->entity_id = $request->entity_id;
                $trading->type = "head";
                $trading->trading_name = $names;
                $trading->save();
            }

            $purpose = new EntityCompaniesPurpose;
            $purpose->entity_id = $request->entity_id;
            $purpose->purpose_type = $request->purpose_type;
            $purpose->activity_description = $request->description;
            $purpose->b2b_service = (isset($request->b2bservice)) ? "Y" : "N";
            $purpose->b2c_service = (isset($request->chB2C)) ? "Y" : "N";

            $purpose->products_manufacture = isset($request->manufacture) ? "Y" : "N";
            $purpose->products_import = isset($request->import) ? "Y" : "N";
            $purpose->products_export = isset($request->export) ? "Y" : "N";
            $purpose->products_domestic_trade = isset($request->domestic) ? "Y" : "N";
            $purpose->places_retail = isset($request->outlet) ? "Y" : "N";
            $purpose->places_market = isset($request->market) ? "Y" : "N";
            $purpose->places_street = isset($request->street) ? "Y" : "N";
            $purpose->palces_internet = isset($request->internet) ? "Y" : "N";
            $purpose->places_home = isset($request->home) ? "Y" : "N";
            $purpose->places_mailorder = isset($request->mail) ? "Y" : "N";
            $purpose->financial_services = isset($request->financial_service) ? "Y" : "N";
            $purpose->employment_agency = isset($request->employment_agency) ? "Y" : "N";
            $purpose->regulatory_approvals = isset($request->regulatory_approvals) ? "Y" : "N";
            $purpose->places_other = $request->othername;
            $purpose->places_other_text = $request->txt_namely;
            $purpose->save();
        } catch (\Exception $e) {
            echo $e->getMessage();
            $ret['msg'] = 'warning';
            $ret['message'] = $e->getMessage();
            exit;
            return back()->with([$ret['msg'] => $ret['message']]);
        }

        $entities = Entity::where("id", $request->entity_id)->first();
        $offices = OfficeServices::get();
        $branches = EntityBranches::where("entity_id", $request->entity_id)->get();
        $countries = Countries::get();
        $addresses = [];

        foreach ($branches as $branch) {
            $addresses[] = EntityAddresses::where("entity_id", $request->entity_id)->where("branch_id", $branch->id)->first();
        }

        // print("<pre>");
        // print_r($addresses);
        // print("</pre>");
        // exit;

        return view('user.entities-template2', compact('offices', 'entities', 'branches', 'addresses', 'countries'));
    }

    public function add_domiciliation(Request $request)
    {
        try {


            if (isset($request->obtain_new) && ($request->regiStreet != null || $request->regiProvince != null || $request->regiPostal != null
                || $request->regiTown != null ||  $request->regiNumber != null || $request->regiUnit != null)) {

                $address = new EntityAddresses;
                $address->entity_id = $request->entity_id;
                $address->branch_id = 0;
                $address->branch_type = "h";
                $address->address_type = isset($request->residental3) ? "registered" : "physical";

                $address->country = $request->regiCountry;
                $address->state_province = $request->regiProvince;
                $address->city = $request->regiTown;
                $address->postal_zip = $request->regiPostal;
                $address->street_name = $request->regiStreet;
                $address->building_nr = $request->regiNumber;
                $address->building_unit = $request->regiUnit;
                $address->save();
            }


            /// $address->address_type = "head_office";
            if (($request->localProvince != null || $request->localCity != null || $request->localPostal != null
                || $request->localStreet != null ||  $request->localNumber != null || $request->localUnit != null)) {

                $address = new EntityAddresses;
                $address->entity_id = $request->entity_id;
                $address->branch_id = 0;
                $address->branch_type = "h";
                $address->address_type = isset($request->local2) ? "physical" : "correspondence";

                $address->country = $request->localCountry;
                $address->state_province = $request->localProvince;
                $address->city = $request->localCity;
                $address->postal_zip = $request->localPostal;
                $address->street_name = $request->localStreet;
                $address->building_nr = $request->localNumber;
                $address->building_unit = $request->localUnit;
                $address->save();
            }

            if (($request->localProvince != null || $request->localCity != null || $request->localPostal != null
                || $request->localStreet != null ||  $request->localNumber != null || $request->localUnit != null)) {

                $address = new EntityAddresses;
                $address->entity_id = $request->entity_id;
                $address->branch_id = 0;
                $address->branch_type = "h";
                $address->address_type = "correspondence";

                $address->country = $request->corCountry;
                $address->state_province = $request->corProvince;
                $address->city = $request->corCity;
                $address->postal_zip = $request->corPostal;
                $address->street_name = $request->corStreet;
                $address->building_nr = $request->corNumber;
                $address->building_unit = $request->corUnit;
                $address->save();
            }

            $domiciliation = new EntitiesDomiciliationOffice;
            $domiciliation->obtain_new_office = isset($request->obtain_new) ? "Y" : "N";
            print(isset($request->obtain_new));


            if (!isset($request->obtain_new)) {
                $domiciliation->registered_office_offer_selection = $request->registered_office_offer_selection;
            }
            $domiciliation->register_new_office = isset($request->register_new) ? "Y" : "N";
            $domiciliation->registered_office_available = isset($request->registered_office) ? "Y" : "N";
            $domiciliation->phone_number = $request->phone;
            $domiciliation->email_address = $request->email;
            $domiciliation->website = $request->website;
            $domiciliation->entity_id = $request->entity_id;
            $domiciliation->save();

            $bodies = EntitiesCorporateBodies::get();
            $shareclasses = EntitiesShareClasses::get();
            $entities = Entity::where("id", $request->entity_id)->first();
            $currencies = Currency::get();

            return view('user.entities-share-capital', compact('currencies', 'entities', 'shareclasses', 'bodies'));
        } catch (\Exception $e) {
            echo $e->getMessage();
            $ret['msg'] = 'warning';
            $ret['message'] = $e->getMessage();
            exit;
            return back()->with([$ret['msg'] => $ret['message']]);
        }
    }
    public function add_branches(Request $request)
    {
        try {
            $trading_names = explode(",", $request->trading_name1);
            foreach ($trading_names as $names) {
                $trading = new EntityTradingName;
                $trading->entity_id = $request->entity_id;
                $trading->type = "branch";
                $trading->trading_name = $names;
                $trading->save();
            }

            $branch = new EntityBranches;
            $branch->branch_name = $request->branchName;
            $branch->entity_id = $request->entity_id;

            $branch->phone_number = $request->phone;
            $branch->email_address = $request->email;
            $branch->website = $request->website;

            $branch->activity_description = $request->description;
            $branch->b2b_service = isset($request->b2bservice) ? "Y" : "N";
            $branch->b2b_product = isset($request->b2bproduct) ? "Y" : "N";
            $branch->b2c_service = isset($request->b2cservice) ? "Y" : "N";
            $branch->b2c_product = isset($request->b2cproduct) ? "Y" : "N";
            $branch->products_manufacture = isset($request->manufacture) ? "Y" : "N";
            $branch->products_import = isset($request->import) ? "Y" : "N";
            $branch->products_export = isset($request->export) ? "Y" : "N";
            $branch->products_domestic_trade = isset($request->domestic) ? "Y" : "N";
            $branch->places_retail = isset($request->outlet) ? "Y" : "N";
            $branch->places_market = isset($request->market) ? "Y" : "N";
            $branch->places_street = isset($request->street) ? "Y" : "N";
            $branch->places_internet = isset($request->internet) ? "Y" : "N";
            $branch->places_home = isset($request->home) ? "Y" : "N";
            $branch->places_mailorder = isset($request->mail) ? "Y" : "N";
            $branch->places_other = isset($request->namely) ? "Y" : "N";
            $branch->places_other_text = $request->othername;
            $branch->save();

            if (($request->phyProvince != null || $request->phyCity != null
                || $request->phyPostal != null ||  $request->phyStreet != null || $request->phyNumber != null || $request->phyUnit != null)) {

                $address = new EntityAddresses;
                $address->entity_id = $request->entity_id;
                $address->branch_id = $branch->id;
                $address->branch_type = "b";
                $address->address_type = isset($request->corAddress) ? "physical" : "correspondence";

                $address->country = $request->phyCountry;
                $address->state_province = $request->phyProvince;
                $address->city = $request->phyCity;
                $address->postal_zip = $request->phyPostal;
                $address->street_name = $request->phyStreet;
                $address->building_nr = $request->phyNumber;
                $address->building_unit = $request->phyUnit;
                $address->save();
            }

            if (($request->corCountry != null || $request->corProvince != null || $request->corCity != null
                || $request->corPostal != null ||  $request->corStreet != null || $request->corNumber != null || $request->corUnit != null)) {

                $address = new EntityAddresses;
                $address->entity_id = $request->entity_id;
                $address->branch_id = $branch->id;
                $address->branch_type = "b";
                $address->address_type = "correspondence";

                $address->country = $request->corCountry;
                $address->state_province = $request->corProvince;
                $address->city = $request->corCity;
                $address->postal_zip = $request->corPostal;
                $address->street_name = $request->corStreet;
                $address->building_nr = $request->corNumber;
                $address->building_unit = $request->corUnit;
                $address->save();
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            $ret['msg'] = 'warning';
            $ret['message'] = $e->getMessage();
            exit;
            return back()->with([$ret['msg'] => $ret['message']]);
        }
        $entities = Entity::where("id", $request->entity_id)->first();
        $offices = OfficeServices::get();
        $branches = EntityBranches::where("entity_id", $request->entity_id)->get();
        $countries = Countries::get();
        $addresses = [];

        foreach ($branches as $branch) {
            $address = EntityAddresses::where("entity_id", $request->entity_id)->where("branch_id", $branch->id)->first();
            if (isset($address)) $addresses[] = $address;
        }

        // print("<pre>");
        // print_r($branches);
        // print("--------------");
        // print($request->entity_id);
        // print_r($addresses);
        // print("</pre>");
        // exit;

        return view('user.entities-template2', compact('offices', 'entities', 'branches', 'addresses', 'countries'));
    }

    public function add_sharecapital(Request $request)
    {
    }

    public function add_shareclass(Request $request)
    {
        dd($request->all());
        if ($request->shareoption == "ordinary") {
            $share = new EntitiesShareClasses;
            $share->entity_id = $request->entities;
            $share->par_value = $request->parvalue;
            $share->authorized_shares = $request->authorizedshares;
            $share->save();

            $shareRight = new EntitiesShareRight;
            $shareRight->share_class_id = $share->id;
            $shareRight->rights_voting = isset($request->chvotingright) ? "Y" : "N";
            $shareRight->rights_voting_number = $request->votingRightNumber;
            $shareRight->rights_meetings = isset($request->chMeetingRight) ? "Y" : "N";
            $shareRight->rights_reserves = isset($request->chReserveRight) ? "Y" : "N";
            $shareRight->rights_conversion = isset($request->chConversionRight) ? "Y" : "N";

            $shareRight->rights_pre_emptive = isset($request->preemption) ? "Y" : "N";
            $shareRight->rights_pre_emptive_apply = $request->pre_emption_apply;
        } else {
        }
    }
}
