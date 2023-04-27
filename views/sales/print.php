<div id="reporte">
    <picture class="d-flex justify-content-center">
        <source srcset="/build/img/logo.avif" type="image/avif">
        <source srcset="/build/img/logo.webp" type="image/webp">
        <img loading="lazy" src="/build/img/logo.jpg" alt="Logo" class="w-15">
    </picture>
    <h1 class="text-center fs-1 fw-bold mb-5 text-uppercase">Sistema de Inventario</h1>
    <div class="d-flex justify-content-end">
        <table class="table table-bordered w-auto text-center fs-2">
            <thead>
                <tr class="bg-body-secondary">
                    <th scope="col">Reporte de Ventas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fs-3 text-uppercase">
                        <?php
                        if (empty($month)) {
                            echo $start;
                            if ($start !== $end) {
                                echo ' - ' . $end;
                            } else {
                                '';
                            }
                        } else {
                            echo $month;
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <table class="table table-bordered text-center fs-2">
        <thead>
            <tr class="bg-body-secondary">
                <th scope="col">Código</th>
                <th scope="col">Fecha</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sales as $sale) : ?>
                <tr>
                    <td><?php echo $sale->id; ?></td>
                    <td><?php echo $sale->date; ?></td>
                    <td><?php echo $sale->product->name; ?></td>
                    <td>$<?php echo $sale->product->sale_price; ?></td>
                    <td><?php echo $sale->quantity; ?></td>
                    <td>$<?php echo $sale->total; ?></td>
                </tr>
                <?php $total = $total + $sale->total; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p class="fs-2 my-5">Total: <span class="fw-bold text-danger">$<?php echo $total; ?></span></p>
</div>

<div id="reporteBotones">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <button id="btnImprimir" class="btn btn-primary fs-3">
            <i class="bi bi-printer"></i>
            Imprimir
        </button>
        <a href="/reports" class="btn btn-secondary fs-3">
            <i class="bi bi-arrow-return-left"></i>
            Regresar
        </a>
    </div>
</div>

<!-- <script src="/build/js/html2pdf.bundle.min.js"></script> -->