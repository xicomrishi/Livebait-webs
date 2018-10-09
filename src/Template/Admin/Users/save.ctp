<section class="content-header">
    <h1><?php echo (!empty($record->id) ? "Update" : "Add") . " User"; ?></h1>
</section>
<section class="content">
    <div class="row">
       <?php echo $this->Form->create($record, ["type" => "file"]); ?>
        <div class="col-md-6">
            <div class="box box-primary well">                
                <?php echo $this->Form->input('id', ['type' => 'hidden']); ?>
                <div class="box-body">                          
                    <div class="form-group">
                        <label>Username</label>
                        <?php echo $this->Form->input('username', ['class' => 'form-control', 'required' => false, 'label' => false, 'div' => false]); ?>
                        <span class="emailerr red"></span>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <?php if(!empty($record->id)){
                                  $readonly=true;
                               }
                               else{
                                  $readonly=false;
                               }

                             echo $this->Form->input('email', ['class' => 'form-control', 'required' => false, 'label' => false, 'div' => false,'readonly'=>$readonly]); ?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <?php echo $this->Form->input('password', ['class' => 'form-control', 'required' => false, 'label' => false, 'div' => false,'value'=>'']); ?>
                    </div> 
                    <div class="form-group">
                        <label>Phone</label>
                        <?php echo $this->Form->input('phone', ['class' => 'form-control', 'required' => false, 'label' => false, 'div' => false]); ?>
                    </div>                    
                </div>
                <div class="box-footer">
                    <label><button type="submit" class="btn btn-primary"><?php echo (!empty($record->id) ? "Update" : "Add") . " User"; ?></button></label>
                </div>                                  
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary well">
                <div class="box-body">
                  <?php if(!empty($record->id)){
                      $status=['1'=>'Active' , '0' => 'De-Active'];
                    ?>
                    <div class="form-group">
                        <label>Status</label>
                        <?php echo $this->Form->select('status',$status, ['class' => 'form-control', 'required' => false, 'label' => false, 'div' => false]); ?>
                    </div>
                  <?php }?>
                    <div class="form-group">
                        <label>Information</label>
                        <?php echo $this->Form->textarea('information', ['class' => 'form-control', 'required' => false, 'label' => false, 'div' => false]); ?>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <?php if(isset($imageSrc)){?>
                          <p class="imageShow"><img src="<?=$imageSrc;?>" class="img-responsive"></p>
                        <?php }?>
                        <?php echo $this->Form->input('image', ['class' => 'form-control','type'=>'file', 'required' => false, 'label' => false, 'div' => false]); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</section>
<!--main content end-->
