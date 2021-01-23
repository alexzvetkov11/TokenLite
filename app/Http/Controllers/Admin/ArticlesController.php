<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use App\Models\Articles;
use App\Models\ArticleContents;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use QR_Code\Util\Split;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        try {
            $role_data  = '';
            $per_page   = gmvl('article_per_page', 10);
            $order_by   = gmvl('article_order_by', 'article_label');
            $ordered    = gmvl('article_ordered', 'DESC');
            $is_page    = (empty($role) ? 'all' : ($role == 'user' ? 'investor' : $role));

            $articles = Articles::orderBy($order_by, $ordered)->paginate($per_page);

            $pagi = $articles->appends(request()->all());
            return view('admin.articles', compact('articles', 'pagi', 'is_page'));
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    public function article_detail($article_id)
    {
        try {

            $entity_types = \DB::table('entity_types')
                ->join('jurisdictions', 'entity_types.jurisdiction_id', '=', 'jurisdictions.id')
                ->orderBy('entity_type_name')->get();

            $contents = \DB::table('article_contents')
                ->join('entity_types', 'article_contents.entity_types', '=', 'entity_types.entity_type_id')
                ->join('jurisdictions', 'entity_types.jurisdiction_id', '=', 'jurisdictions.id')
                ->orderBy('section')->orderBy('entity_types')->get();

            $section_num = \DB::table('article_contents')->distinct('section')->count('section');
            $articlesAll = Articles::get();
            // print('<pre>');
            // print_r($articlesAll);
            // print('</pre');
            // exit;
            $article = Articles::where('id', $article_id)->first();
            return view('admin.article-detail', compact('entity_types', 'article', 'contents', 'section_num', 'articlesAll'));
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    public function editArticle(Request $request)
    {
        try {
            $text = str_replace(['<script>', '</script>'], ['&lt;script&gt;', '&lt;/script&gt;'], trim($request->textEdit));
            if ($request->type == "update") {
                list($temp, $section, $entity) = explode("-", $request->textEditHide);
                $content = ArticleContents::where('section', $section)->where('entity_types', $entity)->first();
                $content->text = $text;
                $content->save();
            } else if ($request->type =="create"){
                list($temp, $section, $entity) = explode("-", $request->textEditHide);
                $content = new ArticleContents;
                $content->section = $section;
                $content->entity_types = $entity;
                $content->text = $text;
                $content->article_title = $request->articleAll;
                $content->save();
            } else if ($request->type == "insert"){
                $content = new ArticleContents;
                $content->section = \DB::table('article_contents')->distinct('section')->count('section') + 1;
                $content->entity_types = $request->entityAll;
                $content->text = $text;
                $content->article_title = $request->articleAll;
                $content->save();
            }
            $content->text = $text;
            $content->save();
            $ret['msg'] = 'success';
            $ret['message'] = __("message.update.success");
        } catch (\Exception $e) {
            echo $e->getMessage();
            $ret['msg'] = 'warning';
            $ret['message'] = __('messages.form.wrong');
        }
        if ($request->type == "update") {
            return back()->with([$ret['msg'] => $ret['message']]);
        } else {
            return redirect()->route('admin.articles.detail', $request->articleId);
        }
    }
    public function newAdd(Request $request)
    {
        try {
            $article = new Articles;
            $article->article_label = $request->article_title;
            $article->statue_type = $request->statue_type;
            $article->save();
            $ret['msg'] = "success";
            $ret['message'] = __("message.insert.success");
        } catch (\Exception $e) {
            //echo $e->getMessage();
            $ret['msg'] = 'warning';
            $ret['message'] = __('messages.form.wrong');
        }
        return back()->with([$ret['msg']=>$ret['message'] ]);
    }

    public function deleteArticle($article_id)
    {
        try {
            $article = Articles::where('id', $article_id)->first();
            $article->delete();

            $ret['msg'] = "success";
            $ret['message'] = __("message.insert.success");
        } catch (\Exception $e) {
            echo $e->getMessage();
            $ret['msg'] = 'warning';
            $ret['message'] = __('messages.form.wrong');
        }
        // return back()->with([$ret['msg']=>$ret['message'] ]);
        return response()->json($ret);
    }
}
