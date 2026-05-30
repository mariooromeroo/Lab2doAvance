<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda</title>
    <link rel="stylesheet" href="{{ asset('css/busqueda.css?v=2') }}">
</head>
<body>

<!-- NAVBAR -->

<header class="navbar">

    <div class="logo">
        <h1>FridgeChef</h1>
    </div>

    <nav>
        <a href="/">Inicio</a>
        <a href="{{ route('categorias.index') }}">Categorías</a>
        <a href="#">Mis recetas</a>
        <a href="#">Sobre Nosotros</a>
    </nav>

    <div class="acciones">

        <form action="{{ route('busqueda') }}" method="GET">

            <input
                type="text"
                name="buscar"
                placeholder="Buscar..."
                value="{{ $buscar }}"
            >

        </form>

        <button>
            Iniciar Sesión
        </button>

    </div>

</header>

<!-- TITULO -->

<div class="titulo">

    <h1>
        Resultados de búsqueda
    </h1>

    <h2>
        Se encontraron {{ count($recetas) }} recetas
    </h2>

</div>

<!-- RECETAS -->

<div class="contenedor">

@foreach($recetas as $receta)

    <div class="card">

        <img src="{{ asset('img/' . $receta->imagen) }}">

        <h3>
            {{ $receta->titulo }}
        </h3>

        <p>
            {{ $receta->descripcion }}
        </p>

        <a href="{{ route('receta.detalle', $receta->id_receta) }}">
            Ver receta
        </a>

    </div>

@endforeach

</div>

</body>
</html>