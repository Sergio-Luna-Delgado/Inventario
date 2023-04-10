<div class="d-flex justify-content-between align-items-center mb-5">
    <h1 class="fs-1 fw-bold">Gestiona a todos los productos del sistema</h1>
    <a href="/products/create" class="btn btn-primary fs-3">
        <i class="bi bi-plus-circle"></i>
        Agregar Producto
    </a>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr class="text-center">
                <th scope="col">Código</th>
                <th scope="col">Categoría</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <!-- <th scope="col">Precio de compra</th> -->
                <th scope="col">Stock</th>
                <th scope="col">Fecha</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($products as $product) : ?>
                <tr class="text-center">
                    <td><?php echo $product->id; ?></td>
                    <td><?php echo $product->category->name; ?></td>
                    <td><?php echo $product->name; ?></td>
                    <!-- <td>$<php echo $product->buy_price; ?></td> -->
                    <td>$<?php echo $product->sale_price; ?></td>
                    <td><?php echo $product->stock; ?></td>
                    <td><?php echo $product->date; ?></td>
                    <td>
                        <a href="/products/update?id=<?php echo $product->id; ?>" class="btn btn-warning fs-3 m-1">
                            <i class="bi bi-pencil"></i>
                            Editar
                        </a>
                        <button type="button" class="btn btn-danger fs-3 m-1" data-bs-toggle="modal" data-bs-target="#borrarModal<?php echo $product->id; ?>">
                            <i class="bi bi-trash"></i>
                            Eliminar
                        </button>
                        <div class="modal fade" id="borrarModal<?php echo $product->id; ?>" tabindex="-1" aria-labelledby="borrarModalLabel<?php echo $product->id; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-1" id="borrarModalLabel<?php echo $product->id; ?>">¿Estas seguro en borrar el producto?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <button type="button" class="btn btn-secondary mt-5 fs-2" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary mt-5 fs-2" onclick="eliminarRegistro(<?php echo $product->id; ?>, 'products')">Borrar</button>
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