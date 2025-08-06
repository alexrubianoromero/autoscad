<?php

$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/vista/vista.php');

class VehiculoVista extends vista
{





    public function pantallaCreacionVehiculo(){

        ?>

            <div>

                <?php $this->infoMoto($datosMoto); ?>

                    <button class="btn btn-default">GRABAR VEHICULO</button>

                </div>



            </body>

        <?php



    }





    public function pantallainicialVehiculos($datosVehiculos){

        ?>

           <!DOCTYPE html>

            <html lang="en">

            <head>

                <meta charset="UTF-8">

                <meta http-equiv="X-UA-Compatible" content="IE=edge">

                <meta name="viewport" content="width=device-width, initial-scale=1.0">

                <link rel="stylesheet" href="../css/bootstrap.min.css">  

                <link rel="stylesheet" href="../css/estilosresponsivos.css">  
                <link rel="stylesheet" href="../css/style.css">  

                <title>Document</title>

            </head>

            <body>

            <div id="div_vehiculos" class="container">

                <div id="divBotonesvehiculo">

                <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12">

                    <i class="fas fa-search" onclick="busquedaAvanzadaVehiculos();"  style="font-size:30px;" ></i>

                    <input 
                    type="text" 
                    id="txtBuscarPlaca" 
                    placeholder="Placa" 
                    style="color:black; font-size:20px;" 
                    onkeyup="buscarVehiculoPorPlaca();"
                    size='7px';
                    >

                </div>

                    <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-4">

                        <button class="btn btn-primary" onclick="pintarOrdenes();">Listar</button>

                    </div>

                    <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-4">

                         <button class="btn btn-primary" onclick="nuevaPlaca();" >Nuevo</button>

                        <br><br>

                    </div>

                    </div>

                </div>

                <div align = "center" id="divResultadosVehiculos">

                    <?php   $this->verVehiculos($datosVehiculos);  ?>        

                </div>

                <?php  $this->modalClientes(); ?>
                <?php  $this->modalHistoriales(); ?>
                <?php  $this->modalItems(); ?>
                <?php  $this->modalInfoVehiculo(); ?>
            </div>

            </body>

            </html>

            <script src = "../js/jquery-2.1.1.js"> </script>    

            <script src="../js/bootstrap.min.js"></script>

            <script src="../vehiculos/js/vehiculos.js"></script>

            <script src="../orden/js/orden.js"></script>
            <script src="../canbiosdeaceite/js/cambiosdeaceite.js"></script>

        <?php        

    }

    public function modalClientes(){

        ?>

         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">

         Launch demo modal

         </button> -->

          <div class="modal fade" id="myModalClientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

              <div class="modal-dialog" role="document">

                  <div class="modal-content">

                  <div class="modal-header">

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                      <h4 class="modal-title" id="myModalLabel">Informacion</h4>

                  </div>

                  <div id="cuerpoModalClientes" class="modal-body">

                      

                      

                  </div>

                  <div class="modal-footer">

                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->

                  </div>

                  </div>

              </div>

          </div>

        <?php

    }
    public function modalInfoVehiculo(){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div style="color:black;" class="modal fade" id="myModalInfoVehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Informacion</h4>
                  </div>
                  <div id="cuerpoModalInfoVehiculo" class="modal-body">

                </div>
                  <div class="modal-footer">
                      <button 
                        type="button" 
                        class="btn btn-default" 
                        data-dismiss="modal"
                        onclick ="mostrarVehiculos();"
                       >
                       Cerrar
                       </button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }

    public function modalHistoriales(){

        ?>

         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">

         Launch demo modal

         </button> -->

          <div class="modal fade" id="myModalHistoriales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

              <div class="modal-dialog" role="document">

                  <div class="modal-content">

                  <div class="modal-header">

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                      <h4 class="modal-title" id="myModalLabel">Historiales</h4>

                  </div>

                  <div id="cuerpoModalHistoriales" class="modal-body">

                      

                      

                  </div>

                  <div class="modal-footer">

                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->

                  </div>

                  </div>

              </div>

          </div>

        <?php

    }
    public function modalItems()
    {

        ?>
          <div class="modal fade" id="myModalItems" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Historiales</h4>
                  </div>
                  <div id="cuerpoModalItems" class="modal-body">
                      
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }

