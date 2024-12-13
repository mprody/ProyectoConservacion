<h1>{{modes_dsc}}</h1>
<section>
    <form action="index.php?page=proyectos-proyectosForm&mode={{mode}}&ProjectID={{ProjectID}}" method="post" class="row">
        {{with proyecto}}
        <div class="row col-8 offset-2">
            <label class="col-4" for="ProjectID">Codigo Proyecto</label>
            <input class="col-8" type="text" name="ProjectID" id="ProjectID" value="{{ProjectID}}" {{readonly}}>
        </div>
        <div class="row col-8 offset-2">
            <label class="col-4" for="ProjectName">Nombre del proyecto</label>
            <input class="col-8" type="text" name="ProjectName" id="ProjectName" value="{{ProjectName}}" {{~readonly}}>
        </div>
        <div class="row col-8 offset-2">
            <label class="col-4" for="StartDate">Dia de inicio</label>
            <input class="col-8" type="text" name="StartDate" id="StartDate" value="{{StartDate}}" {{~readonly}}>
        </div>
        <div class="row col-8 offset-2">
            <label class="col-4" for="EndDate">Dia de finalizacion</label>
            <input class="col-8" type="text" name="EndDate" id="EndDate" value="{{EndDate}}" {{~readonly}}>
        </div>
        <div class="row col-8 offset-2">
            <label class="col-4" for="Budget">Presupuesto</label>
            <input class="col-8" type="text" name="Budget" id="Budget" value="{{Budget}}" {{~readonly}}>
        </div>
        <div class="row col-8 offset-2">
            <label class="col-4" for="FocusArea">Area del proyecto</label>
            <input class="col-8" type="text" name="FocusArea" id="FocusArea" value="{{FocusArea}}" {{~readonly}}>
        </div>
        <div class="row flex-center" style="margin-top: 10px;">
            {{if ~showConfirm}}
                <button type="submit" class="primary">Confirmar</button> &nbsp;
            {{endif ~showConfirm}}
            <button id="btnCancelar" class="btn">Cancelar</button>

        </div>
        {{endwith proyecto}}
    </form>
    
</section>


<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnCancelar").addEventListener('click',(e)=>{
            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=proyectos-proyectosList");
        });
    });
</script>