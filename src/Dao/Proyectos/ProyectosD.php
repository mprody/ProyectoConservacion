<?php 
namespace Dao\Proyectos;

use Dao\Table;

class ProyectosD extends Table{

    public static function obtenerProyectos(){
        $sqlstr ='SELECT * FROM conservationprojects';
        $proyectos=self::obtenerRegistros($sqlstr,[]);
        return $proyectos;
    }

    public static function obtenerProyectosPorId($ProjectID){
        $sqlstr='SELECT * FROM conservationprojects WHERE ProjectID=:ProjectID;';
        $proyectos=self::obtenerUnRegistro($sqlstr,["ProjectID"=>$ProjectID]);
        return $proyectos;
    }
}


?>