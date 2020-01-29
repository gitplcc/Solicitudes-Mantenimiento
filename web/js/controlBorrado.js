function controlBorrado(path,id){
  swal({
  title: "¿Estás seguro?",
  text: "Vas a borrar el parte "+id,
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    window.location.replace(path);
  }
});
  return false;
}
