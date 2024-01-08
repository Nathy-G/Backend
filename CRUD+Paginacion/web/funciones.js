/**
 * Funciones auxiliares de javascripts 
 */
function confirmarBorrar(first_name,id){
  if (confirm("¿Quieres eliminar el usuario:  "+first_name+"?"))
  {
   document.location.href="?orden=Borrar&id="+id;
  }
}