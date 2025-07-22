
<section class="h-100">

		<div class="container h-100 my-5">
    
			<div class="row justify-content-sm-center h-100">
               
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
				
                    <?php
                        if($this->session->flashdata('logout')){
                            echo '<div class="alert alert-success" role="alert">';
                            echo $this->session->flashdata('logout');
                            echo '</div>';
                        }
                     ?>       
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<img src="<?php echo base_url(); ?>logo.png" alt="San José de Mayo" class="img-fluid mb-4">
							<h1 class="fs-4 card-title fw-bold mb-4 text-center">Iniciar sesion</h1>
                            <?php

                          

                            if($this->session->flashdata('error')){
                                $error = $this->session->flashdata('error');
                                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                            }
                            ?>
							<form method="POST" action="<?php echo base_url();?>welcome/login" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="username">Usuario</label>
									<input id="username" type="text" class="form-control" name="username" value="" required autofocus>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">Contraseña</label>
									</div>
									<input id="password" type="password" class="form-control" name="password" required>
								</div>

	

								<div class="d-flex align-items-center justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                    Iniciar sesion
                                    </button>
								</div>

							</form>
						</div>
			
					</div>
					
				</div>
			</div>
		</div>
	</section>
</body>
</html>