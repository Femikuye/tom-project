<div class="col-md-10 content">
   <div class="panel panel-default">
		<div class="panel-heading">
			Users
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">
					<h3>Admin Users list</h3>
					<table class="table table-striped custab">
						<p class="error text-default"></p>
					    <thead>
					        <tr>
					            <th>User Name</th>
					            <th>Email</th>
					            <!-- <th class="text-center">Action</th> -->
					        </tr>
					    </thead>
					    <?php if($users = $this->general_model->get_table_rows_by_a_field('admins')){
					    		foreach($users as $num => $user){
					     ?>
					     <tbody></tbody>
					    <tr>
					        <td><?php echo $user['username'];  ?></td>
					        <td><?php echo $user['email'];  ?></td>
					        <!-- <td class="text-center"><a class='btn btn-info btn-xs' href="<?php //echo base_url('admin/edit-page/'.$page['page_slug']) ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a> <a href="#!" onclick="deletePage('<?php //echo $this->my_encrypt->encode($page['id_page']) ?>')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a></td> -->
					    </tr>
					<?php }} ?>
					</table>
					<div>
						<a href="<?php echo base_url('admin/new-admin') ?>">Add New Admin</a>
					</div>
				</div>
			</div>
		</div> 
	</div>
</div>