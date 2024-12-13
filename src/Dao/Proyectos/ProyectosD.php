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

    public static function agregarProyectos($proyecto){
        
        unset($proyecto['ProjectID']);
        unset($proyecto['creado']);
        unset($proyecto['actualizado']);
        

        $sqlstr='insert into conservationprojects (
            ProjectName,StartDate,EndDate,Budget,FocusArea) values
        (
            :ProjectName,:StartDate, :EndDate, :Budget, :FocusArea
        );';
        
        return self::executeNonQuery($sqlstr,$proyecto);
    }
    public static function actualizarProyecto($proyecto){
        unset($proyecto['creado']);
        unset($proyecto['actualizado']);
        $sqlstr=" update conservationprojects set ProjectName = :ProjectName, StartDate = :StartDate, EndDate = :EndDate, Budget = :Budget, FocusArea = :FocusArea where ProjectID = :ProjectID;";

            return self::executeNonQuery($sqlstr,$proyecto);
    }

    public static function eliminarProyecto($ProjectID){
        $sqlstr='delete from conservationprojects where ProjectID=:ProjectID;';
        return self::executeNonQuery($sqlstr,["ProjectID"=>$ProjectID]);
    }
}


?>