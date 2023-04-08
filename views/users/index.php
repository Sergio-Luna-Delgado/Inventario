<div class="d-flex justify-content-between align-items-center mb-5">
    <h1 class="fs-1 fw-bold">Gestiona a todos los usuarios con acceso al sistema</h1>
    <a href="/users/create" class="btn btn-primary fs-3">
        <i class="bi bi-plus-circle"></i>
        Crear Usuario
    </a>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr class="text-center">
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Username</th>
                <th scope="col">Imagen</th>
                <th scope="col">Estatus</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($users as $user) : ?>
                <tr class="text-center">
                    <td><?php echo $user->id; ?></td>
                    <td><?php echo $user->fullname; ?></td>
                    <td><?php echo $user->username; ?></td>
                    <td>
                        <picture>
                            <source srcset="/build/img/users/<?php echo $user->imagen; ?>.webp" type="image/webp">
                            <img loading="lazy" src="/build/img/users/<?php echo $user->imagen; ?>.png" alt="<?php echo $user->imagen; ?>" class="w-5">
                        </picture>
                    </td>
                    <td><?php echo $user->active == 1 ? 'Activo' : 'Inactivo'; ?></td>
                    <?php if ($_SESSION['admin'] || $user->id == $_SESSION['id']) : ?>
                        <td>
                            <a href="/users/update?id=<?php echo $user->id; ?>" class="btn btn-warning fs-3 m-1">
                                <i class="bi bi-pencil"></i>
                                Editar
                            </a>
                            <button type="button" class="btn btn-danger fs-3 m-1" data-bs-toggle="modal" data-bs-target="#borrarModal<?php echo $user->id; ?>">
                                <i class="bi bi-trash"></i>
                                Eliminar
                            </button>
                            <div class="modal fade" id="borrarModal<?php echo $user->id; ?>" tabindex="-1" aria-labelledby="borrarModalLabel<?php echo $user->id; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-1" id="borrarModalLabel<?php echo $user->id; ?>">¿Estas seguro en borrar el usuario?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <button type="button" class="btn btn-secondary mt-5 fs-2" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-primary mt-5 fs-2" onclick="eliminarUsuario(<?php echo $user->id; ?>)">Borrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>