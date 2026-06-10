<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('email');
            $table->string('phone')->nullable()->after('avatar');
            $table->string('country')->nullable()->after('phone');
            $table->string('google_id')->nullable()->after('country');
            $table->string('provider')->nullable()->after('google_id');
            $table->boolean('is_active')->default(true)->after('provider');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar', 'phone', 'country', 'google_id', 'provider', 'is_active']);
        });
    }
};
