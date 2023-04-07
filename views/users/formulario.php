<div class="mb-3">
    <label for="fullname" class="form-label fw-bold">Nombre Completo*</label>
    <input type="text" name="fullname" id="fullname" class="form-control fs-2" placeholder="Escribe tu nombre completo" value="<?php echo $user->fullname; ?>">
    <span class="text-danger d-block"><?php if (isset($alertasInput['fullname'])) echo "* " . $alertasInput['fullname']; ?></span>
</div>

<div class="mb-3">
    <label for="username" class="form-label fw-bold">Nombre de Usuario*</label>
    <input type="text" name="username" id="username" class="form-control fs-2" placeholder="Escribe tu username" value="<?php echo $user->username; ?>">
    <span class="text-danger d-block"><?php if (isset($alertasInput['username'])) echo "* " . $alertasInput['username']; ?></span>
    <span class="text-danger d-block"><?php if (isset($alertasInput['noUsername'])) echo "* " . $alertasInput['noUsername']; ?></span>
</div>

<?php if (isset($user->imagen_actual)) : ?>
    <button class="btn btn-warning fs-3 my-3" type="button" data-bs-toggle="modal" data-bs-target="#passwordModal">Cambiar Contraseña</button>
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-1" id="passwordModalLabel">Cambiar Contraseña</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="password" id="password" class="form-control fs-2" placeholder="Escribe tu contraseña">
                    <button type="button" class="btn btn-secondary mt-5 fs-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary mt-5 fs-2" onclick="cambiarPassword(<?php echo $user->id; ?>)">Guardar Contraseña</button>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="mb-3">
        <label for="password" class="form-label fw-bold">Contraseña*</label>
        <input type="password" name="password" id="password" class="form-control fs-2" placeholder="Escribe tu contraseña">
        <span class="text-danger d-block"><?php if (isset($alertasInput['password'])) echo "* " . $alertasInput['password']; ?></span>
        <span class="text-danger d-block"><?php if (isset($alertasInput['noPassword'])) echo "* " . $alertasInput['noPassword']; ?></span>
    </div>
<?php endif; ?>

<?php if ($_SESSION['admin']) : ?>
    <p class="mt-3 fw-bold">Estatus*</p>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="active" id="estatusActivo" value="1" <?php echo $user->active == "1" ? 'checked' : '' ?>>
        <label class="form-check-label" for="estatusActivo">
            Activo
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="active" id="estatusInactivo" value="0" <?php echo $user->active == "0" ? 'checked' : '' ?>>
        <label class="form-check-label" for="estatusInactivo">
            Inactivo
        </label>
    </div>
<?php endif; ?>

<div class="my-3">
    <label for="imagen" class="form-label fw-bold">Foto de perfil</label>
    <input type="file" name="imagen" id="imagen" class="form-control fs-2">
</div>

<?php if (isset($user->imagen_actual)) : ?>
    <div class="d-flex flex-column justify-content-center align-items-center">
        <p class="fs-3 text-center">Imagen Actual:</p>
        <div class="">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/build/img/users/' . $user->imagen; ?>.webp" type="image/webp">
                <img loading="lazy" src="<?php echo $_ENV['HOST'] . '/build/img/users/' . $user->imagen; ?>.png" alt="<?php echo $user->fullname ?>" class="w-15">
            </picture>
        </div>
    </div>
<?php endif; ?>

<p class="fs-3 text-danger">* = Obligatorio</p>