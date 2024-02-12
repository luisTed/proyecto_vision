<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($mensaje = Session::get('success'))
    <script>
        // Esperar 2 segundos (2000 milisegundos) antes de mostrar el mensaje de Swal
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "{{$mensaje}}",
                showConfirmButton: false,
                timer: 3000
            });
    </script>
@endif
<form action="" method="GET">
    @csrf
<div class="form-group">
  <label for="nombre">Nombre:</label>
  <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="">
  <small id="helpId" class="form-text text-muted"></small>
</div>
<div class="form-group">
  <label for="Contraseña"></label>
  <input type="text" class="form-control" name="contraseña" id="contraseña" aria-describedby="helpId" placeholder="">
  <small id="helpId" class="form-text text-muted"></small>
</div>
<div class="col-12 mt-2">
    <button id="entrar" type="button" class="btn btn-primary" >
        entrar
    </button>
</div>
</form>