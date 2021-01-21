<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table = 'articles';
    protected $fillable = [
        'article_label', 'statue_type',
    ];

    public function __construct()
    {
        
    }

   
    public function getAll($request)
    {
        return $this;
    }
}
