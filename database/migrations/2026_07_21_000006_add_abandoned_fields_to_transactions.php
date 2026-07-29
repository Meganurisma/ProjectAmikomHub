<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'abandoned_reminder_sent_at')) {
                $table->timestamp('abandoned_reminder_sent_at')->nullable()->after('snap_token');
            }
            if (!Schema::hasColumn('transactions', 'reminder_attempts')) {
                $table->unsignedTinyInteger('reminder_attempts')->default(0)->after('abandoned_reminder_sent_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'reminder_attempts')) {
                $table->dropColumn('reminder_attempts');
            }
            if (Schema::hasColumn('transactions', 'abandoned_reminder_sent_at')) {
                $table->dropColumn('abandoned_reminder_sent_at');
            }
        });
    }
};
