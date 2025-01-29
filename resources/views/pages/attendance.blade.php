<x-app-layout>
    @vite(['resources/js/axios.js', 'resources/js/student_attendance.js'])

    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-violet-800 leading-tight">
            {{ __('Student Attendance') }}
        </h2>
        <div class="flex justify-between items-center p-4 bg-gray-100 border-b">
            <h1 class="text-xl font-bold">Dashboard</h1>
            <div class="flex">

            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded-md">
                    Logout
                </button>
            </form>


        </div>
    </x-slot>

    <div class="mt-4">
        <div class="flex justify-between">

            <h3 class="text-3xl text-violet-800 font-extrabold">
                Attendance Record
            </h3>

            <div x-data="{ play: false }" class="flex">

                <button x-show='play' x-on:click='play=false'
                    class="bg-red-500 px-3 py-2 mb-2 text-white transition-full max-w-xs text-center rounded-xl shadow-lg">
                    Stop Attendance
                </button>

                <button x-show='!play' x-on:click='play = true'
                    class="bg-orange-500 px-3 py-2 mb-2 hover:bg-orange-600 transition-full max-w-xs text-center rounded-xl text-white shadow-lg"
                    onclick="">
                    Start Attendance
                </button>

            </div>


        </div>

        <table class="min-w-full">
            <tr class="bg-violet-200 text-violet-900 py-2 text-lg font-semibold">
                <td>Name</td>
                <td>Program</td>
                <td>Set</td>
                <td>Year Level</td>
                <td>Time In</td>
                <td>Time Out</td>
                <td>Date</td>
            </tr>
            <tbody>

            </tbody>
        </table>
    </div>



</x-app-layout>
<script>
    function myFunction() {
        console.log('hoo')
        document.getElementById("inputField").focus();
    }
</script>
