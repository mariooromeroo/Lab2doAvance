<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $categoria->nombre_categoria }} - FridgeChef</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/categorias.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="navbar">
        <div class="logo"><h1>FridgeChef</h1></div>
        <nav>
            <a href="/">Inicio</a>
            <a href="/categorias">Categorías</a>
            <a href="{{ route('mis-recetas') }}">Mis recetas</a>
            <a href="{{ route('favoritos.index') }}">Favoritos</a>
            <a href="{{ route('sobre-nosotros') }}">Sobre Nosotros</a>
        </nav>
        <div class="acciones">
            <form action="{{ route('busqueda') }}" method="GET">
                <input type="text" name="buscar" placeholder="Buscar...">
            </form>
            <a href="{{ url('/login') }}">
                <button type="button">Iniciar Sesión</button>
            </a>
        </div>
    </header>

    <div class="detalle-container">
        <div class="categoria-header">
            <div class="categoria-icono">
                @php
                    $iconoPorCategoria = [
                    'Platos Fuertes' => 'fa-utensils',
                    'Ensaladas' => 'fa-leaf',
                    'Pastas' => 'fa-utensil-spoon',
                    'Sopas' => 'fa-mug-hot',
                    'Postres' => 'fa-ice-cream'
                ];
                $icono = $iconoPorCategoria[$categoria->nombre_categoria] ?? 'fa-utensils';
                @endphp
                <i class="fas {{ $icono }}"></i>
            </div>
            <h1>{{ $categoria->nombre_categoria }}</h1>
            <p>{{ $categoria->descripcion ?? 'Sin descripción' }}</p>
        </div>

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
                            <a href="{{ route('receta.detalle', $receta->id_receta) }}" class="btn-ver-receta">
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

            <div class="text-center mt-3">
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