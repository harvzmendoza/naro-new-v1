<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->text('issuance_no')->nullable();
            $table->text('title');
            $table->string('onar_no');
            $table->string('signatory')->nullable();
            $table->string('doc_date')->nullable();
            $table->string('doc_year')->nullable();
            $table->integer('publish');
            $table->text('content')->nullable();
            $table->text('committee')->nullable();
            $table->text('councilor')->nullable();
            $table->text('author')->nullable();
            $table->timestamps();
            $table->integer('division_id')->nullable();
            $table->text('members_of_division')->nullable();
            $table->text('ponente')->nullable();
            $table->text('subject')->nullable();
            $table->text('parties')->nullable();
            $table->text('case_status')->nullable();
            $table->integer('issuance_type_id')->nullable();
            $table->integer('agency_id');
            $table->integer('section_id');
            $table->string('file');
            $table->string('date_filed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
