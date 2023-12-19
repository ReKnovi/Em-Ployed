<?php

// database/migrations/yyyy_mm_dd_create_jobs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Foreign key to link job to employer
            $table->string('title');
            $table->text('description');
            $table->string('qualifications');
            $table->decimal('salary', 10, 2);
            $table->string('location');
            $table->string('company_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}

