

<h3> Create an account </h3>
<?php $form = \app\core\form\Form::begin('',"post") ?>
  <div class="row">
    <div class="col-6">
      <?php echo $form->field($model,'firstname')?>
    </div>
    <div class="col-6">
      <?php echo $form->field($model,'lastname')?>
    </div>
</div>

  <?php echo $form->field($model,'email')?>
  <?php echo $form->field($model,'password')->passwordField()?>
  <?php echo $form->field($model,'confirmpassword')->passwordField()?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end() ?>
