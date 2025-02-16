<?php

use Database\Seeders\EmployeesTableSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('code', 4);
            $table->string('name', 150);
            $table->string('nickname', 100);
            $table->string('mother_name', 150);
            $table->string('father_name', 150);
            $table->string('document', 11);
            $table->date('birth_date');
            $table->string('role', 100);
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed', [
            '--class' => EmployeesTableSeeder::class,
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
