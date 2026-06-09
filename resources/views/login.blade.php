<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Login UrbanVibe</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Poppins,sans-serif;
        }

        body{

            background:#000;
            height:100vh;

            display:flex;
            justify-content:center;
            align-items:center;

        }

        .login-box{

            width:560px;

            background:#070707;

            border:1px solid #171717;

            border-radius:35px;

            padding:60px 55px;

        }

        .logo{

            text-align:center;

            font-size:48px;

            font-weight:800;

            color:white;

            margin-bottom:10px;

        }

        .logo span{

            color:#1565ff;

        }

        .subtitle{

            text-align:center;

            color:#bdbdbd;

            font-size:16px;

            margin-bottom:50px;

        }

        .label{

            color:white;

            font-size:15px;

            font-weight:500;

            margin-bottom:12px;

            display:block;

        }

        .password-row{

            display:flex;

            justify-content:space-between;

            align-items:center;

            margin-bottom:12px;

        }

        .forgot{

            color:#1565ff;

            text-decoration:none;

            font-size:14px;

        }

        .input-box{

            width:100%;

            height:74px;

            background:#111111;

            border:none;

            border-radius:20px;

            padding:0 28px;

            color:white;

            font-size:18px;

            outline:none;

            margin-bottom:35px;

        }

        .input-box::placeholder{

            color:#4f4f4f;

        }

        .btn-login{

            width:100%;

            height:76px;

            border:none;

            border-radius:22px;

            background:#ff5b00;

            color:white;

            font-size:20px;

            font-weight:700;

            cursor:pointer;

            transition:0.3s;

            margin-top:10px;

        }

        .btn-login:hover{

            opacity:0.85;

        }

        @media(max-width:600px){

            .login-box{

                width:92%;

                padding:40px 30px;

            }

            .logo{

                font-size:38px;

            }

        }

    </style>

</head>
<body>

    <div class="login-box">

        <!-- LOGO -->

        <div class="logo">

            URBAN<span>VIBE</span>

        </div>

        <div class="subtitle">

            Login ke sistem fashion store

        </div>

        <!-- FORM -->

        <form action="/login-process" method="POST">

            @csrf

            <!-- USERNAME -->

            <label class="label">

                Masukan Username

            </label>

            <input type="text"
            name="username"
            class="input-box"
            placeholder="Masukan Username">

            <!-- PASSWORD -->

            <div class="password-row">

                <label class="label"
                style="margin-bottom:0;">

                    Masukan Password

                </label>

                <a href="#"
                class="forgot">

                    Lupa Password?

                </a>

            </div>

            <input type="password"
            name="password"
            class="input-box"
            placeholder="Masukan Password">

            <!-- BUTTON -->

            <button type="submit"
            class="btn-login">

                Masuk Ke Sistem

            </button>

        </form>

    </div>

</body>
</html>
