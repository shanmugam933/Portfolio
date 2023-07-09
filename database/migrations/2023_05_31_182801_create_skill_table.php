<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('skills', 11);
            $table->string('progress', 11);
            $table->timestamps();
        });

        DB::table('skills')->insert([
            ['id' => 1, 'skills' => 'PHP', 'progress' => '90', 'created_at' => null, 'updated_at' => null],
            ['id' => 2, 'skills' => 'Databases', 'progress' => '90', 'created_at' => null, 'updated_at' => null],
            ['id' => 3, 'skills' => 'JavaScript', 'progress' => '75', 'created_at' => null, 'updated_at' => null],
            ['id' => 6, 'skills' => 'Node js', 'progress' => '50', 'created_at' => null, 'updated_at' => null],
            ['id' => 7, 'skills' => 'HTML & CSS', 'progress' => '90', 'created_at' => null, 'updated_at' => null],
            ['id' => 8, 'skills' => 'Laravel', 'progress' => '70', 'created_at' => null, 'updated_at' => null]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
