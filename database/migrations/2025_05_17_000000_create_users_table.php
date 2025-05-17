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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->string('is_admin')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone',10)->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code',6)->nullable();
            $table->string('image')->default('user.png');
            $table->rememberToken();
            $table->timestamps();
            $table->fullText(['fname', 'lname', 'email']);
            
        });
        DB::statement("
            CREATE VIEW users_view AS
            SELECT
                id,
                CONCAT(fname, ' ', lname) AS full_name,
                email,
                is_admin,
                email_verified_at,
                phone,
                street,
                city,
                province,
                postal_code,
                image,
                created_at,
                updated_at
            FROM users
        ");
    
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
