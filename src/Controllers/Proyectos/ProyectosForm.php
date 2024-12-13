<?php

namespace Controllers\Proyectos;

use Controllers\PublicController;
use Utilities\Site;
use Views\Renderer;
use Dao\Proyectos\ProyectosD;


class ProyectosForm extends PublicController{
    private $viewData=[];
    private $modeDscArr=[
        "INS"=>"Crear nuevo Rol",
        "UPD"=>"Editando %s (%s)",
        "DSP"=>"Detalle de %s (%s)",
        "DEL"=>"Eliminando %s (%s)",
    ];
    private $mode='';
    private $proyectos=[
    "ProjectID"=> '',
    "ProjectName"=> '',
    "StartDate"=> '',
    "EndDate"=> '',
    "Budget"=> '',
    "FocusArea"=> '',
    ];

    public function run():void{

        $this->inicializarForm();
        if($this->isPostBack()){
            $this->cargarDatosDelFormulario();
            $this->procesarAccion();
        }
        $this->generarViewData();
        Renderer::render('proyectos/proyectosForm',$this->viewData);
    }

    private function inicializarForm(){
        if(isset($_GET["mode"]) && isset($this->modeDscArr[$_GET["mode"]])){
            $this ->mode =$_GET["mode"];
        }else{
            Site::redirectToWithMsg("index.php?page=products-rolesList","Algo sucedio mal! intente de nuevo");
            die();
        }

        if($this->mode!=='INS' && isset($_GET["ProjectID"])) {
            $this->proyectos["ProjectID"]=$_GET["ProjectID"];
            $this->cargarDatosProyecto();
        }
    }

    private function cargarDatosProyecto(){
        $tmpProyecto=ProyectosD::obtenerProyectosPorId($this->["ProjectID"]);
        $this->proyectos =$tmpProyecto;
    }
    
    private function cargarDatosDelFormulario(){
    
    $this->proyectos["ProjectID"]=$_POST["ProjectID"];
    $this->proyectos["ProjectName"]=$_POST["ProjectName"];
    $this->proyectos["StarDate"]=$_POST["StarDate"];
    
 
    }

    private function procesarAccion(){
        switch($this->mode){
            case 'INS':
                $result=RolesD::agregarRoles($this->rol);
                if($result){
                    Site::redirectToWithMsg("index.php?page=products-rolesList","El rol se registro satisfactoriamente!");
                }
                break;
            case 'UPD':
                $result=RolesD::actualizarRoles($this->rol);
                if($result){
                    Site::redirectToWithMsg("index.php?page=products-rolesList","El registro del Rol fue actualizado satisfactoriamente!");
                }
                break;
            case 'DEL':
                $result=RolesD::eliminarRoles($this->rol['rolescod']);
                if($result){
                    Site::redirectToWithMsg("index.php?page=products-rolesList","El registro del Rol fue eliminado satisfactoriamente!");
                }

                break;
        }
    }

    private function generarViewData(){
        $this->viewData["mode"]=$this->mode;
        $this->viewData["modes_dsc"]=sprintf($this->modeDscArr[$this->mode],
        $this->rol["rolesdsc"],
        $this->rol["rolescod"]);
        $this->viewData["rol"]=$this->rol;

        //Para no poder editar informacion en otras partes que no sea en modo editar
        $this ->viewData["readonly"]=
        ($this->viewData["mode"] === 'DSP' 
        || $this->viewData["mode"] === 'DEL')? 'readonly':'';
        $this->viewData["showConfirm"]=($this->viewData["mode"] !== 'DSP');


    }
}