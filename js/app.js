$(document).ready(function(){
    // alert('hola ');
});

$("#btn_recordar_contrasena").click(function(){
     var usuario =  $("#usuario").val();
     if(usuario != ''){
        //    alert(usuario); 
         var data =  'usuario=' + usuario;
         $.post('../recuperarclaves/correo_enviar_clave.php',data,function(a){
             //$(window).attr('location', '../index.php);
             $("#div_recuperar_clave").html(a);
            });	
    
    }else{
        $("#avisofaltousuario").show();
    }

});

$("#btn_recordar_contrasena").click(function(){
});

$("#cerraraviso").click(function(){
    $("#avisofaltousuario").hide();
});
