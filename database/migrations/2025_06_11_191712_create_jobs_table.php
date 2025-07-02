<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company_name');
            $table->string('location');
            $table->enum('type', ['full-time', 'freelance', 'contract', 'part-time']);
            $table->text('description');
            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();
            $table->enum('salary_unit', ['annual', 'hourly'])->default('annual');
            $table->boolean('is_featured')->default(false);
            $table->date('posted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
