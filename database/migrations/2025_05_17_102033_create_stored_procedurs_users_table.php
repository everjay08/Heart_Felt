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
            CREATE PROCEDURE sp_create_user (
                IN p_first_name VARCHAR(50),
                IN p_last_name VARCHAR(50),
                IN p_email VARCHAR(100),
                IN p_password VARCHAR(255),
                IN p_created_at DATETIME,
                IN p_updated_at DATETIME
            )
            BEGIN
                -- Check if the email already exists
                IF EXISTS (
                    SELECT 1 FROM users WHERE email = p_email
                ) THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Email already exists";
                ELSE
                    -- Insert the new user
                    INSERT INTO users (first_name, last_name, email, password, created_at, updated_at)
                    VALUES (p_first_name, p_last_name, p_email, p_password, p_created_at, p_updated_at);
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
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_create_user');
        
    }
};
