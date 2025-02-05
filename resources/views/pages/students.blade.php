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

    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-3xl text-violet-800 leading-tight">
            Students Masterlist
        </h2>
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
                                <input type="text" placeholder="Enter Student ID (Ex. 2023-00069)" name="s_studentID"
                                    id="s_studentID">
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
                                    <input type="text" placeholder="Scan RFID" name="s_rfid" id="s_RFID">
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

        <table class="min-w-full">
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
            <tbody>
                @isset($students)
                    @foreach ($students as $student)
                        {{-- Added tr elements for rows to fix UI --}}
                        <tr>
                            <td>{{ $student->s_studentID }}</td>
                            <td>{{ $student->s_fname }}</td>
                            <td>{{ $student->s_lname }}</td>
                            <td>{{ $student->s_mname }}</td>
                            <td>{{ $student->s_suffix }}</td>

                            <td>{{ $student->s_lvl }}</td>
                            <td>{{ $student->s_set }}</td>
                            <td>{{ $student->s_program }}</td>
                            <td>{{ $student->s_status }}</td>
                            <td class="flex gap-3">
                                <button x-on:click="open = true"
                                    onclick="updateStudent({{ $student }})">Edit</button>
                                <button onclick="deleteStudent({{ $student }})">Delete</button>

                            </td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
    </div>

    <form action="{{ route('deleteStudent') }}" id="deleteStudent" method="POST" hidden>
        @csrf
        @method('DELETE')
        <input type="text" name="id" id="s_id" hidden>
    </form>
</x-app-layout>
