<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        // Menambahkan kolom sizes setelah kolom price (harga)
        $table->string('sizes')->nullable()->after('price'); 
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('sizes');
    });
}
};
