<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('asset_code');
            $table->string('name');
            $table->string('category');
            $table->string('serial_number')->nullable();
            $table->string('ble_mac', 32)->nullable()->index();
            $table->enum('status', ['checked_in', 'checked_out', 'maintenance'])->default('checked_out');
            $table->timestamp('last_seen_at')->nullable();
            $table->string('last_gateway_mac', 32)->nullable();
            $table->timestamps();
            $table->unique(['organization_id', 'asset_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
