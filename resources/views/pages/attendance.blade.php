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


            @if ($event)
                <div x-data="{ play: false }" class="flex">
                    <div x-data="{ open: false }" class="transition-all">
                        <button x-on:click="open = ! open" onclick="myFunction()"
                            class="bg-orange-500 px-3 py-2 mb-2 hover:bg-orange-600 transition-full max-w-xs text-center rounded-xl text-white shadow-lg">
                            Start Attendance
                        </button>

                        <div x-show.important="open"
                            class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <div id="modalAttendance" x-on:click.outside="open = false"
                                class="max-w-[1000px] min-w-[500px] bg-white p-6 rounded-lg shadow-lg">
                                <div class="border-b-2 border-gray-300 mb-5">
                                    <h1 class="text-2xl font-bold">
                                        Attendance is Starting
                                    </h1>
                                </div>
                                <div class="mb-5">
                                    <form id="attendanceForm" method="POST">
                                        @csrf
                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                        <input type="hidden" name="uri" value="{{ route('attendanceStudent') }}">
                                        <div class="flex flex-col">
                                            <label class="text-lg font-semibold" for="">Enter RFID:</label>
                                            <input type="text" name="s_rfid" id="inputField">
                                        </div>
                                    </form>
                                </div>

                                <div class="flex justify-end">
                                    <button x-on:click="open = false"
                                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Close</button>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            @endif

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

    <form id="getAttendanceForm" hidden>
        <input type="text" id="getURI" value="{{ route('getAttendanceRecent') }}" hidden>
    </form>

</x-app-layout>
<script>
    var startAttendance = false;
    const scannedData = document.getElementById("inputField");

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
    }
</script>
