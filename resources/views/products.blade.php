<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce B2B Fashion</title>

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            background: #0f172a;
            color: white;
            overflow-x: hidden;
        }

        /* NAVBAR */

        nav{
            width: 100%;
            padding: 20px 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        .logo{
            font-size: 30px;
            font-weight: bold;
            color: #38bdf8;
        }

        nav ul{
            display: flex;
            gap: 35px;
            list-style: none;
        }

        nav ul li a{
            text-decoration: none;
            color: white;
            font-size: 16px;
            transition: 0.3s;
        }

        nav ul li a:hover{
            color: #38bdf8;
        }

        /* HERO */

        .hero{
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 120px 60px 60px;
            background:
            radial-gradient(circle at top left,#1e3a8a,#0f172a 40%),
            radial-gradient(circle at bottom right,#0ea5e9,#0f172a 40%);
        }

        .hero-content{
            max-width: 750px;
            text-align: center;
        }

        .hero-content h1{
            font-size: 70px;
            line-height: 1.1;
            margin-bottom: 25px;
        }

        .hero-content h1 span{
            color: #38bdf8;
        }

        .hero-content p{
            font-size: 20px;
            color: #cbd5e1;
            line-height: 1.8;
            margin-bottom: 40px;
        }

        .btn-group{
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn{
            padding: 16px 35px;
            border-radius: 14px;
            text-decoration: none;
            font-size: 17px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary{
            background: #38bdf8;
            color: #0f172a;
        }

        .btn-primary:hover{
            transform: translateY(-5px);
            background: #0ea5e9;
        }

        .btn-secondary{
            border: 2px solid #38bdf8;
            color: #38bdf8;
        }

        .btn-secondary:hover{
            background: #38bdf8;
            color: #0f172a;
        }

        /* CARD SECTION */

        .features{
            padding: 80px;
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(280px,1fr));
            gap: 30px;
            background: #111827;
        }

        .card{
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 35px;
            transition: 0.4s;
        }

        .card:hover{
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(56,189,248,0.2);
        }

        .card h2{
            color: #38bdf8;
            margin-bottom: 20px;
        }

        .card p{
            color: #cbd5e1;
            line-height: 1.7;
        }

        /* FOOTER */

        footer{
            padding: 30px;
            text-align: center;
            background: #0f172a;
            color: #94a3b8;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        /* RESPONSIVE */

        @media(max-width:768px){

            nav{
                padding: 20px;
                flex-direction: column;
                gap: 20px;
            }

            .hero-content h1{
                font-size: 45px;
            }

            .hero-content p{
                font-size: 17px;
            }

            .features{
                padding: 40px 20px;
            }
        }

    </style>
</head>
<body>

    <!-- NAVBAR -->

    <nav>

        <div class="logo">
            B2B Fashion
        </div>

        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Produk</a></li>
            <li><a href="#">Kategori</a></li>
            <li><a href="#">Distributor</a></li>
            <li><a href="#">Kontak</a></li>
        </ul>

    </nav>

    <!-- HERO -->

    <section class="hero">

        <div class="hero-content">

            <h1>
                Platform <span>E-Commerce B2B</span>
                Untuk Toko Baju Grosir
            </h1>

            <p>
                Solusi modern untuk distributor, reseller, dan toko retail
                dalam melakukan pembelian baju partai besar dengan sistem
                harga grosir bertingkat dan manajemen stok real-time.
            </p>

            <div class="btn-group">

                <a href="/api/products" class="btn btn-primary">
                    Lihat Produk
                </a>

                <a href="#" class="btn btn-secondary">
                    Pelajari Sistem
                </a>

            </div>

        </div>

    </section>

    <!-- FEATURES -->

    <section class="features">

        <div class="card">
            <h2>📦 Katalog Produk</h2>

            <p>
                Kelola produk baju grosir lengkap dengan warna,
                ukuran, stok gudang, dan kategori produk.
            </p>
        </div>

        <div class="card">
            <h2>💰 Harga Grosir</h2>

            <p>
                Sistem harga tier otomatis berdasarkan jumlah
                pembelian lusin maupun bal besar.
            </p>
        </div>

        <div class="card">
            <h2>🚚 Pengiriman Kargo</h2>

            <p>
                Mendukung pengiriman partai besar menggunakan
                layanan logistik dan ekspedisi terpercaya.
            </p>
        </div>

    </section>

    <!-- FOOTER -->

    <footer>
        © 2026 E-Commerce B2B Fashion Store • Laravel 13
    </footer>

</body>
</html>