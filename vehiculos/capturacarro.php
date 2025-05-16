<html>
<head><title>verificacion de placas de automoviles</title>

<BODY BGCOLOR="COCOCO">
<P ALIGN = "CENTER">


<FORM name=verificar action=capturacarro.php method=post>
<TABLE borderColor=black cellSpacing=5 width="90%" bgColor=#c0c0c0 border=2>
  <TBODY>
  <TR>
    
    <TD>PLACA NO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<INPUT size=15 name=placapan> </TD>
	<!-- <TD>SIGLA NO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<INPUT size=15 name=siglapan value=0 > </TD>
	-->
	</TR></TR>
  
    
<TABLE borderColor=black cellSpacing=5 width="90%" bgColor=#c0c0c0 border=2>
  <TBODY>
  <TR>
     <P align=center>
    <TD height="32"><INPUT type=submit value=CONTINUAR></TD></TR></TBODY></TABLE>


</FORM>





</P> 

<?
include('../valotablapc.php');;
	
   
	if ($_POST['placapan']!="" )
	{	
		$tabla = $tabla4;
		$username = $usuario;
		$password1 = $clave;
		$dbName   = $nombrebase;
		$hostname = $servidor;

		mysql_connect($hostname,$username,$password1) or
		print "Error en la Conexión";

		mysql_select_db($nombrebase) or
		print "Error en la Base de datos";

		$consulta = "select * from $tabla where placa= '".$_POST['placapan']."' ";
		
		$resultado=mysql_query($consulta);
		$numregistros=mysql_numrows($resultado);
		$j=mysql_num_fields($resultado);
		
		
		if ($numregistros==0) 
			{echo " <html> <font color= red> 	VEHICULO  NO EXISTE POR FAVOR DIGITE LOS DATOS </font></html>" ;
			//aqui pide datos 
			?>		
		<FORM name=HOJA action=grabarcarro.php method=post>		
		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>
 		 <TBODY>


  		<TR>
  		  <TD>PLACA 
  		    <INPUT name=placapan size=20  value= <? echo $_POST['placapan'] ?>  ></TD>
			<!--
			<TD>SIGLA
  		    <INPUT name=siglapan size=20  value= <? echo $siglapan ?>  ></TD>
			-->
		   </TR></TBODY></TABLE>

		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>
  		<TBODY>
  		<TR>
  		<TR>
   		 <TD>Marca<INPUT name=marcapan size=20 value=<? echo $marcapan ?>></TD>
		  <TD>Modelo<INPUT name=modelopan size=20 value=<? echo $modelopan ?>></TD>
		   <TD>Tipo
		     <INPUT name=cilinpan size=20 value=<? echo $cilinpan ?>></TD>
		  </TR></TBODY></TABLE>
		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>
 		 <TBODY>
 		 <TR>
   		 <TD>Color
   		   <INPUT size=20 name=asegpan value=<? echo $asegpan ?>></TD>
		
		 
         <td>Nombre Propietario</td></td> <TD>  <?php
								  $link = mysql_connect($servidor,$usuario,$clave);
							if (!$link) {
								die('Imposible establecer conexion : ' . mysql_error());
							}
							 
							// Estableciondo selccion de base de datos
							$db_selected = mysql_select_db($nombrebase, $link);
							if (!$db_selected) {
								die ('bd no selccionada : ' . mysql_error());
							}
							//Consulta para seleccionar lo deseado, en este caso se seleccionara el usuario de la tabla sesion
							$result=mysql_query("select idcliente,nombre from $tabla3");
							//Mostramos por un echo la etiqueta del select con su nombre y su id*******
							echo "<select name='propi1' id='propi1'> ";
							//Realizamos un Bucle wile para recorrer la tabla*******
							while ($row=mysql_fetch_array($result))
							{
							//Por otro echo mostramos en cada Option del select lo seleccionado por la consulta***  
								echo '<option value="'.$row['idcliente'].'">'.$row['nombre'].'</option>';
							//Cerramos el Bucle
							}
							//Cerramos el PHP**
							?>
</TD>  

         
         
         </TR></TBODY></TABLE>
		
	      
          * Si el nombre del propietario no figura en el listado entonces debe digitar la tecla escape
          <br />
          * Y dirigirse al modulo de clientes para crearlo
		 <br>
		 <br>
		<br>

		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>
  		<TBODY>
  		<TR>
    	<TD>Observaciones Vehiculo
			<textarea cols="70" rows="3" name="obsevehipan"> <? echo $obsevehipan ?></textarea>
		  </TD></TR></TBODY>
		</TABLE>
		<TABLE borderColor=black cellSpacing=5 width="90%"  bgcolor="#6699CC" border=2>
  <TBODY>
  <TR>
     <TD><INPUT type=reset value=BORRAR></TD>
    <TD><INPUT type=submit value=GRABAR></TD>
	</TR></TBODY></TABLE>
		</FORM>
		<?

			//aqui termina de pedir datos 
			
			         
			}
       else  {
	   
	   echo "VEHICULO YA EXISTE EN LA BASE DE DATOS";
				 //aqui muestra los datos del clienteinclude("colocarclientecaptura.php");
		
		$i=0;
		while ($i < $numregistros)
	 	{
      	$marcapan=	mysql_result($resultado,$i,marca);
		$siglapan=	mysql_result($resultado,$i,sigla);
		$modelopan=	mysql_result($resultado,$i,modelo);
		$cilinpan=	mysql_result($resultado,$i,cilindraje);
		$asegpan=	mysql_result($resultado,$i,aseguradora);
		$propipan=	mysql_result($resultado,$i,propietario);
		
		$fecamaceipan=	mysql_result($resultado,$i,aceite);
		$fecrevtecpan=	mysql_result($resultado,$i,revision);
		$fecamcorrpan=	mysql_result($resultado,$i,cambiocorrea);
		$fecprovipan=mysql_result($resultado,$i,proxima_visita);
		$soatpan=	mysql_result($resultado,$i,numerosoat);
		$soatcompan=mysql_result($resultado,$i,asesoat);
		$soatvalpan=mysql_result($resultado,$i,valorsoat);
		$soatvencipan =	mysql_result($resultado,$i,vencisoat);
		$obsevehipan=	mysql_result($resultado,$i,observaciones);
        
		
	
	 $i++;
	 }
     $identipan = $propipan;
     if ($identipan !="")	{ include("verificarcliente01.php");}
?>			
<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>
 		 <TBODY>


  		<TR>
  		  <TD>PLACA 
  		    <INPUT name=placapan size=20  value= <? echo $_POST['placapan'] ?>  ></TD>
			<!--
			<TD>SIGLA
  		    <INPUT name=siglapan size=20  value= <? echo $siglapan ?>  ></TD> 
			-->
  		    </TR></TBODY></TABLE>

		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>
  		<TBODY>
  		<TR>
  		<TR>
   		 <TD>Marca<INPUT name=marcapan size=20 value=<? echo "'$marcapan'" ?>></TD>
		  <TD>Modelo<INPUT name=modelopan size=20 value=<? echo "'$modelopan'" ?>></TD>
		   <TD>Tipo
		     <INPUT name=cilinpan size=20 value=<? echo "'$cilinpan'" ?>></TD>
		  </TR></TBODY></TABLE>
		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>
 		 <TBODY>
 		 <TR>
   		 <TD>Color
   		   <INPUT size=20 name=asegpan value=<? echo "'$asegpan'" ?>></TD>
		 <TD>Identificacion Propietario<INPUT size=20 name=propipan value=<? echo $identipan ?>></TD>
		 </TR></TBODY></TABLE>
		
		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>
 		 <TBODY>
 		 <TR>
    	<TD>Nombre<INPUT size=50 name=nompan value=<? echo "'$nompan'" ?>></td>
	 
  		 </TR></TBODY></TABLE>
		 <br>
		 <br>

		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>
  		<TBODY>
  		<TR>
    	<TD>Observaciones Vehiculo
			<textarea cols="70" rows="3" name="obsevehipan"> <? echo $obsevehipan ?></textarea>
		  </TD></TR></TBODY>
		</TABLE><?
  // aqui termina de mostra losdatos delcliente   

			 //include("colocarclientecaptura.php");			
			}
                             
		
	// hasta aqui termina la primera consulta con los datos basicos
		

          } // de si placapan = ""



?>


</BODY>
</HTML>
