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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('formation_sessions')->restrictOnDelete();
            $table->string('external_contact_id');
            $table->string('external_contact_name');
            $table->enum('status', ['registered', 'cancelled']);
            $table->timestamps();
            $table->unique(['session_id', 'external_contact_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
