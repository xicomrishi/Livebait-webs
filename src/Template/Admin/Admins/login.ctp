<div class="login-box">
  <div class="login-logo">
    <?php echo $this->Html->link('<b>LiveBait</b>', '/', ['escape' => false]);?>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Administrator Login</p>

    <?php echo $this->Form->create("Users", ['class' => '']); ?>
      <div class="form-group has-feedback">
        <?php echo $this->Form->input('email', ["placeholder" => "Email", 'class' => 'form-control', 'required' => true, 'label' => false, 'div' => false]); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo $this->Form->input('password', ["placeholder" => "Password", 'class' => 'form-control', 'required' => true, 'label' => false, 'div' => false]); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    <?php echo $this->Form->end(); ?>                  
    <br>
    <?=$this->Html->link('Forgot Password?',['action'=>'forgotPassword'],['class'=>'']);?>
    <!-- <?= $this->Html->link('Not registered yet?', ['controller' => 'Users', 'action' => 'register'], ['class' => 'pull-right']); ?> -->

  </div>
  <!-- /.login-box-body -->
</div>