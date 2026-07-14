<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            if (! Schema::hasColumn('alumni', 'status')) {
                $table->string('status')->default('pending')->after('photo');
            }

            if (! Schema::hasColumn('alumni', 'show_on_homepage')) {
                $table->boolean('show_on_homepage')->default(false)->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            if (Schema::hasColumn('alumni', 'show_on_homepage')) {
                $table->dropColumn('show_on_homepage');
            }

            if (Schema::hasColumn('alumni', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
