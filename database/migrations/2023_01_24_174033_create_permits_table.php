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
        Schema::create('permits', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable(false);
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('permitType',['death','move','exam','prenat','fecAs','marriage','duties','particularBussines','unexpection']);

            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);
            $table->time('start_time')->nullable(false);
            $table->time('end_time')->nullable(false);

            $table->date('requested_at')->nullable(false);
            $table->enum('status', ['pending', 'accepted', 'denied'])->default('pending');
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
        Schema::dropIfExists('permits');
    }
};
