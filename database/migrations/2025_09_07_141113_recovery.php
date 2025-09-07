<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('otps', function (Blueprint $table) {
            $table->id('otp_id');

            // email as foreign key
            $table->string('email');
            $table->foreign('email')
                  ->references('email')
                  ->on('users')
                  ->cascadeOnDelete();

            $table->string('otp_code'); // the generated OTP
            $table->dateTime('expires_at'); // expiry time
            $table->boolean('is_used')->default(false); // track usage
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
