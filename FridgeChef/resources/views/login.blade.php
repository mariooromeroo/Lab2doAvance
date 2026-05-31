<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FridgeChef - Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-body">
                <h2>Iniciar sesión</h2>
                <p>Ingresa tus datos para acceder a tu cuenta</p>
                
                @if($errors->any())
                    <div class="alert alert-error">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
                @endif
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                <form method="POST" action="{{ url('/login') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label>Correo electrónico</label>
                        <input type="email" name="correo" 
                            value="{{ old('correo', (isset($_COOKIE['remember_email']) && $_COOKIE['remember_email'] != 'deleted' && $_COOKIE['remember_email'] != '') ? $_COOKIE['remember_email'] : '') }}" 
                            placeholder="ejemplo@correo.com" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Contraseña</label>
                        <div class="password-input">
                            <input type="password" name="password" id="password" placeholder="Tu contraseña" required>
                            <span class="toggle-password" onclick="togglePassword()"></span>
                        </div>
                    </div>
                    
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember" {{ isset($_COOKIE['remember_email']) && $_COOKIE['remember_email'] != 'deleted' && $_COOKIE['remember_email'] != '' ? 'checked' : '' }}>
                            <span>Recordarme</span>
                        </label>
                        <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
                    </div>
                    
                    <button type="submit" class="btn-login">Iniciar sesión</button>
                </form>
                
                <div class="register-link">
                    ¿No tienes cuenta? <a href="#" onclick="showRegisterForm(); return false;">Regístrate aquí</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal de Registro -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Crear cuenta</h2>
                <span class="close" onclick="closeRegisterModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('/register') }}">
                    @csrf
                    <div class="form-group">
                        <label>Nombre completo</label>
                        <input type="text" name="nombre" placeholder="Tu nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Correo electrónico</label>
                        <input type="email" name="correo" placeholder="ejemplo@correo.com" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Contraseña</label>
                        <div class="password-input">
                            <input type="password" name="password" id="reg_password" placeholder="Mínimo 6 caracteres" required>
                            <span class="toggle-password" onclick="togglePassword('reg_password')"></span>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-login">Registrarse</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId = 'password') {
            const field = document.getElementById(fieldId);
            if (field.type === 'password') {
                field.type = 'text';
            } else {
                field.type = 'password';
            }
        }
        
        function showRegisterForm() {
            document.getElementById('registerModal').style.display = 'block';
        }
        
        function closeRegisterModal() {
            document.getElementById('registerModal').style.display = 'none';
        }
        
        window.onclick = function(event) {
            const modal = document.getElementById('registerModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>