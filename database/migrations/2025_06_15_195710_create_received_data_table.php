<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('received_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->json('payload');
            $table->uuid('user_identifier');
            $table->foreign('user_identifier')
                ->references('identifier')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('received_data');
    }
};
