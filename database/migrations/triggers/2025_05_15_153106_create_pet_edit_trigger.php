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
    DB::unprepared('
        CREATE TRIGGER log_pet_edits AFTER UPDATE ON pets
        FOR EACH ROW
        BEGIN
            INSERT INTO activity_logs (pet_id, action, description, performed_at)
            VALUES (NEW.id, "update", CONCAT("Pet updated: ", NEW.pet_name), NOW());
        END
    ');
}

public function down()
{
    DB::unprepared('DROP TRIGGER IF EXISTS log_pet_edits');
}
};
