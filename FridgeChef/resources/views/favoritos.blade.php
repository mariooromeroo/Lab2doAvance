<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FridgeChef - Favoritos</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <h1>FridgeChef</h1>
        </div>
        <nav>
            <a href="{{ url('/') }}">Inicio</a>
            <a href="{{ route('categorias.index') }}">Categorías</a>
            <a href="{{ route('mis-recetas') }}">Mis recetas</a>
            <a href="{{ route('favoritos.index') }}" class="active">Favoritos</a>
            <a href="{{ route('sobre-nosotros') }}">Sobre Nosotros</a>
        </nav>
        <div class="acciones">
            <form action="{{ route('busqueda') }}" method="GET">
                <input type="text" name="buscar" placeholder="Buscar...">
            </form>
            @if(auth()->check())
                <span class="usuario-nombre">{{ auth()->user()->nombre }}</span>
                <form method="POST" action="{{ url('/logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-cerrar-sesion">Cerrar Sesión</button>
                </form>
            @else
                <a href="{{ url('/login') }}" class="btn-iniciar-sesion">Iniciar Sesión</a>
            @endif
        </div>
    </header>

    <section class="contenedor-favoritos" style="padding: 2rem;">
        <h2>⭐ Mis Favoritos</h2>

        @if(session('success'))
            <div class="alerta-success">{{ session('success') }}</div>
        @endif

        @if($favoritos->isEmpty())
            <p>No tienes recetas guardadas aún.</p>
        @else
            <div class="contenedor-recetas">
                @foreach($favoritos as $fav)
                    <div class="card-receta">
                        <div class="receta-imagen-placeholder">🍲</div>
                        <h3>{{ $fav->receta->titulo }}</h3>
                        <p>⏱ {{ $fav->receta->tiempo_preparacion }} min</p>
                        <a href="{{ route('receta.detalle', $fav->receta->id_receta) }}">
                            Ver receta
                        </a>
                        <form action="{{ route('favoritos.toggle', $fav->receta->id_receta) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-quitar-receta" style="border:none; cursor:pointer;">
                            🗑 Quitar
                        </button>
                    </form>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <footer>
        <p>"Cocina sin desperdiciar, aprovecha cada ingrediente"</p>
        <p>Únete a FridgeChef, es completamente gratis</p>
    </footer>

</body>
</html>