<div class="d-flex justify-content-between align-items-center mb-5">
    <h1 class="fs-1 fw-bold">Llena el formulario para crear nuevos productos</h1>
    <a href="/products" class="btn btn-secondary fs-3">
        <i class="bi bi-arrow-return-left"></i>
        Regresar
    </a>
</div>

<form action="/products/create" method="post" class="mt-5 fs-2">
    <?php include 'formulario.php'; ?>
    <input type="submit" value="Crear Producto" class="btn btn-primary fs-3 px-5 py-2 mt-5">
</form>