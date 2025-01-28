<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-violet-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
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
                <button onclick="" class="bg-violet-600 text-white rounded-xl px-5 text-2xl">
                    Start Attendance
                </button>

            </div>
            <div>
                <button onclick="openModal('studentModal')" class="bg-violet-600 text-white rounded-xl px-5 text-2xl">
                    Create Event
                </button>
                <button onclick="openModal('eventModal')" class="bg-violet-600 text-white rounded-xl px-5 text-2xl">
                    Add Student
                </button>
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

    <div id="studentModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <div class="border-b-2 border-gray-300">
                <h1 class="text-2xl font-bold">Add Student Information</h1>
            </div>
            <div>
                Test
            </div>

            <div class="flex justify-end">
                <button onclick="closeModal('studentModal')"
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Close</button>
            </div>
        </div>
    </div>

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


    const modal = document.getElementsByClassName('modal');
    // Close modal when clicking outside the modal content
    window.addEventListener('click', (event) => {
        modal.forEach(element => {
            modal.classList.add('hidden');

        });

    });
</script>
