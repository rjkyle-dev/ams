<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Testing Page - APIs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/test.js'])


</head>

<body onload="myFunction('{{ url()->full() }}')">


    <div class="bg-green-300 text-center text-3xl">
        TESTING IN PROGRESS
    </div>

    <div class="flex gap-5 p-5">
        <div class="basis-1/2">
            <h3 class="text-xl "> DATA RETRIEVE via CONTROLLER</h3>
            <div class="max-w-1/2">
                @foreach ($data as $da)
                    <ol>
                        <li>
                            {{ $da }}
                        </li>
                    </ol>
                @endforeach
            </div>
            <form id="testForm" method="POST">
                @csrf
                <input type="text" name="uri" hidden value="{{ route('postAPI') }}">
                <label for="">Name</label>
                <input type="text" name="name"><br>
                <label for="">Age</label>
                <input type="text" name="Age"><br>
                <input type="submit" value="Submit">
            </form>

        </div>
        <div class="basis-1/2">
            <h3 class="text-xl ">
                DATA RETRIEVE via API
            </h3>
            <div class="max-w-1/2" id="test_container">
                <ul id="posts-list">

                </ul>
            </div>
        </div>
    </div>



    <script>
        function setURI(url) {
            console.log('working');
            this.uri = url
        }
        const element = document.getElementById('testForm');
        element.addEventListener('submit', event => {
            event.preventDefault();
            submitForm(new FormData(event.target))
        });
    </script>

</body>

</html>
