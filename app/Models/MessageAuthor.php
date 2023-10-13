<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MessageAuthor
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * 
 * @property Message $message
 *
 * @package App\Models
 */
class MessageAuthor extends Model
{
	protected $table = 'message_author';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'email'
	];

	public function message()
	{
		return $this->hasOne(Message::class, 'author_id');
	}
}
