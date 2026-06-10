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
            $table->string('last_name', 60)->nullable()->after('name');
            $table->string('phone', 10)->nullable()->after('email');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('is_deleted')->default(0);
            $table->integer('is_active')->default(1);
            $table->string('code',5)->nullable();
            $table->string('type', 20)->default('client');
            $table->string('description', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_name', 'phone', 'parent_id', 'is_deleted', 'is_active', 'code', 'type', 'description']);
        });
    }
};
