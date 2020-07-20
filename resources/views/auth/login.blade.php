<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kuisioner</title>
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            background-color: #ebebeb;
        }
    </style>
</head>
<body>
    
    <main id="main-content">
        <div class="w-full max-w-xs m-auto mt-20">
            <div class="login-result"></div>

            {{ Form::open(['id' => 'login-form', 'class' => 'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4'])}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" name="email" placeholder="Username">
                    </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="Password">
                </div>
                <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    Login
                </button>
                </div>
            {{ Form::close() }}
            <p class="text-center text-gray-500 text-xs">
                &copy;2020 Acme Corp. All rights reserved.
            </p>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(function() {
            $('#login-form').submit(function(e) {
                e.preventDefault();
                $('.login-result').html('<div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert"><p>Sedang Login</p></div>');
                $.ajax({
                    type: 'post',
                    url: '{{ route('login') }}',
                    data: $(this).serializeArray(),
                }).done(function(data) {
                    $('.login-result').html('<div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert"><p>Login Sukses</p></div>');
                    setTimeout(function() {
                        location.reload(true);
                    });
                }).fail(function(data) {
                    $('.login-result').html('<div class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3" role="alert"><p>'+ data.responseJSON.message +'</p></div>');
                });
            });
        });
    </script>
</body>
</html>