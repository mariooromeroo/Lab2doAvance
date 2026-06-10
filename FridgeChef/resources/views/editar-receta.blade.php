<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Receta - FridgeChef</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mis-recetas.css') }}">
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
        <a href="{{ route('favoritos.index') }}">Favoritos</a>
        <a href="{{ route('sobre-nosotros') }}">Sobre Nosotros</a>
    </nav>
    <div class="acciones">
        <form action="{{ route('busqueda') }}" method="GET">
            <input type="text" name="buscar" placeholder="Buscar...">
        </form>
        @if(auth()->check())
            <span>{{ auth()->user()->nombre }}</span>
            <form method="POST" action="{{ url('/logout') }}" style="display: inline;">
                @csrf
                <button type="submit">Cerrar Sesión</button>
            </form>
        @else
            <a href="{{ url('/login') }}">Iniciar Sesión</a>
        @endif
    </div>
</header>

<div class="titulo">
    <h1>Editar receta</h1>
    <p>Modifica los datos de tu receta</p>
</div>

<section class="nueva-receta">
    <form action="{{ route('receta.update', $receta->id_receta) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-section">
                <h3>Información Básica</h3>
                <div class="campo">
                    <label>Título de la receta</label>
                    <input type="text" name="titulo" value="{{ old('titulo', $receta->titulo) }}" required>
                </div>
                <div class="campo">
                    <label>Descripción corta</label>
                    <textarea name="descripcion" rows="3">{{ old('descripcion', $receta->descripcion) }}</textarea>
                </div>
                <div class="campo">
                    <label>Categoría *</label>
                    <select name="id_categoria" required>
                        <option value="">Selecciona una categoría...</option>
                        @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}" {{ $receta->id_categoria == $categoria->id_categoria ? 'selected' : '' }}>
                            {{ $categoria->nombre_categoria }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="campo-row">
                    <div class="campo">
                        <label>Tiempo total (minutos)</label>
                        <input type="number" name="tiempo_preparacion" value="{{ old('tiempo_preparacion', $receta->tiempo_preparacion) }}" required>
                    </div>
                    <div class="campo">
                        <label>Dificultad</label>
                        <select name="dificultad">
                        <option value="Fácil" {{ $receta->dificultad == 'Fácil' ? 'selected' : '' }}>Fácil</option>
                        <option value="Media" {{ $receta->dificultad == 'Media' ? 'selected' : '' }}>Media</option>
                        <option value="Difícil" {{ $receta->dificultad == 'Difícil' ? 'selected' : '' }}>Difícil</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label>Porciones</label>
                        <input type="number" name="porciones" value="{{ old('porciones', $receta->porciones) }}" required>
                    </div>
                </div>
                <div class="campo">
                    <label>Imagen actual</label>
                    @if($receta->imagen)
                        <img src="{{ asset('img/' . $receta->imagen) }}" style="width: 100px; display: block; margin-bottom: 10px;">
                    @endif
                    <input type="file" name="imagen" accept="image/*">
                    <small>Dejar en blanco para mantener la imagen actual</small>
                </div>
            </div>

            <div class="form-section">
                <h3>Ingredientes</h3>
                <p>Agrega todos los ingredientes que necesita tu receta.</p>
                <div id="ingredientes-list">
                    @foreach($receta->ingredientes as $index => $ing)
                    <div class="ingrediente-row">
                        <input type="text" name="ingredientes[{{ $index }}][nombre]" value="{{ $ing->nombre_ingrediente }}" placeholder="Ingrediente">
                        <input type="text" name="ingredientes[{{ $index }}][cantidad]" value="{{ $ing->pivot->cantidad }}" placeholder="Cantidad" style="width: 100px;">
                        <input type="text" name="ingredientes[{{ $index }}][unidad]" value="{{ $ing->pivot->unidad_medida }}" placeholder="Unidad" style="width: 100px;">
                        <button type="button" class="btn-eliminar-fila" onclick="this.parentElement.remove()">❌</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn-agregar" onclick="agregarIngrediente()">+ Agregar ingrediente</button>

                <h3 style="margin-top: 30px;">Preparación</h3>
                <textarea name="preparacion" rows="10" style="width: 100%;">{{ old('preparacion', $receta->preparacion) }}</textarea>
            </div>
        </div>

        <div class="form-acciones">
            <a href="{{ route('mis-recetas') }}" class="btn-cancelar">Cancelar</a>
            <button type="submit" class="btn-publicar">Guardar cambios</button>
        </div>
    </form>
</section>

<footer>
    <p>🍽️ FridgeChef - Cocina sin desperdiciar, aprovecha cada ingrediente</p>
    <p>Únete a FridgeChef, es completamente gratis</p>
</footer>

<script>
    let ingredienteIndex = {{ $receta->ingredientes->count() }};

    function agregarIngrediente() {
        const container = document.getElementById('ingredientes-list');
        const div = document.createElement('div');
        div.className = 'ingrediente-row';
        div.innerHTML = `
            <input type="text" name="ingredientes[${ingredienteIndex}][nombre]" placeholder="Ingrediente">
            <input type="text" name="ingredientes[${ingredienteIndex}][cantidad]" placeholder="Cantidad" style="width: 100px;">
            <input type="text" name="ingredientes[${ingredienteIndex}][unidad]" placeholder="Unidad" style="width: 100px;">
            <button type="button" class="btn-eliminar-fila" onclick="this.parentElement.remove()">❌</button>
        `;
        container.appendChild(div);
        ingredienteIndex++;
    }
</script>

</body>
</html>