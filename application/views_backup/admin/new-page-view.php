<div class="col-md-10 content">
   <div class="panel panel-default">
		<div class="panel-heading">
			Create New Page
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">
					<!-- <h3>Add New Page</h3> -->
					<div class="card-body">
                        <form accept-charset="UTF-8" id="addPage">
                          <fieldset> 
                            <div class="form-group">
                                <label for="title">Page Title</label>
                                <input class="form-control" id="title" name="title" type="text">
                            </div>
                            <div class="form-group">
                                <label for="area_editor">Page Content</label>
                               <textarea name="content" id="area_editor" class="form-control"></textarea>
                            </div>
                            <div class="responce">
                                  
                            </div>
                            <div class="">
                                <button class="btn btn-default" type="submit" id="submit">Create Page</button>
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