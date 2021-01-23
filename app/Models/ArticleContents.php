<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleContents extends Model
{
    protected $table = 'article_contents';
    protected $fillable = [
        'article_title', 'section', 'entity_types', 'text',
    ];

    public function __construct()
    {
        //
    }

   
    public function getAll($request)
    {
        return $this;
    }
}