    public function infoMoto($datosMoto){

        ?>

          <table border="0" class="table">

                     <tr>

                         <td><label>Placa:</label></td>

                         <td><?php echo strtoupper($datosMoto['placa']) ?></td>

                         <td><label>Marca:</label></td>

                         <td><?php echo strtoupper($datosMoto['marca']) ?></td>

                     </tr>

                     <!-- <tr>

                     </tr> -->

                     <tr>

                         <td><label>Linea:</label></td>

                         <td><?php echo strtoupper($datosMoto['tipo']) ?></td>

                         <td><label>Modelo:</label></td>

                         <td><?php echo strtoupper($datosMoto['modelo']) ?></td>

                     </tr>

                     <!-- <tr>

                     </tr> -->

                     <tr>

                         <td><label>Color:</label></td>

                         <td><?php echo strtoupper($datosMoto['color']) ?></td>

                     </tr>

                  </table>

        <?php

    }



    public function verVehiculos($datosVehiculos){

        // echo '<pre>';

        // print_r($datosVehiculos);

        // echo '</pre>';

        if($datosVehiculos['filas']>0)

        {

            ?>

            <table class="table">

                <thead>

                    <tr>

                        <th>PLACA</th>

                        <th>MARCA/MODIF</th>

                        <th>LINEA</th>

                        <th>NOMBRE</th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                        foreach($datosVehiculos['datos'] as $vehi){
                            echo '<tr>';
                            echo '<td>';
                            echo '<button
                                 class="btn btn-primary"
                                 data-toggle="modal" data-target="#myModalHistoriales" 
                                 onclick = "verHistorialVehiculo(\''.$vehi['placa'].'\');"
                                    >'.$vehi['placa'].'</button>';
                            echo '</td>';
                            echo '<td><button  
                                        class="btn btn-primary"
                                        data-toggle="modal" data-target="#myModalInfoVehiculo" 
                                        onclick= "muestreInfoVehiculo(\''.$vehi['placa'].'\');"
                                        >'.strtoupper($vehi['marca']).'</button></td>';
                            echo '<td>'.strtoupper($vehi['tipo']).'</td>';
                            echo '<td>'.strtoupper($vehi['nombre']).'</td>';
                            echo '</tr>';
                        }

                        ?>

                </tbody>

                

            </table>

            <?php

        }

    }

    public function nuevaPlaca(){

        ?><div id="divPregunteDatos">

            <div id="divPreguntePlaca">

                <div class="col-xs-4">

                    <label>Placa</label>

                 

                </div>

                <div class="col-xs-4">

                

                    <input 

                        class = "form-control" 

                        type="text" 

                        id="placaPeritaje" 

                        size="3" 

                        value="" 

                        size = "10"

                        placeholder = 'PLACA'

                        >

                </div>

                <div class="col-xs-4">

                    <button 

                        class="btn btn-primary " 

                        onclick="buscarPlacaPeritaje();"  

                        id="btnBuscarPlaca"

                        placeholder = "PLACA"

                        >
                    BUSCAR PLACA
                    <i class="fas fa-search"></i>

                    <!-- <i class="fas fa-search"></i> -->

                    </button>

                </div>



            </div>

            <div id="divResultadobusqueda">



            </div>

        </div>



        <?

    }


    public function mostrarDatosPlacaNew($datosPlaca,$datosCliente0)
    {
        ?>
        <div style="color:black;">
        <input type="hidden" id="placaoripan" value = "<?php  echo $datosPlaca['placa'] ?>">
        <input type="hidden" id="idcarro" value = "<?php  echo $datosPlaca['idcarro'] ?>">
            <div class="form-group row">
                <div class ="col-xs-12">
                    <label>Placa:</label><input type="text" id="placapan" value = "<?php  echo $datosPlaca['placa'] ?>">
                </div>
                <div class ="col-xs-12">
                    <label>Marca:</label><input type="text" id="marcapan" value = "<?php  echo $datosPlaca['marca'] ?>">
                </div>
                <div class ="col-xs-12">
                    <label>Tipo:</label><input type="text" id="tipopan" value = "<?php  echo $datosPlaca['tipo'] ?>">
                </div>
                <div class ="col-xs-12">
                    <label>Modelo:</label><input type="text" id="modelopan" value = "<?php  echo $datosPlaca['modelo'] ?>">
                </div>
            </div>
            <br>
            <button 
                class="btn btn-primary"  
                onclick="actualizarVehiculoNew();"
            >Actualizar Vehiculo</button>
        </div>
        <?php
    }
    
