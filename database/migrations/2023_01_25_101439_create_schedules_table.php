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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('date_range_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('day', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])->nullable(false);
            $table->time('starts_at')->nullable(false);
            $table->time('ends_at')->nullable(false);
            $table->date('created_at')->nullable(false)->default(now());
        });
        Schema::create('schedules_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('date_range_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('day', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])->nullable(false);
            $table->time('starts_at')->nullable(false);
            $table->time('ends_at')->nullable(false);
            $table->date('created_at')->nullable(false);
        });
        DB::unprepared('
            CREATE TRIGGER schedules_delete_trigger BEFORE DELETE ON schedules
            FOR EACH ROW
            BEGIN
                INSERT INTO schedules_logs (date_range_id, day, starts_at, ends_at, created_at)
                VALUES (OLD.date_range_id, OLD.day, OLD.starts_at, OLD.ends_at, OLD.created_at);
            END');
        DB::unprepared('
            CREATE EVENT schedules_log_delete_event ON SCHEDULE EVERY 1 DAY
            DO DELETE FROM schedules_logs WHERE created_at < DATE_SUB(NOW(), INTERVAL 5 YEAR);'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
