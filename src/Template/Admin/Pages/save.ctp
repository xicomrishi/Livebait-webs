<section class="content-header">
    <h1><?php echo (!empty($record->id) ? "Update" : "Add") . " Page"; ?></h1>
</section>
<section class="content">
    <div class="row">
       <?php echo $this->Form->create($record, ["type" => "file"]); ?>
        <div class="col-md-6">
            <div class="box box-primary well">                
                <?php echo $this->Form->input('id', ['type' => 'hidden']); ?>
                <div class="box-body">                          
                    <div class="form-group">
                        <label>Title</label>
                        <?php echo $this->Form->input('title', ['class' => 'form-control', 'required' => false, 'label' => false, 'div' => false]); ?>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <?php echo $this->Form->textarea('content', ['class' => 'form-control', 'required' => false, 'label' => false, 'div' => false]); ?>
                    </div>                                       
                </div>
                <div class="box-footer">
                    <label><button type="submit" class="btn btn-primary"><?php echo (!empty($record->id) ? "Update" : "Add") . " Page"; ?></button></label>
                </div>                                  
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary well">
                <div class="box-body">
                   <div class="form-group">
                        <label>Slug</label>
                        <?php if(!empty($record->id)){
                                  $readonly=true;
                               }
                               else{
                                  $readonly=false;
                               }

                             echo $this->Form->input('slug', ['class' => 'form-control', 'required' => false, 'label' => false, 'div' => false,'readonly'=>$readonly]); ?>
                   </div> 
                    
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</section>
<!--main content end-->
