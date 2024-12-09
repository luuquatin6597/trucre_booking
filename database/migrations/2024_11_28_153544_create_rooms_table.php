<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('description');
            $table->string('address');
            $table->string('country');
            $table->string('map');
            $table->enum('status', ['waiting', 'active', 'inactive'])->default('waiting');
            $table->timestamps();
        });

        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->constrained();
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('type_id')->constrained();
            $table->foreignId('building_id')->constrained();
            $table->string('name');
            $table->integer('price');
            $table->integer('comparePrice')->nullable();
            $table->string('images');
            $table->string('description');
            $table->integer('maxChair');
            $table->integer('maxTable');
            $table->integer('maxPeople');
            $table->string('tags');
            $table->timestamp('startAt')->default(now());
            $table->timestamp('endAt')->default(now());
            $table->enum('status', ['waiting', 'active', 'inactive'])->default('waiting');
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained();
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('building_id')->constrained();
            $table->enum('status', ['waiting', 'active', 'inactive'])->default('waiting');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('buildings');
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('images');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('types');
    }
};
