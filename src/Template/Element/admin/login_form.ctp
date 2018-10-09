<div class="login-box-body">
	<?php if(!isset($frontend)){?>
    <p class="login-box-msg">Sign in to start your session</p>
	<?php }?>
		<!-- Login Form -->
    <?php echo $this->Form->create('User');?>
    <div class="form-group has-feedback">
      <?php echo($this->Form->input('phone', array('id'=>'phone','class' => 'form-control','placeholder'=>'Contact Number','div'=>false,'label'=>false,'required'=>true))); ?>
	  <i class="fa fa-envelope form-control-feedback" aria-hidden="true"></i>
    </div>
    <div class="form-group has-feedback">  
      <?php echo($this->Form->password('password', array('id'=>'password','class' => 'form-control','placeholder'=>'Password','required'=>true))); ?>
	  <i class="fa fa-key form-control-feedback" aria-hidden="true"></i>
    </div>
    <div class="row">
       <div class="col-xs-12">  
          <?php echo($this->Form->button('Sign In', array('div' => false,'class' => 'btn btn-primary btn-block btn-flat','type'=>'submit')));?>
       </div>
    </div>
    <?php echo($this->Form->end());?>
	<br>
    <?php //echo $this->Html->link('I forgot my password',array('controller'=>'users','action'=>'forgotPassword')); ?><br>
  </div>