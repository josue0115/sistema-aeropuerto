<x-guest-layout>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1474&q=80') no-repeat center center fixed;
            background-size: cover;
        }

        .login-card {
            background: #fff;
            width: 700px;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .login-card h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 0.5rem;
        }

        .login-card p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 2rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .input-group {
            position: relative;
        }

        .input-group svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #003366;
        }

        label {
            display: block;
            font-weight: 600;
            color: #003366;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            text-align: left;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem 0.75rem 0.75rem 2.5rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus {
            border-color: #003366;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 51, 102, 0.1);
        }

        .btn-login {
            background: linear-gradient(135deg, #003366, #0055a5);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            margin-top: 1rem;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #002244, #004080);
            transform: translateY(-2px);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            margin-top: 1rem;
        }

        .remember-forgot a {
            color: #003366;
            text-decoration: none;
            font-weight: 500;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .register-link {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .register-link a {
            color: #003366;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            color: #fff;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Minimal responsive for web focus */
        @media (max-width: 480px) {
            .login-card {
                width: 90%;
                padding: 2rem;
            }
        }
    </style>

    <div class="login-card">
        <h2>Accede a tu Panel de Vuelos</h2>
        <p>Sistema Aeropuerto - Gestión de Reservas</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
            </div>

            <div class="input-group">
                <label for="password">Contraseña</label>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox" name="remember"> Recordarme</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                @endif
            </div>

            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>

        <div class="register-link">
            @if (Route::has('register'))
                ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
            @endif
        </div>
    </div>

    <!-- <footer>Sistema Aeropuerto © {{ date('Y') }} - Gestión Integral de Vuelos</footer> -->
</x-guest-layout>
