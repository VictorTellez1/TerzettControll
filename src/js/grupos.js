window.Swal = swal;
$('.eliminar').submit(function (e){
  e.preventDefault();
  var id = $(this).data('id');
  swal({
        title: "¿Deseas eliminar la tarea?",
        text: "Una vez eliminado el tablon se ira para siempre",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Si, eliminalo!",
        cancelButtonText: "Cancelar!",
      }).then((result) => {
        if (result.isConfirmed) {
            swal(
            'Datos Eliminados!',
            'eliminación correcta',
            'success'
            )
            
        }
        })
    });

//     function fetch(){
//       $.ajax({
//         method: 'POST',
//         url: '/admin/proyectos/eliminar?url='+id,
//         dataType: 'json',
//         success: function(response){
//           $('#tbody').html(response);
//         }
//       });
//     }
      
// // function alertaEliminacion(usuario)
// // {

// //       swal({
// //         title: 'Estas seguro de eliminar?',
// //         text: "Se eliminara para siempre",
// //         type: 'info',
// //         showCancelButton: true,
// //         confirmButtonColor: '#3085d6',
// //         cancelButtonColor: '#d33',
// //         confirmButtonText: 'Si,Eliminalo!',
// //         cancelButtonText: 'Cancelar'
// //       }).then((result) => {
// //           eliminarUsuario(usuario);  
// //       })
// // }
// // async function eliminarUsuario(usuario){
// //   const datos=new FormData()
// //   datos.append('id',usuario);
// //   console.log(usuario);
  
// //   try{
// //       const url="http://localhost:3000/admin/proyectos/eliminar";
// //       const respuesta=await fetch(url,{
// //           method:"POST",
// //           body:datos
// //       });
      
// //       const resultado=await respuesta.json();
      
      
// //   }catch(error){

// //   }
// // }



