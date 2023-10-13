<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * 
 * @property int $id
 * @property string $label
 * 
 * @property Collection|Message[] $messages
 *
 * @package App\Models
 */
class Tag extends Model
{
	protected $table = 'tags';
	public $timestamps = false;

	protected $fillable = [
		'label'
	];

	public function messages()
	{
		return $this->belongsToMany(Message::class, 'message_has_tag');
	}
}
