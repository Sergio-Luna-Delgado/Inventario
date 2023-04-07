<div class="d-flex justify-content-between align-items-center mb-5">
    <h1 class="fs-1 fw-bold">Crea las etiquetas para usarlas en los productos del sistema</h1>
    <!-- <a href="/categories/create" class="btn btn-primary fs-3">
        <i class="bi bi-plus-circle"></i>
        Crear Categoria
    </a> -->
</div>

<div class="row flex-md-nowrap gap-3">
    <div class="col-12 col-md-6 bg-body-secondary p-3 h-18">
        <h2 class="fs-2 fw-bold pb-3 border-2 border-bottom border-primary">
            <i class="bi bi-plus-circle"></i>
            Agregar categorias
        </h2>

        <form action="/categories" method="post" class="my-3">
            <input type="text" name="name" id="name" class="form-control fs-2" placeholder="Nombre de la categoria" value="<?php echo $category->name; ?>">
            <span class="text-danger d-block"><?php if (isset($alertasInput['name'])) echo "* " . $alertasInput['name']; ?></span>
            <span class="text-danger d-block"><?php if (isset($alertasInput['existeName'])) echo "* " . $alertasInput['existeName']; ?></span>
            <input type="submit" class="btn btn-primary fs-3 mt-5 mb-3" value="Crear Categoria">
        </form>

    </div>
    <div class="col-12 col-md-6 bg-body-secondary p-3">
        <h2 class="fs-2 fw-bold pb-3 border-2 border-bottom border-primary">
            <i class="bi bi-list-ul"></i>
            Listado de categorias
        </h2>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($categories as $cate) : ?>
                        <tr class="text-center">
                            <td>
                                <?php echo $cate->id; ?>
                            </td>
                            <td>
                                <?php echo $cate->name; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning fs-3 m-1" data-bs-toggle="modal" data-bs-target="#nameModal<?php echo $cate->id; ?>">
                                    <i class="bi bi-pencil"></i>
                                    Editar
                                </button>
                                <div class="modal fade" id="nameModal<?php echo $cate->id; ?>" tabindex="-1" aria-labelledby="nameModalLabel<?php echo $cate->id; ?>" aria-hidden="false">
                                    <p><?php echo $cate->id; ?></p>
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-1" id="nameModalLabel<?php echo $cate->id; ?>">Cambiar categoria</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <input type="text" name="categoryName" id="categoryName<?php echo $cate->id; ?>" class="form-control fs-2" placeholder="Escribe tu categoria" value="<?php echo $cate->name; ?>">
                                                    <button type="button" class="btn btn-secondary mt-5 fs-2" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-primary mt-5 fs-2" onclick="cambiarNombre(<?php echo $cate->id; ?>)">Guardar Categoria</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger fs-3 m-1" onclick="eliminarCategoria(<?php echo $cate->id; ?>)">
                                    <i class="bi bi-trash"></i>
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>