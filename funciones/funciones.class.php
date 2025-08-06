<?php

class funciones{

    
    public static function table_assoc($datos)
	{
		$arreglo_assoc='';
			$i=0;	
			while($row = mysql_fetch_assoc($datos)){		
				$arreglo_assoc[$i] = $row;
				$i++;
			}
		return $arreglo_assoc;
	}

    public static function printR($arreglo){
        echo '<pre>';
        print_r($arreglo); 
        echo '</pre>'; 
        die(); 
    }   

    public static function draw_table($datos)
					{
					
								echo '<table class="table" border = "1">';
									$titulos = array_keys($datos[0]);
										echo '<tr>';
										foreach   ($titulos as $d ) { 
											echo "<td>".strtoupper($d)."</TD>"; 
										} 
										
										
										echo '</tr>';
										foreach   ($datos as $d ) {   
											echo '<tr>';
											foreach   ($d as $r ) {
											echo "<td>$r</TD>";
											}
											echo '</tr>';		
										}
										echo '</table>';

					
					}

    public  static function titulosTabla($datos){
        $titulos = array_keys($datos[0]);

		echo '<tr>';
		foreach   ($titulos as $d ) { 
			echo '<td>'.strtoupper($d).'</td>'; 
		} 			
        echo '<tr>';		
        			
    }

    public static function pintarTabla($datos,$borde){
        echo '<table border="'.$borde.'">';
        echo '<thead>';
            // self ::titulosTabla($datos);
            /////////
            $titulos = array_keys($datos[0]);
            echo '<tr>';
		    foreach   ($titulos as $d ) { 
			    echo '<td>'.strtoupper($d).'</td>'; 
		    } 			
            echo '<tr>';
            /////////
        echo '</thead>';
        echo '<tbody>';
        $cuantasColumnas= count($titulos);    
        echo '<br>'.$cuantasColumnas;
        die();
        $i=0;
            foreach($datos as $f){
                
                echo '<tr>';
                echo '<td>'.$f[$titulos[0]].'</td>';
                echo '<td>'.$f[$titulos[1]].'</td>';
                echo '<td>'.$f[$titulos[2]].'</td>';
                echo '<td>'.$f[$titulos[3]].'</td>';
                echo '</tr>';
                
            }
        echo '</tbody>';
        echo '</table>';

    }


    //////////////para traer un select y dejar una opcion seleccionada de cuerdo a la condicion
    /*
     $tabla : la tabla sobre la que se va a hacer la consulta 
     $conexion : la conexion hacia la base de datos 
     $campo1 :  el valor que se tomara  de la opcion
     $campo2 : el valor que se mostrara en la opcion  
    */
 public static function select_general($propietarios,$campo1,$campo2){

	echo '<option value="" >...</option>';
	foreach($propietarios as $propi)
	{
		echo '<option value="'.$propi[$campo1].'" >'.substr($propi [$campo2],0,15).'</option>';
	}
}



public static function select_general_condicion($tabla,$conexion,$campo1,$campo2,$condicion){
    $sql_general = "select * from $tabla    ";
    
   $con_general = mysql_query($sql_general,$conexion);
    echo '<option value="" >...</option>';
    while($general  = mysql_fetch_assoc($con_general))
    {
        if($general[$campo1] == $condicion){
             echo '<option value="'.$general[$campo1].'" selected >'.$general [$campo2].'</option>';
        }
        else 
        {
            echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
        }
       }//fin del while
      } //fin ed la funcion  
  
   
         

}




?>