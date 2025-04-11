<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
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
            $table->string('password');
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('decorators', function (Blueprint $table) {
            $table->id('decorator_id');
            $table->string('decorator_name', 100);
            $table->string('decorator_icon', 100)->nullable();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->decimal('rating', 3, 2)->default(0.0);
            $table->boolean('availability')->default(true);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password_hash');
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image', 100)->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('decorator_id');
            $table->boolean('is_live')->default(false);
            $table->decimal('price', 10, 2);
            $table->decimal('rating', 3, 2)->default(0.0);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('decorator_id')->references('decorator_id')->on('decorators')->onDelete('cascade');
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->id('package_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('decorator_id');
            $table->decimal('price', 10, 2);
            $table->decimal('rating', 3, 2)->default(0.0);
            $table->enum('status', ['pending', 'confirmed', 'completed'])->default('pending');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('decorator_id')->references('decorator_id')->on('decorators')->onDelete('cascade');
        });

        Schema::create('package_events', function (Blueprint $table) {
            $table->id('package_event_id');
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('event_id');

            $table->foreign('package_id')->references('package_id')->on('packages')->onDelete('cascade');
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'completed', 'cancelled'])->default('pending');
            $table->decimal('advance_paid', 10, 2)->default(0.0);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('set null');
            $table->foreign('package_id')->references('package_id')->on('packages')->onDelete('set null');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
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

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('set null');
            $table->foreign('package_id')->references('package_id')->on('packages')->onDelete('set null');
            $table->foreign('decorator_id')->references('decorator_id')->on('decorators')->onDelete('set null');
        });

        Schema::create('admin_commissions', function (Blueprint $table) {
            $table->id('commission_id');
            $table->unsignedBigInteger('booking_id');
            $table->decimal('amount', 10, 2);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
        });

        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id('promo_id');
            $table->string('code', 50)->unique();
            $table->decimal('discount_percentage', 5, 2);
            $table->decimal('max_discount_amount', 10, 2)->default(0.0);
            $table->date('expiry_date');
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('applied_promo_codes', function (Blueprint $table) {
            $table->id('applied_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('promo_id');
            $table->unsignedBigInteger('booking_id');
            $table->decimal('discount_applied', 10, 2);
            $table->timestamp('applied_at')->useCurrent();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('promo_id')->references('promo_id')->on('promo_codes')->onDelete('cascade');
            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
        });

        Schema::create('booking_cancellations', function (Blueprint $table) {
            $table->id('cancellation_id');
            $table->unsignedBigInteger('booking_id');
            $table->enum('cancelled_by', ['user', 'decorator', 'admin']);
            $table->text('reason')->nullable();
            $table->decimal('refund_amount', 10, 2)->default(0.0);
            $table->timestamp('cancelled_at')->useCurrent();

            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('message')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });

        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id('bookmark_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->unsignedBigInteger('decorator_id')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('set null');
            $table->foreign('package_id')->references('package_id')->on('packages')->onDelete('set null');
            $table->foreign('decorator_id')->references('decorator_id')->on('decorators')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('booking_cancellations');
        Schema::dropIfExists('applied_promo_codes');
        Schema::dropIfExists('promo_codes');
        Schema::dropIfExists('admin_commissions');
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