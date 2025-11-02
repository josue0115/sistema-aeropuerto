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

        .register-card {
            background: #fff;
            width: 700px;
            padding: .5rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .register-card h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 0.5rem;
        }

        .register-card p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 2rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
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

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 0.75rem 0.75rem 0.75rem 2.5rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus,
        select:focus {
            border-color: #003366;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 51, 102, 0.1);
        }

        .btn-register {
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

        .btn-register:hover {
            background: linear-gradient(135deg, #002244, #004080);
            transform: translateY(-2px);
        }

        .login-link {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .login-link a {
            color: #003366;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
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
            .register-card {
                width: 90%;
                padding: 2rem;
            }
        }
    </style>

    <div class="overlay"></div>

    <div class="register-card">
        <h2>Únete al Sistema Aeropuerto</h2>
        <p>Regístrate para gestionar tus reservas y vuelos</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group">
                <label for="name">Nombre Completo</label>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="input-group">
                <label for="password">Contraseña</label>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="input-group">
                <label for="role">Rol en el Sistema</label>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <select id="role" name="role" required>
                    <option value="cliente" {{ old('role') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                    <option value="operador" {{ old('role') == 'operador' ? 'selected' : '' }}>Operador</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <button type="submit" class="btn-register">Crear Cuenta</button>
        </form>

        <div class="login-link">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia Sesión</a>
        </div>
    </div>

    <!-- <footer>Sistema Aeropuerto © {{ date('Y') }} - Gestión Integral de Vuelos</footer> -->
</x-guest-layout>
