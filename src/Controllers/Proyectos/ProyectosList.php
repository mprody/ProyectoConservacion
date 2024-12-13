<?php 
namespace Controllers\Proyectos;

use Controllers\PublicController;
use Dao\Proyectos\ProyectosD;
use Views\Renderer;

class ProyectosList extends PublicController{
    public function run(): void{
        $proyectosD=ProyectosD::obtenerProyectos();
        $viewProyectos=[];
        

        foreach($proyectosD as $proyecto){
            $viewproyectos[]=$proyecto;
        }
        $viewData=[
            "proyectos"=>$viewproyectos
        ];
        Renderer::render('proyectos/proyectosList',$viewData);
    }
}

?>