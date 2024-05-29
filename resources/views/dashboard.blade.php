<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table id="job_positions">
                        <thead>
                        <tr>
                            <th>Job ID</th>
                            <th>Sub Company</th>
                            <th>Office</th>
{{--                            <th>Department</th>--}}
{{--                            <th>Recruiting Category</th>--}}
                            <th>Job/Position Name</th>
                            <th>Employment Type</th>
{{--                            <th>Seniority</th>--}}
                            <th>Years of Experience</th>
{{--                            <th>Occupation</th>--}}
{{--                            <th>Occupation Category</th>--}}
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($positions as $position)
                        <tr>
                            <td>{!! $position->id !!}</td>
                            <td>{!! $position->company->company_name !!}</td>
                            <td>{!! $position->office->office_name !!}</td>
{{--                            <td>{!! $position->department->department_name !!}</td>--}}
{{--                            <td>{!! $position->recruitingCategory->recruiting_category_name !!}</td>--}}
                            <td>{!! $position->name !!}</td>
                            <td>{!! ucfirst($position->employmentType->employment_type) !!}</td>
{{--                            <td>{!! $position->seniority->seniority !!}</td>--}}
                            <td>{!! $position->years_from !!} - {!! $position->years_to !!}</td>
{{--                            <td>{!! $position->occupation->occupation_name !!}</td>--}}
{{--                            <td>{!! $position->occupationCategory->occupation_category_name !!}}</td>--}}
                            <td>{!! $position->status == \App\Models\Position::STATUS_ACTIVE ? 'Active' : 'Inactive' !!}</td>
                            <td><a href="#">Details</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
