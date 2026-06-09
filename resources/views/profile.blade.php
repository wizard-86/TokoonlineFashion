<!-- resources/views/profile.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Profile UrbanVibe</title>

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

/* HEADER PROFILE */

.profile-header{
    background:#1565ff;
    margin:20px;
    border-radius:28px;
    padding:25px;
    display:flex;
    align-items:center;
    gap:18px;
}

.profile-header img{
    width:80px;
    height:80px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid white;
}

.profile-info h2{
    font-size:28px;
    font-weight:700;
    margin:0;
}

.profile-info p{
    margin:5px 0 0;
    opacity:0.9;
}

/* MENU STATUS */

.status-box{
    margin:20px;
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:15px;
}

.status-item{
    background:#111;
    border-radius:20px;
    padding:20px 10px;
    text-align:center;
    border:1px solid #1f1f1f;
}

.status-item i{
    font-size:26px;
    color:#1565ff;
    margin-bottom:8px;
    display:block;
}

.status-item span{
    font-size:14px;
}

/* MENU LIST */

.menu-area{
    padding:0 20px;
}

.menu-item{
    background:#111;
    border-radius:18px;
    padding:18px 20px;
    margin-bottom:15px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    text-decoration:none;
    color:white;
    border:1px solid #1f1f1f;
    transition:0.3s;
}

.menu-item:hover{
    background:#1565ff;
}

.menu-left{
    display:flex;
    align-items:center;
    gap:15px;
}

.menu-left i{
    font-size:22px;
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

@media(max-width:600px){

.profile-header{
    flex-direction:column;
    text-align:center;
}

.status-box{
    grid-template-columns:1fr;
}

}

</style>

</head>

<body>

<!-- PROFILE HEADER -->

<div class="profile-header">

    <img src="https://i.pravatar.cc/300" alt="profile">

    <div class="profile-info">

        <h2>UrbanVibe User</h2>

        <p>urbanvibe@gmail.com</p>

    </div>

</div>

<!-- STATUS -->

<div class="status-box">

    <div class="status-item">

        <i class="bi bi-box-seam"></i>

        <span>Dikemas</span>

    </div>

    <div class="status-item">

        <i class="bi bi-truck"></i>

        <span>Dikirim</span>

    </div>

    <div class="status-item">

        <i class="bi bi-star"></i>

        <span>Belum Dinilai</span>

    </div>

</div>

<!-- MENU -->

<div class="menu-area">

    <a href="#" class="menu-item">

        <div class="menu-left">

            <i class="bi bi-ticket-perforated"></i>

            <span>Voucher Saya</span>

        </div>

        <i class="bi bi-chevron-right"></i>

    </a>

    <a href="#" class="menu-item">

        <div class="menu-left">

            <i class="bi bi-clock-history"></i>

            <span>Riwayat Pembelian</span>

        </div>

        <i class="bi bi-chevron-right"></i>

    </a>

    <a href="#" class="menu-item">

        <div class="menu-left">

            <i class="bi bi-gear"></i>

            <span>Pengaturan Akun</span>

        </div>

        <i class="bi bi-chevron-right"></i>

    </a>

    <a href="/login" class="menu-item">

        <div class="menu-left">

            <i class="bi bi-box-arrow-right"></i>

            <span>Logout</span>

        </div>

        <i class="bi bi-chevron-right"></i>

    </a>

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

    <a href="/notification">
        <i class="bi bi-bell"></i>
        Notifikasi
    </a>

    <a href="/profile" class="active">
        <i class="bi bi-person"></i>
        Profile
    </a>

</div>

</body>
</html>