    public function mostrarDatosPlacaNewCambioAceite($datosPlaca,$datosCliente0)
    {
        ?>
        <div style="color:black;">
        <input type="hidden" id="placaoripan" value = "<?php  echo $datosPlaca['placa'] ?>">
        <input type="hidden" id="idcarro" value = "<?php  echo $datosPlaca['idcarro'] ?>">
            <div class="form-group row">
                <div class ="col-xs-3">
                    <label>Placa:</label> 
                    <?php  
                    echo $datosPlaca['placa'] 
                    ?>
                </div>
                <div class ="col-xs-3">
                    <label>Marca:</label><?php  echo $datosPlaca['marca'] ?>
                </div>
                <div class ="col-xs-3">
                    <label>Tipo:</label><?php  echo $datosPlaca['tipo'] ?>
                </div>
                <div class ="col-xs-3">
                    <label>Modelo:</label><?php  echo $datosPlaca['modelo'] ?>
                </div>
            </div>
            <br>
            <!-- <button 
                class="btn btn-primary"  
                onclick="actualizarVehiculoNew();"
            >Actualizar Vehiculo</button> -->
        </div>
        <?php
    }
    

    public function mostrarDatosPlaca($datosPlaca,$datosCliente0)

    {

        ?>

        <div class="row" class="linea">

            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">

               

                <table class="table">

                <tr>

                    <td>

                    <input type="hidden" id="idCarroPeritaje" value = "<?php  echo $datosPlaca[0]['idcarro']; ?>">

                       <label> Propietario: </label>

                    </td>

                    <td><?php   echo $datosCliente0[0]['nombre']; ?></td>

                </tr>    

                <tr>

                    <td><label>Marca:</label></td>

                    <td><?php   echo $datosPlaca[0]['marca']; ?></td>

                </tr>    

                <tr>

                    <td><label>Color:</label></td>

                    <td><?php   echo $datosPlaca[0]['color']; ?></td>

                </tr>    

                <tr>

                    <td><label>VenciSoat:</label></td>

                    <td><?php   echo $datosPlaca[0]['vencisoat']; ?></td>

                </tr>    

                

            </table>

            </div>

            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">

            <table class="table">

            <tr>

                <td><label>Modelo:</label></td>

                <td><?php   echo $datosPlaca[0]['modelo']; ?></td>

            </tr>    

            <tr>

                <td><label>PLaca:</label></td>

                <td><?php   echo $datosPlaca[0]['placa']; ?></td>

            </tr>    

            </table>

            </div>

        </div>



     <?php

    }    

    public function preguntarDatosPlaca($placa,$propietarios){

        ?>

        <div class= "row" id="div_pregunte_datos_placa">

            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">

                <table class="table">

                    <tr>

                        <td><label>Placa</label></td>

                        <td><?php echo $placa  ?>

                            <input type="hidden" id="placa" value = "<?php echo $placa ?>">

                    

                        </td>

                    </tr>

                    <tr>

                        <td><label>Propietario</label></td>

                        <td>

                            <select style="background:gray; color:white;" name="selectPropietario" id="selectPropietario" class="form-control">

                                <?php  funciones::select_general($propietarios,'idcliente','nombre'); ?>

                            </select>

                            <button data-toggle="modal" data-target="#myModalClientes" onclick= "nuevoPropietarioDesdeVehiculo();" class="btn btn-primary">Crear Persona <i class="fas fa-plus-square"></i></button>

                        </td>

                    </tr>

                    <tr>

                        <td><label>Marca.</label></td>

                        <td> <input type="text" id="marca" style="background-color:gray;" ></td>

                    </tr>

                    <tr>

                        <td><label>Linea.</label></td>

                        <td> <input type="text" id="linea" style="background-color:gray;"></td>

                    </tr>

                    <tr>

                        <td><label>Modelo</label></td>

                        <td> <input type="text" id="modelo" style="background-color:gray;"></td>

                    </tr>

                

                </table>

            </div>

            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">

                <table class="table">

                    <tr>

                        <td><label>Color</label></td>

                        <td> <input type="text" id="color" style="background-color:gray;"></td>

                    </tr>

                    <tr>

                        <td><label>Venci Soat</label></td>

                        <td> <input type="date" id="vencisoat" style="background-color:gray;"></td>

                    </tr>

                    <tr>

                        <td><label>Venci Tecno</label></td>

                        <td> <input type="date" id="revision" style="background-color:gray;"></td>

                    </tr>

                    <tr>

                        <td><label>Chasis</label></td>

                        <td> <input type="text" id="chasis" style="background-color:gray;"></td>

                    </tr>

                

                    <tr>

                        <td><label>Motor</label></td>

                        <td> <input type="text" id="motor" style="background-color:gray;"></td>

                    </tr>

                

                </table>

            </div>

            <div>

                <button class = "btn btn-primary btn-block btn-lg" onclick="grabarVehiculo();" >Grabar </button>

            </div>

        </div>

        <?php

    }

