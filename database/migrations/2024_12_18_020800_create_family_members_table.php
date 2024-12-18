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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_head_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->date('m_birth_date');
            $table->enum('marital_status', ['married', 'unmarried'])->default('unmarried');
            $table->date('wedding_date')->nullable();
            $table->string('education');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
