<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MessageHasTag
 * 
 * @property int $message_id
 * @property int $tag_id
 * 
 * @property Message $message
 * @property Tag $tag
 *
 * @package App\Models
 */
class MessageHasTag extends Model
{
	protected $table = 'message_has_tag';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'message_id' => 'int',
		'tag_id' => 'int'
	];

	public function message()
	{
		return $this->belongsTo(Message::class);
	}

	public function tag()
	{
		return $this->belongsTo(Tag::class);
	}
}
