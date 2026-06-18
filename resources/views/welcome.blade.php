<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URBAN VIBE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#0b0b0b;
            color:white;
        }

        .btn-category{
            background:#111;
            color:#b3b3b3;
            border:1px solid #333;
            border-radius:8px;
            padding:8px 18px;
            transition:.3s;
        }

        .btn-category:hover{
            color:white;
            border-color:#0d6efd;
        }

        .active-category{
            background:#0d6efd !important;
            color:white !important;
            border-color:#0d6efd !important;
        }

        .product-card{
            background:#111;
            border:1px solid #222;
            border-radius:16px;
            overflow:hidden;
            transition:.3s;
            height:100%;
        }

        .product-card:hover{
            transform:translateY(-5px);
        }

        .product-img{
            width:100%;
            height:250px;
            object-fit:cover;
        }

        .product-category{
            color:#0d6efd;
            font-size:12px;
            font-weight:bold;
            letter-spacing:1px;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">logout</button>
    </form>

    <h1 class="fw-bold mb-3">
        URBAN <span class="text-primary">VIBE</span>
    </h1>

    <p class="text-secondary mb-4">
        Koleksi streetwear terbaik untuk gaya urban modern.
    </p>

    <!-- KATEGORI -->
    <div class="d-flex flex-wrap gap-2 mb-5">

        <button
            class="btn btn-category active-category"
            onclick="filterCategory('all', this)">
            All
        </button>

        @foreach($categories as $category)

            <button
                class="btn btn-category"
                onclick="filterCategory('{{ $category->id }}', this)">

                {{ $category->name }}

            </button>

        @endforeach

    </div>

    <!-- PRODUK -->
    <div class="row g-4">

        @foreach($products as $product)

            <div
                class="col-md-6 col-lg-3 product-item"
                data-category="{{ $product->category_id }}">

                <div class="product-card">

                    <img
                        src="{{ asset('assets/' . $product->image) }}"
                        class="product-img"
                        alt="{{ $product->name }}">

                    <div class="p-3">

                        <span class="product-category">
                            {{ strtoupper($product->category->name) }}
                        </span>

                        <h5 class="mt-2">
                            {{ $product->name }}
                        </h5>

                        <p class="text-secondary mb-2">
                            Stok : {{ $product->stock }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center">

                            <span class="fw-bold text-primary">
                                Rp {{ number_format($product->price,0,',','.') }}
                            </span>

                            <a
                                href="{{ route('product.show',$product->id) }}"
                                class="btn btn-primary btn-sm">

                                Detail

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

<script>

function filterCategory(categoryId, button){

    document.querySelectorAll('.btn-category')
        .forEach(btn => btn.classList.remove('active-category'));

    button.classList.add('active-category');

    document.querySelectorAll('.product-item')
        .forEach(product => {

            let productCategory =
                product.getAttribute('data-category');

            if(
                categoryId === 'all'
                || productCategory === categoryId
            ){
                product.style.display = 'block';
            }
            else{
                product.style.display = 'none';
            }

        });
}

</script>

</body>
</html>