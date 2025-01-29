<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-violet-800 leading-tight">
            {{ __('Report Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white mb-4 py-4 px-2">
        <button class="bg-violet-600 text-white rounded-xl px-5 text-2xl">
            Generate Report
        </button>
        <button class="bg-violet-600 text-white rounded-xl px-5 text-2xl">
            Clear Attendance Logs
        </button>
    </div>

    <div class="bg-white p-3">
        <div class="flex justify-between mb-3">
            <div>
                <form action="">
                    <select name="" id="">
                        <option value="">
                            TEST
                        </option>
                    </select>
                </form>
            </div>
            <div>
                <form action="" class="flex items-center gap-2">
                    <button>Search</button>
                    <input type="text" class="bg-transparent rounded-2 focus:outline-0 py-1 px-1">

                </form>
            </div>
        </div>
        <div class="flex justfiy-start">
            <div class=" text-white flex items-center text-lg

                ">
                <button
                    class="
                    px-2 rounded-l-xl
                    hover:bg-violet-400 transition-colors duration-200 border-r-2 pr-2 bg-violet-600 ">
                    X
                </button>


                <span class="bg-violet-600 px-3
                    rounded-r-xl
                    ">
                    1st Year

                </span>
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
