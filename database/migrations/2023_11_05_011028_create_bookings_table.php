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
        Schema::create('bookings', function (Blueprint $table) { 
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('lot_id')->constrained('lots');
            $table->bigInteger('approved_by')->nullable();
            $table->integer('pax')->nullable(); //NUM OF PAX
            $table->integer('totalprice')->nullable();
            $table->integer('paymentstatus')->default(0)->comment('0=Unpaid 1=Paid 2=Unsuccessful');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('numdays')->nullable();
            $table->text('remark')->nullable();
            $table->integer('status')->default(0)->comment('0=Pending 1=Under Review 2=Approved 3=Rejected 4=Past 5=Cancel 6=Cancel Approved');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
