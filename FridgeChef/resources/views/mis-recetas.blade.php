<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FridgeChef - Mis Recetas</title>
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
        <a href="{{ route('mis-recetas') }}" class="active">Mis recetas</a>
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
    <h1>Mis recetas</h1>
    <p>Tus recetas creadas y favoritas</p>
</div>

<div class="contenedor">
    @forelse($misRecetas as $receta)
    <div class="card">
        <img src="{{ asset('img/' . ($receta->imagen ?? 'default.jpg')) }}" alt="{{ $receta->titulo }}">
        <h3>{{ $receta->titulo }}</h3>
        <p>{{ $receta->descripcion ?? 'Sin descripción' }}</p>
        <div class="card-info">
            <span>⏱ {{ $receta->tiempo_preparacion }} min</span>
            <span>🍽 {{ $receta->porciones }} porciones</span>
        </div>
        <div class="card-botones">
            <a href="{{ route('receta.detalle', $receta->id_receta) }}" class="btn-ver">Ver receta</a>
            <a href="{{ route('receta.editar', $receta->id_receta) }}" class="btn-editar">Editar</a>
            <form action="{{ route('receta.destroy', $receta->id_receta) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-eliminar" onclick="return confirm('¿Eliminar esta receta?')">Eliminar</button>
            </form>
        </div>
    </div>
    @empty
    <div class="no-recetas">
        <p>Aún no tienes recetas creadas.</p>
    </div>
    @endforelse
</div>

<section class="nueva-receta">
    <h2>Agregar Nueva Receta</h2>
    <p>Comparte tu receta favorita con la comunidad.</p>
    <form action="{{ route('mis-recetas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
            <div class="form-section">
                <h3>Información Básica</h3>
                <div class="campo">
                    <label>Título</label>
                    <input type="text" name="titulo" required>
                </div>
                <div class="campo">
                    <label>Descripción</label>
                    <textarea name="descripcion" rows="3"></textarea>
                </div>
                <div class="campo">
                    <label>Categoría</label>
                    <select name="id_categoria" required>
                        <option value="">Selecciona...</option>
                        @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="campo-row">
                    <div class="campo">
                        <label>Tiempo (min)</label>
                        <input type="text" name="tiempo_preparacion">
                    </div>
                    <div class="campo">
                        <label>Dificultad</label>
                        <select name="dificultad">
                            <option value="Fácil">Fácil</option>
                            <option value="Media">Media</option>
                            <option value="Difícil">Difícil</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label>Porciones</label>
                        <input type="number" name="porciones">
                    </div>
                </div>
                <div class="campo">
                    <label>Imagen</label>
                    <input type="file" name="imagen">
                </div>
            </div>
            <div class="form-section">
                <h3>Ingredientes</h3>
                <div id="ingredientes-list">
                    <div class="ingrediente-row">
                        <input type="text" name="ingredientes[0][nombre]" placeholder="Ingrediente">
                        <input type="text" name="ingredientes[0][cantidad]" placeholder="Cantidad">
                        <input type="text" name="ingredientes[0][unidad]" placeholder="Unidad">
                    </div>
                </div>
                <button type="button" class="btn-agregar" onclick="agregarIngrediente()">+ Agregar ingrediente</button>
                <h3>Preparación</h3>
                <textarea name="preparacion" rows="8" style="width: 100%;"></textarea>
            </div>
        </div>
        <div class="form-acciones">
            <button type="submit" class="btn-publicar">Publicar Receta</button>
        </div>
    </form>
</section>

<footer>
    <p>FridgeChef - Cocina sin desperdiciar</p>
</footer>

<script>
    let ingredienteIndex = 1;
    function agregarIngrediente() {
        const container = document.getElementById('ingredientes-list');
        const div = document.createElement('div');
        div.className = 'ingrediente-row';
        div.innerHTML = `
            <input type="text" name="ingredientes[${ingredienteIndex}][nombre]" placeholder="Ingrediente">
            <input type="text" name="ingredientes[${ingredienteIndex}][cantidad]" placeholder="Cantidad">
            <input type="text" name="ingredientes[${ingredienteIndex}][unidad]" placeholder="Unidad">
            <button type="button" onclick="this.parentElement.remove()">❌</button>
        `;
        container.appendChild(div);
        ingredienteIndex++;
    }
</script>

</body>
</html>