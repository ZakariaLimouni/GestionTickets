
<style>
        
    *:before,
    *:after {
        box-sizing: inherit;
    }

    h1 {
        text-align: center;
    }

    body {
        background-image: url('{{ asset('img/background-img.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #C8E6C9;
    }

    .login-wrapper {
        background-color: #C8E6C9;
        position: relative;
        width: 792px;
        display: flex;
    }

    .login-image {
       margin-left:30;
       margin-top:25;
        margin-bottom:auto;
    }

    .login-image img {
        width: 265px;
        height: 265px;
    }

    .login-form {
        margin-right: 25px;
        padding: 20px;
        position: relative;
        z-index: 1;
        width: 400px;
    }

    .form-field-group {
        margin-bottom: 15px;
    }

    label {
        display: inline-block;
        margin-bottom: 10px;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .form-field {
            display: flex;
            justify-content: space-between; /* Pour espacer les éléments horizontalement */
            align-items: center; /* Pour aligner les éléments verticalement */
        }

        .remember-me,
        .forgot-password {
            margin-top: 4px;
           
        }
        .forgot-password{
            color:#4a5568;
        }

        .login-button {
    background-color: #092911;
    color: white;
    padding: 7px 20px;
    border: none;
    font-size: 17px;
    border-radius: 7px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.login-button:hover {
    background-color: #ADF2CE;
    color: darkgreen;
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
    <img  src="{{ asset('img/background-img.jpg') }} " style="height: 100%;
            width: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            position:fixed" />

    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="login-wrapper">
        <!-- Form section -->
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <!-- Email Address -->
            <div class="form-field-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-field-group">
                <x-input-label for="password" :value="__('Mot de pass')" />
                <x-text-input id="password" class="block mt-1" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="form-field">
            <!-- Remember Me -->
            <div >
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span class="ms-2 text-sm">{{ __('Se souvenir') }}</span>
                </label>
            </div>
            
            <!-- Forgot Password -->
                <div >
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié?') }}
                        </a>
                    @endif
                </div>
</div>
<div class="login-buttons">
            <!-- Login Button -->
                <a class="registered-link" href="{{ route('register') }}">{{ __('J\'ai pas un compte!') }}</a>
                <button type="submit" class="login-button" style="width: 200px">{{ __('Se connecter') }}</button>
    </div>          
        </form>

        <!-- Image section -->
        <div class="login-image">
            <img src="{{ asset('img/sdtm_sa_logo.jpg') }}" alt="Image" />
        </div>
    </div>
</body>