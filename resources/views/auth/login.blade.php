
<style>
      {
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }  
    *:before,
    *:after {
        box-sizing: inherit;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333333;
    }

    body {
        background-color: #f3f4f6;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-wrapper {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 30px;
        width: 400px;
    }
    

    .login-form {
    margin-right: auto; /* Center horizontally */
    margin-left: auto; /* Center horizontally */
    padding: 20px;
    position: relative;
    z-index: 1;
    width: 400px;
}

.form-field-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #555555;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #cccccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .form-field {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

        .remember-me,
        .forgot-password,
    .registered-link {
        text-align: center;
        color: #666666;
        text-decoration: none;
    }

    .login-button {
        background-color: #007bff;
        color: #ffffff;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .login-button:hover {
        background-color: #0056b3;
    }

       
        .login-buttons {
            margin-right: 70px;
            margin-left: 70px;
            display: flex;
            justify-content:space-between ;
            align-items: center; /* Pour aligner les éléments verticalement */
            margin-top: 35px;
            
            /* Ajout de l'espace au-dessus des boutons */
        }
        

        .registered-link,
        .forgot-password a {
            color: #4a5568;
        }
        
    </style>
<body>
    <img src="{{ asset('img/background-img.jpg') }}" style="height: 100%; width: 100%; object-fit: cover; position: fixed; top: 0; left: 0; z-index: -1;" />

    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="login-wrapper">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-field-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-field-group">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-field">
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    Se souvenir
                </label>
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                @endif
            </div>
            <button type="submit" class="login-button">Se connecter</button>
        </form>
        <div class="form-field">
            <a class="registered-link" href="{{ route('register') }}">Je n'ai pas de compte !</a>
        </div>
    </div>
    
</body>