<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario | <?php echo $titulo ?? '' ?></title>
    <meta name="description" content="Sitio web diseñado para manejar el inventario de un negocio">
    <link rel="icon" type="image/svg" href="/build/img/icon-white.svg">
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700;900&display=swap" rel="stylesheet">
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preload" href="/build/css/app.css" as="style">
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body class="dashboard">
    <header class="dashboard__header">

        <div class="dashboard__mobile">

            <div class="d-flex align-items-center justify-content-between">

                <h1 class="dashboard__logo"><?php echo $titulo ?? '' ?></h1>

                <i class="bi bi-list text-white" style="font-size:3rem" data-bs-toggle="offcanvas" href="#menuOpciones" role="button" aria-controls="menuOpciones"></i>
                <div class="offcanvas offcanvas-start w-100" tabindex="-1" id="menuOpciones" aria-labelledby="menuOpcionesLabel">
                    <div class="offcanvas-header">
                        <h1 class="offcanvas-title fs-1 fw-bold" id="menuOpcionesLabel">Menu de Opciones</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-flex flex-column gap-5 align-items-center mt-5 fs-1">
                        <a href="/dashboard" class="<?php echo pagina_actual('/dashboard') ? 'text-warning' : 'text-black'; ?>">
                            <i class="bi bi-house"></i>
                            Dashboard
                        </a>
                        <a href="/users" class="<?php echo pagina_actual('/users') ? 'text-warning' : 'text-black'; ?>">
                            <i class="bi bi-person-circle"></i>
                            Usuarios
                        </a>
                        <a href="/categories" class="<?php echo pagina_actual('/categories') ? 'text-warning' : 'text-black'; ?>">
                            <i class="bi bi-tag-fill"></i>
                            Categorias
                        </a>
                        <a href="/products" class="<?php echo pagina_actual('/products') ? 'text-warning' : 'text-black'; ?>">
                            <i class="bi bi-grid-fill"></i>
                            Productos
                        </a>
                        <a href="/sales" class="<?php echo pagina_actual('/sales') ? 'text-warning' : 'text-black'; ?>">
                            <i class="bi bi-bag-check-fill"></i>
                            Ventas
                        </a>
                        <a href="/reports" class="<?php echo pagina_actual('/reports') ? 'text-warning' : 'text-black'; ?>">
                            <i class="bi bi-filetype-pdf"></i>
                            Reporte de Ventas
                        </a>
                    </div>
                </div>

            </div>

            <a class="text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <picture>
                    <source srcset="<?php echo $_ENV['HOST'] . '/build/img/users/' . $_SESSION['imagen']; ?>.webp" type="image/webp">
                    <img loading="lazy" src="<?php echo $_ENV['HOST'] . '/build/img/users/' . $_SESSION['imagen']; ?>.png" alt="<?php echo $_SESSION['imagen']; ?>" class="perfil">
                </picture>
                <?php echo $_SESSION['fullname'] ?>
            </a>
            <ul class="dropdown-menu fs-2">
                <li><a class="dropdown-item" href="/users/update?id=<?php echo $_SESSION['id'] ?>">Mi perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="/logout" class="">
                        <input type="submit" value="Cerrar Sesión" class="dropdown-item">
                    </form>
                </li>
            </ul>

        </div>

        <div class="dashboard__tablet">
            <div class="d-flex align-items-center justify-content-between">
                <h1 class="dashboard__logo"><?php echo $titulo ?? '' ?></h1>

                <a class="text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <picture>
                        <source srcset="<?php echo $_ENV['HOST'] . '/build/img/users/' . $_SESSION['imagen']; ?>.webp" type="image/webp">
                        <img loading="lazy" src="<?php echo $_ENV['HOST'] . '/build/img/users/' . $_SESSION['imagen']; ?>.png" alt="<?php echo $_SESSION['imagen']; ?>" class="perfil">
                    </picture>
                    <?php echo $_SESSION['fullname'] ?>
                </a>
                <ul class="dropdown-menu fs-3">
                    <li><a class="dropdown-item" href="/users/update?id=<?php echo $_SESSION['id'] ?>">Mi perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="/logout" class="">
                            <input type="submit" value="Cerrar Sesión" class="dropdown-item">
                        </form>
                    </li>
                </ul>
            </div>
        </div>

    </header>

    <!--     <php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : ''; ?>" -->

    <div class="dashboard__grid">
        <aside class="dashboard__sidebar">
            <nav class="dashboard__menu">
                <a href="/dashboard" class="<?php echo pagina_actual('/dashboard') ? 'text-warning' : 'text-white'; ?>">
                    <i class="bi bi-house"></i>
                    Dashboard
                </a>
                <a href="/users" class="<?php echo pagina_actual('/users') ? 'text-warning' : 'text-white'; ?>">
                    <i class="bi bi-person-circle"></i>
                    Usuarios
                </a>
                <a href="/categories" class="<?php echo pagina_actual('/categories') ? 'text-warning' : 'text-white'; ?>">
                    <i class="bi bi-tag-fill"></i>
                    Categorias
                </a>
                <a href="/products" class="<?php echo pagina_actual('/products') ? 'text-warning' : 'text-white'; ?>">
                    <i class="bi bi-grid-fill"></i>
                    Productos
                </a>
                <a href="/sales" class="<?php echo pagina_actual('/sales') ? 'text-warning' : 'text-white'; ?>">
                    <i class="bi bi-bag-check-fill"></i>
                    Ventas
                </a>
                <a href="/reports" class="<?php echo pagina_actual('/reports') ? 'text-warning' : 'text-white'; ?>">
                    <i class="bi bi-filetype-pdf"></i>
                    Reporte de Ventas
                </a>
            </nav>
        </aside>

        <main class="dashboard__contenido">
            <?php echo $contenido; ?>
        </main>
    </div>


    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="/build/js/bundle.min.js" defer></script>
</body>

</html>