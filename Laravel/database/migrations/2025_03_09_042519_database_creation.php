<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('category_name', 100);
            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('decorators', function (Blueprint $table) {
            $table->id('decorator_id');
            $table->string('decorator_name', 100);
            $table->string('decorator_icon', 255)->nullable();
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->boolean('availability')->default(true);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password_hash', 255);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('decorator_id');
            $table->boolean('is_live')->default(false);
            $table->decimal('price', 10, 2);
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->foreign('decorator_id')->references('decorator_id')->on('decorators');
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->id('package_id');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('decorator_id');
            $table->decimal('price', 10, 2);
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->enum('status', ['pending', 'confirmed', 'completed'])->default('pending');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('decorator_id')->references('decorator_id')->on('decorators');
        });

        Schema::create('package_events', function (Blueprint $table) {
            $table->id('package_event_id');
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('event_id');

            $table->foreign('package_id')->references('package_id')->on('packages');
            $table->foreign('event_id')->references('event_id')->on('events');
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected', 'completed'])->default('pending');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('event_id')->references('event_id')->on('events');
            $table->foreign('package_id')->references('package_id')->on('packages');
        });

        Schema::create('feedback', function (Blueprint $table) {
            $table->id('feedback_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->unsignedBigInteger('decorator_id')->nullable();
            $table->decimal('rating', 3, 2);
            $table->text('comment')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('event_id')->references('event_id')->on('events');
            $table->foreign('package_id')->references('package_id')->on('packages');
            $table->foreign('decorator_id')->references('decorator_id')->on('decorators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('package_events');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('events');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('decorators');
        Schema::dropIfExists('users');
        Schema::dropIfExists('categories');
    }
};
