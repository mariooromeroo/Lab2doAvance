<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías - FridgeChef</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .categorias-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        .categorias-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }
        .card-categoria {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e0e0e0;
        }
        .card-categoria:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .card-icon {
            background: #2d6a4f;
            padding: 2rem;
            text-align: center;
            font-size: 3rem;
            color: white;
        }
        .card-body-categoria {
            padding: 1.5rem;
            text-align: center;
        }
        .card-body-categoria h3 {
            color: #2d6a4f;
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }
        .card-body-categoria p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        .btn-ver {
            background: #2d6a4f;
            color: white;
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 25px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-ver:hover {
            background: #1b4d3e;
            transform: scale(1.05);
        }
        .hero-categorias {
            background: #f0f7f0;
            text-align: center;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
        }
        .hero-categorias h2 {
            color: #2d6a4f;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .hero-categorias p {
            color: #555;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="logo"><h1>FridgeChef</h1></div>
        <nav>
            <a href="/">Inicio</a>
            <a href="/categorias" class="active">Categorías</a>
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

    <div class="hero-categorias">
        <h2>Explora nuestras categorías</h2>
        <p>Organiza tus recetas por tipo de comida y encuentra inspiración</p>
    </div>

    <div class="categorias-container">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="categorias-grid">
            @forelse($categorias as $categoria)
                <div class="card-categoria">
                    <div class="card-icon">
                        @php
                            $iconos = ['fa-utensils', 'fa-salad', 'fa-pizza-slice', 'fa-mug-hot', 'fa-ice-cream', 'fa-fish', 'fa-bread-slice', 'fa-apple-alt', 'fa-cake-candles'];
                            $icono = $iconos[$categoria->id_categoria % count($iconos)];
                        @endphp
                        <i class="fas {{ $icono }}"></i>
                    </div>
                    <div class="card-body-categoria">
                        <h3>{{ $categoria->nombre_categoria }}</h3>
                        <p>{{ $categoria->descripcion ?? 'Sin descripción' }}</p>
                        <a href="{{ route('categorias.show', $categoria) }}" class="btn-ver">
                            <i class="fas fa-eye"></i> Ver recetas
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center" style="grid-column: 1/-1; padding: 3rem;">
                    <i class="fas fa-inbox fa-4x" style="color: #ccc;"></i>
                    <h3>No hay categorías registradas</h3>
                    <p>No hay categorías disponibles en este momento.</p>
                </div>
            @endforelse
        </div>
    </div>

    <footer>
        <p>"Cocina sin desperdiciar, aprovecha cada ingrediente"</p>
        <p>Únete a FridgeChef, es completamente gratis</p>
    </footer>
</body>
</html>