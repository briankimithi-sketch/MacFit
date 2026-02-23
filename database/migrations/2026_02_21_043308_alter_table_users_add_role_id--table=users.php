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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->nullable();
            $table->string('user_image')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();

            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['role_id']);

            // Then drop columns
            $table->dropColumn('is_active');
            $table->dropColumn('user_image');
            $table->dropColumn('role_id');
        });
    }
};
