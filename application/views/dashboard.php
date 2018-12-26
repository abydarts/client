   <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
					<a href="#menu-toggle" class="btn btn-warning" id="menu-toggle">Toggle</a>
                    <div class="col-lg-12">
                        <h1 class="page-header">Sample REST API Client</h1>
						<?php if(isset($message) && !empty($message)){ ?>
                        <div class="alert alert-warning alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <strong><?php echo $message; ?></strong>
                        </div>
						<?php } ?>
                        <p>Simple Application Rest Api Client using Codeigniter 3.</p>
						<form class="form-horizontal" action="<?php echo current_url(); ?>" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label class="col-md-2 control-label">Username</label>
								<div class="col-md-6">
									<input class="form-control" type="text" id="username" name="username" value="" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">E-mail</label>
								<div class="col-md-6">
									<input class="form-control" type="text" id="email" name="email" value="" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Image</label>
								<div class="col-md-6">
									<input class="form-control" type="file" id="image" name="image" value="" />
								</div>
							</div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
								  <button type="submit" class="btn btn-success">Submit</button>
								</div>
							</div>
						</form>
						<?php if(isset($img) && !empty($img)){ ?><img src="<?php echo $img; ?>" /><?php } ?>
                    </div>
					
                </div>
            </div>
        </div>
    <!-- /#page-content-wrapper -->