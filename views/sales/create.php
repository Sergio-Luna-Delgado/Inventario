<div class="d-flex justify-content-between align-items-center mb-5">
    <h1 class="fs-1 fw-bold">Llena el formulario para crear una venta</h1>
    <a href="/sales" class="btn btn-secondary fs-3">
        <i class="bi bi-arrow-return-left"></i>
        Regresar
    </a>
</div>

<form method="post" id="formSale" class="mt-5 fs-2">
    <div class="mb-3">
        <label for="product" class="form-label fw-bold">Busca un producto</label>
        <select name="product_ID" id="product_ID" class="form-select fs-2" aria-label="Default product">
            <option hidden>Selecciona un producto</option>
            <?php foreach ($products as $product) : ?>
                <option value="<?php echo $product->id; ?>" <?php echo s($sale->product_ID) === $product->id ? 'selected' : ''; ?>><?php echo $product->name; ?></option>
            <?php endforeach; ?>
        </select>
        <span class="text-danger d-block"><?php if (isset($alertasInput['product_ID'])) echo "* " . $alertasInput['product_ID']; ?></span>
    </div>
    <!-- <div class="mb-3">
        <label for="nameProduct" class="form-label fw-bold">Nombre</label>
        <input type="text" name="name" id="nameProduct" class="form-control fs-2" value="<php echo $product_search->name ?? ''; ?>" disabled>
    </div> -->
    <div class="mb-3">
        <label for="sale_price" class="form-label fw-bold">Precio de Venta</label>
        <input type="number" name="sale_price" id="sale_price" class="form-control fs-2" value="<?php echo $product_search->sale_price ?? ''; ?>" disabled>
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label fw-bold">Cantidad</label>
        <input type="number" name="quantity" id="quantity" class="form-control fs-2" disabled placeholder="Ej. 3" min="1" step="any" value="<?php echo $sale->quantity; ?>">
        <span class="text-danger d-block"><?php if (!empty($product_search)) echo "* Productos en el inventario: " . $product_search->stock; ?></span>
        <span class="text-danger d-block"><?php if (isset($alertasInput['quantity'])) echo "* " . $alertasInput['quantity']; ?></span>
    </div>
    <div class="mb-3">
        <label for="total" class="form-label fw-bold">Total</label>
        <input type="number" name="total" id="total" class="form-control fs-2" disabled value="<?php echo $sale->total; ?>">
    </div>
    <input type="submit" value="Crear Venta" class="btn btn-primary fs-3 px-5 py-2 mt-5">
</form>