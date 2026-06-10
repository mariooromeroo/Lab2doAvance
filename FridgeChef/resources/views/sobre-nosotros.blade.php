<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - FridgeChef</title>

    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sobre-nosotros.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<header class="navbar">
    <div class="logo">
        <h1>FridgeChef</h1>
    </div>

    <nav>
        <a href="/">Inicio</a>
        <a href="{{ route('categorias.index') }}">Categorías</a>
        <a href="{{ route('mis-recetas') }}">Mis Recetas</a>
        <a href="{{ route('favoritos.index') }}">Favoritos</a>
        <a href="{{ route('sobre-nosotros') }}" class="active">Sobre Nosotros</a>
    </nav>

    <div class="acciones">
        <form action="{{ route('busqueda') }}" method="GET">
            <input type="text" name="buscar" placeholder="Buscar...">
        </form>

        @if(auth()->check())
            <span>{{ auth()->user()->nombre }}</span>

            <form method="POST" action="{{ url('/logout') }}" style="display:inline;">
                @csrf
                <button type="submit">Cerrar Sesión</button>
            </form>
        @else
            <a href="{{ url('/login') }}" class="btn-iniciar-sesion">
                Iniciar Sesión
            </a>
        @endif
    </div>
</header>

<section class="about-container">

    <h1>Sobre FridgeChef</h1>

    <p class="subtitulo">
        Una plataforma gratuita para reducir el desperdicio de alimentos y descubrir nuevas recetas.
    </p>

    <p class="descripcion">
        FridgeChef es un proyecto desarrollado como solución a un problema real:
        el desperdicio de alimentos en los hogares y la falta de plataformas
        accesibles en español que permitan organizar recetas por categorías
        y encontrar ideas de cocina utilizando ingredientes disponibles.
    </p>

    <h2>¿Qué problema solucionamos?</h2>

    <div class="cards-problema">

        <div class="card">
            <div class="icono alerta">
                <i class="fas fa-triangle-exclamation"></i>
            </div>

            <h3>La situación actual</h3>

            <ul>
                <li>La mayoría de plataformas de recetas están en inglés.</li>
                <li>Muchas aplicaciones son de pago o poseen funciones limitadas.</li>
                <li>Se desperdician ingredientes por falta de ideas para cocinar.</li>
            </ul>
        </div>

        <div class="card">
            <div class="icono idea">
                <i class="fas fa-lightbulb"></i>
            </div>

            <h3>Nuestra Respuesta</h3>

            <ul>
                <li>FridgeChef es completamente gratuito y en español.</li>
                <li>Búsqueda de recetas utilizando ingredientes disponibles.</li>
                <li>Recetas organizadas por categorías fáciles de explorar.</li>
            </ul>
        </div>

    </div>

</section>

<footer>
    <p>"Cocina sin desperdiciar, aprovecha cada ingrediente"</p>
    <p>Únete a FridgeChef, es completamente gratis</p>
</footer>

</body>
</html>