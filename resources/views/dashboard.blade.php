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
            <div><button class="bg-violet-600 text-white rounded-xl px-5 text-2xl">
                    Start Attendance
                </button>

            </div>
            <div>
                <button class="bg-violet-600 text-white rounded-xl px-5 text-2xl">
                    Create Event
                </button>
                <button class="bg-violet-600 text-white rounded-xl px-5 text-2xl">
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
</x-app-layout>
