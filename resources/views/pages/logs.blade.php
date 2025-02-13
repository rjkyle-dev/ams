<x-app-layout>

    @vite(['resources/js/logs.js'])
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-violet-800 leading-tight">
            {{ __('Activity Reports') }}
        </h2>
    </x-slot>

    {{-- Action buttons --}}
    <div class="mb-4 px-2 rounded-md flex justify-end items-center w-full">
        <div class="flex gap-3">
<<<<<<< HEAD
            <button class="bg-violet-600 hover:bg-violet-700 text-white rounded-md px-2 text-[10px] flex p-3 items-center">
           <a href="{{ route('logs.pdf') }}" class="bg-violet-600 hover:bg-violet-700 text-white rounded-md px-2 text-[15px] flex p-3 items-center">
=======

           <button
           onclick="GeneratePDFReport()"
           class="bg-violet-600 hover:bg-violet-700 text-white rounded-md px-5 text-2xl flex p-3 items-center">
>>>>>>> 179d4643e07a65192848b863db0dcb271ba47710
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                </svg>
                Generate PDF Report
            </button>
<<<<<<< HEAD
            <button class="bg-violet-600 hover:bg-violet-700 text-white rounded-md px-5 text-[15px] flex p-2 items-center">
                
=======
            <button
            onclick="GenerateExcelReport()"
            class="bg-violet-600 hover:bg-violet-700 text-white rounded-md px-5 text-2xl flex p-3 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                </svg>
                Generate Excel Report
            </button>
            <button
            class="bg-violet-600 hover:bg-violet-700 text-white rounded-md px-5 text-[15px] flex p-3 items-center">

>>>>>>> 179d4643e07a65192848b863db0dcb271ba47710
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>

                Clear Logs
            </button>
        </div>
    </div>
    {{-- FORMS FOR EXPORTING PDFS AND EXCELS --}}
    <form method="POST" action="{{route('logs.export')}}"
    id="exportForm"
    hidden>
        @csrf
        <input type="text" name="s_program" id="programField">
        <input type="text" name="s_set" id="setField">
        <input type="text" name="s_lvl" id="lvlField">
        <input type="text" name="s_status" id="statusField">
        <input type="text" name="file_type" id="fileType">
        <input type="text" name="event_id" id="inputField">
    </form>

    {{-- Content --}}
    <div class="bg-white p-3 rounded-md">
        <div class="flex justify-between mb-3">
            <div class="w-full flex items-center gap-5">
                <div class="">
                    <select name="event_id" id="eventField">
                        <option value="">Select Event</option>
                        @foreach ($events as $event)
                            <option value="{{$event->id}}">{{$event->event_name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- SELECTION FORM --}}
                <div class="flex items-center py-3 ">
                    <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                        class="text-gray-100 bg-violet-800 hover:bg-violet-900 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-4 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        type="button">
                        Filter by category
                        <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden w-auto p-3 bg-white rounded-lg shadow dark:bg-gray-700 border-2">
                        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                            Category
                        </h6>
                        {{-- List for Program --}}
                        <div class="flex justify-between gap-3">
                            <form id="search_program" onchange="getCategory()" class="">
                                <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                    <label for="" class="font-semibold text-gray-100">Program</label>
                                    @foreach (['BSIT', 'BSIS'] as $program)
                                        <li class="flex items-center">
                                            <input value="{{ $program }}" type="checkbox" name="program"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                            <label for="{{ $program }}"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $program }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </form>
                            {{-- List for Year Levels --}}
                            <form id="search_lvl" onchange="getCategory()" class="">
                                <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                    <label for="" class="font-semibold text-gray-100">Year Level</label>
                                    {{-- Key-value pair for this list, key is for the database field, value is the placeholder --}}
                                    @foreach (['1' => 'First Year', '2' => 'Second Year', '3' => 'Third Year', '4' => 'Fourth Year'] as $key => $value)
                                        <li class="flex items-center">
                                            <input  type="checkbox" value="{{$key}}" name="lvl"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                            <label for="{{ $key }}"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $value }}
                                            </label>
                                        </li>
                                    @endforeach

                                </ul>
                            </form>
                            {{-- List for Sets --}}
                            <form id="search_set" onchange="getCategory()" class="">
                                <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                    <label for="" class="font-semibold text-gray-100">Set</label>
                                    @foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $set)
                                        <li class="flex items-center">
                                            <input value="{{ $set }}" type="checkbox" name="set"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                            <label for="{{ $set }}"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $set }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </form>
                            {{-- List for Status if Enrolled, Dropped, or Graduated --}}
                            <form id="search_status" onchange="getCategory()" class="">
                                <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                    <label for="" class="font-semibold text-gray-100">Status</label>
                                    @foreach (['ENROLLED', 'DROPPED', 'GRADUATED'] as $status)
                                        <li class="flex items-center">
                                            <input value="{{ $status }}" type="checkbox" name="status"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                            <label for="{{ $status }}"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $status }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="w-full">
                {{-- Search Form --}}
                <div class="flex items-center justify-end py-2 w-full">
                    <form class="max-w-md w-full">
                        <label for="default-search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-2 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <div class="flex items-center">
                                <input type="search" id="default-search"
                                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Student name, Student ID, ..." required />

                                {{-- NOTE: Remove button if Live Search is implemented --}}
                                <button type="submit"
                                    class="inline-flex items-center py-2 px-3 ms-2 text-sm font-semibold text-gray-950 bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ==================================================== --}}
        {{-- Badge Display for Selected Filters
            - This section dynamically displays badges based on the selected filter options.
            - The backend should return an array of selected filters (e.g., ['BSIT', 'First Year', 'Set A'])
            which will be looped through to generate these badges dynamically.
            - Each badge should contain:
            - The name of the selected filter category.
            - A dismiss button to remove the filter (this should trigger a re-fetch of filtered data).
            - Ensure that these badges update in real-time when selections change.
        --}}
        <div class="flex justfiy-start">
            <span id="badge-dismiss-default"
                class="inline-flex items-center px-2 py-1 me-2 text-sm font-semibold text-gray-950 bg-yellow-500 rounded-xl">
                Sample Filter - Ex: BSIT
                <button type="button"
                    class="inline-flex items-center p-1 ms-2 text-sm text-blue-400 bg-transparent rounded-xs hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-300"
                    data-dismiss-target="#badge-dismiss-default" aria-label="Remove">
                    <svg class="w-2 h-2 text-gray-950" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Remove badge</span>
                </button>
            </span>
        </div>
        {{-- ======================================================== --}}

        <div class="mt-4">
            <div class="flex justify-between">
            <h3 class="text-3xl text-violet-800 font-extrabold">
                Attendance Record
            </h3>
            <button id="fullscreenToggle" class="bg-violet-600 text-white px-4 py-2 rounded-md mb-2">
