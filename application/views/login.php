<section class="h-100 bg-azul-fondo d-flex align-items-center">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">

                <?php if ($this->session->flashdata('logout')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('logout') ?></div>
                <?php endif; ?>

                <div class="card card-login">
                    <div class="card-body">
                        <img src="<?= base_url(); ?>public_images/logo.png" alt="San José de Mayo" class="img-fluid mb-4 d-block mx-auto" style="max-height: 100px;">
                        <h1 class="fs-4 fw-bold mb-4 text-center">Iniciar sesión</h1>

                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                        <?php endif; ?>

                        <form method="POST" action="<?= base_url(); ?>welcome/login" class="needs-validation" novalidate autocomplete="off">
                            <div class="mb-3">
                                <label class="form-label text-muted" for="username">Usuario</label>
                                <input id="username" type="text" class="form-control input-focus" name="username" required autofocus>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted" for="password">Contraseña</label>
                                <input id="password" type="password" class="form-control input-focus" name="password" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-login">Iniciar sesión</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
