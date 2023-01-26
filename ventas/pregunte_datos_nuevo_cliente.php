<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<br />
<?PHP
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/
?>


<table width="515" border="1">
  <tr>
    <td colspan="3"><div align="center">INGRESE LOS DATOS DEL NUEVO CLIENTE ..</div></td>
  </tr>
  <tr>
    <td width="139">Identidad </td>
    <td width="177"><label>
      <input type="text" name="identi"  id ="identi"   />
    </label></td>
    <td width="177">&nbsp;</td>
  </tr>
  <tr>
    <td>Nombre</td>
    <td><input type="text" name="nombre"  id ="nombre"  /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Direccion</td>
    <td><input type="text" name="direccion"  id ="direccion"  /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Telefono</td>
    <td><input type="text" name="telefono"  id ="telefono"  /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="email"  id ="email"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>
    <button id = "grabar_datos"  type = "button">Grabar Datos Cliente</button>
    </label></td>
    <td>&nbsp;</td>
  </tr>
</table>
 </form>

</body>
</html>


<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
 		
				$("#grabar_datos").click(function(){
						var data =  'identi=' + $("#identi").val();
						data += '&nombre=' + $("#nombre").val();
						data += '&direccion=' + $("#direccion").val();
						data += '&telefono=' + $("#telefono").val();
						data += '&email=' + $("#email").val();
						$.post('grabar_datos_cliente.php',data,function(a){
							 //$("#carros123").load('pregunte_datos_nuevo_carro.php');
							$("#carros123").html(a);
							//alert(data);
						});	
					});
					
            });		
</script>
