<?php

use App\Models\LeaveType;
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
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbreviation', 6)->nullable()->unique();
            $table->timestamps();
        });


        LeaveType::query()->create([
            'name' => 'Vacation',
            'abbreviation' => 'VAC'
        ]);

        LeaveType::query()->create([
            'name' => 'Sick',
            'abbreviation' => 'SCK'
        ]);
    }
};
