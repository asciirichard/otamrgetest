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
                            <th>Department</th>
                            <th>Recruiting Category</th>
                            <th>Job Name</th>
                            <th>Employment Type</th>
                            <th>Seniority</th>
                            <th>Years of Experience</th>
                            <th>Occupation</th>
                            <th>Occupation Category</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>Job ID</th>
                            <th>Sub Company</th>
                            <th>Office</th>
                            <th>Department</th>
                            <th>Recruiting Category</th>
                            <th>Job Name</th>
                            <th>Employment Type</th>
                            <th>Seniority</th>
                            <th>Years of Experience</th>
                            <th>Occupation</th>
                            <th>Occupation Category</th>
                            <th>View Job Posting Details</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $()
        let table = new DataTable('#myTable');
    </script>
</x-app-layout>
