<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $text
 */
class Message extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';
//    protected $attributes = [  // ez bekavar a mentéskor, 0=>id, 1=>name, ilyenekkel egészíti ki a model attributes tömbjét
//        'id',
//        'name',
//        'title',
//        'text',
//    ];
    protected $fillable = [
        'name',
        'title',
        'text',
    ];
}
