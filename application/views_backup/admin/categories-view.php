<div class="col-md-10 content">
   <div class="panel panel-default">
		<div class="panel-heading">
			Categories
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-8">
					<h3>Categories list</h3>
					<table class="table table-striped custab">
						<p class="error text-default"></p>
					    <thead>
					        <tr>
					            <th>ID</th>
					            <th>Title</th>
					            <th>Parent</th>
					            <th class="text-center">Action</th>
					        </tr>
					    </thead>
					    <?php if($cats = $this->general_model->get_table_rows_by_a_field('aid_categories')){
					    		foreach($cats as $num => $cat){
					     ?>
					     <tbody></tbody>
					    <tr>
					    	<?php $get_row =  $this->general_model->get_a_table_row('aid_categories','id_cat',$cat['parent_id']);
					    			$parent_name = $get_row ? $get_row['cat_name'] : '';
					    	  ?>
					        <td><?php echo $num + 1  ?></td>
					        <td><?php echo $cat['cat_name'];  ?></td>
					        <td><?php echo $parent_name; ?></td>
					        <td class="text-center"><a class='btn btn-info btn-xs' onclick="editCategory('<?php echo $this->my_encrypt->encode($cat['id_cat']) ?>')" href="#!"><span class="glyphicon glyphicon-edit"></span> Edit</a> <a href="#!" onclick="deleteCategory('<?php echo $this->my_encrypt->encode($cat['id_cat']) ?>')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a></td>
					    </tr>
					<?php }} ?>
					</table>
				</div>
				<div class="col-md-4">
					<h3>Add New Category</h3>
					<div class="card-body">
                        <form accept-charset="UTF-8" id="addCategory">
                          <fieldset> 
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input class="form-control" id="title" name="title" type="text">
                            </div>
                            <div class="form-group">
                                <label for="title">Parent Category</label>
                               <select class="form-control" name="parent">
                               		<option value="0">Select Parent</option>
                               		<?php if($cats = $this->general_model->get_table_rows_by_a_field('aid_categories','parent_id','0')){
								    		foreach($cats as $num => $cat){
								     ?>
                               		<option value="<?php echo $cat['id_cat'] ?>"><?php echo $cat['cat_name'] ?></option>
                               	<?php }} ?>
                               </select>
                            </div>
                            <div class="form-group">
                                <label for="about">Category Info</label>
                               <textarea name="info" id="about" class="form-control"></textarea>
                            </div>
                            <div class="responce">
                                  
                            </div>
                                    <input class="btn btn-lg bg-default btn-block" type="submit" id="submit" value="Add Category">
                          </fieldset>
                        </form>
                    </div>
				</div>
			</div>
		</div> 
	</div>
</div>