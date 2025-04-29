<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hozzáadjuk a timestamp mezőket
            $table->timestamps(); // Ez létrehozza a created_at és updated_at mezőket
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }
};
