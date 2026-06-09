<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>UrbanVibe Live</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

body{
    background:#000;
    color:white;
    font-family:Poppins,sans-serif;
    padding-bottom:100px;
}

/* HEADER */

.header{
    padding:20px;
}

.header h1{
    font-size:34px;
    font-weight:800;
}

/* LIVE BOX */

.live-container{
    height:70vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
}

.live-box{
    width:100%;
    max-width:500px;
    background:#111;
    border-radius:28px;
    padding:50px 30px;
    text-align:center;
    border:1px solid #1f1f1f;
}

.live-icon{
    width:100px;
    height:100px;
    background:#1565ff;
    border-radius:50%;
    margin:auto;
    display:flex;
    justify-content:center;
    align-items:center;
}

.live-icon i{
    font-size:42px;
}

.live-box h2{
    margin-top:25px;
    font-size:32px;
    font-weight:700;
}

.live-box p{
    color:#aaa;
    margin-top:10px;
    font-size:17px;
}

/* BOTTOM NAV */

.bottom-nav{
    position:fixed;
    bottom:0;
    width:100%;
    height:80px;
    background:#111;
    border-top:1px solid #1f1f1f;
    display:flex;
    justify-content:space-around;
    align-items:center;
}

.bottom-nav a{
    color:white;
    text-decoration:none;
    text-align:center;
    font-size:12px;
}

.bottom-nav i{
    display:block;
    font-size:24px;
    margin-bottom:4px;
}

.active{
    color:#1565ff !important;
}

</style>

</head>

<body>

<!-- HEADER -->

<div class="header">

    <h1>UrbanVibe Live</h1>

</div>

<!-- LIVE CONTENT -->

<div class="live-container">

    <div class="live-box">

        <div class="live-icon">
            <i class="bi bi-camera-video"></i>
        </div>

        <h2>Belum Ada Creator Live</h2>

        <p>
            Tunggu live shopping terbaru dari UrbanVibe.
        </p>

    </div>

</div>

<!-- BOTTOM NAV -->

<div class="bottom-nav">

    <a href="/dashboard">
        <i class="bi bi-house"></i>
        Dashboard
    </a>

    <a href="/video" class="active">
        <i class="bi bi-camera-video"></i>
        Live
    </a>

    <a href="/notification">
        <i class="bi bi-bell"></i>
        Notifikasi
    </a>

    <a href="/profile">
        <i class="bi bi-person"></i>
        Profile
    </a>

</div>

</body>
</html>
