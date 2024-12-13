<h1>Listado de Proyectos</h1>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre del proyecto</th>
                <th>Dia que inicia el proyecto</th>
                <th>Dia que finaliza el proyecto</th>
                <th>Presupuesto</th>
                <th>Area del proyecto</th>
                <th><a href="index.php?page=proyecto-proyectosForm&mode=INS"><i class="fa-solid fa-plus"></i></a></th>
            </tr>
        </thead>
        <tbody>
            {{foreach proyectos}}
                <tr>
                    <td>{{ProjectID}}</td>
                    <td>{{ProjectName}}</td>
                    <td>{{StartDate}}</td>
                    <td>{{EndDate}}</td>
                    <td>{{Budget}}</td>
                    <td>{{FocusArea}}</td>
                    <td style="display: flex; gap:1rem; justify-content:center; align-items:center;">
                        <a href="index.php?page=proyecto-proyectosForm&mode=UPD&ProjectId={{ProjectID}}"> <i class="fa-solid fa-file-pen"></i></a>
                        <a href="index.php?page=proyecto-proyectosForm&mode=DEL&ProjectId={{ProjectID}}"> <i class="fa-solid fa-trash"></i></i></a>
                        <a href="index.php?page=proyecto-proyectosForm&mode=DSP&ProjectId={{ProjectID}}"> <i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
            {{endfor proyectos}}
        </tbody>
    </table>
</section>