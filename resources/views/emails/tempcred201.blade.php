<!DOCTYPE html>
<html>
<head>
    <title>Welcome to CESB Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            max-width: 600px;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #3498db;
        }
        p {
            color: #777;
        }
        .logo {
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .readonly-input-container {
            margin-top: 10px;
            text-align: center; /* Center the labels and input fields */
        }
        .readonly-input {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="logo" src="{{ $message->embed( $data['imagePath']) }}" alt="CESB Logo" width="100">
        
        @if ($data['type'] == "forgotPassword")
            <h1>CESB Account Recovery</h1>
            <h2>Use these new credentials to login.</h2>
        @else
            <h1>Welcome to CESB Portal</h1>
            <h2>Use these temporary credentials to login.</h2>
        @endif
        
        <div class="readonly-input-container">
            <label for="email"><strong>Email:</strong></label>
            <input class="readonly-input" type="email" id="email" value="{{ $data['email'] }}" readonly>
        </div>
        
        <div class="readonly-input-container">
            <label for="password"><strong>Password:</strong></label>
            <input class="readonly-input" type="text" id="password" value="{{ $data['password'] }}" readonly>
        </div>
        
        <a class="button" href="{{ $data['loginLink'] }}">Go to Login Page</a>
    </div>
</body>
</html>
