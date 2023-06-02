<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'name',
        'email',
        'comment',
        'avatar',
        'parent_comment_id',
        'postid'
    ];

    public function childs(){
        return $this->hasMany(CommentModel::class, 'parent_comment_id', 'id');
    }
}
