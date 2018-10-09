<section class="content-header">
    <h1>My Profile</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary well">
                <?php echo $this->Form->create($record, ["type" => "file"]); ?>
                <?php echo $this->Form->input('id', ['type' => 'hidden']); ?>
                <div class="box-body">                          
                    <div class="form-group">
                        <label>Name</label>
                        <?php echo $this->Form->input('name', ['class' => 'form-control', 'required' => true, 'label' => false, 'div' => false]); ?>
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

                             echo $this->Form->input('email', ['class' => 'form-control', 'required' => true, 'label' => false, 'div' => false,'readonly'=>$readonly]); ?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <?php echo $this->Form->input('password', ['class' => 'form-control', 'required' => false, 'label' => false, 'div' => false,'value'=>'']); ?>
                    </div>
                   <!--  <div class="form-group">
                        <label>Image</label>
                        <?php if(isset($imageSrc)){?>
                          <p class="imageShow"><img src="<?=$imageSrc;?>" class="img-responsive"></p>
                        <?php }?>
                        <?php echo $this->Form->input('image', ['class' => 'form-control','type'=>'file', 'required' => false, 'label' => false, 'div' => false]); ?>
                    </div> -->
                </div>
                <div class="box-footer">
                    <label><button type="submit" class="btn btn-primary"><?php echo (!empty($record->id) ? "Update" : "Add") . " User"; ?></button></label>
                </div>
                <?php echo $this->Form->end(); ?>                  
            </div>
        </div>
    </div>
</section>
<!--main content end-->
