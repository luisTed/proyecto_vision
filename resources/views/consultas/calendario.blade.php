@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')
<style>
    .fc-toolbar-title {
        text-transform: uppercase;
    }
</style>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        let formulario = document.querySelector("form");
        var botonGuardar = document.getElementById("botonGuardar");
        var botonModificar = document.getElementById("botonModificar");
        var botonEliminar = document.getElementById("botonEliminar");

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            displayEventTime: false,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
                list: 'Lista'
            },
            
            events: "{{ route('consulta.show') }}",
            dateClick: function(info) {
                formulario.reset();
                formulario.fecha.value = info.dateStr;
                $("#verModal").modal("show"); // Utiliza verModal para nueva consulta
            },
            eventClick: function(info) {
                var cons = info.event;
                console.log(cons);

                axios.post("{{ route('consulta.edit', '') }}/" + cons.id)
                    .then((respuesta) => {
                        formulario.id.value = respuesta.data.id;
                        formulario.nombre.value = respuesta.data.nombre;
                        formulario.fecha.value = respuesta.data.fecha;
                        formulario.hora.value = respuesta.data.hora;
                        formulario.contacto.value = respuesta.data.contacto;
                        formulario.descripccion.value = respuesta.data.descripccion;

                        // Mostrar y ocultar botones según la acción
                        botonModificar.style.display = "block";
                        botonEliminar.style.display = "block";
                        botonGuardar.style.display = "none";

                        $("#verModal").modal("show");
                    })
                    .catch(error => {
                        if (error.response) {
                            console.log(error.response.data);
                        }
                    });
            }
        });

        calendar.render();

        document.getElementById("botonGuardar").addEventListener("click", function() {
            enviarDatos("{{ route('consulta.store') }}");
        });

        document.getElementById("botonEliminar").addEventListener("click", function() {
          aceptarEliminar();
            // enviarDatos("{{ route('consulta.destroy','') }}/" + formulario.id.value);
        });

        document.getElementById("botonModificar").addEventListener("click", function() {
          // aceptaredicion();
            enviarDatos("{{ route('consulta.update','') }}/" + formulario.id.value); //-----------------------------------mensaje deeditar
        });

        $('#verModal').on('hidden.bs.modal', function () {
            // Desactiva los botones
            botonModificar.style.display = "none";
            botonEliminar.style.display = "none";
            botonGuardar.style.display = "block";
        });

        function enviarDatos(url) {
            const datos = new FormData(formulario);
            axios.post(url, datos)
                .then((respuesta) => {
                  $("#verModal").modal("hide");
                  calendar.refetchEvents();
                    if (respuesta.data.message) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: respuesta.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
                .catch(error => {
                    if (error.response) {
                      Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: 'el campo nombre es obligatorio',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
        }
        function aceptarEliminar(){
          Swal.fire({
          title: "¿Estás  seguro?",
          text: "¡No podrás revertir esto!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, Eliminar!"
        }).then((result) => {
          if (result.isConfirmed) {
            enviarDatos("{{ route('consulta.destroy','') }}/" + formulario.id.value);
          }
        });
        }
        function aceptaredicion(){
          Swal.fire({
          title: "¿Estás  seguro?",
          text: "¡No podrás revertir esto!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, editar!"
        }).then((result) => {
          if (result.isConfirmed) {
            enviarDatos("{{ route('consulta.update','') }}/" + formulario.id.value);
          }
        });
        }
    });
</script>

<!-- <style>
  #calendar-container {
    max-width: 800px; /* Establece el ancho máximo del contenedor del calendario según tus necesidades */
    margin: 0 auto; /* Centra el contenedor del calendario en el contenedor padre */
  }

  #calendar {
    width: 100%; /* Hace que el calendario ocupe todo el ancho del contenedor */
  }
</style> -->

<!-- <div id='calendar-container'>
  <div id='calendar'></div>
</div><br> -->
<div id='calendar'></div>

    <!-- modal para cuando se preicona la fecha -->
<div class="modal" id="verModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Consulta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- formulario para recoleccion de datos -->
        <form action="">


        {!! csrf_field() !!}

            <div class="form-group" style="display:none;">
            <label for="id">id</label>
            <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="">
            <small id="helpId" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
              <label for="nombre">Nombre:</label>
              <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="">
              <small id="helpId" class="form-text text-muted"></small>
            </div>


            <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="" value="2023-11-04">
            <small id="helpId" class="form-text text-muted">Ejemplo: 03/01/2024</small>
          </div>

          <div class="form-group">
            <label for="hora">Hora:</label>
            <input type="time" class="form-control" name="hora" id="hora" aria-describedby="helpId" placeholder="" value="12:00">
            <small id="helpId" class="form-text text-muted">Ejemplo: 12:00</small>
          </div>

          <div class="form-group">
            <label for="contacto">Teléfono de contacto:</label>
            <input type="number" class="form-control" name="contacto" id="contacto" aria-describedby="helpId" placeholder="" value="" min="0" max="9999999999">
            <small id="helpId" class="form-text text-muted">Ingrese un número de teléfono de 10 dígitos sin guiones, espacios o corchetes.</small>
          </div>

          <div class="form-group">
            <label for="descripccion">Descripción:</label>
            <textarea class="form-control" name="descripccion" id="descripccion" rows="3"></textarea>
            <small id="helpId" class="form-text text-muted">maximo de 90 palabras</small>
          </div>

        </form>

      </div> 
      <!-- area de botones -->
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger"  id="botonEliminar" >Eliminar</button>
        <button type="button" class="btn btn-warning" id="botonModificar" >Actualizar</button>
        <button type="button" class="btn btn-primary" id="botonGuardar"  >Aceptar</button>

        
      </div>
    </div>
  </div>
</div>

<script>
    var boton = document.getElementById("botonModificar");
    boton.style.display = "none";
    var boton2 = document.getElementById("botonEliminar");
    boton2.style.display = "none";
</script>


@endsection