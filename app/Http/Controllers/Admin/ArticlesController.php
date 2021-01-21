<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use App\Models\Articles;
use App\Models\ArticlesContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        exit("index");
        try{
            $role_data  = '';
            $per_page   = gmvl('article_per_page', 10);
            $order_by   = gmvl('article_order_by', 'article_label');
            $ordered    = gmvl('article_ordered', 'DESC');
            $is_page    = (empty($role) ? 'all' : ($role=='user' ? 'investor' : $role));
    
            $articles = Articles::orderBy($order_by, $ordered)->paginate($per_page);
    
            $pagi = $articles->appends(request()->all());
            return view('admin.articles', compact('articles', 'pagi', 'is_page'));
        } catch(\Exception $e){
            echo $e->getMessage();
        }
        
    }
    public function article_detail($article_id){
        exit("here");
        try{
            $entity_types = \DB::table('entity_types')
                    ->join('jurisdictions', 'entity_types.jurisdiction_id','=', 'jurisdictions.id')
                    ->orderBy('entity_type_name')->get();
            $entity_types = \DB::table('article_contents')
                    ->join('entity_types', 'article_contents.entity_type_id', '=', 'entity_types.id')
                    ->get();
            $article = Articles::where('id', $article_id)->first();

            dd($entity_types);
            exit;
            return view('admin.article-detail', compact('entity_types', 'article'));

        } catch(\Exception $e){
            echo $e->getMessage();
        }
        
    }
    
}