<svg height="15px" width="15px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 512 512"  xml:space="preserve">
<style type="text/css">
	.st0{fill:#ffffff;}
</style>
<g>
	<polygon class="st0" points="345.495,0 394.507,49.023 287.923,155.607 356.384,224.086 462.987,117.493 511.991,166.515 
		511.991,0 	"/>
	<polygon class="st0" points="155.615,287.914 49.022,394.507 0.009,345.494 0.009,512 166.515,512 117.493,462.978 
		224.087,356.375 	"/>
	<polygon class="st0" points="356.384,287.914 287.923,356.375 394.507,462.978 345.495,512 511.991,512 511.991,345.485 
		462.977,394.507 	"/>
	<polygon class="st0" points="166.505,0 0.009,0 0.009,166.506 49.022,117.493 155.615,224.086 224.087,155.607 117.501,49.023 	"/>
</g>
</svg>
    </button>
    </div>
    <div id="tableContainer" class="overflow-auto border border-gray-300 p-2">         
            <table class="min-w-full">
                <tr class="bg-violet-200 text-violet-900 py-2 text-lg font-semibold">
                    <td>No.</td>
                    <td>Name</td>
                    <td>Program</td>
                    <td>Set</td>
                    <td>Level</td>
                    <td>Time In</td>
                    <td>Time Out</td>
                    <td>Event</td>
                    <td>Date</td>
                </tr>
                <tbody id="student_table_body">
                    {{-- Removed Hard-coded data --- This is now ready for dynamic data --}}
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($logs as $log)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $log->s_fname . ' ' . $log->s_lname }} </td>
                            <td>{{ $log->s_program }}</td>
                            <td>{{ $log->s_set }}</td>
                            <td>{{ $log->s_lvl }}</td>
                            <td>{{ $log->attend_checkIn ? date('h:i A', strtotime($log->attend_checkIn)) : '-' }}</td>
                            <td>{{ $log->attend_checkOut ? date('h:i A', strtotime($log->attend_checkOut)) : '-' }}</td>
                            <td>{{ $log->event_name }}</td>
                            <td>{{ $log->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <span id="std_info_table"></span>
        </div>
        </div>

        {{-- Fines Table Section --}}
        <div class="mt-8">
            <h3 class="text-3xl text-violet-800 font-extrabold mb-4">
                Fines Record
            </h3>
            <table class="min-w-full">
                <tr class="bg-violet-200 text-violet-900 py-2 text-lg font-semibold">
                    <td>No.</td>
                    <td>Name</td>
                    <td>Program</td>
                    <td>Set</td>
                    <td>Level</td>
                    <td>Missed Actions</td>
                    <td>Fine Amount</td>
                    <td>Total Fines</td>
                    <td>Event</td>
                    <td>Date</td>
                </tr>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($fines as $fine)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $fine->student->s_fname . ' ' . $fine->student->s_lname }}</td>
                            <td>{{ $fine->student->s_program }}</td>
                            <td>{{ $fine->student->s_set }}</td>
                            <td>{{ $fine->student->s_lvl }}</td>
                            <td>
                                <ul class="list-disc list-inside">
                                    @if($fine->morning_checkIn_missed)
                                        <li>Morning Check-in</li>
                                    @endif
                                    @if($fine->morning_checkOut_missed)
                                        <li>Morning Check-out</li>
                                    @endif
                                    @if($fine->afternoon_checkIn_missed)
                                        <li>Afternoon Check-in</li>
                                    @endif
                                    @if($fine->afternoon_checkOut_missed)
                                        <li>Afternoon Check-out</li>
                                    @endif
                                </ul>
                            </td>
                            <td>₱{{ number_format($fine->fine_amount, 2) }}</td>
                            <td>₱{{ number_format($fine->total_fines, 2) }}</td>
                            <td>{{ $fine->event->event_name }}</td>
                            <td>{{ $fine->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
<script>
    document.getElementById("fullscreenToggle").addEventListener("click", function() {
        let tableContainer = document.getElementById("tableContainer");
        if (!document.fullscreenElement) {
            tableContainer.style.background = "#ffffff";
            tableContainer.requestFullscreen().catch(err => {
                
                console.error("Error attempting to enable full-screen mode:", err);
            });
        } else {
            document.exitFullscreen();
        }
    });
</script>