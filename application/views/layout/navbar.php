<nav class="navbar navbar-expand-lg bg-azul-gradient border-bottom border-dark">
  <div class="container-fluid">
    <!-- Logo y título -->
    <div class="d-flex align-items-center">
      <a class="navbar-brand d-flex align-items-center" href="<?= base_url(); ?>">
        <img src="<?= base_url(); ?>public_images/logo.png" height="100" alt="Logo IMSJ">
        <h1 class="h4 mb-0 text-blanco">Sistema de Call Center</h1>
      </a>
    </div>

    <!-- Botón responsive -->
    <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido colapsable -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
      <ul class="navbar-nav align-items-center">
          
        <li class="nav-item mx-3 text-blanco">
            <span class="fw-bold">Bienvenido,</span> <?= $this->session->userdata("usuario"); ?>
        </li>
            
        <li class="nav-item me-2">
          <a class="btn btn-azul-claro btn-sm" href="<?= base_url(); ?>">Inicio</a>
        </li>
        <?php if ($this->session->userdata("admin") == 1) { ?>
            <li class="nav-item me-2">
                <a class="btn btn-azul-claro btn-sm" href="<?= base_url(); ?>welcome/usuarios">
                Administrar usuarios
                </a>
            </li>
        <?php } ?>
        <li class="nav-item">
          <a class="btn btn-azul-claro btn-sm" href="<?= base_url(); ?>welcome/logout">Cerrar Sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
