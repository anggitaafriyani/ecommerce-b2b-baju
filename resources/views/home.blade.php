<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B2B Fashion</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Segoe UI;
        }

        body{
            background:#0f172a;
            color:white;
        }

        .hero{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
            text-align:center;
            padding:40px;
            background:
            linear-gradient(rgba(15,23,42,0.8),rgba(15,23,42,0.9)),
            url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=1600&auto=format&fit=crop');
            background-size:cover;
            background-position:center;
        }

        h1{
            font-size:70px;
            margin-bottom:20px;
        }

        h1 span{
            color:#38bdf8;
        }

        p{
            max-width:700px;
            line-height:1.8;
            font-size:20px;
            color:#cbd5e1;
            margin-bottom:40px;
        }

        .btn{
            padding:16px 35px;
            background:#38bdf8;
            color:#0f172a;
            text-decoration:none;
            border-radius:12px;
            font-size:18px;
            font-weight:bold;
            transition:0.3s;
        }

        .btn:hover{
            transform:translateY(-5px);
            background:#0ea5e9;
        }

    </style>

</head>
<body>

    <section class="hero">

        <h1>
            E-Commerce <span>B2B Fashion</span>
        </h1>

        <p>
            Platform grosir modern untuk distributor, reseller,
            dan toko retail dengan sistem harga tier,
            stok gudang real-time, dan pembelian partai besar.
        </p>

        <a href="/products" class="btn">
            Lihat Produk
        </a>

    </section>

</body>
</html>