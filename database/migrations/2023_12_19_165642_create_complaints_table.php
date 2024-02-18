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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('0')->comment('0-Under Review 1-Approved 2-Rejected'); // 0 = PENDING|1 = IN-REVIEW|2 = REJECT
            $table->text('suggestion')->nullable(); // 0 = PENDING|1 = APPROVED|2 = REJECT
            $table->text('photo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
