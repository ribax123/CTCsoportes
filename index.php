<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--tabla js -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
  
        <!--estilo css-->
        <link rel="stylesheet" href="css/estilos.css">

      <title>CTC SOPORTE</title>
  </head>
  <body>
    <br/>
    <br/>
    <div class = "container fondo" >

    <h1 class="text-center">CTC SOPORTE</h1>
    
    <div class = "row">
      <div class = "col-2 offset-10">
          <div class ="text-center">
              
          <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary W-100" 
                data-bs-toggle="modal" data-bs-target="#modalUsuario" 
                id = "botonCrear">
                <i class = "bi bi-plus-circle-fill"></i> Crear          
          </button>
        </div>
      </div>
    </div>
    <br/>
    <br/>
    
      
      <div class = "table-responcive">
          <table id="datos_soportes" class ="table table-bordered 
          table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th>Creacion</th>
                <th>Estado</th>
                <th>Solucion</th>
                <th>Evidencia</th>
                <th>Editar</th>
                <th>Borrar</th>
              </tr>
        </thead>
      </table>
      </div>
    </div>    
    
    <!-- Modal -->

      <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Soporte</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
                <div class="modal-body">

              <form method = "POST" id="formulario" enctype ="multipart/form-data">
                  <div class = "modal-content"> 
                  
                  <label for="descripcion">Descripción</label>
                  <input type="text" name ="descripcion" id = "descripcion" class = "form-control">
                  <br>

                  <label for="creacion">creacion</label>
                  <input type="text" name ="creacion" id = "creacion" class = "form-control">
                  <br>

                  <label for="estado">Estado</label>
                  <input type="text" name ="estado" id = "estado" class = "form-control">
                  <br>

                  <label for="solucion">Descripción/solucion</label>
                  <input type="text" name ="solucion" id = "solucion" class = "form-control">
                  <br>

                  <label for="imagen">Adjuntar datos</label>
                  <input type="file" name ="imagen" id = "imagen" class = "form-control">
                  <span id = "imagen_subida"></span>
                  <br />
                  
                  </div>

                  <div class="modal-footer">
                    <input type="hidden" name="id_soporte" id="id_soporte">
                    <input type="hidden" name="operacion" id="operacion">
                    <input type="submit" name="action" id="action" 
                    class = "btn btn-success" value ="Crear">
                    
                    
                    <!--
                    <button type="button"  class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary"id data-bs-dismiss="modal">Close</button>
                    -->
                </div>
                </div>
              </form>
            </div>
          </div>
      
    <!--include jquery.dataTables-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
    crossorigin="anonymous"></script>
    
      <!--jquery datatables js-->
      <br><script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" 
      defer ></script>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2
    /dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>

    <script type ="text/javascript">
      
    $(document).ready(function() {
      $("#botonCrear").click(function(){
        $("#formulario")[0].reset();
        $("#operacion").val("Crear");
        $(".modal-title").text("Crear Usuario");
        $("#action").val("Crear");
        $("#imagen_subida").html("");
            
            
          });
          
          
        
        var dataTable = $('#datos_soportes').DataTable({
          "processing" : true,
          "serverSide" : true,
          "order" : [],
          "ajax" : {
            url: "obtener_registros.php",
            type: "POST"
          },

          "columnsDefs" :[
            {
              "targets" :[0, 3, 4],
              "orderable": false,
            },
          ]
        
      });

      
      $(document).on('submit', '#formulario', function(event){
        event.preventDefault();
        var descripcion =$("#descripcion").val();
        var estado =$("#estado").val();
        var solucion =$("#solucion").val();
        var extension =$("#imagen").val().split('.').pop().toLowerCase();
        

        if (extension != ''){
          if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg'])== -1){
            alert('Formato de imagen inválido');
            $("#imagen").val('');
          return false;
        }
      }

      if(descripcion != '' && estado != '' && solucion != ''){
        console.log(estado)
        $.ajax({
          url: "crear.php",
          method: "POST",
          data:new FormData(this),
          contentType:false,
          processData:false,
          success:function(data)
          {
            alert(data);
            $('#formulario')[0].reset();
            $('#modalusuario').modal('hide');
            dataTable.ajax.reload()

          }
        });
      }else{
        alert("Algunos campos son obligatorios")
      }      
    });

    //function editar
    $(document).on('click', '.editar', function(){
      var id_soporte = $(this).attr('id');
      $.ajax({
        url :"obtener_registro.php",
        method:"POST",
        data: {id_soporte:id_soporte},
        dataType:"json",
        success:function(data){

          console.log(data);
          console.log(data.obtener_nombre_imagen);
          $('#modalUsuario').modal('show');
          $('#descripcion').val(data.descripcion);
          $('#creacion').val(data.creacion);
          $('#estado').val(data.estado);
          $('#solucion').val(data.solucion);
          $('.modal-title').text('Editar');
          $('#id_soporte').val(id_soporte);
          $('#imagen_subida').html(data.imagen);
          $('#action').val('Editar');
          $('#operacion').val('Editar');        
        },

        error:function(jqXHR, textStatus, errorThrown){
          console.log(textStatus, errorThrown);
        }
      })
    });

// Funcionalidad de borrar
    $(document).on('click', '.borrar', function(){
      var id_soporte = $(this).attr('id');
      if(confirm("¿Esta seguro que desea eliminar el registro? + id_usuario"))
      {
        $.ajax({
          url:"borrar.php",
          method: "POST",
          data: {id_soporte:id_soporte},
          success:function(data)
          {
            alert(data);
            dataTable.ajax.reload();
          }
        });
      }
      else
      {
          return false;
      }

    });

  });
    
    
      </script>
    
  </body>
</html>