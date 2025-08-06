<?php
 date_default_timezone_set('America/Bogota');
 $raiz = dirname(dirname(dirname(__file__)));
//  die($raiz);
 require_once($raiz.'/calendario/models/GrabarEventoModel.php');  
 
class calendarioView
{

    protected $modelGrabarEvento;

    public function __construct()
    {
        $this->modelGrabarEvento = new GrabarEventoModel();
    }
    public function menuPrincipal()
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <style>
                @media (max-width: 768px) {
                    #calendar {
                        font-size: 14px;
                    }
                    .fc-dayGridMonth-view .fc-day {
                        min-height: 50px; /* Reduce el tamaño de los días */
                    }
                    .fc-toolbar {
                        flex-direction: column; /* Acomoda los botones arriba */
                        align-items: center;
                    }
                }
                #calendar {
                    background-color: #f4f4f4; /* Color de fondo gris claro */
                    padding: 10px;
                    border-radius: 10px;
                }
                .fc-daygrid-day {
                    background-color: #ffffff; /* Fondo blanco para los días */
                }
                .fc-col-header-cell {
                    background-color: white !important; /* Azul */
                    color: white !important; /* Texto blanco */
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <!-- <div align="center"> <img src="../logos/logokaymo.png" width="120px;"></div> -->
            <!-- <h1>Calendario Citas Kaymo</h1> -->

            <div id='calendar'></div>
            <?php  $this->modalEventos(); ?>
            <?php  $this->modalEventoExistente(); ?>

        </body>
        </html>
       
        <script>
            
            document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es', // Configurar el idioma en español
                initialView: 'dayGridMonth',
                height: '500px',
                // initialView: window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth',
                events: 'models/EventoModel.php', // Cargar eventos desde PHP
                selectable: true,
                selectMirror:false,
                headerToolbar: {
                    left: 'prev,next today', // Botones de navegación
                    center: 'title', // Título del calendario
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek' // Botones de vista
                },                eventStartEditable: true,
                eventDrop: function(info) {
                    let nuevaFecha = info.event.start.toISOString().split('T')[0];
                    let id = info.event.id;
                    let opcion = 'actualizarEvento'
                    fetch("calendario.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `opcion=${opcion}&id=${id}&nuevaFecha=${nuevaFecha}`
                    }).then(() => calendar.refetchEvents());


                },
                dateClick: function(info) {
                    let fecha = info.dateStr;
                    // alert('buenas ');
                    limpiarCamposModal();
                    //limpiar campos de modal 
                    mostrarModal();
                    ponerFechaEnFormuEvento(fecha);

              
                },
                eventClick: function(info) {
                    mostrarModalEventoExistente(info.event.id);
                    // alert(info.event);
                    // alert("id:"+info.event.id+ "Título: " + info.event.title + "\nDescripción: " + info.event.extendedProps.description);
                }
            });
            calendar.render();
        });
        
        function mostrarModal(){
            $("#modalEventos").modal("show");
        }
        
        function mostrarModalEventoExistente(id){
            // alert(id);
            // document.getElementById("bodyModaleventoexistente").innerHTML = '1234657989';
            
            const http=new XMLHttpRequest();
            const url = 'calendario.php';
            http.onreadystatechange = function(){
                        if(this.readyState == 4 && this.status ==200)
                        {
                            // var  resp = JSON.parse(this.responseText); 
                                    $("#modalEventoExistente").modal("show");
                                    document.getElementById("bodyModaleventoexistente").innerHTML = this.responseText;
                        }
                    };
                    http.open("POST",url);
                    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    http.send("opcion=traerInfoEventoExistente"
                            + "&id="+id
                        );
            }// fin de mostrar modal 

            function ponerFechaEnFormuEvento(fecha)
            {
                document.getElementById('fechaPuente').value=fecha;
            } 

            function limpiarCamposModal()
            {
                document.getElementById("divResultadosVerificacionPlaca").innerHTML ='';
                document.getElementById("txtPlaca").value = '';
                document.getElementById("email").value = '';
                document.getElementById("txtDescripcion").value = '';

            }
            

        </script> 
        <script>

            $('#btnAgregar').click(function(){
                let valida = validarCamposFormuEvento();
                if(valida){
                    let fecha = document.getElementById('fechaPuente').value;
                    let placa = document.getElementById('txtPlaca').value;
                    let hora = document.getElementById('txtHora').value;
                    let email = document.getElementById('email').value;
                    let servicio = document.getElementById('txtDescripcion').value;
                    let nombre = document.getElementById('txtNombre').value;
                    let telefono = document.getElementById('txtTelefono').value;
                    let flagPlaca = document.getElementById('flagPlaca').value;
                    let opcion = 'grabarEvento';
                    //grabar el evento 
                    fetch("calendario.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `opcion=${opcion}&fecha=${fecha}&placa=${placa}&hora=${hora}&email=${email}&servicio=${servicio}&nombre=${nombre}&telefono=${telefono}&flagPlaca=${flagPlaca}`
                    }).then(() => calendar.refetchEvents());

                    $("#modalEventos").modal("hide");
                    location.reload();
                }   
            });


            


            function validarCamposFormuEvento(){

                if(document.getElementById("txtHora").value == '00:00')
                {
                    alert("Escoja una hora valida ") ;  
                    document.getElementById("txtHora").focus();
                    return 0;
                }
                if(document.getElementById("txtPlaca").value == '')
                {
                    alert("Digite Placa") ;  
                    document.getElementById("txtPlaca").focus();
                    return 0;
                }
                if(document.getElementById("txtNombre").value == '')
                {
                    alert("Digite Nombre") ;  
                    document.getElementById("txtNombre").focus();
                    return 0;
                }
                if(document.getElementById("txtTelefono").value == '')
                {
                    alert("Digite Telefono") ;  
                    document.getElementById("txtTelefono").focus();
                    return 0;
                }
                if(document.getElementById("email").value == '')
                {
                    alert("Digite email") ;  
                    document.getElementById("email").focus();
                    return 0;
                }
                if(document.getElementById("txtDescripcion").value == '')
                {
                    alert("Digite descripcion") ;  
                    document.getElementById("txtDescripcion").focus();
                    return 0;
                }
                return 1;
            }

           

            function updateEvent(eventData) {
                var event = calendar.getEventById(eventData.id);
                alert(event);
                // if (event) {
                //     event.setProp('title', eventData.title);
                //     event.setStart(eventData.start);
                //     event.setEnd(eventData.end);
                // }
                // calendar.rerenderEvents(); // Redibujar eventos sin perder la vista actual
            }


            // $('#btnEliminar').click(function(){
            //     RecolectarDatosGui();
            //     EnviarInformacion('eliminar',NuevoEvento);
            // });

            // $('#btnModificar').click(function(){
            //     RecolectarDatosGui();
            //     EnviarInformacion('modificar',NuevoEvento);
            // });

        // function EnviarInformacion(accion,objEvento,modal){
        //     $.ajax({
        //         type:'POST',
        //         url:'eventos.php?accion='+accion,
        //         data:objEvento,
        //         success:function(msg){
        //             if(msg){
        //                 $("#calendario").fullCalendar('refetchEvents');
        //                 if(!modal){
        //                     $("#modalEventos").modal('toggle');
        //                 }
        //             }
        //         },
        //         error: function(){
        //                 alert('Hay un error');
        //         }
        //     })
        // }
        function EnviarInformacion()
        {
            let fecha = document.getElementById('fechaPuente').value;
            let placa = document.getElementById('txtPlaca').value;
            let hora = document.getElementById('txtHora').value;
            let email = document.getElementById('email').value;
            let servicio = document.getElementById('txtDescripcion').value;
            
            alert('Se envio la informacion '+placa);
            fetch("guardar_cita.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `fecha=${fecha}&placa=${placa}&hora=${hora}&email=${email}&servicio=${servicio}`
                }).then(() => 'abc');
        }    

        function verifiquePlaca()
        {
            let placa = document.getElementById('txtPlaca').value;
            const http=new XMLHttpRequest();
            const url = '../vehiculos/vehiculos.php';
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    var  resp = JSON.parse(this.responseText); 
                    // console.log(this.responseText);
                    // alert(resp.filas);
                    if(resp.filas){
                        document.getElementById("divResultadosVerificacionPlaca").style.color='green';
                        document.getElementById("divResultadosVerificacionPlaca").innerHTML = 'Placa Esta registrada en el sistema';
                        document.getElementById("email").value = resp.datos.email;
                        document.getElementById("txtNombre").value = resp.datos.nombre;
                        document.getElementById("txtTelefono").value = resp.datos.telefono;
                        document.getElementById("flagPlaca").value = 1;
                    }else{
                        document.getElementById("divResultadosVerificacionPlaca").style.color='red';
                        document.getElementById("divResultadosVerificacionPlaca").innerHTML = 'Placa No existe -Sera creada en la base de datos ';
                        //limpiar campos 
                        document.getElementById("email").value = '';
                        document.getElementById("txtNombre").value = '';
                        document.getElementById("txtTelefono").value = '';
                        document.getElementById("txtDescripcion").value = '';
                        document.getElementById("flagPlaca").value = 0;
                    
                    
                    }
                }
            };
            http.open("POST",url);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send("opcion=buscarPlacaSimpleTraerInfoPlacaYProp"
                    + "&placa="+placa
                );
        }

        
 function formuCrearOrdenDesdeAgenda(idEvento)
 {

        const http=new XMLHttpRequest();
        const url = 'calendario.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                console.log(this.responseText);
                document.getElementById("bodyModaleventoexistente").innerHTML = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=formuCrearOrdenDesdeAgenda"
                + "&idEvento="+idEvento
            );
}
 function crearOrdenAgenda(idEvento)
 {
    let kilometraje = document.getElementById('kilometraje').value;
        const http=new XMLHttpRequest();
        const url = 'calendario.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                console.log(this.responseText);
                document.getElementById("bodyModaleventoexistente").innerHTML = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=crearOrdenAgenda"
                + "&idEvento="+idEvento
                + "&kilometraje="+kilometraje
            );
}




        </script>   
        <?php
    }


    public function modalEventos()
    {
        ?>
         <!--aqui comienza el modal -->
            <div class="modal fade" id="modalEventos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agendamiento de Cita</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                     <?php  $this->mostrarFormuNuevoEvento();  ?>
                </div>
                <div class="modal-footer">

                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnAgregar">Agregar</button>
                    <!-- <button type="button" class="btn btn-success" id="btnModificar">Modificar</button>
                    <button type="button" class="btn btn-danger" id="btnEliminar" >Eliminar</button> -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <!-- aqui termina el modal -->

        <?php
    }
    public function modalEventoExistente()
    {
        ?>
         <!--aqui comienza el modal -->
            <div class="modal fade" id="modalEventoExistente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Informacion Cita</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bodyModaleventoexistente">

                </div>
                <div class="modal-footer">

                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-success" id="btnAgregar">Agregar</button>
                    <button type="button" class="btn btn-success" id="btnModificar">Modificar</button>
                    <button type="button" class="btn btn-danger" id="btnEliminar" >Eliminar</button> -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <!-- aqui termina el modal -->

        <?php
    }

    public function mostrarFormuNuevoEvento()
    {
        ?>
        <div class="row">
            <span>La franja de atencion es lunes a viernes de 8am a 5pm y Sabados de 8am a 2 pm..</span>
            <div class="col-lg-4">
                <label>Fecha:</label>
                <input type="text" class="form-control" id ="fechaPuente" onfocus="blur();">
            </div>

            <div class="col-lg-4">
            <label>Hora:</label>
            <div class="input-group flatpickr" data-autoclose="true">
                        <!-- <input type="text" id="txtHora" value="10:30" class="form-control"> -->
                         <?php  
                         $opcionesHoras60 = $this->generarOpcionesHoras(60);
                         ?>
                         <select name="txtHora" id="txtHora" class="form-control">
                                <?php
                                    echo $opcionesHoras60;
                                ?>
                         </select>
                </div>
            </div>
            
            <!-- <div class="col-lg-4" id="divResultadosVerificacionPlaca">
                      
            </div> -->
        </div>
        <!-- <input type ="text" id="fechaPuente"> -->
        <div class="container row">
            <input type="hidden" id ="flagPlaca" name = "flagPlaca" value=0>
            <div class="col-lg-4">
                <label>Placa:</label>
                <input type="text" class="form-control" id ="txtPlaca" onkeyup="verifiquePlaca();">
            </div>
            <div class="col-lg-6 mt-3" id="divResultadosVerificacionPlaca"></div>
            
                <div class="col-lg-12">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" id ="txtNombre">
                </div>
                <div class="col-lg-12">
                    <label>Telefono:</label>
                    <input type="text" class="form-control" id ="txtTelefono">
                </div>
                <div class="col-lg-12">
                        <label>Email:</label>
                        <input type="text" class="form-control" id ="email">
                </div>

                <div class="col-lg-12" >
                            <label for="">Motivo de la visita:</label>
                            <textarea id="txtDescripcion" name="txtDescripcion" rows="3" class="form-control" ></textarea>
                </div>    
                        <!-- <div class="form-group col-lg-12" >
                            <label for=""> Color : </label>
                        <input type="color"  value="#ff0000" id="txtColor" name="txtColor" class="form-control" style="height:36x;">
                        </div>   -->

                    </div>

        <?php
    }
    public function formuEventoExistente($evento)
    {
       $infoCLiente = $this->modelGrabarEvento->traerClienteConPlaca($evento['placa']);  
       $verifiOrdenCreada = $this->modelGrabarEvento->verificarOrdenCreada($evento);  
        //     echo '<pre>';
        //    print_r($verifiOrdenCreada);
        //    echo '</pre>';
        //    die();      
       ?>
        <div class="row">
           
            <div class="col-lg-4">
                <label>Fecha:</label>
                <input type="text" class="form-control" id ="fechaPuente"  onfocus="blur();" value ="<?php echo $evento['fecha']; ?>">
            </div>

            <div class="col-lg-4">
            <label>Hora:</label>
            <div class="input-group flatpickr" data-autoclose="true">
                        <!-- <input type="text" id="txtHora" value="10:30" class="form-control"> -->
                         <?php  
                                $opcionesHoras60 = $this->generarOpcionesHorasYSeleccionadaUna(60,$evento['hora']) 
                         ?>
                         <select name="txtHora" id="txtHora" class="form-control">
                                <?php
                                    echo $opcionesHoras60;
                                ?>
                         </select>
                </div>
            </div>
            
            <!-- <div class="col-lg-4" id="divResultadosVerificacionPlaca">
                      
            </div> -->
        </div>
        <!-- <input type ="text" id="fechaPuente"> -->
        <div class="container row">
            <input type="hidden" id ="flagPlaca" name = "flagPlaca" value=0>
            <div class="col-lg-4">
                <label>Placa:</label>
                <input type="text" class="form-control" id ="txtPlaca" value="<?php echo $evento['placa'];  ?>">
            </div>
            <?php  if($verifiOrdenCreada['filas']==0){?>
                <div class="col-lg-4">
                    <label>Crear Orden</label>
                    <button class="btn btn-primary" onclick="formuCrearOrdenDesdeAgenda('<?php echo $evento['id'];  ?>');">Crear Orden</button>
                </div>
            <?php }else{
                 $orden = $this->modelGrabarEvento->traerUltimaOrdenPlaca($evento['placa']);
            ?>
                <div class="col-lg-4">
                    <label>Numero Orden</label>
                    <label><?php echo $orden['orden'];  ?></label>
                </div>
            <?php } ?>


            
            <div class="col-lg-6 mt-3" id="divResultadosVerificacionPlaca"></div>
            
                <div class="col-lg-12">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" id ="txtNombre"  value="<?php echo $infoCLiente['nombre'];  ?>"    >
                </div>
                <div class="col-lg-12">
                    <label>Telefono:</label>
                    <input type="text" class="form-control" id ="txtTelefono"  value="<?php echo $infoCLiente['telefono'];  ?>"">
                </div>
                <div class="col-lg-12">
                        <label>Email:</label>
                        <input type="text" class="form-control" id ="email"  value="<?php echo $evento['email'];  ?>">
                </div>

                <div class="col-lg-12" >
                            <label for="">Motivo de la visita:</label>
                            <textarea id="txtDescripcion" name="txtDescripcion" rows="3" class="form-control" > <?php echo $evento['servicio'];  ?></textarea>
                </div>    
                        <!-- <div class="form-group col-lg-12" >
                            <label for=""> Color : </label>
                        <input type="color"  value="#ff0000" id="txtColor" name="txtColor" class="form-control" style="height:36x;">
                        </div>   -->

                    </div>

        <?php
    }

    public function  generarOpcionesHoras($intervaloMinutos = 30) {
        $opciones = '';
        $inicioDia = 0; // Representa las 00:00 en minutos
        $finDia = 24 * 60 - 1; // Representa las 23:59 en minutos
    
        for ($minutos = $inicioDia; $minutos <= $finDia; $minutos += $intervaloMinutos) {
            $hora = floor($minutos / 60);
            $minuto = $minutos % 60;
            $horaFormateada = sprintf('%02d:%02d', $hora, $minuto);
            $opciones .= '<option value="' . $horaFormateada . '">' . $horaFormateada . '</option>';
        }
    
        return $opciones;
    }
    public function  generarOpcionesHorasYSeleccionadaUna($intervaloMinutos = 30,$horaEvento) {
        // die('HORA EVENTO '.substr($horaEvento,0,5));
        $opciones = '';
        $inicioDia = 0; // Representa las 00:00 en minutos
        $finDia = 24 * 60 - 1; // Representa las 23:59 en minutos
    
        for ($minutos = $inicioDia; $minutos <= $finDia; $minutos += $intervaloMinutos) {
            $hora = floor($minutos / 60);
            $minuto = $minutos % 60;
            $horaFormateada = sprintf('%02d:%02d', $hora, $minuto);
            if( $horaFormateada == substr($horaEvento,0,5))
            {
                $opciones .= '<option selected value="' . $horaFormateada . '">' . $horaFormateada . '</option>';
            }else {
                $opciones .= '<option  value="' . $horaFormateada . '">' . $horaFormateada . '</option>';
            }
        }
    
        return $opciones;
    }

    public function formuCrearOrdenDesdeAgenda($idEvento)
    {
        $infoEvento = $this->modelGrabarEvento->traerEventoId($idEvento);
        // echo 'llego a las vista '; 
        //mostrar nombre
        //mostrar dats de la placa 
        ?>
        <div class="row">
            <div class="col-lg-4">
                <label>Placa:</label>
                <label><?php   echo $infoEvento['placa']; ?></label>
            </div>
            <div class="col-lg-4">
                <label>Kilometraje:</label>
                <input type="text"  id="kilometraje"  >
            </div>

        </div>
        <div>
            <button class="btn btn-primary" onclick="crearOrdenAgenda('<?php echo  $infoEvento['id'] ?>')">Crear Orden</button>
        </div>

        <?php
    }

}



?>