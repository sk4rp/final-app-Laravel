<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('offers', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertiser_id')->constrained('users');
            $table->string('name');
            $table->decimal('cost_per_click')->nullable();
            $table->string('target_url');
            $table->text('site_themes');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
