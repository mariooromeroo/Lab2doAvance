<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría - FridgeChef</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 600px;
            margin: 3rem auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }
        .form-header {
            background: #2d6a4f;
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        .form-header h2 {
            margin: 0;
        }
        .form-body {
            padding: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #2d6a4f;
        }
        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
        }
        .form-group input:focus, 
        .form-group textarea:focus {
            outline: none;
            border-color: #2d6a4f;
        }
        .botones-form {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        .btn-actualizar {
            background: #2d6a4f;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .btn-actualizar:hover {
            background: #1b4d3e;
        }
        .btn-cancelar {
            background: #6c757d;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
        }
        .btn-cancelar:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="logo"><h1>FridgeChef</h1></div>
        <nav>
            <a href="/">Inicio</a>
            <a href="/categorias">Categorías</a>
            <a href="#">Mis recetas</a>
            <a href="#">Sobre Nosotros</a>
        </nav>
        <div class="acciones">
            <div class="acciones">
            <form action="{{ route('busqueda') }}" method="GET">

                 <input
                     type="text"
                     name="buscar"
                  placeholder="Buscar..."
                 >

            </form>
            <button>Iniciar Sesión</button>
        </div>
    </header>
            <button>Iniciar Sesión</button>
        </div>
    </header>

    <div class="form-container">
        <div class="form-header">
            <h2><i class="fas fa-edit"></i> Editar Categoría</h2>
        </div>
        <div class="form-body">
            <form action="{{ route('categorias.update', $categoria) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label> Nombre de la Categoría *</label>
                    <input type="text" name="nombre_categoria" value="{{ old('nombre_categoria', $categoria->nombre_categoria) }}" required>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" rows="4">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                </div>
                <div class="botones-form">
                    <a href="{{ route('categorias.index') }}" class="btn-cancelar">Cancelar</a>
                    <button type="submit" class="btn-actualizar">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>"Cocina sin desperdiciar, aprovecha cada ingrediente"</p>
        <p>Únete a FridgeChef, es completamente gratis</p>
    </footer>
</body>
</html>