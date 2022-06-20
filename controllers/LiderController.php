<?php
namespace Controllers;

use MVC\Router;
use Model\Tablon;
use Model\Usuario;
use Model\Grupo;
use Model\Tarea;
use Model\UsuarioTarea;
use Model\Comentario;
use Intervention\Image\ImageManagerStatic as Image;
class LiderController{
    public static function usuario(Router $router){
        //Iniciarlizar el revisar si es lider y presentar su perfil
        isLider();
        expira();
        $id=$_SESSION['id'];
        $usuario=Usuario::where('id',$id);
        $router->render('lider/cuenta',[
            'usuario'=>$usuario
        ]);
       
        
    }
    public static function password(Router $router)
    {
        //Permite al lider restablecer su contraseña
        isLider();
        expira();
        $alertas=[];
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
        }else{
            $id=4;
        }
        $idUsuario=$_SESSION['id'];
        $usuario=Usuario::where('id',$idUsuario);
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(!($_POST['password']==="")){
                $password=$_POST['password'];
            }else{
                $alertas['error'][]="La contraseña es obligatoria";
            }
            if(!($_POST['password1']==="")){
                $password1=$_POST['password1'];
            }else{
                $alertas['error'][]="La confirmacion de contraseña es obligatoria";
            }
            if(empty($alertas))
            {
                //Comprobar que las contraseñas sean iguales
                $resultado=strcasecmp($password,$password1);
                if($resultado===0)
                {
                    $contraseña=password_hash($password,PASSWORD_DEFAULT);
                    $usuario->contraseña=$contraseña;
                    $resultado=$usuario->guardar();
                    if($resultado){
                        header("Location: /lider/password?id=2");
                    }
                }else{
                    $alertas['error'][]="Las contraseñas deben ser iguales";
                } 
            }
        }
        
        $router->render('lider/password',[
            "alertas"=>$alertas,
            "resultado"=>$id
        ]);
    }
    public static function proyectos(Router $router)
    {
        
        isLider();
        expira();
        //Crear un tablon nuevo
        $alertas=[];
        // debuguear($_SESSION['id']);
        $tablones1=Tablon::allFechaLider($_SESSION['id']); //Te trae todos los proyectos en orden por fecha en los que el lider sea lider 
        $tablones2=Tablon::allFechaUsuario($_SESSION['id']); //Te trae todos los proyectos en orden por fecha en los que el lider sea participe en alguna tarea del tablon
        $tablones=array_merge($tablones1,$tablones2); //Une los arrays 
        $tablones=array_unique($tablones,SORT_REGULAR); //Elimina los repetidos
        
        $tablon=new Tablon;
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
        }else{
            $id=4;
        }
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $tablon->sincronizar($_POST);
            $alertas=$tablon->validarTablon();
            $hash=md5(uniqid()); //Crear la url para el tablon
            $tablon->url=$hash;
            $tablon->lider=$_SESSION['nombre'];
            $tablon->fecha=date('d-m-Y');
            $tablon->idLider=$_SESSION['id'];
            
            if(empty($alertas)){
                $resultado=$tablon->guardar();
                if($resultado){
                    header("Location: /lider/proyectos?id=1");
                } 
            }
        }
        $router->render('lider/proyectos',[
                'alertas'=>$alertas,
                'tablon'=>$tablon,
                'resultado'=>$id,
                'tablones'=>$tablones
        ]);
    }
    public static function filtro(Router $router)
    {
        //Filtar los tablones por lugar BD, FORD O INTERNAS  o por palabra por ejemplo "Proyecto"
        isLider();
        expira();
        if(isset($_GET['filtro']))
        {
            
            $filtro=$_GET['filtro'];
            $valor=$filtro;
            $tablones1=Tablon::belongsToLider('lugar',$filtro,$_SESSION['id']); //Te trae todos los proyectos en orden por fecha en los que el lider sea lider 
            $tablones2=Tablon::beongsToUsuario($_SESSION['id'],$valor);  //Te trae todos los proyectos en orden por fecha en los que el lider sea participe en alguna tarea del tablon
            $tablones = array_merge($tablones1, $tablones2);  //Une los arrays 
            $tablones=array_unique($tablones,SORT_REGULAR); //Elimina los repetidos
            
        }
        
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            
            $busqueda=$_POST['busqueda'];
            $tablones1=new Tablon();
            $tablones1=$tablones1->buscarPalabraLider($busqueda,$_SESSION['id']); //Te trae los tablones que coincidan con la palabra que buscaste donde el lider sea lider 
            $tablones2=new Tablon();
            $tablones2=$tablones2->buscardorPalabraUsuario($busqueda,$_SESSION['id']); //Te ttrae los tablones que coincidan con la palabra que buscaste donde el lider tenga alguna tarea que realizar
            $tablones = array_merge($tablones1, $tablones2);//Une los arrays 
            $tablones=array_unique($tablones,SORT_REGULAR); //Elimina los repetidos
            
        }
        $router->render('lider/proyectosfiltrados',[
            'tablones'=>$tablones
        ]);
    }
    public static function tablon(Router $router)
    {
        //En jefes se va a tener que revisar que no puedan acceder a otros proyectos
        //Asi $url=$_GET['id'];
        //if(!url) header ('Location :/admin/proyectos)
        //if($tablon->idLider!==$_SESSION['id]) No es el propietario redireccionar, tiene un bug, no te va a dejar acceder a los tablones donde no sea ldier pero sea participe de la tarea
        
        //Te muestra los grupos, taress y personas correpondientes a un tablon
        isLider();
        expira();
        $alertas=[];
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
        }else{
            $id=4;
        }
        
        $url=$_GET['url'];
        if(!$url) header ("Location: /lider/proyectos");
        $tablon=Tablon::where('url',$url);
        if(is_null($tablon)){
            header("Location: /lider/proyectos");
        }
        $idTablon=$tablon->id;

        $grupos=Grupo::belogsTo('idTablon',$idTablon);
        $tablon=Tablon::where('url',$url);
        // if($tablon->idLider!==$_SESSION['id']){
        //     header ("Location: /admin/proyectos");
        // }
        $usuarios=Usuario::all();
        $tareas=new Tarea();
        $tareas=$tareas->tareasRecuperar($tablon->id);  //Te recupera todas las tareas pertenecientes a ese tablon
        $usuarioTareas=new UsuarioTarea();        
        $usuarioTareas=$usuarioTareas->usuariosTareas($tablon->id);
        foreach($grupos as $grupo) //Llena la tabla de grupo con toda la informacion de tareas que se tengan respecto a ese tablon
        {
            $grupo=Grupo::where('id',$grupo->id);
            $grupo->id=$id;
            $grupo->total=$grupo->total($grupo->id);
            $grupo->nuevas=$grupo->estado($grupo->id,0);
            $grupo->estancadas=$grupo->estado($grupo->id,1);
            $grupo->proceso=$grupo->estado($grupo->id,2);
            $grupo->listas=$grupo->estado($grupo->id,3);
            
            $grupo->guardar();   
        }
        $router->render('lider/tablon',[
            'tablon'=>$tablon,
            'alertas'=>$alertas,
            'resultado'=>$id,
            'grupos'=>$grupos,
            'usuarios'=>$usuarios,
            'tareas'=>$tareas,
            'usuarioTareas'=>$usuarioTareas,
            
        ]);
    }
    public static function pdf()
    {
        //Crear PDF del tablon
        isLider();
        expira();
        $url=$_GET['url'];
        $tablon=Tablon::where('url',$url);
        $id=$tablon->id;
        $grupos=Grupo::belogsTo('idTablon',$id);
        $tareas=new Tarea();
        $tareas=$tareas->tareasRecuperar($tablon->id);  //Necesario en tablon
        $usuarioTareas=new UsuarioTarea();        
        $usuarioTareas=$usuarioTareas->usuariosTareas($tablon->id);
        
        crearPDF($tablon,$grupos,$tareas,$usuarioTareas);
    }
    public static function proyectoseliminar(Router $router)
    {
        //Eliminar un proyecto
        isLider();
        expira();
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            $url=$_GET['url'];
            $tablon=Tablon::where('url',$url);
            $id=$tablon->id;
            $grupos=Grupo::belogsTo('idTablon',$id);
            $tareas=new Tarea();
            $tareas=$tareas->tareasRecuperar($tablon->id);  //Necesario en tablon
            $usuarioTareas=new UsuarioTarea();
            
            if($tablon->lider !== $_SESSION['nombre']){ //QUTITAR EL DEBUGEAR Y CAMBIAR POR UN HEADER
                
                header ("Location: /lider/proyectos");
                
            }else{
                $usuarioTareas=$usuarioTareas->usuariosTareas($tablon->id);
                crearPDF($tablon,$grupos,$tareas,$usuarioTareas);
                $resultado=$tablon->eliminar();
                debuguear($resultado);
                if($resultado){
                    header("Location: /lider/proyectos?id=3");
                } 
            }
                  
            
        }
    }
    public static function grupo(Router $router)
    {
        //Crear un grupo dentro de un tablon
        isLider();
        expira();
        // if($tablon->lider !== $_SESSION['nombre']){ //QUTITAR EL DEBUGEAR Y CAMBIAR POR UN HEADER
        //     header("Location: /lider/proyectos");
        // }
        $alertas=[];
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
        }else{
            $id=4;
        }
        $url=$_GET['url'];
        $url1=$url;
        $tablon=Tablon::where('url',$url);
        $grupo=new Grupo();
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $grupo->sincronizar($_POST);
            $alertas=$grupo->validarGrupo();
            if(empty($alertas))
            {
                $grupo->idTablon=$tablon->id;
                if($tablon->lider !== $_SESSION['nombre']){ //QUTITAR EL DEBUGEAR Y CAMBIAR POR UN HEADER
                    header("Location: /lider/proyectos");
                    
                }
                
                $resultado=$grupo->guardar();
                if($resultado){
                    header("Location: /lider/proyectos/tablon?url=$url1&id=1");
                }
            }
        }
        $router->render('lider/tablon',[
            'tablon'=>$tablon,
            'alertas'=>$alertas,
            'resultado'=>$id
        ]);
       
    }
    public static function tarea(Router $router)
    {
        //Crear una tarea y mostrarlas
        isLider();
        expira();
        $alertas=[];
        if(isset($_GET['id'])){
            $idUsuario=$_GET['id'];
            $idUsuario=filter_var($idUsuario,FILTER_VALIDATE_INT);
        }else{
            $idUsuario=4;
        }
        $url=$_GET['url'];
        $url1=$url;
        $tablon=Tablon::where('url',$url);
        // if($tablon->lider !== $_SESSION['nombre']){ //QUTITAR EL DEBUGEAR Y CAMBIAR POR UN HEADER
        //     header("Location: /lider/proyectos");
        // }
        $id=$tablon->id;
        $grupos=Grupo::belogsTo('idTablon',$id);
        $usuarios=Usuario::all();
        $tarea=new Tarea();
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(isset($_POST['nombre'])){ //Obtener todos los datos de la tarea que se va a crear en este caso el nombre
                $nombre=$_POST['nombre'];
                $tarea->nombre=$nombre;
            }else{
                $nombre='';
            } 
            if(isset($_POST['grupo'])){
                $IdGrupo=$_POST['grupo'];
                $tarea->IdGrupo=$IdGrupo;
                
            }else{
                $IdGrupo='';
            }
            $alertas=$tarea->validarTarea();
            $tarea->estado='0';
            $tarea->fecha=date('d-m-Y');
            $hash=md5(uniqid());
            $tarea->url=$hash;
            if(!isset($_POST['CheckBox']))
            {
                $alertas['error'][]="Debe seleccionar al menos un usuario para la tarea creada";
            }
            
            if(empty($alertas))
            {
                $tarea->guardar();
                $tarea=Tarea::where('url',$tarea->url);
                $idTarea=$tarea->id;
                $usuariosSeleccionados=array();//Se crear un array para guardar los usuarios
                $usuariosSeleccionados=$_POST['CheckBox']; //Se llena ese check box con los usuarios selecionados
                $longitud=sizeof($usuariosSeleccionados);
                for($i=0;$i<$longitud;$i++) //Se llena la tabla de usuariotarea con todos los usuarios seleccionados 
                {
                    $usuariotarea=new UsuarioTarea();
                    $usuariotarea->IdTarea=$idTarea;
                    $usuariotarea->IdUsuario=$usuariosSeleccionados[$i]; //Obtiene el id del usuario en custion
                    $usuariotarea->crearVarios();
                }
                
                $usuarios=Usuario::all();
                $tareas=new Tarea();
                $tareas=$tareas->tareasRecuperar($tablon->id);  //Necesario en tablon
                $usuarioTareas=new UsuarioTarea();        
                $usuarioTareas=$usuarioTareas->usuariosTareas($tablon->id);
                foreach($grupos as $grupo) //Actualizar o llenar la tabla de grupo con las tareas del grupo en cuestion
                {
                    $grupo=Grupo::where('id',$grupo->id);
                    $grupo->total=$grupo->total($grupo->id);
                    $grupo->nuevas=$grupo->estado($grupo->id,0);
                    $grupo->estancadas=$grupo->estado($grupo->id,1);
                    $grupo->proceso=$grupo->estado($grupo->id,2);
                    $grupo->listas=$grupo->estado($grupo->id,3);
                    $grupo->guardar();
                
                }
                header("Location: /lider/proyectos/tablon?url=$url1&id=1");        
            }
            $tareas=new Tarea();
            $tareas=$tareas->tareasRecuperar($tablon->id);  //Necesario en tablon
            $usuarioTareas=new UsuarioTarea();        
            $usuarioTareas=$usuarioTareas->usuariosTareas($tablon->id);
            
        }
        $router->render('lider/tablon',[
            'grupos'=>$grupos,
            'tablon'=>$tablon,
            'alertas'=>$alertas,
            'resultado'=>$idUsuario,
            'usuarios'=>$usuarios,
            'tareas'=>$tareas,
            'usuarioTareas'=>$usuarioTareas
            
        ]);
        
    }
    public static function tareasActualizar(Router $router)
    {
        //Permite actualizar a alguna tarea, puede ser el nombre o el estado de la tarea
        isLider();
        expira();
        $alertas=[];
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
        }else{
            $id=4;
        }
        $url=$_GET['url'];
        $tarea=Tarea::where('url',$url);
        $idGrupo=$tarea->IdGrupo;
        $grupo=Grupo::where('id',$idGrupo);
        $url=$grupo->idTablon;
        $tablon=Tablon::where('id',$url);
        // if($tablon->lider !== $_SESSION['nombre']){ //QUTITAR EL DEBUGEAR Y CAMBIAR POR UN HEADER
        //     header("Location: /lider/proyectos");
        // }
        $usuariostarea=UsuarioTarea::belogsTo('IdTarea',$tarea->id);// Te regresa la tarea que se va a modificar
        // foreach($usuariostarea as $usuariotarea)
        // {
        //     foreach($usuarios as $usuario)
        //     {
        //         if($usuario->id===$usuariotarea->IdUsuario)
        //         {
        //             $usuario->check="1";
        //         }
        //     }
        // }
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            
            $tarea->sincronizar($_POST);
            $idGrupo=$tarea->IdGrupo;
            $grupo=Grupo::where('id',$idGrupo);
            $url=$grupo->idTablon;
            $tablon=Tablon::where('id',$url);
            $resultado=$tarea->guardar();
            if($resultado) //Actualiza la tabla de grupo con los cambios correspondientes a las tarea
            {
                
                $grupo=Grupo::where('id',$grupo->id);
                $grupo->total=$grupo->total($grupo->id);
                $grupo->nuevas=$grupo->estado($grupo->id,0);
                $grupo->estancadas=$grupo->estado($grupo->id,1);
                $grupo->proceso=$grupo->estado($grupo->id,2);
                $grupo->listas=$grupo->estado($grupo->id,3);
                $grupo->guardar();
                $url=$grupo->idTablon;
                $tablon=Tablon::where('id',$url);
                $url=$tablon->url;
                header("Location: /lider/proyectos/tablon?url=$url&id=2");
            }

        }
        
        $router->render('lider/tareas-actualizar',[
            
            'tarea'=>$tarea,
            // 'usuarios'=>$usuarios,
            'usuariostarea'=>$usuariostarea,
            'alertas'=>$alertas,
            'resultado'=>$id
            
        ]);
    }
    public static function eliminartarea(Router $route)
    {
        //Permite eliminar una tarea
        isLider();
        expira();
        
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            $url=$_GET['url'];
            $tarea=Tarea::where('url',$url);
            $urlGrupo=$tarea->IdGrupo;
            $grupo=Grupo::where('id',$urlGrupo);
            $urlTablon=$grupo->idTablon;
            $tablon=Tablon::where('id',$urlTablon);
            
            if($tablon->lider !== $_SESSION['nombre']){ //QUTITAR EL DEBUGEAR Y CAMBIAR POR UN HEADER
                header('Location : /lider/proyectos/tablon');
            }else{
                $url=$tablon->url;
                $resultado=$tarea->eliminar();
                if($resultado){
                    $grupo=Grupo::where('id',$grupo->id);
                    $grupo->total=$grupo->total($grupo->id);
                    $grupo->nuevas=$grupo->estado($grupo->id,0);
                    $grupo->estancadas=$grupo->estado($grupo->id,1);
                    $grupo->proceso=$grupo->estado($grupo->id,2);
                    $grupo->listas=$grupo->estado($grupo->id,3);
                    $grupo->guardar();
               
                }
                header("Location: /lider/proyectos/tablon?url=$url&id=3");
            
            } 
            header('Location : /lider/proyectos');
            
            
            // $resultado=$tablon->eliminar();
            // if($resultado){
            //     header("Location: /admin/proyectos?id=3");
            // } 
            
        }
        header('Location : /lider/proyectos');
    }

    public static function comentarios(Router $router)
    {
        //Permite al usuario agreagar comentarios a las tareas
        isLider();
        expira();
        $url=($_GET['url']);
        $alertas=[];
        $tarea=new Tarea();
        $tarea=Tarea::where('url',$url);
        $urlGrupo=$tarea->IdGrupo;
        $grupo=Grupo::where('id',$urlGrupo);
        $urlTablon=$grupo->idTablon;
        $tablon=Tablon::where('id',$urlTablon);
        // $tarea=$tarea->comprobarSiUsuarioTarea($_SESSION['id'],$url);
        // if(empty($tarea) && ($tablon->lider !== $_SESSION['nombre']))
        // {
        //     header("Location: /lider/proyectos/tablon?url=$url");
        // }
        $tarea=Tarea::where('url',$url);
        $IdGrupo=$tarea->IdGrupo;
        $grupo=Grupo::where('id',$IdGrupo);
        $idTablon=$grupo->idTablon;
        $tablon=Tablon::where('id',$idTablon);
        $url=$tablon->url;
        $id=$tarea->id;
       
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            $comentario=new Comentario();
            $comentario=new Comentario();
            
            if($_FILES['imagen'])
            {
                
                $size=$_FILES['imagen']['size']; //Esto es lo que se puede cambiar para el tamaño 
                $path=$_FILES['imagen']['name'];
                $ext=pathinfo($path,PATHINFO_EXTENSION);
               
                $imagen=$_FILES['imagen'];
                if(($ext==='jpg') || ($ext==='jpeg') || ($ext==='png'))
                {
                    $nombreImagen=md5(uniqid(rand(),true)). ".jpg"; //Crear un nombre unic
                    //Realizar un resize a la imagen con intervention
                    $image=Image::make($_FILES['imagen']['tmp_name'])->resize(800,600);
                    
                    $comentario->setImagen($nombreImagen);
                    if(!is_dir(CARPETA_IMAGENES)){
                        mkdir(CARPETA_IMAGENES);
                    }
                    $image->save(CARPETA_IMAGENES .'/'.$nombreImagen);
                }
                elseif($ext===""){
                    $comentario->imagen="";
                }else{
                    $alertas['error'][]="Formato de imagen no valido";
                }
            }
            if($_FILES['archivo'])
            {
                $target_dir = "archivos/";
                $size=$_FILES['archivo']['size']; //Esto es lo que se puede cambiar para el tamaño 
                $path=$_FILES['archivo']['name'];
                $ext=pathinfo($path,PATHINFO_EXTENSION);
                $temp_name = $_FILES['archivo']['tmp_name'];
              
                if(($ext==='xlsx') || ($ext==='doc') || ($ext==='pdf'))
                {
                    if(!is_dir(CARPETA_ARCHIVO)){
                        mkdir(CARPETA_ARCHIVO);
                    }
                    $nombreArchivo=md5(uniqid(rand(),true)).".".$ext; //Crear un nombre unic
                    $path_filename_ext = $target_dir.$nombreArchivo;
                    
                    
                    
                    //Realizar un resize a la imagen con intervention
                    $comentario->setArchivo($nombreArchivo);
                    move_uploaded_file($temp_name,$path_filename_ext);
                }
                elseif($ext===""){
                    $comentario->archivo="";
                }else{
                    $alertas['error'][]="Formato de archivo no valido";
                }
            }
            if(!($_POST['contenido']==="")){
                $comentario->contenido=$_POST['contenido'];
                $comentario->fecha=date('d-m-Y');
                $comentario->IdTarea=$id;
                $comentario->IdUsuario=$_SESSION['id'];
                $comentario->nombre=$_SESSION['nombre'];
                
            }else{
                $alertas['error'][]="tu comentario esta vacio, vuelve a intentarlo";
            }
            if(empty($alertas))
            {
                
                
                $resultado=$comentario->guardar();
                if($resultado)
                {
                    header("Location: /lider/proyectos/tablon?url=$url&id=1");
                }
            }
        }
        $router->render('lider/comentarios',[
            'tarea'=>$tarea,
            'alertas'=>$alertas
            
        ]);
    }
    public static function contenido(Router $router)
    {
        //Permite al usuario visualizar contenido como comentarios o imagenes
        isLider();
        expira();
        $url=$_GET['url'];
        $tarea=new Tarea();
        // $tarea=$tarea->comprobarSiUsuarioTarea($_SESSION['id'],$url); //Revisar si la persona que intenta comentar es dueña del proyecto o participa en esa tarea
        if(empty($tarea))
        {
            header("Location: /lider/proyectos/tablon?url=$url");
        }
        $tarea=Tarea::where('url',$url);
        $id=$tarea->id;
        $comentarios=Comentario::belogsToOrdenado('IdTarea',$id);
        
        $router->render('lider/mostrar',[
            'comentarios'=>$comentarios
            
        ]);
    }
    
    
    
    
}


?>