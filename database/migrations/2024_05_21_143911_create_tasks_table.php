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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('comment')->nullable();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->string('status')->default(\App\Enums\TaskStatusEnum::Progressing->value);
            $table->string('priority')->default(\App\Enums\TaskPpriorityEnum::Low->value);
            $table->timestamp('deadline_at')->nullable();
            $table->timestamp('reminder_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
