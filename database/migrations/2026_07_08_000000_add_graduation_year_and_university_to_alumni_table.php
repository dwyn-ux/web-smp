<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('alumni')) {
            Schema::create('alumni', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('class_level');
                $table->string('address');
                $table->string('current_school');
                $table->string('current_university')->nullable();
                $table->unsignedSmallInteger('graduation_year')->nullable();
                $table->text('message');
                $table->text('suggestion');
                $table->string('photo');
                $table->string('status')->default('pending');
                $table->boolean('show_on_homepage')->default(false);
                $table->timestamps();
            });
        } else {
            Schema::table('alumni', function (Blueprint $table) {
                if (! Schema::hasColumn('alumni', 'status')) {
                    $table->string('status')->default('pending')->after('photo');
                }

                if (! Schema::hasColumn('alumni', 'show_on_homepage')) {
                    $table->boolean('show_on_homepage')->default(false)->after('status');
                }

                if (! Schema::hasColumn('alumni', 'current_university')) {
                    $table->string('current_university')->nullable()->after('current_school');
                }

                if (! Schema::hasColumn('alumni', 'graduation_year')) {
                    $table->unsignedSmallInteger('graduation_year')->nullable()->after('current_university');
                }
            });
        }

        if (! Schema::hasTable('alumni_graduation_years')) {
            Schema::create('alumni_graduation_years', function (Blueprint $table) {
                $table->id();
                $table->unsignedSmallInteger('year')->unique();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('alumni')) {
            Schema::table('alumni', function (Blueprint $table) {
                if (Schema::hasColumn('alumni', 'graduation_year')) {
                    $table->dropColumn('graduation_year');
                }

                if (Schema::hasColumn('alumni', 'current_university')) {
                    $table->dropColumn('current_university');
                }
            });
        }

        Schema::dropIfExists('alumni_graduation_years');
    }
};
