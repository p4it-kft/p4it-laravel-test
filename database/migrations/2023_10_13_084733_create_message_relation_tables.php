<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('message_author', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->bigInteger('author_id')->nullable()->unsigned();

            $table->index('author_id');
            $table->unique('author_id');

            $table->foreign('author_id', 'fk_message_message_author_1')
                ->references('id')
                ->on('message_author')
                ->onUpdate('CASCADE')
                ->onDelete('SET NULL');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('label');
        });

        Schema::create('message_has_tag', function (Blueprint $table) {
            $table->bigInteger('message_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();

            $table->primary(['message_id', 'tag_id']);

            $table->foreign('message_id', 'fk_message_has_tag_message1')
                ->references('id')
                ->on('messages')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('tag_id', 'fk_message_has_tag_tag1')
                ->references('id')
                ->on('tags')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_author');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('message_has_tag');
    }
};
