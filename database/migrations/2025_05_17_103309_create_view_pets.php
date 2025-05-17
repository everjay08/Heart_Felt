<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::statement("
            CREATE VIEW pets_view AS
            SELECT 
                pets.id,
                pets.pet_name,
                pets.age,
                pets.gender,
                pets.animal_type,
                pets.color,
                pets.coat_length,
                pets.pet_image,
                pets.is_adopted,
                pets.description,
                pets.created_at,
                pets.updated_at,
                users.id AS user_id,
                CONCAT(users.fname, ' ', users.lname) AS owner_name,
                users.email AS owner_email
            FROM pets
            JOIN users ON pets.user_id = users.id
        ");
    }

    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS pets_view");
    }
};