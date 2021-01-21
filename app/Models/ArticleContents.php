<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleContents extends Model
{
    protected $table = 'article_contents';

    protected $fillable = [
        "article_title_id", "section", "entity_type_id", "text",
    ];

    public function __construct()
    {
        
    }

    public function getAll($request)
    {
        // $result = [];
        // $find = ['state', 'doc'];
        // $replace = ['status', 'documentType'];
        // foreach($request as $key => $value) {
        //     $set_key = str_replace($find, $replace, $key);
        //     $val = trim($value);

        //     if(!empty($val)) {
        //         $result[] = array($set_key, '=', $val);
        //     }
        // }
        return $this;
    }

}
