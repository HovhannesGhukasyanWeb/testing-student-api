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
        Schema::create('group_teacher_subject', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(false);
            $table->foreignId('group_id')->nullable(false);
            $table->foreignId('subject_id')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_teacher_subject', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('group_id');
            $table->dropForeign('subject_id');
        });
        Schema::dropIfExists('group_teacher');
    }
};
