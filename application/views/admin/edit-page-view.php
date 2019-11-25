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
            <?php if($page_row){ ?>
                        <form accept-charset="UTF-8" id="updatePage">
                          <fieldset> 
                            <div class="form-group">
                                <label for="title">Page Title</label>
                                <input class="form-control" value="<?php echo $page_row['page_name'] ?>" id="title" name="title" type="text">
                            </div>
                            <div class="form-group">
                                <label for="area_editor">Page Content</label>
                               <textarea name="content" id="area_editor" class="form-control"><?php echo $page_row['page_content'] ?></textarea>
                               <input type="hidden" value="<?php echo $this->my_encrypt->encode($page_row['id_page']) ?>" name="page_id">
                            </div>
                            <div class="responce">
                                  
                            </div>
                            <div class="form-group">
                                <input class="btn btn-default" type="submit" id="submit" value="Update">
                            </div> 
                          </fieldset>
                        </form>
                <?php }else{ ?>
                  <p>The page is no longer exist on the server</p>
                <?php } ?>
            </div>
				</div>
			</div>
		</div> 
	</div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jodit/jodit.min.css') ?>">