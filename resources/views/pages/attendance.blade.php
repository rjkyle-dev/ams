<x-app-layout>
    @vite(['resources/js/axios.js', 'resources/js/student_attendance.js'])

    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-violet-800 leading-tight">
            {{ __('Student Attendance') }}
        </h2>
        <div class="flex justify-between items-start p-4 bg-gray-100 border-b">
            <div>
                <h2 class="text-2xl font-bold text-violet-800">
                    Today's Event:

                    @if ($event)
                        <span class="text-green-500">
                            {{ $event->event_name }}
                        </span>
                    @else
                        <span class="text-red-600">
                            None
                        </span>
                    @endif

                </h2>
                @if ($event)
                    <h2 class="text-2xl font-bold text-violet-800">
                        Check In Start:
                        <span class="text-green-500">
                            {{ date_format(date_create($event->checkIn_start), 'h:i A') }}
                        </span>
                    </h2>
                    <h2 class="text-2xl font-bold text-violet-800">
                        Check In End:
                        <span class="text-green-500">
                            {{ date_format(date_create($event->checkIn_end), 'h:i A') }}
                        </span>
                    </h2>
                    <h2 class="text-2xl font-bold text-violet-800">
                        Check Out Start:
                        <span class="text-green-500">
                            {{ date_format(date_create($event->checkOut_start), 'h:i A') }}
                        </span>
                    </h2>
                    <h2 class="text-2xl font-bold text-violet-800">
                        Check Out Start:
                        <span class="text-green-500">
                            {{ date_format(date_create($event->checkOut_end), 'h:i A') }}
                        </span>
                    </h2>
                @endif

            </div>
            <div x-data="{ play: false }" class="flex gap-2">

                <button onclick="stopAttendance()" x-show='play' x-on:click='play=false'
                    class="bg-red-500 p-3 mb-2 text-white transition-full max-w-xs text-center rounded-md shadow-lg">
                    Stop Attendance
                </button>

                <button onclick="myFunction()" x-show='!play' x-on:click='play = true'
                    class="bg-orange-500 p-3 mb-2 hover:bg-orange-600 transition-full max-w-xs text-center rounded-md text-white shadow-lg"
                    onclick="">
                    Start Attendance
                </button>


                <form action="" method="POST">
                    <input type="text" name="s_rfid" id="inputField" placeholder="103xxxxxxxx"
                        class="bg-gray-50 border border-gray-500 text-gray-900 text-lg rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full">
                </form>
            </div>

        </div>
    </x-slot>

    <div class="mt-4">
        <div class="flex justify-between">

            <h3 class="text-3xl text-violet-800 font-extrabold">
                Attendance Record
            </h3>
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
    // Added Pop Ups from Sweet Alert2
    let startAttendance = false;

    function myFunction() {
        console.log("attendance start");
        document.getElementById("inputField").focus();
        startAttendance = true;

        Swal.fire({
            icon: "info",
            title: "Attendance is now starting!",
            showConfirmButton: false,
            timer: 500
        });
    }

    function stopAttendance() {
        console.log("attendance stop");
        startAttendance = false;
        Swal.fire({
            icon: "warning",
            title: "Attendance Stopped!",
            showConfirmButton: false,
            timer: 500
        });
    }
    document.getElementById('inputField').onkeydown = function() {
        if (startAttendance) {
            return false
        }
    };
</script>
