<div class="d-flex flex-column justify-content-center h-100">
    <a href="/" class="d-flex align-items-center justify-content-center gap-3">
        <img src="/build/img/icon.svg" alt="Logo Todolist" class="w-5">
        <span class="fw-bold fs-1 text-black">Inventario</span>
    </a>

    <p class="fw-bold fs-2 text-center mt-5">Inicia sesión para entrar al sistema de inventario</p>

    <form action="/" method="post" class="mt-5">
        <label for="username" class="form-label fs-3">Username:</label>
        <input type="text" name="username" id="username" class="form-control fs-3" placeholder="Escribe tu username" value="<?php echo $user->username; ?>">
        <span class="text-danger d-block"><?php if (isset($alertasInput['username'])) echo "* " . $alertasInput['username']; ?></span>
        <span class="text-danger d-block"><?php if (isset($alertasInput['noUsername'])) echo "* " . $alertasInput['noUsername']; ?></span>

        <label for="password" class="form-label fs-3 mt-5">Contraseña:</label>
        <input type="password" name="password" id="password" class="form-control fs-3" placeholder="Escribe tu contraseña">
        <span class="text-danger d-block"><?php if (isset($alertasInput['password'])) echo "* " . $alertasInput['password']; ?></span>
        <span class="text-danger d-block"><?php if (isset($alertasInput['noPassword'])) echo "* " . $alertasInput['noPassword']; ?></span>

        <input type="submit" value="Iniciar Sesión" class="btn btn-primary fs-3 px-5 py-2 mt-5">
    </form>
</div>