
        <footer class="pull-left footer">
            <p class="col-md-12">
                <hr class="divider">
                <!-- Copyright &COPY; 2015 <a href="http://www.pingpong-labs.com">Gravitano</a> -->
            </p>
        </footer>
    </div>
	
	<script type="text/javascript">
		let base_url = '<?php echo base_url(); ?>'
	</script>
	<script src="<?php echo base_url('assets/js/jquery.2.1.1.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/admin-script.js') ?>"></script>	
	<script	  src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>
	<?php 
		if(isset($scripts)){
			foreach($scripts as $script){
	?>
	<script src="<?php echo base_url('assets/js/'.$script) ?>" type="text/javascript"></script>
	<?php } } ?>
</body>
</html>