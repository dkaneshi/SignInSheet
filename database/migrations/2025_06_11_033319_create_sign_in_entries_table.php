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
        Schema::create('sign_in_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->foreignId('sign_in_sheet_id')->index();
            $table->foreignId('leave_type_id')->index();
            $table->dateTime('start_time');
            $table->dateTime('lunch_start')->nullable();
            $table->dateTime('lunch_end')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->integer('overtime_hours')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
};
