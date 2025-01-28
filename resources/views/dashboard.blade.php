<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-violet-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="flex justify-between items-center p-4 bg-gray-100 border-b">
            <h1 class="text-xl font-bold">Dashboard</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded-md">
                    Logout
                </button>
            </form>
        </div>
    </x-slot>

    <div class="flex gap-5 mb-4">
        <div class="bg-white basis-1/2 items-center">
            <p>
                Welcome {{ auth()->user()->admin_fname }}

            </p>

            <br>
            <p>
                {{ auth()->user()->admin_type }}
            </p>
            <br>

        </div>
        <div class="bg-white basis-1/2 flex items-center">
            <div class="basis-3/4">
                <p>12345</p><br>

                <p>Students</p>
            </div>
            <div class="basis-1/4">
                Jan <br>
                25
            </div>
        </div>
    </div>


    <div class="bg-white p-3">
        <div class="flex justify-between">
            <div>
                <button onclick="uploadImage()" class="bg-violet-600 text-white rounded-xl px-5 text-2xl">
                    Start Attendance
                </button>

            </div>
            <div class="flex gap-3">
                <x-new-modal>
                    <x-slot name="button">
                        Create New Event
                    </x-slot>

                    <x-slot name="heading">
                        Create Event
                    </x-slot>
                    <x-slot name="content">
                        <form action="" method="POST" class="min-w-[500px]">

                            <div class="flex flex-col mb-3">
                                <label for="">Day or Event:</label>
                                <input type="text" placeholder="Enter Event Name" name="s_fname">
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
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="time" id="start-time"
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
                                        <input type="time" id="end-time"
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
                                        <input type="time" id="start-time"
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
                                        <input type="time" id="end-time"
                                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            min="09:00" max="18:00" value="00:00" required />
                                    </div>
                                </div>
                            </div>
                        </form>

                    </x-slot>
                    <x-slot name="footer">
                        <button type="submit" class="bg-green-400 text-white px-3 py-2 rounded-md mx-4">
                            Save </button>
                    </x-slot>
                </x-new-modal>

                <x-new-modal>
                    <x-slot name="button">
                        Add New Student
                    </x-slot>

                    <x-slot name="heading">
                        Add Student Information
                    </x-slot>
                    <x-slot name="content">
                        <form method="POST" action="{{ route('addStudent') }}" class="flex items-center">
                            @csrf
                            <div class="basis-3/4 justify-start">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">

                                    <div class="grid grid-cols-1">
                                        <label for="">
                                            RFID
                                        </label>
                                        <input type="text" placeholder="Scan RFID" name="s_rfid">
                                    </div>
                                    <div class="grid grid-cols-1">
                                        <label for="">Student ID:</label>
                                        <input type="text" placeholder="Enter Student ID (Ex. 2023-00069)"
                                            name="s_studentID">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 mt-5 mx-7">
                                    <label for="">First Name:</label>
                                    <input type="text" placeholder="Enter Firstname" name="s_fname">
                                </div>
                                <div class="grid grid-cols-1 mt-5 mx-7">
                                    <label for="">Last Name:</label>
                                    <input type="text" placeholder="Enter Lastname" name="s_lname">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">

                                    <div class="grid grid-cols-1">
                                        <label for="">Middle Name</label>
                                        <input type="text" placeholder="Enter Middlename" name="s_mname">
                                    </div>
                                    <div class="grid grid-cols-1">
                                        <label for="">Suffix</label>
                                        <input type="text" placeholder="Enter Suffix" name="s_suffix">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 mt-5 mx-7">

                                    <div class="grid grid-cols-1">
                                        <label for="">Program</label>
                                        <select name="s_program" id="">
                                            <option selected>Select Program</option>
                                            <option value="BSIT">BSIT</option>
                                            <option value="BSIS">BSIS</option>
                                        </select>
                                    </div>
                                    <div class="grid grid-cols-1">
                                        <label for="">Year Level</label>
                                        <select name="s_lvl" id="">
                                            <option selected>Select Year Level</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                    <div class="grid grid-cols-1">
                                        <label for="">Set</label>
                                        <select name="s_set" id="">
                                            <option selected>Select Set</option>
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
                        <button type="submit" class="bg-green-400 text-white px-3 py-2 rounded-md mx-4">
                            Save </button>
                    </x-slot>
                </x-new-modal>

            </div>
        </div>
        <div class="mt-4">
            <h3 class="text-3xl text-violet-800 font-extrabold">
                Attendance Record
            </h3>
            <table class="min-w-full">
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

                </tbody>
            </table>
        </div>

    </div>
    {{-- MODAL --}}

    <div id="eventModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <div class="border-b-2 border-gray-300">
                <h1 class="text-2xl font-bold">Add Student Information</h1>
            </div>
            <div>
                Test
            </div>

            <div class="flex justify-end">
                <button onclick="closeModal('eventModal')"
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Close</button>
            </div>
        </div>
    </div>


</x-app-layout>

<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.add('hidden');
    }

    function uploadImage() {
        console.log("Working");

        // const file = document.getElementById('uploadFile');
        // const image = document.getElementById('uploadImage')
        // image.src = file.files[0]
    }
</script>
