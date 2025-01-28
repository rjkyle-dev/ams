<button class="" onclick="">
</button>

<div id="{{ $name }}" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <div class="border-b-2 border-gray-300">
            <h1 class="text-2xl font-bold">
                {{ $heading }}

            </h1>
        </div>
        <div>
            {{ $content }}
        </div>

        <div class="flex justify-end">
            @isset($footer)
                {{ $footer }}
            @endisset
            <button id="closeModalBtn" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Close</button>
        </div>
    </div>
</div>

<script></script>
