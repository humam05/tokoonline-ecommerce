<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('invoice')->unique()->nullable()->after('id');
            $table->string('city')->nullable()->after('shipping_address');
            $table->string('postal_code')->nullable()->after('city');
            $table->text('notes')->nullable()->after('postal_code');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['invoice', 'city', 'postal_code', 'notes']);
        });
    }
};
