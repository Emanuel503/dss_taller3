function eliminar(id){
    let opcion = confirm("¿Estas seguro que quieres eliminar el registro?");
    if(opcion == true ){
        location.href = "eliminar.php?id="+id;
    }
}

//Mensajes alert
window.setTimeout(function(){
    $(".alert").fadeTo(1500, 0).slideDown(1000,function(){
        $(this).remove();
    })
}, 1500);