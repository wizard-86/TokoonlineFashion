<!-- resources/views/notification.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>UrbanVibe Notifikasi</title>

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

.header{
    padding:20px;
}

.header h1{
    font-size:34px;
    font-weight:800;
}

.notif-area{
    padding:0 20px;
}

.notif-box{
    background:#111;
    border-radius:22px;
    padding:20px;
    margin-bottom:18px;
    border-left:5px solid #1565ff;
}

.notif-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:10px;
}

.notif-title{
    font-size:20px;
    font-weight:700;
}

.notif-time{
    color:#888;
    font-size:13px;
}

.notif-text{
    color:#bbb;
    font-size:15px;
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

    <h1>Notifikasi</h1>

</div>

<!-- NOTIFIKASI -->

<div class="notif-area">

    <div class="notif-box">

        <div class="notif-top">

            <div class="notif-title">
                🔥 Promo Flash Sale
            </div>

            <div class="notif-time">
                1 Jam Lalu
            </div>

        </div>

        <div class="notif-text">
            Diskon hoodie hingga 70% khusus hari ini.
        </div>

    </div>

    <div class="notif-box">

        <div class="notif-top">

            <div class="notif-title">
                🎁 Gratis Ongkir
            </div>

            <div class="notif-time">
                Hari Ini
            </div>

        </div>

        <div class="notif-text">
            Gratis ongkir seluruh Indonesia tanpa minimum belanja.
        </div>

    </div>

    <div class="notif-box">

        <div class="notif-top">

            <div class="notif-title">
                🛒 Produk Baru
            </div>

            <div class="notif-time">
                Baru Saja
            </div>

        </div>

        <div class="notif-text">
            Koleksi streetwear terbaru sudah tersedia sekarang.
        </div>

    </div>

</div>

<!-- BOTTOM NAV -->

<div class="bottom-nav">

    <a href="/dashboard">
        <i class="bi bi-house"></i>
        Dashboard
    </a>

    <a href="/video">
        <i class="bi bi-camera-video"></i>
        Live
    </a>

    <a href="/notification" class="active">
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
