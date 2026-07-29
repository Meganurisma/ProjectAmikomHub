<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('whatsapp_logs')) {
            Schema::create('whatsapp_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('transaction_id')->nullable()->constrained()->nullOnDelete();
                $table->foreignId('event_id')->nullable()->constrained()->nullOnDelete();
                $table->foreignId('organization_id')->nullable()->constrained()->nullOnDelete();
                $table->string('order_id')->nullable();
                $table->string('recipient_phone');
                $table->string('provider');
                $table->string('status');
                $table->text('message')->nullable();
                $table->json('payload')->nullable();
                $table->json('response')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('whatsapp_logs', function (Blueprint $table) {
                if (! Schema::hasColumn('whatsapp_logs', 'order_id')) {
                    $table->string('order_id')->nullable()->after('organization_id');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_logs');
    }
};
