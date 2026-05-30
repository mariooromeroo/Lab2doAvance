<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $categoria->nombre_categoria }} - FridgeChef</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .detalle-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .categoria-header {
            background: #2d6a4f;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            color: white;
            margin-bottom: 2rem;
        }
        .categoria-header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        .categoria-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        .categoria-icono {
            background: white;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: -60px auto 1rem auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .categoria-icono i {
            font-size: 2.5rem;
            color: #2d6a4f;
        }
        .recetas-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        .recetas-section h2 {
            color: #2d6a4f;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f0f7f0;
        }
        .recetas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        .card-receta {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 1rem;
            border: 1px solid #e0e0e0;
            transition: transform 0.3s ease;
        }
        .card-receta:hover {
            transform: translateY(-5px);
        }
        .receta-icono {
            background: #2d6a4f;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        .receta-icono i {
            font-size: 1.3rem;
            color: white;
        }
        .card-receta h3 {
            color: #2d6a4f;
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }
        .receta-tiempo {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }
        .receta-descripcion {
            color: #888;
            font-size: 0.8rem;
            margin-bottom: 0.8rem;
        }
        .btn-ver-receta {
            color: #2d6a4f;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: bold;
        }
        .btn-ver-receta:hover {
            text-decoration: underline;
        }
        .sin-recetas {
            text-align: center;
            padding: 3rem;
            background: #f8f9fa;
            border-radius: 15px;
        }
        .btn-volver {
            display: inline-block;
            background: #2d6a4f;
            color: white;
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }
        .btn-volver:hover {
            background: #1b4d3e;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="logo"><h1>FridgeChef</h1></div>
        <nav>
            <a href="/">Inicio</a>
            <a href="/categorias">Categorías</a>
            <a href="#">Mis recetas</a>
            <a href="#">Sobre Nosotros</a>
        </nav>
        <div class="acciones">
            <div class="acciones">
            <form action="{{ route('busqueda') }}" method="GET">

                 <input
                     type="text"
                     name="buscar"
                  placeholder="Buscar..."
                 >

            </form>
            <button>Iniciar Sesión</button>
        </div>
    </header>
            <button>Iniciar Sesión</button>
        </div>
    </header>

    <div class="detalle-container">
        <!-- Header de la categoría -->
        <div class="categoria-header">
            <div class="categoria-icono">
                @php
                    $iconos = ['fa-utensils', 'fa-salad', 'fa-pizza-slice', 'fa-mug-hot', 'fa-ice-cream', 'fa-fish', 'fa-bread-slice', 'fa-apple-alt', 'fa-cake-candles'];
                    $icono = $iconos[$categoria->id_categoria % count($iconos)];
                @endphp
                <i class="fas {{ $icono }}"></i>
            </div>
            <h1>{{ $categoria->nombre_categoria }}</h1>
            <p>{{ $categoria->descripcion ?? 'Sin descripción' }}</p>
        </div>

        <!-- SECCIÓN DE RECETAS -->
        <div class="recetas-section">
            <h2><i class="fas fa-utensils"></i> Recetas en {{ $categoria->nombre_categoria }}</h2>
            
            @if($recetas->count() > 0)
                <div class="recetas-grid">
                    @foreach($recetas as $receta)
                        <div class="card-receta">
                            <div class="receta-icono">
                                <i class="fas fa-utensil-spoon"></i>
                            </div>
                            <h3>{{ $receta->titulo }}</h3>
                            <div class="receta-tiempo">
                                <i class="fas fa-clock"></i> {{ $receta->tiempo_preparacion }} min
                            </div>
                            <div class="receta-descripcion">
                                {{ Str::limit($receta->descripcion, 80) }}
                            </div>
                            <a href="#" class="btn-ver-receta">
                                Ver receta completa <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="sin-recetas">
                    <i class="fas fa-info-circle fa-3x" style="color: #ccc;"></i>
                    <p>No hay recetas en esta categoría aún.</p>
                </div>
            @endif

            <!-- Solo botón Volver -->
            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ route('categorias.index') }}" class="btn-volver">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    </div>

    <footer>
        <p>"Cocina sin desperdiciar, aprovecha cada ingrediente"</p>
        <p>Únete a FridgeChef, es completamente gratis</p>
    </footer>
</body>
</html>