<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Application')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background-color: #4267b2;
            padding: 30px 0;
        }

        .header .login-form {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .header .login-form input {
            padding: 8px;
            border: none;
            border-radius: 4px;
            outline: none;
        }

        .header .login-form button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            background-color: #1877f2;
            color: #fff;
            cursor: pointer;
        }

        .header .login-form button:hover {
            background-color: #145dbf;
        }

        .header .user-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .user-info .user-details {
            color: #fff;
            font-size: 16px;
        }

        .header .user-info .logout-btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            background-color: #f44336;
            color: #fff;
            cursor: pointer;
        }

        .header .user-info .logout-btn:hover {
            background-color: #d32f2f;
        }

        .main {
            padding: 50px 0;
            text-align: center;
        }

        .signup-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
            max-width: 400px;
            width: 100%;
        }

        .signup-form h2 {
            margin-bottom: 20px;
        }

        .signup-form input, .signup-form select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        .signup-form button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #1877f2;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }

        .signup-form button:hover {
            background-color: #145dbf;
        }
        a{
            text-decoration: none;
            color: white;
            padding-left: 10px;
        }
        a:hover{
            color: gray;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            @auth
                <div class="user-info">
                    <div class="user-details">
                        <!-- Display the user's name and current date -->
                        <p>Hello, {{ auth()->user()->first_name }}! Today is {{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
                    </div>
                    @if(auth()->user()->role == 'Admin')
                        <a href="/patient_info">Patient Info</a>
                        <a href="/employee_info">Employee Info</a> 
                    @elseif(auth()->user()->role == 'Supervisor')
                        <a href="/patient_info">Patient Info</a>
                        <a href="/employee_info">Employee Info</a> 
                    @endif
                    <a href="/daily_roster">Daily Roster</a> 

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">Log Out</button>
                    </form>
                </div>
            @else
            @endauth
        </div>
    </header>

    <main class="main">
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>
