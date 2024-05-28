<?php

use App\Models\EmploymentType;
use App\Models\Occupation;
use App\Models\OccupationCategory;
use App\Models\RecruitingCategory;
use App\Models\Company;
use App\Models\Department;
use App\Models\Office;
use App\Models\Schedule;
use App\Models\Seniority;
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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class);
            $table->foreignIdFor(Office::class);
            $table->foreignIdFor(Department::class);
            $table->foreignIdFor(RecruitingCategory::class);
            $table->string('name');
            $table->foreignIdFor(EmploymentType::class);
            $table->foreignIdFor(Seniority::class);
            $table->foreignIdFor(Schedule::class);
            $table->integer('years_from');
            $table->integer('years_to');
            $table->foreignIdFor(Occupation::class);
            $table->foreignIdFor(OccupationCategory::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
