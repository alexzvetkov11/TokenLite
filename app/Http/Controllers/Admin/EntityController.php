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
use App\Models\Jurisdictions;
use App\Models\LegalStructures;
use App\Models\EntityTypesCompanies;
use App\Models\EntityTypesAssociations;
use App\Models\EntityTypesFoundations;
use App\Models\EntityTypesPartnerships;
use App\Models\EntityTypesTrusts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EntityController extends Controller
{
    public function index(Request $request, $status = '')
    {
        try{
            $role_data  = '';
            $per_page   = gmvl('entity_types_per_page', 10);
            $order_by   = gmvl('entity_types_order_by', 'entity_type_name');
            // $order_by= 'entity_type_name';
            $ordered    = gmvl('entity_types_ordered', 'DESC');
            $is_page    = (empty($role) ? 'all' : ($role == 'user' ? 'investor' : $role));
            $entity = \DB::table('entity_types')->select(['*', 'entity_types.id as entity_type_id'])
                            ->join('jurisdictions', 'entity_types.jurisdiction_id', '=', 'jurisdictions.id')
                            ->join('legal_structures', 'entity_types.legal_structure_id', '=', 'legal_structures.id')
                            ->orderBy($order_by, $ordered)->paginate($per_page);
            $pagi = $entity->appends(request()->all());
            return view('admin.entity', compact('entity', 'pagi', 'is_page'));
        } catch( \Exception $e){
            echo $e->getMessage();
        }
    }
    public function add_entity(Request $request)
    {
        $juris = \DB::table('jurisdictions')->get();
        $legals = \DB::table('legal_structures')->orderby('label')->get();
        return view('admin.entity-type-add')->with(['juris'=>$juris, 'legals'=>$legals]);
    }

    public function addEntityInitial(Request $request)
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
            $entype->entity_type_name = $request->entityname;
            $entype->abbrev_long = $request->abbrev_long ;
            $entype->abbrev_short = $request->abbrev_short;
            $entype->abbrev_position = $request->abbrev_position ;
            $entype->legal_structure_id = $request->legalStructure;
            $entype->jurisdiction_id = $request->jurisdiction ;
            $entype->separate_legal_person = $request->separateLegal=="on" ? "Y" :"N";
            $entype->formation_documents = $request->formationDocuments ;
            $entype->formation_notary_req = $request->notary=="on" ?"Y" :"N";
            $entype->principal_statute = $request->principal_statue ;
            $entype->register_native_name = $request->registername ;
            try {
                $entype->save();
                $ret['msg'] = "success";
                $ret['message'] = __("Successfully activated!");
                $next = LegalStructures::select('label')->where('id', $entype->legal_structure_id)->first();

                if ($next->label=="Association"){
                    $associations = \DB::table('entity_types_associations')->get();
                    return view('admin.entity-type-associations', compact( 'entype'));
                } else if( $next->label =="Company"){
                    $companies = \DB::table('entity_types_companies')->get();
                    return view('admin.entity-types-companies', compact( 'entype'));
                } else if ($next->label =="Foundation"){
                    $foundations = \DB::table('entity_types_foundations')->get();
                    return view('admin.entity-type-foundations', compact( 'entype'));
                } else if ($next->label=="Partnership"){
                    $partnerships = \DB::table('entity_types_partnerships')->get();
                    return view('admin.entity-type-partnerships', compact( 'entype'));
                } else if ( $next->label=="Trust"){
                    $trusts = \DB::table('entity_type_trusts')->get();
                    return view('admin.entity-type-trusts', compact( 'entype'));
                } else {
                    $ret['msg'] = 'error';
                    $ret['message'] =  __('messages.form.wrong');
                    return redirect()->route('admin.addentity');
                }

            } catch (\Exception $e) {
                echo $e->getMessage();
                $ret['msg'] = 'error';
                $ret['message'] =  __('messages.form.wrong');
                return redirect()->route('admin.addentity');
            }
        }
    }

    public function editEntityInitial(Request $request){
        $validator = Validator::make($request->all(), [
            "entityname" => "required|min:4",
        ]);

        if ($validator->fails()) {
            $ret['msg'] = "warning";
            $ret['message'] = __('messages.form.wrong');
            return response()->json($ret);
        } else {
            $entype = EntityTypes::where('id', $request->entypeId)->first();
            $entype->entity_type_name = $request->entityname;
            $entype->abbrev_long = $request->abbrev_long;
            $entype->abbrev_short = $request->abbrev_short ;
            $entype->abbrev_position = $request->abbrev_position;
            $entype->legal_structure_id = $request->legalStructure;
            $entype->jurisdiction_id = $request->jurisdiction ;
            $entype->separate_legal_person = $request->separateLegal=="on" ? "Y" :"N";
            $entype->formation_documents = $request->formationDocuments;
            $entype->formation_notary_req = $request->notary=="on" ? "Y": "N" ;
            $entype->principal_statute = $request->principal_statue ;
            $entype->register_native_name = $request->registername ;
            try {
                $entype->save();
                $ret['msg'] = "success";
                $ret['message'] = __("successfully updated");
                $next = LegalStructures::select('label')->where('id', $entype->legal_structure_id)->first();

                if ($next->label=="Association"){
                    $associations = EntityTypesAssociations::where('entity_type_id', $entype->id)->first();
                    if (!isset($associations))  $this->deleteData($entype->id);
                    return view('admin.entity-type-associations', compact('associations', 'entype'));
                } else if( $next->label =="Company"){
                    $companies = EntityTypesCompanies::where('entity_type_id', $entype->id)->first();
                    if (!isset($companies))  $this->deleteData($entype->id);
                    return view('admin.entity-types-companies', compact('companies', 'entype'));
                } else if ($next->label =="Foundation"){
                    $foundations = EntityTypesFoundations::where('entity_type_id', $entype->id)->first();
                    if (!isset($foundations))  $this->deleteData($entype->id);
                    return view('admin.entity-type-foundations', compact('foundations', 'entype'));
                } else if ($next->label=="Partnership"){
                    $partnerships = EntityTypesPartnerships::where('entity_type_id', $entype->id)->first();
                    if (!isset($partnerships))  $this->deleteData($entype->id);
                    return view('admin.entity-type-partnerships', compact('partnerships', 'entype'));
                } else if ( $next->label=="Trust"){
                    $trusts = EntityTypesTrusts::where('entity_type_id', $entype->id)->first();
                    if (!isset($trusts))  $this->deleteData($entype->id);
                    return view('admin.entity-type-trusts', compact('trusts', 'entype'));
                } else {
                    $ret['msg'] = 'error';
                    $ret['message'] =  __('messages.form.wrong');
                    return redirect()->route('admin.entity');
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
                exit;
                $ret['msg'] = 'error';
                $ret['message'] =  __('messages.form.wrong');
                return redirect()->route('admin.entity');
            }
        }
    }

    public function addEntityCompanies(Request $request){

        $company = new EntityTypesCompanies;
        $company->entity_type_id = $request->entypeId;
        $company->members_min = $request->minmember;
        $company->members_max = $request->maxmember;
        $company->share_transferability = $request->sharetransfer=="on" ? "Private" : "Public";
        $company->share_cap_issued_min =$request->minissuedcaptial;
        $company->share_cap_paid_up_min =$request->minpaidcaptial;
        $company->share_cap_authorized_paid_up_min_rel =$request->minpaidauth;
        $company->shares_issued_min =$request->minshareissued;
        $company->shares_issued_max =$request->maxshareissued;
        $company->shares_without_dividend_rights = $request->withoutDR=="on" ? "Y" : "N";
        $company->shares_without_voting_rights =$request->withoutVR =="on" ? "Y" : "N";
        $company->bearer_shares_permitted =$request->BSP =="on" ? "Y" : "N";
        $company->fractional_shares_permitted =$request->FSP =="on" ? "Y" : "N";
        $company->directors_min =$request->minNumberDirectors;
        $company->directors_max =$request->maxNumberDirectors;
        $company->local_dir_req =$request->localDR =="on" ? "Y" : "N";
        $company->local_officer_req =$request->localOR =="on" ? "Y" : "N";
        $company->local_reg_office_req =$request->localROR =="on" ? "Y" : "N";
        $company->members_annual_meeting_req =$request->annualAAM;
        $company->member_annual_accounts_approval_deadline_days =$request->initailAD;
        $company->member_annual_accounts_approval_deadline_adjusted_days =$request->AdjustedAD;
        $company->filing_members_req =$request->memberRegister =="on" ? "Y" : "N";
        $company->filing_directors_req =$request->directorRegister =="on" ? "Y" : "N";
        $company->filing_officers_req =$request->officerRegister =="on" ? "Y" : "N";
        $company->filing_paid_up_capital_declaration = $request->paidUCD =="on" ? "Y" : "N";
        $company->filing_annual_accounts_req = $request->annualAFR=="on" ? "Y":"N";
        $company->filing_ubo_req =$request->UBORegister =="on" ? "Y" : "N";
        $company->filing_annual_accounts_deadline_days =  $request->annualAFD;
        $company->UBO_threshold_capital_rights =$request->UBOCapital;
        $company->UBO_threshold_voting_interest =$request->UBOVoting;

        print($company);
        exit;
        try{
            $company->save();
            $ret['msg'] = "success";
            $ret['message'] = __("Successfully inserted.");
        } catch (\Exception $e){
            echo $e->getMessage();
            $ret['msg'] = 'error';
            $ret['message'] =__('messages.form.wrong');
            return back()->with( [$ret['msg']=> $ret['message'] ]);
        }
        return redirect()->route('admin.entity')->with([$ret['msg'] => $ret['message']]);
    }
    public function editEntityCompanies(Request $request){
        $company = EntityTypesCompanies::where('id', $request->companyId)->first();
        $company->members_min = $request->minmember;
        $company->members_max = $request->maxmember;
        $company->share_transferability = $request->sharetransfer=="on" ? "Private" : "Public";
        $company->share_cap_issued_min =$request->minissuedcaptial;
        $company->share_cap_paid_up_min =$request->minpaidcaptial;
        $company->share_cap_authorized_paid_up_min_rel =$request->minpaidauth;
        $company->shares_issued_min =$request->minshareissued;
        $company->shares_issued_max =$request->maxshareissued;
        $company->shares_without_dividend_rights = $request->withoutDR=="on" ? "Y" : "N";
        $company->shares_without_voting_rights =$request->withoutVR =="on" ? "Y" : "N";
        $company->bearer_shares_permitted =$request->BSP =="on" ? "Y" : "N";
        $company->fractional_shares_permitted =$request->FSP =="on" ? "Y" : "N";
        $company->directors_min =$request->minNumberDirectors;
        $company->directors_max =$request->maxNumberDirectors;
        $company->local_dir_req =$request->localDR =="on" ? "Y" : "N";
        $company->local_officer_req =$request->localOR =="on" ? "Y" : "N";
        $company->local_reg_office_req =$request->localROR =="on" ? "Y" : "N";
        $company->members_annual_meeting_req =$request->annualAAM;
        $company->member_annual_accounts_approval_deadline_days =$request->initailAD;
        $company->member_annual_accounts_approval_deadline_adjusted_days =$request->AdjustedAD;
        $company->filing_members_req =$request->memberRegister =="on" ? "Y" : "N";
        $company->filing_directors_req =$request->directorRegister =="on" ? "Y" : "N";
        $company->filing_officers_req =$request->officerRegister =="on" ? "Y" : "N";
        $company->filing_paid_up_capital_declaration = $request->paidUCD =="on" ? "Y" : "N";
        $company->filing_annual_accounts_req = $request->annualAFR=="on" ? "Y":"N";
        $company->filing_ubo_req =$request->UBORegister =="on" ? "Y" : "N";
        $company->filing_annual_accounts_deadline_days =  $request->annualAFD;
        $company->UBO_threshold_capital_rights =$request->UBOCapital;
        $company->UBO_threshold_voting_interest =$request->UBOVoting;

        try{
            $company->save();
            $ret['msg'] = "success";
            $ret['message'] = __("Successfully updated.");
        } catch (\Exception $e){
            echo $e->getMessage();
            $ret['msg'] = 'error';
            $ret['message'] = __('messages.form.wrong');
            return back()->with( [$ret['msg']=> $ret['message'] ]);
        }
        return redirect()->route('admin.entity')->with([$ret['msg'] => $ret['message']]);
    }
    public function addEntityAssociations(Request $request){
        $association = new EntityTypesAssociations;
        $association->entity_type_id = $request->entypeId;
        $association->members_min = $request->minmember;
        $association->members_max = $request->maxmember;
        $association->save();

        $ret['msg'] = "success";
        $ret['message'] = __("Successfully inserted.");
        return redirect()->route('admin.entity')->with([$ret['msg'] => $ret['message']]);
    }
    public function editEntityAssociations(Request $request){
        $association = EntityTypesAssociations::where('id', $request->associationId )->first();
        $association->members_min = $request->minmember;
        $association->members_max = $request->maxmember;
        $association->save();

        $ret['msg'] = "success";
        $ret['message'] = __("Successfully updated.");
        return redirect()->route('admin.entity')->with([$ret['msg'] => $ret['message']]);
    }
    public function addEntityFoundations(Request $request){
        $foundation = new EntityTypesFoundations;
        $foundation->entity_type_id = $request->entypeId;
        $foundation->members_min = $request->minmember;
        $foundation->members_max = $request->maxmember;
        $foundation->save();

        $ret['msg'] = "success";
        $ret['message'] = __("Successfully inserted.");
        return redirect()->route('admin.entity')->with([$ret['msg'] => $ret['message']]);
    }
    public function editEntityFoundations(Request $request){
        $foundation = EntityTypesFoundations::where('id', $request->foundationId)->first();
        $foundation->members_min = $request->minmember;
        $foundation->members_max = $request->maxmember;
        $foundation->save();

        $ret['msg'] = "success";
        $ret['message'] = __("Successfully updated.");
        return redirect()->route('admin.entity')->with([$ret['msg'] => $ret['message']]);
    }
    public function addEntityPartnerships(Request $request){
        $partner = new EntityTypesPartnerships;
        $partner->entity_type_id = $request->entypeId;
        $partner->members_min = $request->minmember;
        $partner->members_max = $request->maxmember;
        $partner->save();

        $ret['msg'] = "success";
        $ret['message'] = __("Successfully inserted.");
        return redirect()->route('admin.entity')->with([$ret['msg'] => $ret['message']]);
    }
    public function editEntityPartnerships(Request $request){
        print($request->partnershipId);
        exit;
        $partner = EntityTypesPartnerships::where("id", $request->partnershipId)->first();
        $partner->members_min = $request->minmember;
        $partner->members_max = $request->maxmember;
        $partner->save();

        $ret['msg'] = "success";
        $ret['message'] = __("Successfully updated.");
        return redirect()->route('admin.entity')->with([$ret['msg'] => $ret['message']]);
    }
    public function addEntityTrusts(Request $request){
        $trust = new EntityTypesTrusts;
        $trust->entity_type_id = $request->entypeId;
        $trust->members_min = $request->minmember;
        $trust->members_max = $request->maxmember;
        $trust->save();

        $ret['msg'] = "success";
        $ret['message'] = __("Successfully inserted.");
        return redirect()->route('admin.entity')->with([$ret['msg'] => $ret['message']]);
    }
    public function editEntityTrusts(Request $request){
        $trust = EntityTypesTrusts::where('id', $request->trustId)->first();
        $trust->members_min = $request->minmember;
        $trust->members_max = $request->maxmember;
        $trust->save();

        $ret['msg'] = "success";
        $ret['message'] = __("Successfully updated.");
        return redirect()->route('admin.entity')->with([$ret['msg'] => $ret['message']]);
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
    public function viewDetail($id){
        $juris = \DB::table('jurisdictions')->get();
        $legals = \DB::table('legal_structures')->orderby('label')->get();
        $entype = EntityTypes::where('id', $id)->first();
        return view('admin.entity-type-add')->with(['juris'=>$juris, 'legals'=>$legals, 'entype'=>$entype]);
    }
    public function deleteEntitytype($id){
        $en = EntityTypes::where('id', $id)->first();
        if ($en){
            $en->delete();
            $ret['msg']="success";
            $ret['message']=__('Entity Type Deleted Successfully');
        } else {
            $ret['msg'] = 'error';
            $ret['message'] = __('messages.form.wrong');
        }
        return response()->json($ret);
    }

    public function activation($id, $act){
        $jur = Jurisdictions::where('id', $id)->first();
        $jur->jur_status = $act;
        $jur->save();
        $ret['msg'] = "success";
        $ret['message'] = __("Successfully ".$act."d.");
        return redirect()->route('admin.entity')->with( [$ret['msg']=> $ret['message'] ]);
    }
    public function deleteData($id){
        $company = EntityTypesCompanies::where('entity_type_id', $id)->first();
        if (isset($company)) $company->delete();
        $association = EntityTypesAssociations::where('entity_type_id', $id)->first();
        if (isset($association)) $association->delete();
        $foundation = EntityTypesFoundations::where('entity_type_id', $id)->first();
        if (isset($foundation)) $foundation->delete();
        $partner = EntityTypesPartnerships::where('entity_type_id', $id)->first();
        if (isset($partner)) $partner->delete();
        $trust = EntityTypesTrusts::where('entity_type_id', $id)->first();
        if (isset($trust)) $trust->delete();
    }
}
