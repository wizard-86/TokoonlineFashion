<!-- resources/views/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>UrbanVibe Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

body{
    background:#000;
    color:white;
    font-family:Poppins,sans-serif;
    padding-bottom:90px;
}

/* HEADER */

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px;
}

.logo{
    font-size:32px;
    font-weight:800;
}

.logo span{
    color:#1565ff;
}

.top-icons{
    display:flex;
    gap:18px;
}

.top-icons a{
    color:white;
    font-size:28px;
}

/* SEARCH */

.search-area{
    padding:0 20px;
}

.search-box{
    background:#111;
    border-radius:20px;
    overflow:hidden;
    display:flex;
    height:58px;
}

.search-box input{
    flex:1;
    border:none;
    outline:none;
    background:none;
    color:white;
    padding:0 20px;
    font-size:16px;
}

.search-btn{
    width:62px;
    border:none;
    background:#1565ff;
    color:white;
    font-size:20px;
}

/* CATEGORY */

.category{
    padding:20px;
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:12px;
}

.category-box{
    background:#111;
    border-radius:18px;
    padding:16px;
    text-align:center;
    border:1px solid #1f1f1f;
}

.category-box i{
    font-size:20px;
    margin-bottom:6px;
}

.category-box div{
    font-size:14px;
}

/* TITLE */

.title{
    padding:0 20px 15px;
}

.title h2{
    font-size:34px;
    font-weight:800;
}

/* PRODUCTS */

.products{
    padding:0 20px;
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:16px;
}

.product-card{
    background:#111;
    border-radius:20px;
    overflow:hidden;
}

.product-card img{
    width:100%;
    height:220px;
    object-fit:cover;
}

.product-body{
    padding:15px;
}

.product-body h5{
    font-size:18px;
    margin-bottom:12px;
}

.product-footer{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.price{
    color:#1565ff;
    font-size:22px;
    font-weight:bold;
}

.cart-btn{
    width:42px;
    height:42px;
    background:#1565ff;
    border-radius:12px;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    text-decoration:none;
    font-size:18px;
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

/* MOBILE */

@media(max-width:900px){

.products{
    grid-template-columns:repeat(2,1fr);
}

}

@media(max-width:600px){

.category{
    grid-template-columns:repeat(2,1fr);
}

.products{
    grid-template-columns:1fr;
}

.logo{
    font-size:28px;
}

.title h2{
    font-size:28px;
}

}

</style>

</head>

<body>

<!-- HEADER -->

<div class="header">

    <div class="logo">
        URBAN<span>VIBE</span>
    </div>

    <div class="top-icons">

        <a href="/cart">
            <i class="bi bi-cart3"></i>
        </a>

        <a href="/notification">
            <i class="bi bi-chat-dots"></i>
        </a>

    </div>

</div>

<!-- SEARCH -->

<div class="search-area">

    <div class="search-box">

        <input type="text"
        placeholder="Cari produk...">

        <button class="search-btn">
            <i class="bi bi-search"></i>
        </button>

        <button class="search-btn">
            <i class="bi bi-camera"></i>
        </button>

    </div>

</div>

<!-- CATEGORY -->

<div class="category">

    <div class="category-box">
        <i class="bi bi-bag"></i>
        <div>Baju</div>
    </div>

    <div class="category-box">
        <i class="bi bi-person"></i>
        <div>Celana</div>
    </div>

    <div class="category-box">
        <i class="bi bi-handbag"></i>
        <div>Tas</div>
    </div>

    <div class="category-box">
        <i class="bi bi-box"></i>
        <div>Jaket</div>
    </div>

</div>

<!-- TITLE -->

<div class="title">
    <h2>Trending Product</h2>
</div>

<!-- PRODUCTS -->

<div class="products">

    <!-- PRODUCT 1 -->

    <div class="product-card">

        <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200">

        <div class="product-body">

            <h5>Oversized Black T-Shirt</h5>

            <div class="product-footer">

                <div class="price">
                    Rp 185.000
                </div>

                <a href="/cart" class="cart-btn">
                    <i class="bi bi-cart-plus"></i>
                </a>

            </div>

        </div>

    </div>

    <!-- PRODUCT 2 -->

    <div class="product-card">

        <img src="https://images.unsplash.com/photo-1556821840-3a63f95609a7?q=80&w=1200">

        <div class="product-body">

            <h5>Street Hoodie</h5>

            <div class="product-footer">

                <div class="price">
                    Rp 350.000
                </div>

                <a href="/cart" class="cart-btn">
                    <i class="bi bi-cart-plus"></i>
                </a>

            </div>

        </div>

    </div>

    <!-- PRODUCT 3 -->

    <div class="product-card">

        <img src="https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?q=80&w=1200">

        <div class="product-body">

            <h5>Denim Jacket</h5>

            <div class="product-footer">

                <div class="price">
                    Rp 420.000
                </div>

                <a href="/cart" class="cart-btn">
                    <i class="bi bi-cart-plus"></i>
                </a>

            </div>

        </div>

    </div>

    <!-- PRODUCT 4 -->

    <div class="product-card">

        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1200">

        <div class="product-body">

            <h5>Urban Backpack</h5>

            <div class="product-footer">

                <div class="price">
                    Rp 275.000
                </div>

                <a href="/cart" class="cart-btn">
                    <i class="bi bi-cart-plus"></i>
                </a>

            </div>

        </div>

    </div>

</div>

<!-- BOTTOM NAV -->

<div class="bottom-nav">

    <a href="/dashboard" class="active">
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

    <a href="/profile">
        <i class="bi bi-person"></i>
        Profile
    </a>

</div>

</body>
</html>
