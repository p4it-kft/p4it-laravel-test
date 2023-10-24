<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Http\Requests\StoreMessageAuthorRequest;
use App\Http\Requests\StoreMessageFormRequest;
use App\Http\Requests\StoreMessageHasTagRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class Message
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string|null $text
 * @property string $email
 * @property array $tags
 *
 * @package App\Models
 */
class MessageForm extends Message
{
	public $timestamps = false;

    protected $fillable = [
        'name',
        'title',
        'text',
        'email',
        'tags'
    ];

    public function message_author()
	{
		return $this->belongsTo(MessageAuthor::class, 'author_id', 'id');
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'message_has_tag', 'message_id', 'tag_id');
	}

    public function load($relations)
    {
        $model = parent::load($relations);

        $model->email = $this->message_author->email ?? '';

        return $model;
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function insertAll(): int
    {
        DB::beginTransaction();

        try {
            $message = new Message();
            $message->name = $this->name;
            $message->title = $this->title;
            $message->text = $this->text;
            Validator::make($message->attributes, (new StoreMessageFormRequest())->rules());
            $message->save();

            $messageAuthor = new MessageAuthor();
            $messageAuthor->name = $this->name;
            $messageAuthor->email = $this->email;
            Validator::make($messageAuthor->attributes, (new StoreMessageAuthorRequest())->rules());
            $messageAuthor->save();

            $message->update(['author_id' => $messageAuthor->id]);

            foreach ($this->tags as $tagId) {
                $messageHasTag = new MessageHasTag();
                $messageHasTag->tag_id = $tagId;
                $messageHasTag->message_id = $message->id;
                Validator::make($messageAuthor->attributes, (new StoreMessageHasTagRequest())->rules());
                $messageHasTag->save();
            }

            DB::commit();

            return $message->id;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function updateAll(Request $request)
    {
        DB::beginTransaction();

        try {
            $requestData = $request->all();

            /** @var Message $message */
            $message = Message::findOrFail($this->id);
            $attributes = $request->only(array_keys($message->attributes));
            $message->update($attributes);

            $messageAuthor = MessageAuthor::updateOrCreate(
                ['name' => $message->message_author->name, 'email' => $message->message_author->email],
                ['name' => $requestData['name'], 'email' => $requestData['email']]
            );

            $message->update(['author_id' => $messageAuthor->id]);

            MessageHasTag::where(['message_id' => $this->id])->delete();

            foreach ($requestData['tags'] ?? [] as $tagId) {
                MessageHasTag::create(['tag_id' => $tagId, 'message_id' => $message->id]);
            }

            DB::commit();

            return $message->id;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function __toString()
    {
        $label[] = $this->name;
        $label[] = $this->title;
        $label[] = $this->message_author->email ?? '';
        $label[] = '(' . collect($this->tags ?? [])->pluck('label')->implode(', ') . ')';

        return implode(' | ', $label);
    }
}
