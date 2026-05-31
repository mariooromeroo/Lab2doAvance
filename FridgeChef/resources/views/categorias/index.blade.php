<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías - FridgeChef</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/categorias.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="navbar">
        <div class="logo"><h1>FridgeChef</h1></div>
        <nav>
            <a href="/">Inicio</a>
            <a href="/categorias" class="active">Categorías</a>
           <a href="{{ route('mis-recetas') }}">Mis recetas</a>
            <a href="#">Sobre Nosotros</a>
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