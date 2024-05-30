<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Job Postings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                    @foreach ($positions as $position)
                        <div class="w-full mb-0">
                            <div class="@if($position->status == \App\Models\Position::STATUS_ACTIVE) bg-white @else bg-gray-300 @endif rounded overflow-hidden shadow-lg">
                                <div class="px-12 py-6">
                                    <div class="font-bold text-l mb-0">Job ID: {!! $position->id !!} @if($position->status == \App\Models\Position::STATUS_INACTIVE) <span class="text-red-600">(INACTIVE)</span> @endif</div>
                                    <div class="text-l mb-0">Job Title: <span class="font-bold">{!! $position->name !!}</span></div>
                                    <div class="text-l mb-0">Company: <span class="font-bold">{!! $position->company->company_name !!}</span></div>
                                    <div class="text-l mb-2">Employment Type: <span class="font-bold">{!! ucfirst($position->employmentType->employment_type) !!}</span></div>
                                    @if($position->email)
                                        <div class="text-l mb-2">Submitted By: <span class="font-bold">{!! $position->email !!}</span></div>
                                    @endif
                                    <hr />
                                    <ul class="my-2">
                                        <li>Office: <b>{!! $position->office->office_name !!}</b></li>
                                        <li>Department: <b>{!! $position->department->department_name !!}</b></li>
                                        <li>Category: <b>{!! $position->recruitingCategory->recruiting_category_name !!}</b></li>
                                        <li>Seniority: <b>{!! ucfirst($position->seniority->seniority) !!}</b></li>
                                        <li>Years of Experience: <b>{!! $position->years_from !!} - {!! $position->years_to !!} years</b></li>
                                        <li>Schedule: <b>{!! ucfirst($position->schedule->schedule) !!}</b></li>
                                    </ul>

                                    <div id="description{!! $position->id !!}" class="hidden">
                                        @foreach($position->jobDescriptions as $d)
                                            <p class="text-gray-700 text-base my-2">{!! $d->name !!}</p>
                                            <p class="text-gray-700 text-base my-2">{!! $d->value !!}</p>
                                        @endforeach
                                    </div>

                                    <div class="py-2">
                                        @foreach($position->jobKeywords->pluck('keyword') as $k)
                                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{!! $k !!}</span>
                                        @endforeach
                                    </div>

                                    <hr />

                                    <div class="pt-4">
                                        <a href="#" onclick="openModal({!! $position->id !!})" class="pr-2 py-12">View Details</a>
                                        |
                                        @if($position->status == \App\Models\Position::STATUS_ACTIVE)
                                            <a href="#" onclick="confirmDeactivate({!! $position->id !!})" class="pl-2 py-12">Deactivate</a>
                                        @else
                                            <a href="#" onclick="confirmActivate({!! $position->id !!})" class="pl-2 py-12">Activate</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="overflow-auto fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-50 rounded-lg">
        <div class="bg-white overflow-hidden shadow-lg max-w-7xl w-full mx-auto rounded-lg">
            <div class="px-12 py-6">
                <div id="modal-content"></div>
                <button onclick="closeModal()" class="mt-4 bg-gray-500 text-white px-4 py-1 rounded">Close</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(positionId) {
            const positions = @json($positions->keyBy('id'));
            const positionData = positions[positionId];

            let descriptions = '';
            if (positionData.job_descriptions) {
                positionData.job_descriptions.forEach(description => {
                    descriptions += `<p class="text-gray-700 text-base my-2">${description.name}</p><p class="text-gray-700 text-base my-2">${description.value}</p>`;
                });
            }

            let keywords = '';
            if (positionData.job_keywords) {
                positionData.job_keywords.forEach(keyword => {
                    keywords += `<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">${keyword.keyword}</span>`;
                });
            }

            const modalContent = `
                <div class="font-bold text-l mb-0">Job ID: ${positionData.id}</div>
                <div class="font-bold text-l mb-0">${positionData.name}</div>
                <div class="text-l mb-0">Company: <span class="font-bold">${positionData.company.company_name}</span></div>
                <div class="text-l mb-2">Employment Type: <span class="font-bold">${positionData.employment_type.employment_type}</span></div>
                <div class="text-l mb-2">Submitted By: <span class="font-bold">${positionData.email}</span></div>
                <hr />
                <ul class="my-2">
                    <li>Office: <b>${positionData.office.office_name}</b></li>
                    <li>Department: <b>${positionData.department.department_name}</b></li>
                    <li>Category: <b>${positionData.recruiting_category.recruiting_category_name}</b></li>
                    <li>Seniority: <b>${positionData.seniority.seniority}</b></li>
                    <li>Years of Experience: <b>${positionData.years_from} - ${positionData.years_to} years</b></li>
                    <li>Schedule: <b>${positionData.schedule.schedule}</b></li>
                </ul>
                <hr />
                ${descriptions}
                <div class="py-2">
                    ${keywords}
                </div>
            `;

            $('#modal-content').html(modalContent);
            $('#modal').removeClass('hidden');
        }

        function closeModal() {
            $('#modal').addClass('hidden');
        }

        function confirmActivate(id)
        {
            const c = confirm('Confirm approval of Job ID ' + id + '?');
            if (c) {
                $.ajax({
                    method: 'POST',
                    url: "{!! route('positions.activate') !!}",
                    data: {
                        _token: '{!! csrf_token() !!}',
                        id: id
                    },
                    success: function(result){
                        $("#div1").html(result);
                    }
                });

                window.location.reload();
            }
        }

        function confirmDeactivate(id)
        {
            const c = confirm('Confirm deactivate of Job ID ' + id + '?');
            if (c) {
                $.ajax({
                    method: 'POST',
                    url: "{!! route('positions.deactivate') !!}",
                    data: {
                        _token: '{!! csrf_token() !!}',
                        id: id
                    },
                    success: function(result){
                        $("#div1").html(result);
                    }
                });

                window.location.reload();
            }
        }
    </script>
</x-app-layout>
