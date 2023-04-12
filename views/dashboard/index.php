<div class="dashboard-total">
    <div class="dashboard-total__content">
        <div class="dashboard-total__left--verde">
            <i class="bi bi-person-circle dashboard-total__icon"></i>
        </div>
        <div class="dashboard-total__right bg-body-secondary">
            <span class="fs-1 fw-bold"><?php echo $totales['users']; ?></span>
            <p>Usuarios</p>
        </div>
    </div>
    <div class="dashboard-total__content">
        <div class="dashboard-total__left--rojo">
            <i class="bi bi-tag-fill dashboard-total__icon"></i>
        </div>
        <div class="dashboard-total__right bg-body-secondary">
            <span class="fs-1 fw-bold"><?php echo $totales['categories']; ?></span>
            <p>Categorias</p>
        </div>
    </div>
    <div class="dashboard-total__content">
        <div class="dashboard-total__left--azul">
            <i class="bi bi-grid-fill dashboard-total__icon"></i>
        </div>
        <div class="dashboard-total__right bg-body-secondary">
            <span class="fs-1 fw-bold"><?php echo $totales['products']; ?></span>
            <p>Productos</p>
        </div>
    </div>
    <div class="dashboard-total__content">
        <div class="dashboard-total__left--amarrillo">
            <i class="bi bi-bag-check-fill dashboard-total__icon"></i>
        </div>
        <div class="dashboard-total__right bg-body-secondary">
            <span class="fs-1 fw-bold"><?php echo $totales['sales']; ?></span>
            <p>Ventas</p>
        </div>
    </div>
</div>

<div class="dashboard-table mt-5">
    <div class="bg-body-secondary">
        <h1 class="fs-1 fw-bold text-center p-4">Productos más vendidos</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Categoria</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Dinero</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($tabla1 as $tab1) : ?>
                        <tr class="text-center">
                            <td><?php echo $tab1->categoria; ?></td>
                            <td><?php echo $tab1->nombre; ?></td>
                            <td><?php echo $tab1->cantidad; ?></td>
                            <td>$<?php echo $tab1->total; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="bg-body-secondary">
        <h1 class="fs-1 fw-bold text-center p-4">Ultimas Ventas</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Venta total</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($sales as $sale) : ?>
                        <tr class="text-center">
                            <td><?php echo $sale->id; ?></td>
                            <td><?php echo $sale->product->name; ?></td>
                            <td><?php echo $sale->date; ?></td>
                            <td>$<?php echo $sale->total; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="bg-body-secondary">
        <h1 class="fs-1 fw-bold text-center p-4">Productos recientemente añadidos</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Nombre</th>
                        <th scope="col">Inventario</th>
                        <th scope="col">Precio</th>
                        <!-- <th scope="col">Fecha</th> -->
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($products as $product) : ?>
                        <tr class="text-center">
                            <td><?php echo $product->name; ?></td>
                            <td><?php echo $product->stock; ?></td>
                            <td>$<?php echo $product->sale_price; ?></td>
                            <!-- <td><php echo $product->date; ?></td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>