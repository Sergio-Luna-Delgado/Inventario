<div class="d-flex justify-content-between align-items-center mb-5">
    <h1 class="fs-1 fw-bold">Genera los reportes de ventas según la fecha que necesites</h1>
</div>

<button type="button" type="button" data-bs-toggle="modal" data-bs-target="#reportModal" class="btn btn-danger fs-3 px-4 py-2">Por fecha</button>
<!-- <button type="button" onclick="reportDate()" class="btn btn-danger fs-3 px-4 py-2">Por fecha</button> -->

<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-1" id="reportModalLabel">Coloca el rango de fechas para generar el reporte</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="fechaInicio" class="form-label">De:</label>
                <input type="date" name="fechaInicio" id="fechaInicio" class="form-control fs-3">
                <label for="fechaFin" class="form-label mt-3">Hasta:</label>
                <input type="date" name="fechaFin" id="fechaFin" class="form-control fs-3">
                <button type="button" class="btn btn-primary mt-5 fs-2" onclick="reportDate()">Generar reporte</button>
            </div>
        </div>
    </div>
</div>

<button type="button" onclick="reportMonth()" class="btn btn-warning fs-3 px-4 py-2 mx-5">Este mes</button>
<button type="button" onclick="reportDay()" class="btn btn-success fs-3 px-4 py-2">Este día</button>