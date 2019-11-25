<div class="col-md-10 content">
   <div class="panel panel-default">
		<div class="panel-heading">
			Create New Admin
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<!-- <h3>Add New Page</h3> -->
					<div class="card-body">
              <form accept-charset="UTF-8" id="addAdmin">
                <fieldset> 
                  <div class="form-group">
                      <label for="name">Admin User Name</label>
                      <input class="form-control" id="name" name="name" type="text">
                  </div>
                  <div class="form-group">
                      <label for="email">Admin Email <small class="text-default"> A detail instruction will be sent here</small></label>
                      <input class="form-control" id="email" name="email" type="email">
                  </div>
                  <div class="responce">
                  </div>
                  <div class="">
                      <button class="btn btn-default" type="submit" id="submit">Create Admin</button>
                  </div> 
                </fieldset>
              </form>
          </div>
				</div>
			</div>
		</div> 
	</div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jodit/jodit.min.css') ?>">