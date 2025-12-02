<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <style>
       * {
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #fff;
            padding: 35px;
            width: 360px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(15px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .login-container h2 {
            margin-bottom: 25px;
            text-align: center;
            color: #ff6a00;
            font-size: 26px;
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #ffad66;
            border-radius: 10px;
            font-size: 15px;
            transition: 0.3s;
        }

        .login-container input:focus {
            border-color: #ff6a00;
            outline: none;
            box-shadow: 0 0 5px rgba(255,106,0,0.5);
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background: #ff6a00;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 17px;
            font-weight: bold;
            transition: 0.3s;
        }

        .login-container button:hover {
            background: #e65c00;
            transform: scale(1.02);
        }

        .error {
            color: #d00000;
            font-size: 14px;
            display: none;
            margin-top: 10px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <input type="text" id="username" placeholder="Masukkan Username Admin" />
        <input type="password" id="password" placeholder="Masukkan Sandi Admin" />
        <button onclick="login()">Masuk</button>
        <p class="error" id="error">Sandi salah! Coba lagi.</p>
    </div>

    <script>
        function login() {
            const user = document.getElementById("username").value;
            const pw = document.getElementById("password").value;
            const error = document.getElementById("error");

            const adminUser = "admin";
            const adminPass = "admin123";

            if (user === adminUser && pw === adminPass) {
                window.location.href = "http://localhost/dbadmin/admin%20fx/dashboard.php";
            } else {
                error.style.display = "block";
            }
        }
    </script>
</body>
</html>
