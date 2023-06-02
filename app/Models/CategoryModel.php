<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'id',
        'category',
        'parent_id',
    ];

    public function parent()
    {
        return $this->hasMany(CategoryModel::class,  'parent_id', 'id');
    }

    public function childs(){
        return $this->hasMany(CategoryModel::class, 'parent_id', 'id');
    }

}
