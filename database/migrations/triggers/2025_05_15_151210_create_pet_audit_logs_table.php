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
        // Create audit_logs table
        Schema::create('pet_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('action');
            $table->text('old_data')->nullable();
            $table->text('new_data')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        // Create Trigger for INSERT
        DB::unprepared("
            CREATE TRIGGER tr_pets_insert 
            AFTER INSERT ON pets 
            FOR EACH ROW 
            BEGIN
                INSERT INTO pet_audit_logs (pet_id, user_id, action, new_data, created_at)
                VALUES (NEW.id, NEW.user_id, 'INSERT', JSON_OBJECT('pet_name', NEW.pet_name, 'age', NEW.age, 'gender', NEW.gender, 'animal_type', NEW.animal_type, 'color', NEW.color, 'coat_length', NEW.coat_length, 'is_adopted', NEW.is_adopted, 'description', NEW.description), NOW());
            END;
        ");

        // Create Trigger for UPDATE
        DB::unprepared("
            CREATE TRIGGER tr_pets_update 
            AFTER UPDATE ON pets 
            FOR EACH ROW 
            BEGIN
                INSERT INTO pet_audit_logs (pet_id, user_id, action, old_data, new_data, created_at)
                VALUES (OLD.id, OLD.user_id, 'UPDATE', 
                    JSON_OBJECT('pet_name', OLD.pet_name, 'age', OLD.age, 'gender', OLD.gender, 'animal_type', OLD.animal_type, 'color', OLD.color, 'coat_length', OLD.coat_length, 'is_adopted', OLD.is_adopted, 'description', OLD.description),
                    JSON_OBJECT('pet_name', NEW.pet_name, 'age', NEW.age, 'gender', NEW.gender, 'animal_type', NEW.animal_type, 'color', NEW.color, 'coat_length', NEW.coat_length, 'is_adopted', NEW.is_adopted, 'description', NEW.description), 
                    NOW());
            END;
        ");

        // Create Trigger for DELETE
        DB::unprepared("
            CREATE TRIGGER tr_pets_delete 
            AFTER DELETE ON pets 
            FOR EACH ROW 
            BEGIN
                INSERT INTO pet_audit_logs (pet_id, user_id, action, old_data, created_at)
                VALUES (OLD.id, OLD.user_id, 'DELETE', 
                    JSON_OBJECT('pet_name', OLD.pet_name, 'age', OLD.age, 'gender', OLD.gender, 'animal_type', OLD.animal_type, 'color', OLD.color, 'coat_length', OLD.coat_length, 'is_adopted', OLD.is_adopted, 'description', OLD.description), 
                    NOW());
            END;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop triggers
        DB::unprepared("DROP TRIGGER IF EXISTS tr_pets_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS tr_pets_update");
        DB::unprepared("DROP TRIGGER IF EXISTS tr_pets_delete");

        // Drop audit_logs table
        Schema::dropIfExists('pet_audit_logs');
    }
};
