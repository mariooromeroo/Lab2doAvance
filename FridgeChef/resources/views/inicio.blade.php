<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FridgeChef</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <h1>FridgeChef</h1>
        </div>
        <nav>
            <a href="#">Inicio</a>
            <a href="{{ route('categorias.index') }}">Categorías</a>
            <a href="{{ route('mis-recetas') }}">Mis recetas</a>
            <a href="#">Sobre Nosotros</a>
        </nav>
        <div class="acciones">
            <form action="{{ route('busqueda') }}" method="GET">
                <input type="text" name="buscar" placeholder="Buscar...">
            </form>
            <!-- Botón corregido -->
            <a href="{{ url('/login') }}">
                <button type="button">Iniciar Sesión</button>
            </a>
        </div>
    </header>

    <section class="hero">
        <h2>Cocina con lo que ya tienes en casa</h2>
        <p>Descubre recetas deliciosas usando ingredientes disponibles en tu refrigerador.</p>
        <button class="btn-principal">+ Crear Receta</button>
    </section>

    <section class="recetas">
        <h2>Recetas Destacadas</h2>
        <div class="contenedor-recetas">
            @foreach($recetas as $receta)
            <div class="card-receta">
                <div class="receta-imagen-placeholder">🍲</div>
                <h3>{{ $receta->titulo }}</h3>
                <p>⏱ {{ $receta->tiempo_preparacion }} min</p>
                <a href="{{ route('receta.detalle', $receta->id_receta) }}">
                    Ver receta
                </a>
            </div>
            @endforeach
        </div>
    </section>

    <section class="funciona">
        <h2>¿Cómo funciona?</h2>
        <div class="pasos">
            <div class="paso">
                <h3>1. Elige ingredientes</h3>
                <p>Selecciona lo que tienes disponible.</p>
            </div>
            <div class="paso">
                <h3>2. Encuentra recetas</h3>
                <p>Te mostramos recetas compatibles.</p>
            </div>
            <div class="paso">
                <h3>3. Cocina y disfruta</h3>
                <p>Aprovecha mejor tus alimentos.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>"Cocina sin desperdiciar, aprovecha cada ingrediente"</p>
        <p>Únete a FridgeChef, es completamente gratis</p>
    </footer>

</body>
</html>