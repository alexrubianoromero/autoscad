<html>

<head><title>verificacion de cedulas</title>



<BODY BGCOLOR="COCOCO">

<P ALIGN = "CENTER">





<FORM name=verificar action=capturacliente.php method=post>

<TABLE borderColor=black cellSpacing=5 width="90%" bgColor=#c0c0c0 border=2>

  <TBODY>

  <TR>

    

    <TD>CEDULA NO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<INPUT size=15 name=identipan> </TD></TR></TR>

  

    

<TABLE borderColor=black cellSpacing=5 width="90%" bgColor=#c0c0c0 border=2>

  <TBODY>

  <TR>

     <P align=center>

    <TD><INPUT type=submit value=CONTINUAR></TD></TR></TBODY></TABLE>





</FORM>











</P> 



<?

include ("../valotablapc.php"); 	

   

	if ($_POST['identipan']!="")

	{	

		$tabla = $tabla3;

		$username = $usuario;

		$password1 = $clave;

		$dbName   = nombrebase;

		$hostname = $servidor;



		mysql_connect($hostname,$username,$password1) or

		print "Error en la Conexión";



		mysql_select_db("$dbName") or

		print "Error en la Base de datos";



		$consulta = "select * from $tabla where identi= '".$_POST['identipan']."' ";

		

		$resultado=mysql_query($consulta);

		$numregistros=mysql_numrows($resultado);

		$j=mysql_num_fields($resultado);

		

		

		echo $identipan;

		if ($numregistros==0) 

			{echo " <html> <font color= red> CLIENTE NO EXISTE POR FAVOR DIGITE LOS DATOS </font></html>" ;

			//aqui pide datos 

			?>		

		<FORM name=HOJA action=grabarsolocliente.php method=post>		

		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>

 		 <TBODY>





  		<TR>

  		  <TD>IDENTIDAD<INPUT name=identipan size=20  value=<? echo $_POST['identipan'] ?> onFocus="blur();"  ></TD> </TR></TBODY></TABLE>



		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>

  		<TBODY>

  		<TR>

  		<TR>

   		 <TD>Nombre<INPUT name=nompan size=50 value=<? echo "'$nompan'" ?>></TD></TR></TBODY></TABLE>

		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>

 		 <TBODY>

 		 <TR>

   		 <TD>Direccion <INPUT size=50 name=dirpan value=<? echo "'$dirpan'" ?>></TD></TR></TBODY></TABLE>

		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>

 		 <TBODY>

 		 <TR>

    	<TD>telefono<INPUT size=30 name=telepan value=<? echo "'$telepan'" ?>></td>

		 <TD>Email<INPUT size=30 name=emailpan value=<? echo $emailpan ?>></td>

	 

  		 </TR></TBODY></TABLE>









		<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>

  		<TBODY>

  		<TR>

    	<TD>Observaciones cliente

			<textarea cols="70" rows="3" name="obseasegpan"> <? echo $obseasegpan ?></textarea>

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

	   

	   echo "CLIENTE YA EXISTE EN LA BASE DE DATOS";

				 //aqui muestra los datos del clienteinclude("colocarclientecaptura.php");

		

		$i=0;

		while ($i < $numregistros)

	 	{

      	$identipan=	mysql_result($resultado,$i,identi);

		$nompan=	mysql_result($resultado,$i,nombre);

		$telepan=	mysql_result($resultado,$i,telefono);

		$emailpan=	mysql_result($resultado,$i,email);

		$dirpan=	mysql_result($resultado,$i,direccion);

		

		$obseasegpan=	mysql_result($resultado,$i,observaci);

	

	 $i++;

	 }

?>			

<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>

  <TBODY>





  <TR>

    <TD>IDENTIDAD<INPUT name=identipan size=20  value=<? echo $_POST['identipan'] ?> onFocus="blur();"  ></TD> </TR></TBODY></TABLE>



<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>

  <TBODY>

  <TR>

  <TR>

    <TD>Nombre<INPUT name=nompan size=50 value=<? echo "'$nompan'" ?>></TD></TR></TBODY></TABLE>

<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>

  <TBODY>

  <TR>

    <TD>Direccion <INPUT size=50 name=dirpan value=<? echo "'$dirpan'" ?>></TD></TR></TBODY></TABLE>

<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>

  <TBODY>

  <TR>

    	<TD>telefono<INPUT size=30 name=telepan value=<? echo "'$telepan'" ?>></td>

		 <TD>Email<INPUT size=30 name=emailpan value=<? echo $emailpan ?>></td>

	 

   </TR></TBODY></TABLE>









<TABLE borderColor=black cellSpacing=5 width="90%" bgColor="#FFFF99" border=2>

  <TBODY>

  <TR>

    	<TD>Observaciones asegurado

	<textarea cols="70" rows="3" name="obseasegpan"> <? echo $obseasegpan ?></textarea>

	</TD></TR></TBODY>

</TABLE>

<?

			

			    

            // aqui termina de mostra losdatos delcliente   



			 //include("colocarclientecaptura.php");			

			}

                             

		

	// hasta aqui termina la primera consulta con los datos basicos

		



          } // de si placapan = ""







?>





</BODY>

</HTML>

