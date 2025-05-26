<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('floodgates', function (Blueprint \$table) {
            \$table->string('id', 5)->primary();
            \$table->string('location');
            \$table->decimal('water_flow_rate', 8, 2);
            \$table->enum('status', ['open', 'close']);
            \$table->enum('pump_status', ['open', 'close']);
            \$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floodgates');
    }
};
