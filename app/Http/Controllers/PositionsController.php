<?php

namespace App\Http\Controllers;

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
use App\Notifications\FirstJobPosting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PositionsController extends Controller
{
    //
    public function index()
    {
        $positions = Position::where('status', Position::STATUS_ACTIVE)->get();

        return view('index', compact('positions'));
    }

    public function job($id)
    {
        $position = Position::find($id);
        return view('job', compact('position'));
    }

    public function dashboard()
    {
        $positions = Position::all();

        return view('dashboard', compact('positions'));
    }

    public function submit(Request $request)
    {
        $company = Company::updateOrCreate(['company_name' => $request->company]);
        $office = Office::updateorCreate(['office_name' =>  $request->office]);
        $department = Department::updateOrCreate(['department_name' =>  $request->department]);
        $recruitingCategory = RecruitingCategory::updateOrCreate(['recruiting_category_name' =>  $request->recruitingCategory]);

        $employmentType = EmploymentType::updateOrCreate(['employment_type' =>  $request->employmentType]);
        $seniority = Seniority::updateOrCreate(['seniority' =>  $request->seniority]);
        $schedule = Schedule::updateOrCreate(['schedule' =>  $request->schedule]);

        $yearsOfExperience =  $request->yearsOfExperience;
        $yearsOfExperienceArray = explode('-', $yearsOfExperience);
        $yearsFrom = $yearsOfExperienceArray[0];
        $yearsTo = $yearsOfExperienceArray[1];

        $occupationCategory = OccupationCategory::updateOrCreate(['occupation_category_name' =>  $request->occupationCategory]);
        $occupation = Occupation::updateOrCreate(['occupation_category_id' => $occupationCategory->id, 'occupation_name' =>  $request->occupation]);

        $position = Position::create(
            [
                'email' => $request->email,
                'company_id' => $company->id,
                'office_id' => $office->id,
                'department_id' => $department->id,
                'recruiting_category_id' => $recruitingCategory->id,
                'name' =>  $request->name,
                'employment_type_id' => $employmentType->id,
                'seniority_id' => $seniority->id,
                'schedule_id' => $schedule->id,
                'years_from' => $yearsFrom,
                'years_to' => $yearsTo,
                'occupation_id' => $occupation->id,
                'occupation_category_id' => $occupationCategory->id,
                'created_by' => Carbon::now(),
                'status' => Position::STATUS_INACTIVE
            ]
        );

        // job description entries
        for ($i = 0; $i < count($request->descriptionValues); $i++) {
            JobDescription::updateOrCreate([
                'position_id' => $position->id,
                'name' => $request->descriptionNames[$i],
                'value' => $request->descriptionValues[$i]
            ]);
        }

        // job keywords
        foreach ($request->keywords as $k) {
            JobKeyword::updateOrCreate([
                'position_id' => $position->id,
                'keyword' => $k,
            ]);
        }

//        // check if this is the first job post by email
        $emailCount = Position::where('email', $request->email)->count();
        if ($emailCount == 1) {
            $position->notify(new FirstJobPosting($position));
        }

        Session::flash('success', 'Job Position added successfully. The moderator will check the details for approval.');
        return redirect()->back();

    }

    public function activate($id)
    {
        Position::find($id)->update(['status' => Position::STATUS_ACTIVE]);
        return redirect()->back();
    }

    public function deactivate($id)
    {
        Position::find($id)->update(['status' => Position::STATUS_INACTIVE]);
        return redirect()->back();
    }

    public function spam($id)
    {
        Position::find($id)->update(['status' => Position::STATUS_SPAM]);
        return redirect()->back();
    }
}
