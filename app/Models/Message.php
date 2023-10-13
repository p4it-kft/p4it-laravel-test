<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * 
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string|null $text
 * @property int|null $author_id
 * 
 * @property MessageAuthor|null $message_author
 * @property Collection|Tag[] $tags
 *
 * @package App\Models
 */
class Message extends Model
{
	protected $table = 'messages';
	public $timestamps = false;

	protected $casts = [
		'author_id' => 'int'
	];

	protected $fillable = [
		'name',
		'title',
		'text',
		'author_id'
	];

	public function message_author()
	{
		return $this->belongsTo(MessageAuthor::class, 'author_id');
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'message_has_tag');
	}
}
