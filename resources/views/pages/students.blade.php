<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-violet-800 leading-tight">
            {{ __('Student Attendance') }}
        </h2>

    </x-slot>
    <div class="mt-4">

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
                            <button>Edit</button>
                            <button>Delete</button>

                        </td>
                    @endforeach
                @endisset
            </tbody>
        </table>
    </div>

</x-app-layout>
