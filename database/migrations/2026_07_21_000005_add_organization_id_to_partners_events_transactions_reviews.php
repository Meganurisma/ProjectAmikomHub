<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            if (!Schema::hasColumn('partners', 'organization_id')) {
                $table->foreignId('organization_id')->nullable()->constrained('organizations')->nullOnDelete()->after('id');
            }
        });

        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'organization_id')) {
                $table->foreignId('organization_id')->nullable()->constrained('organizations')->nullOnDelete()->after('partner_id');
            }
        });

        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'organization_id')) {
                $table->foreignId('organization_id')->nullable()->constrained('organizations')->nullOnDelete()->after('event_id');
            }
        });

        Schema::table('reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'organization_id')) {
                $table->foreignId('organization_id')->nullable()->constrained('organizations')->nullOnDelete()->after('partner_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            if (Schema::hasColumn('partners', 'organization_id')) {
                $table->dropConstrainedForeignId('organization_id');
            }
        });

        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'organization_id')) {
                $table->dropConstrainedForeignId('organization_id');
            }
        });

        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'organization_id')) {
                $table->dropConstrainedForeignId('organization_id');
            }
        });

        Schema::table('reviews', function (Blueprint $table) {
            if (Schema::hasColumn('reviews', 'organization_id')) {
                $table->dropConstrainedForeignId('organization_id');
            }
        });
    }
};
