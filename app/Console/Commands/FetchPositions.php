<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Department;
use App\Models\EmploymentType;
use App\Models\JobDescription;
use App\Models\JobKeyword;
use App\Models\Occupation;
use App\Models\OccupationCategory;
use App\Models\Office;
use App\Models\Position;
use App\Models\RecruitingCategory;
use App\Models\Schedule;
use App\Models\Seniority;
use Illuminate\Console\Command;
use SimpleXMLElement;

class FetchPositions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-positions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch job positions from API. All fetched positions will be marked active.';

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle()
    {
        //
        $ids = array();
        $xmlString = file_get_contents('https://mrge-group-gmbh.jobs.personio.de/xml');
        $xml = new SimpleXMLElement($xmlString);

        foreach ($xml->children() as $p) {

            try {

                $company = Company::updateOrCreate(['company_name' => (string) $p->subcompany]);
                $office = Office::updateorCreate(['office_name' => (string) $p->office]);
                $department = Department::updateOrCreate(['department_name' => (string) $p->department]);
                $recruitingCategory = RecruitingCategory::updateOrCreate(['recruiting_category_name' => (string) $p->recruitingCategory]);

                $employmentType = EmploymentType::updateOrCreate(['employment_type' => (string) $p->employmentType]);
                $seniority = Seniority::updateOrCreate(['seniority' => (string) $p->seniority]);
                $schedule = Schedule::updateOrCreate(['schedule' => (string) $p->schedule]);

                $yearsOfExperience = (string) $p->yearsOfExperience;
                $yearsOfExperienceArray = explode('-', $yearsOfExperience);
                $yearsFrom = $yearsOfExperienceArray[0];
                $yearsTo = $yearsOfExperienceArray[1];

                $occupationCategory = OccupationCategory::updateOrCreate(['occupation_category_name' => (string) $p->occupationCategory]);
                $occupation = Occupation::updateOrCreate(['occupation_category_id' => $occupationCategory->id, 'occupation_name' => (string) $p->occupation]);
                $createdAt = (string) $p->createdAt;

                $position = Position::updateOrCreate(
                    [
                        'id' => (int) $p->id
                    ],
                    [
                        'id' => (int) $p->id,
                        'company_id' => $company->id,
                        'office_id' => $office->id,
                        'department_id' => $department->id,
                        'recruiting_category_id' => $recruitingCategory->id,
                        'name' => (string) $p->name,
                        'employment_type_id' => $employmentType->id,
                        'seniority_id' => $seniority->id,
                        'schedule_id' => $schedule->id,
                        'years_from' => $yearsFrom,
                        'years_to' => $yearsTo,
                        'occupation_id' => $occupation->id,
                        'occupation_category_id' => $occupationCategory->id,
                        'created_by' => $createdAt,
                        'status' => Position::STATUS_ACTIVE
                    ]
                );

                // job description entries
                foreach ($p->jobDescriptions->children() as $d) {
                    $descriptionName = (string) $d->name;
                    $descriptionValue = (string) $d->value;
                    $descriptionValue = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}\x{A0}]/u', '', $descriptionValue);
                    $descriptionValue = trim(preg_replace('/\s+/', ' ', $descriptionValue));

                    JobDescription::updateOrCreate([
                        'position_id' => $position->id,
                        'name' => $descriptionName,
                        'value' => $descriptionValue,
                    ]);
                }

                // job keywords
                $keywords = (string) $p->keywords;
                $keywordsArray = explode(',', $keywords);
                foreach ($keywordsArray as $keyword) {
                    JobKeyword::updateOrCreate([
                        'position_id' => $position->id,
                        'keyword' => $keyword,
                    ]);
                }

                $ids[] = $position->id;

            }
            catch (\Exception $e) {
                $this->fail($e->getMessage());
            }

        }

        $this->info("Added/Updated Job Position IDs: " . implode(', ', $ids));
    }
}
