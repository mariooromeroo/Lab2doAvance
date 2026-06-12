<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $receta->titulo }} - FridgeChef</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/detalle.css') }}">
</head>
<body>
@if(session('success'))
    <div id="toast-fav" style="
        position: fixed; top: 20px; right: 20px; z-index: 9999;
        background: #3a6b4a; color: white; padding: 12px 24px;
        border-radius: 10px; font-size: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    ">
        ⭐ {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            document.getElementById('toast-fav').style.display = 'none';
        }, 3000);
    </script>
@endif
<header class="navbar">
    <div class="logo"><h1>FridgeChef</h1></div>
    <nav>
        <a href="{{ url('/') }}">Inicio</a>
        <a href="{{ route('categorias.index') }}">Categorías</a>
        <a href="{{ route('mis-recetas') }}">Mis Recetas</a>
        <a href="{{ route('favoritos.index') }}">Favoritos</a>
        <a href="{{ route('sobre-nosotros') }}">Sobre Nosotros</a>
    </nav>
    <div class="acciones">
        <form action="{{ route('busqueda') }}" method="GET">
            <input type="text" name="buscar" placeholder="Buscar..." value="{{ request('buscar') }}">
        </form>
        @if(auth()->check())
            <span class="usuario-nombre">{{ auth()->user()->nombre }}</span>
            <form method="POST" action="{{ url('/logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-cerrar-sesion">Cerrar Sesión</button>
            </form>
        @else
            <a href="{{ url('/login') }}" class="btn-iniciar-sesion">Iniciar Sesión</a>
        @endif
    </div>
</header>

<div class="pagina-detalle">

    {{-- ===== COLUMNA IZQUIERDA: Receta ===== --}}
    <div class="col-receta">

        {{-- Imagen + info lado a lado --}}
        <div class="receta-top">
            <img class="receta-imagen"
                 src="{{ asset('img/' . ($receta->imagen ?? 'default.jpg')) }}"
                 alt="{{ $receta->titulo }}">

            <div class="receta-info">
                <h1 class="receta-titulo">{{ $receta->titulo }}</h1>

                <div class="rating">
                    <span class="estrellas">★★★★☆</span>
                    <span class="rating-texto">4.6 (128 opiniones)</span>
                </div>
                @auth
                <form action="{{ route('favoritos.toggle', $receta->id_receta) }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="btn-fav">
                        ⭐ Agregar a favoritos
                    </button>
                </form>
                @endauth
                <div class="datos-rapidos">
                    <div class="dato-item">
                        <i class="fas fa-tag"></i>
                        <span>Categoría: <strong>{{ $receta->categoria->nombre_categoria ?? 'Sin categoría' }}</strong></span>
                    </div>
                    <div class="dato-item">
                        <i class="far fa-clock"></i>
                        <span>Tiempo total: <strong>{{ $receta->tiempo_preparacion }} min</strong></span>
                    </div>
                    <div class="dato-item">
                        <i class="fas fa-signal"></i>
                        <span>Dificultad: <strong>Fácil</strong></span>
                    </div>
                    <div class="dato-item">
                        <i class="fas fa-users"></i>
                        <span>Porciones: <strong>{{ $receta->porciones }}</strong></span>
                    </div>
                </div>

                <p class="receta-descripcion">{{ $receta->descripcion }}</p>
            </div>
        </div>

        {{-- Ingredientes y preparación debajo --}}
        <div class="receta-cuerpo">

            <hr class="divisor">

            <h2 class="seccion-titulo">Ingredientes</h2>
            <ul class="lista-ingredientes">
                @foreach($receta->ingredientes as $ingrediente)
                    <li>
                        {{ $ingrediente->nombre_ingrediente }}
                        @if($ingrediente->pivot->cantidad)
                            — {{ $ingrediente->pivot->cantidad }} {{ $ingrediente->pivot->unidad_medida }}
                        @endif
                    </li>
                @endforeach
            </ul>

            <hr class="divisor">

            <h2 class="seccion-titulo">Preparación</h2>
            <div class="pasos-preparacion">
                @foreach(array_filter(explode("\n", $receta->preparacion)) as $index => $paso)
                    @if(trim($paso))
                        <div class="paso">
                            <div class="paso-num">{{ $index + 1 }}</div>
                            <p>{{ trim($paso) }}</p>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
    </div>

    {{-- ===== COLUMNA DERECHA: Comentarios ===== --}}
    <aside class="col-comentarios">

        <h3 class="comentarios-titulo">
            Comentarios ({{ $receta->comentarios->count() }})
        </h3>

        <div class="lista-comentarios">
            @forelse($receta->comentarios as $comentario)
                <div class="comentario-item">
                    <div class="comentario-header">
                        <div class="avatar-mini">
                            {{ strtoupper(substr($comentario->usuario->nombre ?? 'U', 0, 1)) }}
                        </div>
                        <div class="comentario-meta">
                            <span class="comentario-nombre">{{ $comentario->usuario->nombre ?? 'Usuario' }}</span>
                            <span class="comentario-fecha">{{ \Carbon\Carbon::parse($comentario->fecha_comentario)->diffForHumans() }}</span>
                        </div>
                        @auth
                            @if(Auth::id() === $comentario->id_usuario)
                                <form action="{{ route('comentario.destroy', $comentario->id_comentario) }}" method="POST" style="margin-left:auto;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-eliminar" onclick="return confirm('¿Eliminar este comentario?')">🗑️</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                    <div class="estrellas-mini">★★★★★</div>
                    <p class="comentario-texto">{{ $comentario->comentario }}</p>
                    <button class="btn-responder">↩ Responder</button>
                </div>
            @empty
                <p class="sin-comentarios">Aún no hay comentarios. ¡Sé el primero en opinar!</p>
            @endforelse
        </div>

        @auth
            <form action="{{ route('comentario.store', $receta->id_receta) }}" method="POST" class="form-comentario">
                @csrf
                <div class="form-autor">
                    <div class="avatar-mini">{{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}</div>
                    <span>{{ auth()->user()->nombre }}</span>
                </div>
                <textarea name="comentario" rows="3" placeholder="Escribe tu comentario..." required></textarea>
                <button type="submit" class="btn-publicar">Publicar comentario</button>
            </form>
        @else
            <p class="login-para-comentar">
                <a href="{{ url('/login') }}">Inicia sesión</a> para dejar un comentario.
            </p>
        @endauth

    </aside>

</div>

<footer>
    <p>🍽️ FridgeChef — Cocina sin desperdiciar, aprovecha cada ingrediente</p>
    <p>Únete a FridgeChef, es completamente gratis</p>
</footer>

</body>
</html>