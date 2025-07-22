<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <div class="d-flex flex-column">
                <a href="<?php echo base_url();?>" class="navbar-brand">
                    <img src="<?php echo base_url();?>logo.png" height="50" alt="CoolBrand">
                </a>
            </div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if($this->session->userdata("admin") == 1){ ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url();?>welcome/usuarios">Administrar usuarios</a>
                    </li>
                <?php } ?>
            </ul>
            <div class="d-flex flex-column">                
            </div>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="Toggle navigation"
                >
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <p class="nav-item nav-link active text-center font-weight-bold me-5"> Bienvenido:  <?php echo $this->session->userdata("usuario");  ?> </p>
                        <a href="<?php echo base_url();?>welcome/logout" class="nav-item nav-link active">Cerrar Sesión</a>
                </div>
            </div>
        </div>
</nav>