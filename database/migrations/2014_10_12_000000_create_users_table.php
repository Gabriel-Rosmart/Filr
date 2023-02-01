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
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->char('dni', 9)->unique()->nullable(false);
            $table->char('phone', 9)->unique()->nullable(false);
            $table->boolean('is_admin')->default(false);
            $table->boolean('active')->default(false);
            $table->foreignId('role_id')->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_pic')->default('0fe194e2c89b5188129fbbcff5781d60001129fc684039ab57ca8364913339ae.jpg');
            $table->rememberToken();
            $table->timestamps();
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
