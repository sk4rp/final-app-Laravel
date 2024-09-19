<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('clicks', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained('offers');
            $table->foreignId('webmaster_id')->constrained('users');
            $table->string('client_ip');
            $table->timestamp('clicked_at');
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('clicks');
    }
};
