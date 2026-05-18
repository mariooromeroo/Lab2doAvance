<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $receta->titulo }}</title>

    <link rel="stylesheet" href="{{ asset('css/detalle.css') }}">

    <!-- ICONOS -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<div class="contenedor-principal">

    <!-- IMAGEN -->
    <div class="imagen-receta">

        <img src="{{ asset('img/' . $receta->imagen) }}"
             alt="{{ $receta->titulo }}">

    </div>

    <!-- INFORMACION -->
    <div class="info-receta">

        <h1>{{ $receta->titulo }}</h1>

        <!-- ESTRELLAS -->
        <div class="rating">

            <div class="estrellas">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>

            <span>4.6 (128 opiniones)</span>

        </div>

        <!-- DATOS -->
        <div class="datos">

            <div class="dato">
                <i class="far fa-clock"></i>

                <div>
                    <span>Tiempo total</span>
                    <strong>{{ $receta->tiempo_preparacion }} min</strong>
                </div>
            </div>

            <div class="dato">
                <i class="fas fa-hat-chef"></i>

                <div>
                    <span>Dificultad</span>
                    <strong>Fácil</strong>
                </div>
            </div>

            <div class="dato">
                <i class="fas fa-users"></i>

                <div>
                    <span>Porciones</span>
                    <strong>{{ $receta->porciones }} porciones</strong>
                </div>
            </div>

        </div>

        <!-- DESCRIPCION -->
        <p class="descripcion">
            {{ $receta->descripcion }}
        </p>

        <!-- BOTON -->
        <button class="btn-compartir">
            <i class="fas fa-share-alt"></i>
            Compartir
        </button>

    </div>

</div>

<!-- CONTENIDO ABAJO -->
<div class="contenido">

    <!-- INGREDIENTES -->
    <div class="ingredientes">

        <h2>Ingredientes</h2>

        <ul>

        @foreach($receta->ingredientes as $ingrediente)

        <li>
            {{ $ingrediente->pivot->cantidad }}
            {{ $ingrediente->pivot->unidad_medida }}
            de
            {{ $ingrediente->nombre_ingrediente }}
        </li>

        @endforeach

        </ul>

    </div>

    <!-- PREPARACION -->
    <div class="preparacion">

        <h2>Preparación</h2>

        <p class="texto-preparacion">
            {!! nl2br(e($receta->preparacion)) !!}
        </p>

    </div>

</div>

</body>
</html>