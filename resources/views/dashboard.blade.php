<x-app-layout>
    {{-- @vite(['resources/js/dashboard.js', 'resources/js/app.js']) --}}

    {{-- Add these styles at the top of the file --}}
    <style>
        .modal-backdrop {
            z-index: 60;
        }
        .modal-content {
            z-index: 61;
        }
        #tableContainer {
            z-index: 10;
            position: relative;
        }
        [x-cloak] {
            display: none !important;
        }
        .fixed {
            z-index: 50;
        }
    </style>

    {{-- Implemented Sweet Alert Pop Ups on Conditionals --}}
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

    <div class="flex justify-between w-full">
      <div class="w-full relative">
    <x-slot name="header">
        <div class="">
            <h2 class="font-semibold text-3xl text-violet-800 leading-tight">
                Welcome, {{ ucwords(auth()->user()->admin_uname) }}
            </h2>
           
    </x-slot>

    <div class="flex gap-5 mb-4">
        <div class="bg-white basis-1/2 flex gap-20 p-3 items-start rounded-md">
            <div class="">
                <p class="text-base font-bold">First Name: <span
                        class="text-slate-500 font-medium">{{ ucfirst(auth()->user()->admin_fname) }}</span></p>
                <p class="text-base font-bold">Last Name: <span
                        class="text-slate-500 font-medium">{{ ucfirst(auth()->user()->admin_lname) }}</span></p>
                <p class="text-base font-bold">Role: <span
                        class="text-slate-500 font-medium">{{ ucfirst(auth()->user()->admin_type) }}</span></p>
                <p class="text-base font-bold">Username: <span
                        class="text-slate-500 font-medium">{{ ucfirst(auth()->user()->admin_uname) }}</span></p>
            </div>
            {{-- <div class="">
                <p class="text-base font-bold">Account Created: <span
                        class="text-slate-500 font-medium">{{ auth()->user()->created_at }}</span></p>
                <p class="text-base font-bold">Account Updated: <span
                        class="text-slate-500 font-medium">{{ auth()->user()->updated_at }}</span></p>
                <p class="text-base font-bold">Email Address: <span
                        class="text-slate-500 font-medium">{{ auth()->user()->admin_email }}</span></p>
            </div> --}}

        </div>
        <div class="bg-white basis-1/2 flex items-center justify-evenly rounded-md">
            <div onclick="window.location.href = '{{ route('students') }}'"
                class="flex items-center gap-1 bg-yellow-500 rounded-md p-2 hover:scale-105 hover:text-gray-900 ease-linear transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-20">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>

                <h1 class="font-semibold text-2xl">
                    <span>{{ $studentCount }}</span>
                    Students
                </h1>
            </div>
            <div onclick="window.location.href = '{{ route('students') }}'"
                class="flex items-center gap-1 bg-yellow-500 rounded-lg p-2 hover:scale-105 hover:text-gray-900 ease-linear transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-20">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>


                <h1 class="font-semibold text-2xl">
                    <span>{{ $graduateCount }}</span>
                    Graduates
                </h1>
            </div>
        </div>
    </div>


    <div class="flex items-center justify-between bg-white p-3 rounded">
        <div class="flex gap-5">
            <button onclick="location.href = '{{ route('attendance') }}'"
                class="bg-violet-800 hover:bg-violet-950 ease-linear transition-all text-white rounded-xl px-3 text-[20px] flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z" />
                </svg>
                Attendance

            </button>
            <div id="clockdate">
                <div class="clockdate-wrapper bg-gray-800 p-2 max-w-xs w-full text-center rounded-xl mx-auto shadow-lg">
                    <div id="clock" class="bg-gray-800 text-yellow-400 text-2xl font-sans shadow-sm"></div>
                    <div id="date" class="tracking-widest text-sm font-sans text-white"></div>
                </div>
            </div>
        </div>

        {{-- Update the modals wrapper to include higher z-index --}}
        <div class="flex gap-3 relative z-50">
            {{-- MODALS --}}
            <x-new-modal>
                <x-slot name="button"
                    class="bg-violet-600 hover:bg-violet-950 ease-linear transition-all text-white rounded-xl px-5 text-2xl
                    flex items-center p-4 gap-1">
                    <div class="flex px-3 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-7 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                        Event
                    </div>
                </x-slot>

                <x-slot name="heading">
                    Create Event
                </x-slot>
                <x-slot name="content">
                    <form x-ref="eventForm" action="{{ route('addEvent') }}" method="POST" class="min-w-[500px]">
                        @csrf

                        <div class="flex flex-col mb-3">
                            <label for="">Day or Event:</label>
                            <input type="text" placeholder="Enter Event Name" name="event_name">
                        </div>

                        <div class="flex flex-col mb-3">
                            <label for="">Event Date:</label>
                            <input type="date" name="date" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>

                        <p>Check In:</p>
                        <div class="flex gap-5 mb-3">
                            <div class="w-full">
                                <label for="start-time"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                                    time:</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="time" id="start-time" name="checkIn_start"
                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        min="09:00" max="18:00" value="00:00" required />
                                </div>
                            </div>
                            <div class="w-full">
                                <label for="end-time"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End
                                    time:</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="time" id="checkIn_end" name="checkIn_end"
                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        min="09:00" max="18:00" value="00:00" required />
                                </div>
                            </div>
                        </div>
                        <p>Check Out:</p>
                        <div class="flex gap-5 mb-3">
                            <div class="w-full">
                                <label for="start-time"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                                    time:</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="time" id="start-time" name="checkOut_start"
                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        min="09:00" max="18:00" value="00:00" required />
                                </div>
                            </div>
                            <div class="w-full">
                                <label for="end-time"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End
                                    time:</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="time" id="end-time" name="checkOut_end"
                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        min="09:00" max="18:00" value="00:00" required />
                                </div>
                            </div>
                        </div>
                    </form>

                </x-slot>
                <x-slot name="footer">
                    <button x-on:click="$refs.eventForm.submit()" type="submit"
                        class="bg-green-400 text-white px-3 py-2 rounded-md mx-4">
                        Save </button>
                </x-slot>
            </x-new-modal>
            {{-- MODALS --}}
            <x-new-modal>
                <x-slot name="button">
                    <div class="flex px-3 py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-7 mr-1">
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
                                    <input type="text" placeholder="Scan RFID" name="s_rfid" id="s_rfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div class="grid grid-cols-1">
                                    <label for="">Student ID:</label>
                                    <input type="text" placeholder="Enter Student ID (Ex. 2023-00069)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        name="s_studentID" id="s_studentID">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 mt-5 mx-7">
                                <label for="">First Name:</label>
                                <input type="text" placeholder="Enter Firstname" name="s_fname" id="s_fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="grid grid-cols-1 mt-5 mx-7">
                                <label for="">Last Name:</label>
                                <input type="text" placeholder="Enter Lastname" name="s_lname" id="s_lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">

                                <div class="grid grid-cols-1">
                                    <label for="">Middle Name</label>
                                    <input type="text" placeholder="Enter Middlename" name="s_mname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        id="s_mname">
                                </div>
                                <div class="grid grid-cols-1">
                                    <label for="">Suffix</label>
                                    <input type="text" placeholder="Enter Suffix" name="s_suffix" id="s_suffix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 mt-5 mx-7">

                                <div class="grid grid-cols-1">
                                    <label for="">Program</label>
                                    <select name="s_program" id="s_program" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option selected value="">Select Program</option>
                                        <option value="BSIT">BSIT</option>
                                        <option value="BSIS">BSIS</option>
                                    </select>
                                </div>
                                <div class="grid grid-cols-1">
                                    <label for="">Year Level</label>
                                    <select name="s_lvl" id="s_lvl" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option selected value="">Select Year Level</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="grid grid-cols-1">
                                    <label for="">Set</label>
                                    <select name="s_set" id="s_set" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                        <div x-data="{ image: '{{ asset('images/icons/default-image.svg') }}' }" class="basis-1/4 flex flex-col mt-5 items-center gap-5">
                            <img id="uploadImage" class="max-w-1/2 w-100" :src="image" alt="">
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

        </div>

    

    <div class="flex items-center justify-between bg-white p-3 rounded mt-2 w-full">
        <div class="flex gap-5 mb-4">
        <div class="basis-1/2 flex items-center justify-evenly rounded-md gap-3">
            <div onclick="window.location.href = '{{ route('students') }}'"
                class="flex items-center gap-1 bg-yellow-500 rounded-md p-2 hover:scale-105 hover:text-gray-900 ease-linear transition-all cursor-pointer min-h-[100px]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-[40px]">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>



                <h1 class="font-semibold text-2xl">
                    <span>{{ $studentCount }}</span>
                    Students
                </h1>
            </div>
            <div onclick="window.location.href = '{{ route('students') }}'"
                class="flex items-center gap-1 bg-yellow-500 rounded-lg p-2 hover:scale-105 hover:text-gray-900 ease-linear transition-all cursor-pointer min-h-[100px]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-[40px]">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>


                <h1 class="font-semibold text-2xl">
                    <span></span>
                    Graduates
                </h1>
            </div>
        </div>
        </div>

        <div class="flex gap-5">
            <button onclick="location.href = '{{ route('attendance') }}'"
                class="bg-violet-800 hover:bg-violet-950 ease-linear transition-all text-white rounded-xl px-3 text-[15px] flex items-center gap-1 py-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />   
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z" />
                </svg>
                Attendance

            </button>
            <div id="clockdate">
                <div class="clockdate-wrapper bg-gray-800 p-2 max-w-xs w-full text-center rounded-xl mx-auto shadow-lg">
                    <div id="clock" class="bg-gray-800 text-yellow-400 text-2xl font-sans shadow-sm"></div>
                    <div id="date" class="tracking-widest text-sm font-sans text-white"></div>
                </div>
            </div>
        </div>

        
    </div>


    <div class="mt-4">
        <div class="flex justify-between">
    <h3 class="text-3xl text-violet-800 font-extrabold">
        Attendance Record
    </h3>
    
    {{-- full-screen-btn --}}
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
        <table class="min-w-full bg-white " style="background:#ffffff">
            <tr class="bg-violet-200 text-violet-900 py-2 text-lg font-semibold">
                <td>No.</td>
                <td>Name</td>
                <td>Program</td>
                <td>Set</td>
                <td>Year Level</td>
                <td>Time In</td>
                <td>Time Out</td>
                <td>Event</td>
                <td>Date</td>
            </tr>
            <tbody>
                @php
                    $index = 1;
                @endphp
                @foreach ($attendances as $attendance)
                    <tr class="scroll">
                        <td>{{ $index++ }}</td>
                        <td>{{ $attendance->s_fname . ' ' . $attendance->s_lname }}</td>
                        <td>{{ $attendance->s_program }}</td>
                        <td>{{ $attendance->s_set }}</td>
                        <td>{{ $attendance->s_lvl }}</td>
                        <td>{{ $attendance->attend_checkIn }}</td>
                        <td>{{ $attendance->attend_checkOut }}</td>
                        <td>{{ $attendance->event_name }}</td>
                        <td>{{ $attendance->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

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
            <h3 class="text-3xl text-violet-800 font-extrabold">
                Attendance Record
            </h3>
            
            {{-- full-screen-btn --}}
            <button id="fullscreenToggle" class="bg-violet-600 text-white px-4 py-2 rounded-md mb-2">
                <svg height="15px" width="15px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                    viewBox="0 0 512 512"  xml:space="preserve">
                <style type="text/css">
                    .st0{fill:#000000;}
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
        <div id="tableContainer" class="relative overflow-auto border border-gray-300 p-2" >
            <table class="min-w-full" >
                <tr class="bg-violet-200 text-violet-900 py-2 text-lg font-semibold">
                    <td>No.</td>
                    <td>Name</td>
                    <td>Program</td>
                    <td>Set</td>
                    <td>Year Level</td>
                    <td>Time In</td>
                    <td>Time Out</td>
                    <td>Event</td>
                    <td>Date</td>
                </tr>
                <tbody>
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($attendances as $attendance)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $attendance->s_fname . ' ' . $attendance->s_lname }}</td>
                            <td>{{ $attendance->s_program }}</td>
                            <td>{{ $attendance->s_set }}</td>
                            <td>{{ $attendance->s_lvl }}</td>
                            <td>{{ $attendance->attend_checkIn ? date('h:i A', strtotime($attendance->attend_checkIn)) : '-' }}</td>
                            <td>{{ $attendance->attend_checkOut ? date('h:i A', strtotime($attendance->attend_checkOut)) : '-' }}</td>
                            <td>{{ $attendance->event_name }}</td>
                            <td>{{ $attendance->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <script>
        document.getElementById("fullscreenToggle").addEventListener("click", function() {
            let tableContainer = document.getElementById("tableContainer");
            if (!document.fullscreenElement) {
                tableContainer.requestFullscreen().catch(err => {
                    style.backgroundColor = 'white'
                    console.error("Error attempting to enable full-screen mode:", err);
                });
            } else {
                document.exitFullscreen();
            }
        });
    </script>

</x-app-layout>

{{-- Removed the script file, transferred them into dashboard.js --}}
