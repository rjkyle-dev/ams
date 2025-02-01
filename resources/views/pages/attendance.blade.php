<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/axios.js'])

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
    <script>
        function myFunction() {
            console.log('hoo')
            document.getElementById("inputField").focus();
        }
    </script>
    <div class="mt-4">
        <div class="flex justify-between">

            <h3 class="text-3xl text-violet-800 font-extrabold">
                Attendance Record
            </h3>
            <x-new-modal>
                <x-slot name="button">
                    Start Attendance
                </x-slot>
                <x-slot name="heading">
                    Start Attendance
                </x-slot>
                <x-slot name="content">
                    <form action="" class="flex flex-col mb-3 min-w-[300px]" method = "POST">

                        <label for="">Enter RFID / Student ID:</label>
                        <input id = "inputField" type = "text" name = "s_rfid" onload="console.log('Hello World')"
                            onfocus = "console.log('hi')" placeholder="Enter RFID or Student ID"
                            onchange = "console.log('Hello World')">
                    </form>
                </x-slot>
            </x-new-modal>
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
