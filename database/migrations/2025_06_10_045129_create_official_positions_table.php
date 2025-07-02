<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('official_positions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->timestamps();
        });


        DB::table('official_positions')->insert([
            ['title' => 'President'],
            ['title' => 'Vice President for Internal Affairs'],
            ['title' => 'Vice President for External Affairs'],
            ['title' => 'Vice President for Education'],
            ['title' => 'Secretary'],
            ['title' => 'Treasurer'],
            ['title' => 'Auditor'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('official_positions');
    }
}
