<x-app-layout>

    <x-slot name="header">
        <div class="">
            <h2 class="font-semibold text-3xl text-violet-800 leading-tight">
                Welcome, {{ auth()->user()->admin_fname }}
            </h2>
        </div>
    </x-slot>

    <div class="flex gap-5 mb-4">
        <div class="bg-white basis-1/2 flex gap-20 p-3 items-start rounded-md">
            <div class="">
                <p class="text-base font-bold">First Name: <span class="text-slate-500 font-medium">{{ auth()->user()->admin_fname }}</span></p>
                <p class="text-base font-bold">Last Name: <span class="text-slate-500 font-medium">{{ auth()->user()->admin_lname }}</span></p>
                <p class="text-base font-bold">Role: <span class="text-slate-500 font-medium">{{ auth()->user()->admin_type }}</span></p>
                <p class="text-base font-bold">Username: <span class="text-slate-500 font-medium">{{ auth()->user()->admin_uname }}</span></p>
            </div>
            <div class="">
                <p class="text-base font-bold">Account Created: <span class="text-slate-500 font-medium">{{ auth()->user()->created_at }}</span></p>
                <p class="text-base font-bold">Account Updated: <span class="text-slate-500 font-medium">{{ auth()->user()->updated_at }}</span></p>
                <p class="text-base font-bold">Email Address: <span class="text-slate-500 font-medium">{{ auth()->user()->admin_email }}</span></p>
            </div>
            <div class="">

            </div>
        </div>
        <div class="bg-white basis-1/2 flex items-center justify-evenly rounded-md">
            <div class="flex items-center gap-1 bg-yellow-500 rounded-md p-2 hover:scale-105 hover:text-gray-900 ease-linear transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                  
                
                <h1 class="font-semibold text-2xl">
                    <span>10000</span>
                    Students
                </h1>
            </div>
            <div class="flex items-center gap-1 bg-yellow-500 rounded-lg p-2 hover:scale-105 hover:text-gray-900 ease-linear transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>   
                
                <h1 class="font-semibold text-2xl">
                    <span>10000</span>
                    Graduates
                </h1>
            </div>
        </div>
    </div>

    <div class="bg-white p-3">
        <div class="flex justify-between">
            <div class="flex gap-3">
                <button class="bg-violet-800 hover:bg-violet-950 ease-linear transition-all text-white rounded-xl px-5 text-2xl flex items-center p-4 gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z" />
                    </svg>  
                    Attendance                    
                </button>
                <div id="clockdate">
                    <div class="clockdate-wrapper bg-gray-800 p-4 max-w-xs w-full text-center rounded-xl mx-auto shadow-lg">
                      <div id="clock" class="bg-gray-800 text-yellow-400 text-2xl font-sans shadow-sm"></div>
                      <div id="date" class="tracking-widest text-sm font-sans text-white"></div>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button class="bg-violet-600 hover:bg-violet-950 ease-linear transition-all text-white rounded-xl px-5 text-2xl flex items-center p-4 gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                    Event  
                </button>
                <button class="bg-yellow-500 hover:bg-amber-500 ease-linear transition-all text-white rounded-xl px-5 text-2xl flex items-center p-4 gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                    Student  
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
