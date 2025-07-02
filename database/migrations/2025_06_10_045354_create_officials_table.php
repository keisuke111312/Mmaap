<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title_abbreviation')->nullable();
            $table->foreignId('position_id')->constrained('official_positions')->onDelete('cascade');
            $table->foreignId('term_id')->constrained('official_terms')->onDelete('cascade');
            $table->string('photo_url')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('officials');
    }
}
