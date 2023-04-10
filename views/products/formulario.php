<div class="mb-3">
    <label for="nameProduct" class="form-label fw-bold">Nombre</label>
    <input type="text" name="name" id="nameProduct" class="form-control fs-2" placeholder="Escribe el nombre del producto" value="<?php echo $product->name; ?>">
    <span class="text-danger d-block"><?php if (isset($alertasInput['name'])) echo "* " . $alertasInput['name']; ?></span>
</div>

<!-- <div class="mb-3">
    <label for="buy_price" class="form-label fw-bold">Precio de Compra</label>
    <input type="number" name="buy_price" id="buy_price" class="form-control fs-2" placeholder="$" min="1" step="any" value="<php echo $product->buy_price; ?>">
    <span class="text-danger d-block"><php if (isset($alertasInput['buy_price'])) echo "* " . $alertasInput['buy_price']; ?></span>
</div> -->

<div class="mb-3">
    <label for="sale_price" class="form-label fw-bold">Precio de Venta</label>
    <input type="number" name="sale_price" id="sale_price" class="form-control fs-2" placeholder="$" min="1" step="any" value="<?php echo $product->sale_price; ?>">
    <span class="text-danger d-block"><?php if (isset($alertasInput['sale_price'])) echo "* " . $alertasInput['sale_price']; ?></span>
</div>

<div class="mb-3">
    <label for="stock" class="form-label fw-bold">Inventario</label>
    <input type="number" name="stock" id="stock" class="form-control fs-2" placeholder="Ej. 3" min="0" step="1" value="<?php echo $product->stock; ?>">
    <span class="text-danger d-block"><?php if (isset($alertasInput['stock'])) echo "* " . $alertasInput['stock']; ?></span>
</div>

<div class="mb-3">
    <label for="category" class="form-label fw-bold">Categoria</label>
    <select name="category_ID" id="category_ID" class="form-select fs-2" aria-label="Default category">
        <option hidden>Selecciona una categoria</option>
        <?php foreach($categories as $category): ?>
            <option value="<?php echo $category->id; ?>" <?php echo s($product->category_ID) === $category->id ? 'selected' : ''; ?> ><?php echo $category->name; ?></option>
        <?php endforeach; ?>
    </select>
    <span class="text-danger d-block"><?php if (isset($alertasInput['category_ID'])) echo "* " . $alertasInput['category_ID']; ?></span>
</div>
