<?php

namespace Controllers\Proyectos;

use Controllers\PublicController;
use Utilities\Site;
use Views\Renderer;
use Dao\Proyectos\ProyectosD;


class ProyectosForm extends PublicController{
    private $viewData=[];
    private $modeDscArr=[
        "INS"=>"Crear nuevo Proyecto",
        "UPD"=>"Editando %s (%s)",
        "DSP"=>"Detalle de %s (%s)",
        "DEL"=>"Eliminando %s (%s)",
    ];
    private $mode='';
    private $proyectos=[
    "ProjectID"=> 0,
    "ProjectName"=> '',
    "StartDate"=> '',
    "EndDate"=> '',
    "Budget"=> 0,
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
            Site::redirectToWithMsg("index.php?page=proyectos-proyectosList","Algo sucedio mal! intente de nuevo");
            die();
        }

        if($this->mode!=='INS' && isset($_GET["ProjectID"])) {
            $this->proyectos["ProjectID"]=$_GET["ProjectID"];
            $this->cargarDatosProyecto();
        }
    }

    private function cargarDatosProyecto(){
        $tmpProyecto=ProyectosD::obtenerProyectosPorId($this->proyectos["ProjectID"]);
        $this->proyectos =$tmpProyecto;
    }
    
    private function cargarDatosDelFormulario(){
        
        $this->proyectos["ProjectName"]=$_POST["ProjectName"];
        $this->proyectos["StarDate"]=$_POST["StarDate"];
        $this->proyectos["EndDate"]=$_POST["EndDate"];
        $this->proyectos["Budget"]=floatval($_POST["Budget"]);
        $this->proyectos["FocusArea"]=$_POST["FocusArea"];
 
    }

    private function procesarAccion(){
        switch($this->mode){
            case 'INS':
                $result=ProyectosD::agregarProyectos($this->proyectos);
                if($result){
                    Site::redirectToWithMsg("index.php?page=proyectos-proyectosList","El proyecto se registro satisfactoriamente!");
                }
                break;
            case 'UPD':
                $result=ProyectosD::actualizarProyecto($this->proyectos);
                if($result){
                    Site::redirectToWithMsg("index.php?page=proyectos-proyectosList","El registro del proyecto fue actualizado satisfactoriamente!");
                }
                break;
            case 'DEL':
                $result=ProyectosD::eliminarProyecto($this->proyectos['ProjectID']);
                if($result){
                    Site::redirectToWithMsg("index.php?page=proyectos-proyectosList","El registro del proyecto fue eliminado satisfactoriamente!");
                }

                break;
        }
    }

    private function generarViewData(){
        $this->viewData["mode"]=$this->mode;
        $this->viewData["modes_dsc"]=sprintf($this->modeDscArr[$this->mode],
        $this->proyectos["ProjectID"],
        $this->proyectos["ProjectName"]);
        $this->viewData["proyecto"]=$this->proyectos;

        //Para no poder editar informacion en otras partes que no sea en modo editar
        $this ->viewData["readonly"]=
        ($this->viewData["mode"] === 'DSP' 
        || $this->viewData["mode"] === 'DEL')? 'readonly':'';
        $this->viewData["showConfirm"]=($this->viewData["mode"] !== 'DSP');


    }
}