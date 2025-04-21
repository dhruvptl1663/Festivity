<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            // Explicit foreign key for user_id -> users.user_id
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            // Explicit foreign key for event_id -> events.event_id
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');

            // Explicit foreign key for package_id -> packages.package_id
            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id')->references('package_id')->on('packages')->onDelete('cascade');

            $table->timestamps();

            // Ensure a user can't add the same event/package twice
            $table->unique(['user_id', 'event_id']);
            $table->unique(['user_id', 'package_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
