<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
    CREATE PROCEDURE sp_create_pet (
        IN p_user_id BIGINT,
        IN p_pet_name VARCHAR(255),
        IN p_color VARCHAR(50),
        IN p_description TEXT,
        IN p_pet_image VARCHAR(255),
        IN p_created_at DATETIME,
        IN p_updated_at DATETIME
    )
    BEGIN
        -- Check if the user exists
        IF NOT EXISTS (
            SELECT 1 FROM users WHERE id = p_user_id
        ) THEN
            SIGNAL SQLSTATE "45000"
            SET MESSAGE_TEXT = "User not found";
        ELSE
            -- Insert the new pet
            INSERT INTO pets (user_id, pet_name, color, description, pet_image, created_at, updated_at)
            VALUES (p_user_id, p_pet_name, p_color, p_description, p_pet_image, p_created_at, p_updated_at);
        END IF;
    END;
');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the stored procedure if it exists
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_create_pet');
    }
};
