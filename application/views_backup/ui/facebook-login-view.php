<div class="container">
    <div class="row">
      <div class="col-6 offset-3 login-page">
        <div class="card">
          <h5 class="card-header"><?php echo $responce['msg']; ?></h5>
          <p>
            <?php if($this->input->get('error_code')){ echo $this->input->get('error_message'); } ?>
          </p>
        </div>
    </div>
  </div>
</div>