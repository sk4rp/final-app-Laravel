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
        Schema::create('offer_subscriptions', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('webmaster_id')->constrained('users');
            $table->foreignId('offer_id')->constrained('offers');
            $table->decimal('cost_per_click');
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_subscriptions');
    }
};
