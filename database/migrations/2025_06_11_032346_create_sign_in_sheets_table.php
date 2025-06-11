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
        Schema::create('sign_in_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->index();
            $table->foreignId('team_id')->index();
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }
};
