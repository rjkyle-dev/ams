<x-app-layout>
    @vite(['resources/js/students.js'])
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "Oops!...",
                    html: `
                    <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside text-left">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                    showConfirmButton: true,
                });
            });
        </script>
    @endif

    {{-- Session Error Handling from Import Controller --}}
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500,
                });
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif

    <div class="flex justify-between items-center">
        <div class="flex flex-col items-start">
            <h2 class="font-semibold text-3xl text-violet-800 leading-tight my-3">
                Students Masterlist
            </h2>
            <form action="{{ route('importStudent') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center">
                    <label for="file"
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        Choose Excel File
                    </label>
                    <input type="file" name="file" id="file" class="hidden" onchange="selectFile(event)">
                    {{-- Choose Excel file and import it --}}
                    <button id="import-btn"
                        class="hidden focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                        Import Data
                    </button>
                </div>
                <div class="preview mb-4 mt-2 p-1 border border-gray-300 rounded-lg bg-gray-100 shadow-md">
                    <p id="preview-name" class="text-gray-700 text-base font-semibold italic text-center">
                        No file currently selected
                    </p>
                </div>
            </form>
        </div>

        <div class="flex flex-col">

            <x-new-modal>
                <x-slot name="button">
                    <div class="flex px-3 py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-9">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                        Student
                </x-slot>


                <x-slot name="heading">
                    Add Student Information
                </x-slot>
                <x-slot name="content">
                    <form id="studentForm"action="{{ route('addStudent') }}" x-ref ="studentForm" method="POST"
                        enctype="multipart/form-data" class="flex items-center">
                        @csrf
                        <div class="basis-3/4 justify-start">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">

                                <div class="grid grid-cols-1">
                                    <label for="">
                                        RFID
                                    </label>
                                    <input type="text" placeholder="Scan RFID" name="s_rfid" id="s_rfid">
                                </div>
                                <div class="grid grid-cols-1">
                                    <label for="">Student ID:</label>
                                    <input type="text" placeholder="Enter Student ID (Ex. 2023-00069)"
                                        name="s_studentID" id="s_studentID">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 mt-5 mx-7">
                                <label for="">First Name:</label>
                                <input type="text" placeholder="Enter Firstname" name="s_fname" id="s_fname">
                            </div>
                            <div class="grid grid-cols-1 mt-5 mx-7">
                                <label for="">Last Name:</label>
                                <input type="text" placeholder="Enter Lastname" name="s_lname" id="s_lname">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">

                                <div class="grid grid-cols-1">
                                    <label for="">Middle Name</label>
                                    <input type="text" placeholder="Enter Middlename" name="s_mname" id="s_mname">
                                </div>
                                <div class="grid grid-cols-1">
                                    <label for="">Suffix</label>
                                    <input type="text" placeholder="Enter Suffix" name="s_suffix" id="s_suffix">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 mt-5 mx-7">

                                <div class="grid grid-cols-1">
                                    <label for="">Program</label>
                                    <select name="s_program" id="s_program">
                                        <option selected value="">Select Program</option>
                                        <option value="BSIT">BSIT</option>
                                        <option value="BSIS">BSIS</option>
                                    </select>
                                </div>
                                <div class="grid grid-cols-1">
                                    <label for="">Year Level</label>
                                    <select name="s_lvl" id="s_lvl">
                                        <option selected value="">Select Year Level</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="grid grid-cols-1">
                                    <label for="">Set</label>
                                    <select name="s_set" id="s_set">
                                        <option selected value="">Select Set</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                        <option value="H">H</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ image: '{{ asset('images/icons/profile.svg') }}' }" class="basis-1/4 flex flex-col mt-5 items-center gap-5">
                            <img id="uploadImage" class="max-w-1/2" :src="image" alt="">
                            <input id="uploadFile" type="file" name="s_image" x-ref="imageFile"
                                x-on:change="image = URL.createObjectURL($refs.imageFile.files[0])" hidden>
                            <button x-on:click="$refs.imageFile.click()" type="button"
                                class="bg-green-400 text-white px-3 py-2 text-xl">
                                Upload Image
                            </button>
                        </div>
                    </form>
                </x-slot>
                <x-slot name="footer">
                    <button onclick="testStudentForm()" class="bg-green-400 text-white px-3 py-2 rounded-md mx-4">
                        Test Form </button>
                    <button x-on:click="$refs.studentForm.submit()"
                        class="bg-green-400 text-white px-3 py-2 rounded-md mx-4">
                        Save </button>
                </x-slot>
            </x-new-modal>

            {{-- SEARCH FORM --}}

            <div class="flex justify-around gap-5 items-center">
                {{-- SEARCH FORM --}}
                <div class="search">
                    {{-- Search Form --}}
                    <div class="flex items-center justify-end py-3 w-full">
                        <form class="max-w-md w-full" id="searchForm" method="GET">
                            <input type="hidden" id="search_uri" value="{{ route('fetchStudent') }}" hidden>
                            <label for="default-search"
                                class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                            <div class="">
                                <div class="flex items-center">

                                    <div
                                        class="flex items-center bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                        <svg class="w-4 h-4 text-gray-500 mx-3" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                        <input type="search" id="default-search"
                                            class="outline-none w-full p-4 ps-2 text-sm text-gray-900 border-none  bg-gray-50 "
                                            placeholder="Student name, Student ID, ..." />

                                    </div>

                                    {{-- NOTE: Remove button if Live Search is implemented --}}
                                    <button type="submit"
                                        class="inline-flex items-center py-4 px-3 ms-2 text-sm font-semibold text-gray-950 bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                        <svg class="w-4 h-4 me-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- SELECTION FORM --}}
                <div class="flex items-center py-3">
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
                    <div id="dropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                            Category
                        </h6>
                        <div class="flex justify-between gap-3">
                            {{-- List for Program --}}
                            <form id="search_program" class="" onchange="getCategory()">
                                <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                    <label for="" class="font-semibold dark:text-gray-100">Program</label>
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
                            <form id="search_lvl" onchange="getCategory()">
                                <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                    <label for="" class="font-semibold dark:text-gray-100">Year Level</label>
                                    {{-- Key-value pair for this list, key is for the database field, value is the placeholder --}}
                                    @foreach (['1' => 'First Year', '2' => 'Second Year', '3' => 'Third Year', '4' => 'Fourth Year'] as $key => $value)
                                        <li class="flex items-center">
                                            <input value="{{ $key }}" type="checkbox" name="lvl"
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
                            <form id="search_set" onchange="getCategory()">
                                <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                    <label for="" class="font-semibold dark:text-gray-100">Set</label>
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
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div x-data="{ open: false }"="mt-4">
        <div x-show.important="open" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div x-on:click.outside="open = false" class="max-w-[1000px] bg-white p-6 rounded-lg shadow-lg">
                <div class="border-b-2 border-gray-300 mb-5">
                    <h1 class="text-2xl font-bold">
                        Edit Student Information
                    </h1>
                </div>
                <div class="mb-5">
                    <form id="updateForm" action="{{ route('updateStudent') }}" x-ref ="updateForm" method="POST"
                        enctype="multipart/form-data" class="flex items-center">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="id" id="s_ID" hidden>
                        <div class="basis-3/4 justify-start">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">

                                <div class="grid grid-cols-1">
                                    <label for="">
                                        RFID
                                    </label>
                                    <input type="text" placeholder="Scan RFID" name="s_rfid" id="s_RFID"
                                        value="">
                                </div>
                                <div class="grid grid-cols-1">
                                    <label for="">Student ID:</label>
                                    <input type="text" placeholder="Enter Student ID (Ex. 2023-00069)"
                                        name="s_studentID" id="s_STUDENTID">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 mt-5 mx-7">
                                <label for="">First Name:</label>
                                <input type="text" placeholder="Enter Firstname" name="s_fname" id="s_FNAME">
                            </div>
                            <div class="grid grid-cols-1 mt-5 mx-7">
                                <label for="">Last Name:</label>
                                <input type="text" placeholder="Enter Lastname" name="s_lname" id="s_LNAME">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">

                                <div class="grid grid-cols-1">
                                    <label for="">Middle Name</label>
                                    <input type="text" placeholder="Enter Middlename" name="s_mname"
                                        id="s_MNAME">
                                </div>
                                <div class="grid grid-cols-1">
                                    <label for="">Suffix</label>
                                    <input type="text" placeholder="Enter Suffix" name="s_suffix" id="s_SUFFIX">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 mt-5 mx-7">

                                <div class="grid grid-cols-1">
                                    <label for="">Program</label>
                                    <select name="s_program" id="s_PROGRAM">
                                        <option selected value="">Select Program</option>
                                        <option value="BSIT">BSIT</option>
                                        <option value="BSIS">BSIS</option>
                                    </select>
                                </div>
                                <div class="grid grid-cols-1">
                                    <label for="">Year Level</label>
                                    <select name="s_lvl" id="s_LVL">
                                        <option selected value="">Select Year Level</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="grid grid-cols-1">
                                    <label for="">Set</label>
                                    <select name="s_set" id="s_SET">
                                        <option selected value="">Select Set</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                        <option value="H">H</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="basis-1/4  mt-5 items-center gap-5">
                            <div x-data="{ image: '{{ asset('images/icons/profile.svg') }}' }" class="flex flex-col items-center gap-5">
                                <img id="uploadImage" class="max-w-1/2" :src="image" alt="">
                                <input id="uploadFile" type="file" name="s_image" x-ref="imageFile"
                                    x-on:change="image = URL.createObjectURL($refs.imageFile.files[0])" hidden>
                                <button x-on:click="$refs.imageFile.click()" type="button"
                                    class="bg-green-400 text-white px-3 py-2 text-xl">
                                    Upload Image
                                </button>
                            </div>
                            <div>
                                <span>
                                    Change Student Status
                                </span>
                                <select name="s_status" id="s_STATUS">
                                    <option value="ENROLLED">ENROLLED</option>
                                    <option value="DROPPED">DROPPED</option>
                                    <option value="GRADUATED">GRADUATED</option>
                                </select>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="flex justify-end">
                    <button x-on:click="$refs.updateForm.submit()"
                        class="bg-green-400 text-white px-3 py-2 rounded-md mx-4">
                        Save </button>
                    <button x-on:click="open = false"
                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Close</button>
                </div>
            </div>
        </div>


        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <div class="shadow-lg rounded-md border border-gray-400 my-2 p-2">
                Action Bar
                <button id="selectAllBtn" onclick="selectAll()" class="p-1 bg-blue-400 rounded-md">
                    Select All
                </button>
                <button onclick="editSelectedRows()" class="p-1 rounded-md bg-blue-400">
                    Edit
                </button>
                <button onclick="deleteSelectedRows()" class="bg-red-400 p-1 rounded-md">
                    Delete
                </button>
            </div>
            <table class="min-w-full w-full text-sm text-center rtl:text-right text-gray-900 font-semibold">
                <thead class="text-base text-gray-700 uppercase bg-gray-50">
                    <tr class="bg-violet-200 text-violet-900 py-2 text-lg font-semibold">
                        <td>No.</td>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Middle Name</td>
                        <td>Suffix</td>
                        <td>Year Level</td>

                        <td>Set</td>
                        <td>Program</td>

                        <td>Status</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody id="student_table_body">
                    @isset($students)
                        @foreach ($students as $student)
                            {{-- Added tr elements for rows to fix UI --}}
                            <tr class="table_row" id="{{ $student->id }}">
                                <td>{{ $student->s_studentID }}</td>
                                <td>{{ $student->s_fname }}</td>
                                <td>{{ $student->s_lname }}</td>
                                <td>{{ $student->s_mname }}</td>
                                <td>{{ $student->s_suffix }}</td>
                                <td>{{ $student->s_lvl }}</td>
                                <td>{{ $student->s_set }}</td>
                                <td>{{ $student->s_program }}</td>
                                <td>{{ $student->s_status }}</td>
                                <td class="flex gap-3 py-3">
                                    <x-edit-button x-on:click="open = true" onclick="updateStudent({{ $student }})">
                                        {{-- Edit Button --}}
                                    </x-edit-button>
                                    <x-delete-button onclick="deleteStudent({{ $student }})">
                                        {{-- Delete button --}}
                                    </x-delete-button>

                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
            <span id="std_info_table">

            </span>
        </div>

    </div>

    <form action="{{ route('deleteStudent') }}" id="deleteStudent" method="POST" hidden>
        @csrf
        @method('DELETE')
        <input type="text" name="id" id="s_id" hidden>
    </form>

    {{-- MODALS FOR MULTIPLE EDIT AND DELETE --}}
    {{-- EDIT MODAL --}}
    <div id="multipleEditModal" class="d-none inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="max-w-[1000px] bg-white p-6 rounded-lg shadow-lg">
            <div class="border-b-2 border-gray-300 mb-5">
                <h1 class="text-2xl font-bold">
                    Edit Selected Students
                </h1>
            </div>
            <form

            class="mb-5" id="multiEditForm" action="{{route('multiStudentEdit')}}" method="POST">
                @csrf
                @method('PATCH')
                <input type="text" name="students" id="_selected_students_field" hidden>
                <div>
                    <label for="">Set:</label>
                    <select name="s_set" id="">
                        <option value="">Keep Current</option>
                        @foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $set)
                            <option value="{{ $set }}">{{ $set }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="">Status</label>
                    <select name="s_status" id="">
                        <option value="">Keep Current</option>
                        @foreach (['ENROLLED', 'GRADUATED', 'DROPPED', 'TO BE UPDATED'] as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">Program</label>
                    <select name="s_program" id="">
                        <option value="">Keep Current</option>
                        <option value="BSIT">BSIT</option>
                        <option value="BSIS">BSIS</option>
                    </select>
                </div>
                <div>
                    <label for="">Year Level</label>
                    <select name="s_lvl" id="">
                        <option value="">Keep Current</option>
                        @foreach (['1' => 'First Year', '2' => 'Second Year', '3' => 'Third Year', '4' => 'Fourth Year'] as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="flex justify-end">
                <button onclick="document.getElementById('multiEditForm').submit()"
                    class="px-4 py-2 mx-2 bg-green-600 text-white rounded-md hover:bg-green-800 transition-colors">
                    Apply Changes
                </button>
                <button onclick="closeEditModal()"
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Close</button>
            </div>
        </div>
    </div>

    <form id="_selected_delete_form" method="POST" action="{{route('multiStudentDelete')}}">
        @csrf
        @method('DELETE')
        <input type="text" name="students" id="_selected_students_delete" hidden>
    </form>

    <script>
        //FILE UPLOADED PREVIEW AND DISPLAYING OF IMPORT BUTTON
        function selectFile(event) {
            let preview = document.getElementById("preview-name");
            let importBtn = document.getElementById("import-btn");

            // Check if a file is selected
            if (event.target.files.length > 0) {
                const fileName = event.target.files[0].name; // Get file name
                preview.innerHTML = fileName; // Display file name
                importBtn.classList.remove('hidden'); //Show the import button
                console.log('File Upload: ' + fileName);
            }
        }
    </script>

</x-app-layout>
