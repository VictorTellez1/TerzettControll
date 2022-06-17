<?php


namespace Model;

class Comentario extends ActiveRecord{
    protected static $tabla='comentarios';
    protected static $columnasDB=['id','contenido','IdTarea','IdUsuario','fecha','nombre'];
    public $id;
    public $contenido;
    public $IdTarea;
    public $IdUsuario;
    public $fecha;
    public $nombre;
    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null;
        $this->contenido=$args['contenido'] ?? '';
        $this->IdTarea=$args['IdTarea'] ?? '';
        $this->IdUsuario=$args['IdUsuario'] ?? '';
        $this->fecha=$args['fecha'] ?? '';
        $this->nombre=$args['nombre'] ?? '';
    }
    //Mensajes de validacion para la creacion de una cuenta
    public function validarGrupo(){
        if(!$this->nombre){
            self::$alertas['error'][]="El nombre es obligatorio";
        }
        return self::$alertas;
    }
   
}