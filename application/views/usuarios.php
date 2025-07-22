<section class="h-100">
		<div class="container h-100 my-2">
			<div class="row justify-content-sm-center h-100">
				<div class="">
					<div class="card shadow-lg">
						<div class="card-body p-5">
        				
		                <?php if ($this->session->flashdata("error")) : ?>
			
                            <div class="alert alert-danger text-center" role="alert">
                                <?= $this->session->flashdata("error") ?>
                            </div>
		                <?php endif; ?>

                        <?php if ($this->session->flashdata("success")){?>
                            <div class="alert alert-success text-center" role="alert">
                                <?php echo $this->session->flashdata("success") ?>
                            </div>
                        <?php } ?>

		                <div class="row">
			                <div class="col-md-3"> <!-- Columna que contiene al registro -->
    				            <h1 class="fs-4 card-title fw-bold mb-4 text-center">Nuevo Usuario</h1>
                				<form method="POST" action="<?php echo base_url();?>welcome/nuevo_usuario" class="needs-validation" novalidate="" autocomplete="off">
				                	<div class="mb-3">
						                <label for="username">Usuario</label>
						                <input type="text" class="form-control" id="username" name="username" >
								
					                </div>

					                <div class="mb-3">
                                        <label>Contraseña</label>
                                        <div class="input-group" id="password"name="password" >
                                            <input class="form-control" id="password"name="password"type="password">
                                        </div>
					                </div>

                                    <div class="mb-3">
                                        <label>Confirmar contraseña</label>
                                        <div class="input-group" id="password" >
                                            <input class="form-control" id="password_confirm"name="password2" type="password">
                                            <div class="input-group-addon">
                                            </div>				
                                    </div>

                                    <label for="destino" class="form-label">Es admin</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="admin" id="Si" value="1" >
                                        <label class="form-check-label" for="Si">
                                        Si
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="admin" id="No" value="0" checked>
                                        <label class="form-check-label" for="No">
                                        No    
                                        </label>
                                    </div>

	                				
                                    <br>
					
                                    <div class="form-group d-flex justify-content-center">
                                        <input type="submit" class="btn btn-success" value="Registrar">
                                    </div>
				                </form>
			                </div>
			            </div>

			            <div class="col-md-9">
				            <h1 class="fs-4 card-title fw-bold mb-4 text-center">Lista de usuarios</h1>
				            <div class="scroll">
					            <table class="table align-middle mb-1 bg-white ms-4 table-striped table-hover">
						            <thead class="bg-light">
							            <tr>
								            <th class="text-center" scope="col">Usuario</th>
                                            <th class="text-center" scope="col">Admin</th>
                                            <th class="text-center" scope="col">Acciones</th>
		            					</tr>
					            	</thead>
						            <tbody>
                                        <?php foreach ($usuarios as $usuario) { ?>
                                        <tr>							
                                            <td class="text-center"><?php echo $usuario['username'];?></td>
                                            <td class="text-center"><?php if($usuario['admin']){echo "Si";} else {echo "No";} ?></td>
                                            <td class="text-center">

                                                <button type="button" 
                                                    data-bs-toggle="modal" 
                                                    id="BotonEliminar_<?php echo $usuario['username'];?>" 
                                                    data-bs-target="#ModalEliminar_<?php echo $usuario['username'];?>" 
                                                    class="btn btn-danger btn-sm"
                                                    <?php if($this->session->userdata("usuario") == $usuario['username']){echo "disabled";} ?>
                                                    >Eliminar
                                                </button>
                                            </td>

                                            <!-- Modal Eliminar -->
                                            <div class="modal" tabindex="-1" id="ModalEliminar_<?php echo $usuario['username'];?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Eliminar usuario <?php echo $usuario['username']; ?> </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>¿Estás seguro de que quieres eliminar este usuario?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                                            <form method="POST" action="<?php echo base_url();?>welcome/eliminar_usuario">
                                                                <input type="hidden" name="username" value="<?php echo $usuario['username'];?>">
                                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </tr>
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