<?php

echo '<pre>mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm';
print_r($_POST);
echo '</pre>';


for ($i = 0 ;$i<= $_POST['control'];$i++)

		{
		   echo '<br>id'.$_POST["id_item_$i"].'porcentaje '.$_POST["porcentaje_$i"];
		}

?>