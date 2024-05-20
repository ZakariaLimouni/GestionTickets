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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_ticket_id')->constrained('type_tickets');
            $table->string('status')->nullable();
            $table->string('sujet')->nullable();
            $table->string('client')->nullable();
            $table->string('code_client')->nullable()->unique();
            $table->foreignId('agence_id')->nullable()->constrained('agences');
            $table->text('description')->nullable();
            $table->text('resolution')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->foreign('assigned_to')
                  ->references('id')
                  ->on('users');
            $table->string('document')->nullable();
            $table->foreignId('type_document_id')->nullable()->constrained('type_documents');
            $table->dateTime('publie_le')->nullable();
            $table->dateTime('date_cloture')->nullable();
            $table->string('document_creator')->nullable();
            $table->string('cloture_creator')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
