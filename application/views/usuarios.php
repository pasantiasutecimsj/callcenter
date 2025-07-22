<section class="h-100">
  <div class="container h-100 my-5">
    <div class="row justify-content-center">
      <div class="col-xl-11">
        <div class="card shadow-lg p-4 rounded-4">

          <!-- Alertas -->
          <?php if ($this->session->flashdata("error")) : ?>
            <div class="alert alert-danger text-center" role="alert">
              <?= $this->session->flashdata("error") ?>
            </div>
          <?php endif; ?>

          <?php if ($this->session->flashdata("success")) : ?>
            <div class="alert alert-success text-center" role="alert">
              <?= $this->session->flashdata("success") ?>
            </div>
          <?php endif; ?>

          <div class="row">
            <!-- Formulario de usuario -->
            <div class="col-md-4">
              <h2 class="text-center mb-4 text-azul fw-bold">Nuevo Usuario</h2>
              <form method="POST" action="<?php echo base_url();?>welcome/nuevo_usuario" autocomplete="off">
                <div class="mb-3">
                  <label for="username" class="form-label">Usuario</label>
                  <input type="text" class="form-control input-focus" id="username" name="username" required>
                </div>

                <div class="mb-3">
                  <label for="password" class="form-label">Contraseña</label>
                  <input type="password" class="form-control input-focus" id="password" name="password" required>
                </div>

                <div class="mb-3">
                  <label for="password_confirm" class="form-label">Confirmar contraseña</label>
                  <input type="password" class="form-control input-focus" id="password_confirm" name="password2" required>
                </div>

                <label class="form-label">Es admin</label>
                <div class="radio-group">
                  <label class="custom-radio">
                    <input type="radio" name="admin" value="1">
                    <span class="radio-mark"></span> Si
                  </label>
                  <label class="custom-radio">
                    <input type="radio" name="admin" value="0" checked>
                    <span class="radio-mark"></span> No
                  </label>
                </div>

                <div class="d-grid mt-3">
                  <button type="submit" class="btn btn-login">Registrar</button>
                </div>
              </form>
            </div>

            <!-- Tabla de usuarios -->
            <div class="col-md-8">
              <h2 class="text-center mb-4 text-azul fw-bold">Lista de Usuarios</h2>
              <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                  <thead class="bg-light">
                    <tr>
                      <th class="text-center">Usuario</th>
                      <th class="text-center">Admin</th>
                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($usuarios as $usuario) { ?>
                      <tr>
                        <td class="text-center"><?php echo $usuario['username']; ?></td>
                        <td class="text-center"><?php echo $usuario['admin'] ? 'Si' : 'No'; ?></td>
                        <td class="text-center">
                          <button type="button" 
                            data-bs-toggle="modal" 
                            data-bs-target="#ModalEliminar_<?php echo $usuario['username']; ?>" 
                            class="btn btn-danger btn-sm"
                            <?php if ($this->session->userdata("usuario") == $usuario['username']) echo "disabled"; ?>
                          >Eliminar</button>
                        </td>
                      </tr>

                      <!-- Modal de eliminación -->
                      <div class="modal fade" id="ModalEliminar_<?php echo $usuario['username']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Eliminar usuario <?php echo $usuario['username']; ?></h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p>¿Estás seguro de que quieres eliminar este usuario?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                              <form method="POST" action="<?php echo base_url();?>welcome/eliminar_usuario">
                                <input type="hidden" name="username" value="<?php echo $usuario['username']; ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>