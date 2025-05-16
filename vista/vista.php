<?php

class vista
{
    public function get_table_assoc($datos)
    {
                     $arreglo_assoc='';
                        $i=0;	
                        while($row = mysql_fetch_assoc($datos)){		
                            $arreglo_assoc[$i] = $row;
                            $i++;
                        }
                    return $arreglo_assoc;
    }
public function draw_table($datos)
                {
                
                            echo '<table border = "1" class="table">';
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

}

?>