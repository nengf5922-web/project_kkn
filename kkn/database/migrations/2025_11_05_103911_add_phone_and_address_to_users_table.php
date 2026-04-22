<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Letakkan 'phone' setelah 'email'
            $table->string('phone')->nullable()->after('email'); 
            // Letakkan 'address' setelah 'phone'
            $table->text('address')->nullable()->after('phone'); 
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'address']);
        });
    }
};