<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<script>
  setTimeout(() => {
    let alert = document.getElementById('alert-success');
    if(alert){
      alert.style.transition = "opacity 0.5s";
      alert.style.opacity = "0";
      setTimeout(() => alert.remove(), 500);
    }
  }, 3000);
</script>

<script>
  function editarUsuario(user){
    document.querySelector('[name="name"]').value = user.name;
    document.querySelector('[name="email"]').value = user.email;
    document.querySelector('[name="cellPhone_number"]').value = user.cellPhone_number;
    document.querySelector('[name="city"]').value = user.city;
    document.querySelector('[name="country"]').value = user.country;

    // Rol
    document.querySelectorAll('[name="role"]').forEach(r => {
      r.checked = (r.value === user.role);
    });

    // Cambiar acción del formulario
    let form = document.querySelector('form');
    form.action = '/usuarios/' + user.id;

    // Agregar método PUT si no existe
    if(!document.getElementById('method-put')){
      let input = document.createElement('input');
      input.type = 'hidden';
      input.name = '_method';
      input.value = 'PUT';
      input.id = 'method-put';
      form.appendChild(input);
    }

    // Cambiar texto del botón
    form.querySelector('button').innerText = 'Actualizar Usuario';
  }
</script>


<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary text-white text-center">
          <h4>Registro de Usuario</h4>
        </div>

        <div class="card-body">

        @if(session('success'))
          <div id="alert-success" class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

          <form method="POST" action="{{ route('usuarios.store') }}">
            @csrf

            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" name="name" 
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}"
              >

              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Correo</label>
              <input type="email" name="email" 
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
              >

              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Celular</label>
              <input type="number" name="cellPhone_number" 
                class="form-control @error('cellPhone_number') is-invalid @enderror"
                value="{{ old('cellPhone_number') }}"
              >

              @error('cellPhone_number')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Rol</label>

              <div class="form-check">
                <!-- <input class="form-check-input @error('role') is-invalid @enderror" type="radio" name="role" value="admin"> -->
                 <input type="radio" name="role" value="admin" {{ old('role') == 'admin' ? 'checked' : '' }}>
                <label class="form-check-label">Administrador</label>
              </div>

              <div class="form-check">
                <!-- <input class="form-check-input @error('role') is-invalid @enderror" type="radio" name="role" value="user"> -->
                 <input type="radio" name="role" value="user" {{ old('role') == 'user' ? 'checked' : '' }}>
                <label class="form-check-label">Usuario</label>
              </div>

              @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Ciudad</label>
              <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                value="{{ old('city') }}"
              >

              @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">País</label>
              <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
                value="{{ old('country') }}"
              >

              @error('country')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-grid">
              <button class="btn btn-success">
                Guardar Usuario
              </button>
            </div>

          </form>

        </div>

      </div>
    </div>
  </div>
  
  <div class="card mt-5 shadow">
    <div class="card-body">    
      
      <h4 class="mb-3">Usuarios Registrados</h4>
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Celular</th>
              <th>Rol</th>
              <th>Ciudad</th>
              <th>País</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse($usuarios ?? [] as $user)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->cellPhone_number }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->city }}</td>
                <td>{{ $user->country }}</td>
                <td>
                  <button class="btn btn-warning btn-sm" onclick="editarUsuario({{ $user }})">
                    Editar
                  </button>

                  <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este usuario?')">
                      Eliminar
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center">
                  No hay usuarios registrados
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
  
    </div>
  </div>

</div>

