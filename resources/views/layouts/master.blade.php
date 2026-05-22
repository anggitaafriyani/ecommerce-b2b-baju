<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IndieArt Connect — @yield('title')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --navy-main: #0f172a;
            --navy-light: #1e293b;
            --accent-blue: #3b82f6;
            --bg-body: #f8fafc;
            --border-color: #e2e8f0;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f0f4f8;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(219, 234, 254, 0.7) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(224, 231, 255, 0.7) 0%, transparent 40%);
            background-attachment: fixed;
            color: var(--text-main);
            font-size: 0.95rem;
        }

        /* --- KEYFRAMES ANIMASI --- */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }

        /* Navbar Sleek */
        .navbar-custom { 
            background: var(--navy-main); 
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.1); 
            padding: 1.2rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar-brand { font-weight: 700; letter-spacing: -0.5px; font-size: 1.25rem; color: #ffffff !important; }

        /* Card Container Utama + Animasi FadeIn */
        .card-main { 
            background: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(10px);
            border-radius: 20px; 
            border: 1px solid rgba(255, 255, 255, 0.8); 
            border-top: 5px solid var(--navy-main);
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.06); 
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Tombol Navy Premium yang Lebih Hidup */
        .btn-navy { 
            background-color: var(--navy-main); 
            color: white; 
            border-radius: 10px; 
            padding: 10px 24px; 
            font-weight: 600; 
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            border: none;
            box-shadow: 0 4px 10px rgba(15, 23, 42, 0.15);
            position: relative;
            overflow: hidden;
        }
        .btn-navy:hover { 
            background-color: var(--accent-blue); 
            color: white; 
            transform: translateY(-3px) scale(1.02); 
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3); 
        }
        /* Efek riak cahaya pada tombol utama */
        .btn-navy::after {
            content: '';
            position: absolute;
            top: -50%; left: -50%; width: 200%; height: 200%;
            background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0) 100%);
            transform: rotate(45deg);
            transition: all 0.3s;
            opacity: 0;
        }
        .btn-navy:hover::after {
            animation: shimmer 1.5s infinite;
            opacity: 1;
        }
        @keyframes shimmer {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        /* Tabel Estetik */
        .table-responsive-custom {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: visible; 
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.01);
        }
        .table-custom { 
            border-collapse: collapse; 
            width: 100%; 
            margin-bottom: 0;
        }
        
        .table-custom thead th { 
            background-color: #f8fafc; 
            color: var(--navy-main); 
            font-weight: 700; 
            font-size: 0.8rem; 
            text-transform: uppercase; 
            letter-spacing: 0.5px; 
            padding: 16px;
            border-bottom: 2px solid #cbd5e1; 
            border-right: 1px solid var(--border-color); 
        }
        .table-custom thead th:last-child { border-right: none; }

        /* Isi Tabel dengan Efek Pop-out Hover */
        .table-custom tbody tr { 
            border-bottom: 1px solid var(--border-color); 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .table-custom tbody tr:last-child { border-bottom: none; } 
        
        .table-custom tbody tr:nth-of-type(even) { background-color: #fbfcfd; }
        
        /* Baris membesar dan melayang saat dihover */
        .table-custom tbody tr:hover { 
            background-color: #ffffff; 
            transform: scale(1.015);
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            z-index: 10;
            border-radius: 8px;
        }
        .table-custom tbody tr:hover td { border-color: transparent; } 

        .table-custom tbody td { 
            padding: 16px; 
            vertical-align: middle; 
            color: #475569;
            border-right: 1px solid var(--border-color); 
            transition: all 0.3s ease;
        }
        .table-custom tbody td:last-child { border-right: none; } 

        .badge-status { 
            padding: 6px 14px; 
            border-radius: 8px; 
            font-weight: 600; 
            font-size: 0.75rem; 
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .btn-resi-view {
            color: var(--accent-blue);
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-resi-view:hover {
            background-color: var(--accent-blue);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
        }

        /* Tombol Aksi Bulat Lebih Interaktif */
        .btn-action-circle {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            background-color: #ffffff;
            color: var(--text-muted);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 0;
            cursor: pointer;
        }
        .btn-action-circle:hover {
            background-color: #f1f5f9;
            color: var(--navy-main);
            transform: translateY(-2px) rotate(5deg);
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .btn-action-circle.btn-delete:hover {
            background-color: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
            transform: translateY(-2px) rotate(-5deg);
            animation: pulseGlow 1.5s infinite;
        }

        /* Modal Animated */
        .modal.fade .modal-dialog {
            transform: scale(0.95);
            transition: transform 0.3s ease-out;
        }
        .modal.show .modal-dialog {
            transform: scale(1);
        }
        .modal-content { border-radius: 20px; border: none; box-shadow: 0 24px 50px rgba(15,23,42,0.2); }
        .modal-header { 
            background: var(--navy-main); 
            border-top-left-radius: 20px; 
            border-top-right-radius: 20px; 
            padding: 20px 24px; 
            border-bottom: none; 
        }
        .modal-title { font-weight: 700; letter-spacing: -0.5px; color: white; font-size: 1.1rem; }
        
        .form-label { font-weight: 600; color: #475569; font-size: 0.85rem; margin-bottom: 8px; }
        .form-control, .form-select { 
            border-radius: 10px; 
            border: 1px solid var(--border-color); 
            padding: 12px 16px; 
            font-size: 0.95rem; 
            color: var(--text-main);
            background-color: #fcfcfc;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus { 
            border-color: #93c5fd; 
            background-color: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15); 
            transform: translateY(-1px);
        }
        .input-group-text {
            border-radius: 10px 0 0 10px;
            background-color: #f8fafc;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            font-weight: 600;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark navbar-custom mb-5">
        <div class="container">
            <span class="navbar-brand h4 mb-0"><i class="bi bi-diagram-3 me-2"></i>Fashion Gidyrismi — B2B</span>
        </div>
    </nav>

    <div class="container pb-5">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')

</body>
</html>