<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('task');
            $table->text('description');
            $table->date('deadline');
            $table->integer('importance');
            $table->foreignId('user_id')->after('id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
            //$table->boolean('repeat');
            //$table->double('achievement', 3, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // userテーブルとの連携を解除してtodosテーブルを削除
        Schema::table('todos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);       // userテーブルとの連携を解除
            $table->dropColumn(['user_id']);        // user_idカラムを削除
        });
        Schema::dropIfExists('todos');
    }
};
