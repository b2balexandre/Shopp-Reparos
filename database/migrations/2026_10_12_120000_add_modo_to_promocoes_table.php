<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('promocoes', function (Blueprint $table) {
            $table->string('modo', 20)->default('completa')->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('promocoes', function (Blueprint $table) {
            $table->dropColumn('modo');
        });
    }
};
