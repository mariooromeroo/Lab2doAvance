<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $categoria->nombre_categoria }} - FridgeChef</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .detalle-container {
            max-width: 550px;
            margin: 3rem auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }
        .detalle-header {
            background: #2d6a4f;
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        .detalle-header h2 {
            margin: 0;
            font-size: 1.8rem;
        }
        .detalle-icono {
            background: white;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: -35px auto 0 auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .detalle-icono i {
            font-size: 2rem;
            color: #2d6a4f;
        }
        .detalle-body {
            padding: 2rem;
        }
        .detalle-info {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .info-row {
            display: flex;
            padding: 0.8rem 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            width: 120px;
            color: #2d6a4f;
        }
        .info-value {
            flex: 1;
            color: #333;
        }
        .detalle-descripcion {
            background: #f0f7f0;
            border-radius: 15px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #2d6a4f;
            font-style: italic;
        }
        .botones-detalle {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }
        .btn-detalle {
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-editar-detalle {
            background: #ffc107;
            color: #333;
        }
        .btn-editar-detalle:hover {
            background: #e0a800;
        }
        .btn-eliminar-detalle {
            background: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn-eliminar-detalle:hover {
            background: #c82333;
        }
        .btn-volver {
            background: #2d6a4f;
            color: white;
        }
        .btn-volver:hover {
            background: #1b4d3e;
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
            <input type="text" placeholder="Buscar...">
            <button>Iniciar Sesión</button>
        </div>
    </header>

    <div class="detalle-container">
        <div class="detalle-header">
            <h2><i class="fas fa-tag"></i> Detalles</h2>
        </div>
        <div class="detalle-icono">
            @php
                $iconos = ['fa-utensils', 'fa-salad', 'fa-pizza-slice', 'fa-mug-hot', 'fa-ice-cream', 'fa-fish', 'fa-bread-slice', 'fa-apple-alt', 'fa-cake-candles'];
                $icono = $iconos[$categoria->id_categoria % count($iconos)];
            @endphp
            <i class="fas {{ $icono }}"></i>
        </div>
        <div class="detalle-body">
            <div class="detalle-descripcion">
                "{{ $categoria->descripcion ?? 'Sin descripción' }}"
            </div>
            <div class="detalle-info">
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-id-card"></i> ID:</div>
                    <div class="info-value">{{ $categoria->id_categoria }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-tag"></i> Nombre:</div>
                    <div class="info-value"><strong>{{ $categoria->nombre_categoria }}</strong></div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-calendar-alt"></i> Fecha Creación:</div>
                    <div class="info-value">{{ $categoria->created_at ? $categoria->created_at->format('d/m/Y H:i') : 'No registrada' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-sync-alt"></i> Última Actualización:</div>
                    <div class="info-value">{{ $categoria->updated_at ? $categoria->updated_at->format('d/m/Y H:i') : 'No registrada' }}</div>
                </div>
            </div>
            <div class="botones-detalle">
                <a href="{{ route('categorias.index') }}" class="btn-detalle btn-volver">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <a href="{{ route('categorias.edit', $categoria) }}" class="btn-detalle btn-editar-detalle">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-detalle btn-eliminar-detalle" onclick="return confirm('¿Eliminar esta categoría?')">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p>"Cocina sin desperdiciar, aprovecha cada ingrediente"</p>
        <p>Únete a FridgeChef, es completamente gratis</p>
    </footer>
</body>
</html>