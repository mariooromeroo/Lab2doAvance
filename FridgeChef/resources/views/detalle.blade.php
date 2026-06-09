<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $receta->titulo }} - FridgeChef</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/detalle.css') }}">
</head>
<body>

<header class="navbar">
    <div class="logo">
        <h1>FridgeChef</h1>
    </div>
    <nav>
        <a href="/">Inicio</a>
        <a href="{{ route('categorias.index') }}">Categorías</a>
        <a href="{{ route('mis-recetas') }}">Mis recetas</a>
        <a href="#">Sobre Nosotros</a>
    </nav>
    <div class="acciones">
        <form action="{{ route('busqueda') }}" method="GET">
            <input type="text" name="buscar" placeholder="Buscar..." value="{{ request('buscar') }}">
        </form>
        @if(auth()->check())
            <span class="usuario-nombre"> {{ auth()->user()->nombre }}</span>
            <form method="POST" action="{{ url('/logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn-cerrar-sesion">Cerrar Sesión</button>
            </form>
        @else
            <a href="{{ url('/login') }}" class="btn-iniciar-sesion">Iniciar Sesión</a>
        @endif
    </div>
</header>

<main class="contenedor-principal">
    {{-- Columna izquierda: Imagen y datos de la receta --}}
    <div class="izquierda">
        <div class="imagen-receta">
            <img src="{{ asset('img/' . ($receta->imagen ?? 'default.jpg')) }}" alt="{{ $receta->titulo }}">
        </div>

        <div class="info-receta">
            <h1>{{ $receta->titulo }}</h1>
            <div class="rating">
                <div class="estrellas">★★★★☆</div>
                <span>4.6 (128 opiniones)</span>
            </div>
            <div class="datos">
                <div class="dato">
                    <span>⏱ Tiempo total:</span>
                    <strong>{{ $receta->tiempo_preparacion }} min</strong>
                </div>
                <div class="dato">
                    <span>📊 Dificultad:</span>
                    <strong>Fácil</strong>
                </div>
                <div class="dato">
                    <span>🍽 Porciones:</span>
                    <strong>{{ $receta->porciones }} porciones</strong>
                </div>
            </div>
            <div class="descripcion">
                <p>{{ $receta->descripcion }}</p>
            </div>
            <button class="btn-compartir">📤 Compartir</button>
        </div>

        {{-- Ingredientes --}}
        <div class="ingredientes">
            <h2>🛒 Ingredientes</h2>
            <ul>
                @foreach($receta->ingredientes as $ingrediente)
                <li>{{ $ingrediente->nombre_ingrediente }} - {{ $ingrediente->pivot->cantidad }} {{ $ingrediente->pivot->unidad_medida }}</li>
                @endforeach
            </ul>
        </div>

        {{-- Preparación --}}
        <div class="preparacion">
            <h2>👨‍🍳 Preparación</h2>
            <div class="texto-preparacion">
                {!! nl2br(e($receta->preparacion)) !!}
            </div>
        </div>
    </div>

    {{-- Columna derecha: Comentarios --}}
    <div class="derecha">
        <div class="comentarios">
            <h3>Comentarios ({{ $receta->comentarios->count() }})</h3>

            @auth
            <form action="{{ route('comentario.store', $receta->id_receta) }}" method="POST" class="form-comentario">
                @csrf
                <textarea name="comentario" rows="3" placeholder="Escribe tu comentario..." required></textarea>
                <button type="submit">Publicar comentario</button>
            </form>
            @else
            <p class="login-para-comentar">Inicia sesión para dejar un comentario.</p>
            @endauth

            <div class="lista-comentarios">
                @forelse($receta->comentarios as $comentario)
                <div class="comentario">
                    <div class="comentario-header">
                        <strong>{{ $comentario->usuario->nombre ?? 'Usuario' }}</strong>
                        <span>{{ \Carbon\Carbon::parse($comentario->fecha_comentario)->diffForHumans() }}</span>
                        @auth
                            @if(Auth::id() === $comentario->id_usuario)
                            <form action="{{ route('comentario.destroy', $comentario->id_comentario) }}" method="POST" class="form-eliminar-comentario">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar este comentario?')">🗑️</button>
                            </form>
                            @endif
                        @endauth
                    </div>
                    <p class="comentario-texto">{{ $comentario->comentario }}</p>
                    <button class="btn-respuesta">Responde</button>
                </div>
                @empty
                <p class="sin-comentarios">Aún no hay comentarios. ¡Sé el primero en opinar!</p>
                @endforelse
            </div>
        </div>
    </div>
</main>

<footer>
    <p>🍽️ FridgeChef - Cocina sin desperdiciar, aprovecha cada ingrediente</p>
    <p>Únete a FridgeChef, es completamente gratis</p>
</footer>

</body>
</html>