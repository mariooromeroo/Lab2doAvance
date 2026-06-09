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
        <a href="{{ route('mis-recetas') }}">Mis recetas</a>
        <a href="#">Sobre Nosotros</a>
    </nav>
    <div class="acciones">
    <form action="{{ route('busqueda') }}" method="GET">
        <input type="text" name="buscar" placeholder="Buscar...">
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

{{-- Título principal --}}
<div class="titulo">
    <h1>Mis recetas</h1>
    <p>Tus recetas creadas y favoritas</p>
</div>

{{-- Listado de recetas del usuario --}}
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
            <a href="#" class="btn-editar">Editar</a>
            <button class="btn-eliminar" onclick="confirmarEliminacion({{ $receta->id_receta }})">Eliminar</button>
        </div>
    </div>
    @empty
    <div class="no-recetas">
        <p> Aún no tienes recetas creadas.</p>
        <p>Completa el formulario de abajo para agregar tu primera receta.</p>
    </div>
    @endforelse
</div>

{{-- Formulario para agregar nueva receta --}}
<section class="nueva-receta">
    <h2>Agregar Nueva Receta</h2>
    <p>Comparte tu receta favorita con la comunidad.</p>

    <form action="{{ route('mis-recetas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">
            <div class="form-section">
                <h3>Información Básica</h3>
                <div class="campo">
                    <label>Título de la receta</label>
                    <input type="text" name="titulo" placeholder="Ej. Pollo al Horno con Hierbas" required>
                </div>
                <div class="campo">
                    <label>Descripción corta</label>
                    <textarea name="descripcion" rows="3" placeholder="Describe tu receta en pocas palabras..."></textarea>
                </div>
                <div class="campo">
                    <label>Categoría *</label>
                    <select name="id_categoria" required>
                        <option value="">Selecciona una categoría...</option>
                        @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="campo-row">
                    <div class="campo">
                        <label>Tiempo total</label>
                        <input type="text" name="tiempo_preparacion" placeholder="Ej. 45 min">
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
                        <input type="number" name="porciones" placeholder="Ej. 4">
                    </div>
                </div>
                <div class="campo">
                    <label>Imagen de la receta</label>
                    <div class="subir-imagen">
                        <label for="imagen">Haz clic para subir una imagen</label>
                        <input type="file" name="imagen" id="imagen" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3>Ingredientes</h3>
                <p>Agrega todos los ingredientes que necesita tu receta.</p>
                <div id="ingredientes-list">
                    <div class="ingrediente-row">
                        <input type="text" name="ingredientes[0][nombre]" placeholder="Ingrediente">
                        <input type="text" name="ingredientes[0][cantidad]" placeholder="Cantidad" style="width: 100px;">
                        <input type="text" name="ingredientes[0][unidad]" placeholder="Unidad" style="width: 100px;">
                    </div>
                </div>
                <button type="button" class="btn-agregar" onclick="agregarIngrediente()">+ Agregar ingrediente</button>

                <h3 style="margin-top: 30px;">Preparación</h3>
                <p>Describir paso a paso cómo preparar tu receta.</p>
                <textarea name="preparacion" rows="6" placeholder="Ej. Precalienta el horno a 200°C..."></textarea>
                <button type="button" class="btn-agregar">+ Agregar pasos</button>
            </div>
        </div>

        <div class="form-acciones">
            <button type="button" class="btn-cancelar">Cancelar</button>
            <button type="submit" class="btn-publicar">Publicar Receta</button>
        </div>
    </form>
</section>

<footer>
    <p>🍽️ FridgeChef - Cocina sin desperdiciar, aprovecha cada ingrediente</p>
    <p>Únete a FridgeChef, es completamente gratis</p>
</footer>

<script>
    let ingredienteIndex = 1;

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

    function confirmarEliminacion(id) {
        if (confirm('¿Estás seguro de que quieres eliminar esta receta?')) {
            // Aquí iría la llamada AJAX o el formulario para eliminar
            alert('Receta eliminada (simulación)');
        }
    }
</script>

</body>
</html>