@extends('plantilla.layouts.form')

@section('content')
 <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="auth-wrapper auth-cover">
                <div class="auth-inner row m-0 justify-content-center align-items-center mb-2">
                    
                    
                    <!-- Login Form -->
                    <div class="col-12 col-sm-10 col-md-6 col-lg-4">
                      <div class="text-center">
                        <!-- <img src="{{ asset('images/imagenes/sjl_logo1.png') }}" alt="Logo" 
                             style="max-width: 350px; margin-top: 10px;"> -->
                    </div>
                      <div class="card border-0 shadow rounded-4">
                        <div class="card-body p-4 p-md-5">
                          <!-- Formulario -->
                          <form class="auth-login-form" action="{{ route('login') }}" method="POST" novalidate="novalidate">                            <input type="hidden" name="_token" value="R4wg0C7r3H21lNt22TMlJu8uVq6r2R2Af9KqP3YR" autocomplete="off"> <!-- Genera el token CSRF automáticamente -->
                            @csrf
                            <!-- Título -->
                            <p class="text-center fw-bold mb-4" style="font-size: 1.8rem;">GENERADOR DE QR</p>
                            
                            <!-- Usuario -->
                            <div class="mb-3">
                              <label class="form-label" for="user_name">Usuario</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Ingrese su usuario" required="" autofocus="" value="">
                              </div>
                            </div>
          
                            <!-- Contraseña -->
                            <div class="mb-3">
                              <label class="form-label" for="login-password">Contraseña</label>
                              <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" id="login-password" name="password" class="form-control" placeholder="Ingrese su contraseña" required="">
                                <span class="input-group-text toggle-password" style="cursor: pointer;"><i class="fas fa-eye"></i></span>
                              </div>
                            </div>
                            
                            <!-- Recordarme -->
                            <div class="form-check mb-3">
                              <input class="form-check-input" type="checkbox" id="remember" name="remember">
                              <label class="form-check-label" for="remember">Recuérdame</label>
                            </div>
                            
                            <!-- Botón Ingresar -->
                            <div class="d-grid">
                              <button type="submit" class="btn btn-primary btn-lg waves-effect waves-float waves-light">INGRESAR</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
          </div>









            {{-- <!-- Login Form -->
            <div class="col-12 col-sm-10 col-md-6 col-lg-4">
              <div class="card border-0 shadow rounded-4">
                <div class="card-body p-4 p-md-5">
                  <!-- Formulario -->
                  <form class="auth-login-form" action="{{ route('login') }}" method="POST" novalidate="novalidate">
                    @csrf <!-- Genera el token CSRF automáticamente -->
                    
                    <!-- Título -->
                    <p class="text-center fw-bold mb-4" style="font-size: 1.8rem;">Aplicativo Informático de Fiscalización</p>
                    
                    <!-- Usuario -->
                    <div class="mb-3">
                      <label class="form-label" for="user_name">Usuario</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Ingrese su usuario" required autofocus value="{{ old('user_name') }}">
                      </div>
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                      <label class="form-label" for="login-password">Contraseña</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" id="login-password" name="password" class="form-control" placeholder="Ingrese su contraseña" required>
                        <span class="input-group-text toggle-password" style="cursor: pointer;"><i class="fas fa-eye"></i></span>
                      </div>
                    </div>
                    
                    <!-- Recordarme -->
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" id="remember" name="remember">
                      <label class="form-check-label" for="remember">Recuérdame</label>
                    </div>
                    
                    <!-- Botón Ingresar -->
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary btn-lg waves-effect waves-float waves-light">INGRESAR</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </div> --}}

<!-- Script para mostrar/ocultar contraseña -->
<script>
document.querySelector('.toggle-password').addEventListener('click', function (e) {
  const passwordInput = document.getElementById('login-password');
  const icon = this.querySelector('i');

  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    icon.classList.remove('fa-eye');
    icon.classList.add('fa-eye-slash');
  } else {
    passwordInput.type = 'password';
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
  }
});
</script>


@endsection


