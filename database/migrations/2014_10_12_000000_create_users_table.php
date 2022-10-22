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
        Schema::create('users', function (Blueprint $table) {
            // 追加
            $table->string('provider_id')->nullable();
            // 追加
            $table->string('provider_name')->nullable();


            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            // null許容に変更
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // 複合ユニークキー
            $table->unique(['provider_id', 'provider_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
