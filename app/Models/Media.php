<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    //リレーションの設定。tagsというメソッドで、多数のTagにアクセスできる
    public function tag() {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    protected $fillable = [
        'name',
        'type',
        'file',
        'tag_id',
    ];

}


