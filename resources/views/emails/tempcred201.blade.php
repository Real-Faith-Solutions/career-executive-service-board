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
        h1 {
            color: #3498db;
        }
        h2 {
            color: #3498db;
        }
        p {
            color: #777;
        }
        .logo {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="logo" src="{{ $message->embed( $data['imagePath']) }}" alt="CESB Logo" width="100">
        <h1>Welcome to CESB Portal</h1>
        <h2>Use these temporary credentials to login.</h2>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Password:</strong> {{ $data['password'] }}</p>
    </div>
</body>
</html>