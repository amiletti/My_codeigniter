<?php $this->load->view('/themes/admin/header') ?>

<h4 class="page-header">File upload</h4>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label class="col-sm-2 control-label">Upload files</label>
    <div class="col-sm-10">
      <input name="file[]" type="file" multiple="multiple" />
      <small>By default only images files are allowed, if you want you can upload multiple files at once</small>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Upload</button>
    </div>
  </div>
</form>

  
<?php if(isset($files) && $files): ?>
  <h4 class="page-header">File uploaded</h4>
  <?php if(is_array($files)): ?>
    <?php foreach ($files as $k => $v): ?>
      <?php if($v): ?>
        <pre><?php print_r($this->file_model->get($v)) ?></pre>
      <?php else: ?>
        <pre><?php var_dump($v); ?></pre>
      <?php endif ?>
    <?php endforeach ?>
  <?php else: ?>
    <pre><?php print_r($this->file_model->get($files)) ?></pre>
  <?php endif ?>
<?php endif ?>

<?php $this->load->view('/themes/admin/footer') ?>