    public function preguntarDatosPlacaDesdeOrden($placa,$propietarios,$desdeDonde=0){

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/vehiculos.css">
            <title>Document</title>
        </head>
        <body>
        <div class= "row" id="div_pregunte_datos_placa">
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">
                <table class="table">
                    <tr>
                        <td><label>Placa</label></td>
                        <td><?php echo $placa  ?>
                            <input type="hidden" id="placa" value = "<?php echo $placa ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Propietario..</label></td>
                        <td>
                            <input 
                                id="nombrePropietarioAFiltrar"
                                style="background-color:white; color:black;" 
                                type="text" id="buscador" 
                                class ="form-control"
                                placeholder="Buscar Nombre"
                                onkeyup="filtrarPropietariosNombre();"
                                >
                            <select style="background:transparent; background-color:white;" name="selectPropietario" id="selectPropietario" class="form-control">
                                <?php  funciones::select_general($propietarios,'idcliente','nombre'); ?>
                            </select>
                            <button data-toggle="modal" data-target="#myModalClientes" onclick= "nuevoPropietarioDesdeVehiculo();" class="btn btn-primary">Crear Persona <i class="fas fa-plus-square"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Marca..</label></td>
                        <td> <input type="text" id="marca" style="background-color:gray;"  ></td>
                    </tr>
                    <tr>
                        <td><label>Linea</label></td>
                        <td> <input type="text" id="linea" style="background-color:gray;"  ></td>
                    </tr>
                    <tr>
                        <td><label>Modelo</label></td>
                        <td> <input type="text" id="modelo" style="background-color:gray;" ></td>
                    </tr>
                </table>
            </div>
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 linea">
                <table class="table">
                    <tr>
                        <td><label>Color</label></td>
                        <td> <input type="text" id="color" style="background-color:gray;" ></td>
                    </tr>
                    <tr>
                        <td><label>Venci Soat</label></td>
                        <td> <input type="date" id="vencisoat" style="background-color:gray;" ></td>
                    </tr>
                    <tr>
                        <td><label>Venci Tecno</label></td>
                        <td> <input type="date" id="revision" style="background-color:gray;" ></td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <label>Chasis</label> -->
                        </td>
                        <td> 
                            <input type="hidden" id="chasis" style="background-color:gray;" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <label>Motor</label> -->
                        </td>
                        <td> 
                            <input type="hidden" id="motor" style="background-color:gray;" >
                        </td>
                    </tr>
                </table>
            </div>
            <div>
               <?php
               if($desdeDonde == '0')
               {
                   echo   '<button 
                           class = "btn btn-primary btn-block btn-lg" 
                           onclick="grabarVehiculoDesdeOrden();" 
                           >
                           Grabar 
                           </button>';
                           
                        }
                if($desdeDonde == '1')
                {
                            echo   '<button 
                                    class = "btn btn-primary btn-block btn-lg" 
                                    onclick="grabarVehiculoDesdeCambioDeAceite();" 
                                    >
                                    Grabar 
                                    </button>';
                            
                }
                        

               ?>
            </div>
        </div>
        </body>
        </html>
        <?php

    }
    public function mostrarHistorialvehiculo($ordenes)
    {
        echo '<div id="divMostrarItemsOrden" style="color:black; ">';
        echo '</div>';
        echo '<div style="color:black; "
        >';
        // overflow-y: scroll;
        // $this->draw_table($historial);
            echo '<table class="table">'; 
            echo '<tr>';
            echo '<td>Fecha</td>'; 
            echo '<td>Orden</td>'; 
            echo '<td>Placa</td>'; 
            echo '<td>Kilometraje</td>'; 
            echo '<td>Observaciones</td>'; 
            echo '</tr>';
            foreach($ordenes as $orden)
            {
                echo '<tr>'; 
                echo '<td><button 
                        class ="btn btn-default"
                        onclick="muestreItemsOrden123('.$orden['id'].');"  
                        >'.$orden['fecha'].'</button></td>';
                        echo '<td>'.$orden['orden'].'</td>';
                        echo '<td>'.$orden['placa'].'</td>';
                        echo '<td>'.$orden['kilometraje'].'</td>';
                        echo '<td>'.$orden['observaciones'].'</td>';
                        echo '</tr>';
                        
                        // data-toggle="modal" data-target="#myModalItems"
            }
            echo '</table>';


        echo '</div>';
        ?>
        <div>
               
        </div>
        <?php
    }

}



?>