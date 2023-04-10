<div class="d-flex justify-content-between align-items-center mb-5">
    <h1 class="fs-1 fw-bold">Gestiona a todas las ventas</h1>
    <a href="/sales/create" class="btn btn-primary fs-3">
        <i class="bi bi-plus-circle"></i>
        Agregar Venta
    </a>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr class="text-center">
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Total</th>
                <th scope="col">Fecha</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($sales as $sale) : ?>
                <tr class="text-center">
                    <td><?php echo $sale->id; ?></td>
                    <td><?php echo $sale->product->name; ?></td>
                    <td><?php echo $sale->quantity; ?></td>
                    <td>$<?php echo $sale->total; ?></td>
                    <td><?php echo $sale->date; ?></td>
                    <td>
                        <button type="button" class="btn btn-danger fs-3 m-1" data-bs-toggle="modal" data-bs-target="#borrarModal<?php echo $sale->id; ?>">
                            <i class="bi bi-trash"></i>
                            Eliminar
                        </button>
                        <div class="modal fade" id="borrarModal<?php echo $sale->id; ?>" tabindex="-1" aria-labelledby="borrarModalLabel<?php echo $sale->id; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-1" id="borrarModalLabel<?php echo $sale->id; ?>">¿Estas seguro en borrar la venta?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <button type="button" class="btn btn-secondary mt-5 fs-2" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary mt-5 fs-2" onclick="eliminarRegistro(<?php echo $sale->id; ?>, 'sales')">Borrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>