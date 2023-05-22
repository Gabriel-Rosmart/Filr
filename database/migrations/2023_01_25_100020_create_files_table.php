<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->date('date')->nullable(false);
            $table->time('timestamp')->nullable(false);
            //$table->string('day')->nullable(false)->default(DB::raw('DAYNAME(date)'));
        });

        DB::unprepared('DROP TRIGGER IF EXISTS `files_incidences_insert`');
        DB::unprepared('CREATE TRIGGER `files_incidences_insert` AFTER INSERT ON `files` FOR EACH ROW
        BEGIN
            INSERT INTO incidences (user_id, date, subject, minutes, created_at, updated_at)
            VALUES (NEW.user_id, NEW.date, "late", 5, NOW(), NOW());
        END');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
};
