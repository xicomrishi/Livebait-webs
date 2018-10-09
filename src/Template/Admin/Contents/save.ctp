<script src="https://cdn.ckeditor.com/4.5.4/standard/ckeditor.js"></script>
<section class="content-header">
    <h1><?php echo (!empty(@$record['id']) ? "Update" : "Add") . " Content"; ?>
        <small class="pull-right"><?= $this->Html->link(__('<span class="fa fa-arrow-left"></span>  Manage Content'), ['action' => 'index'], ["class" => "btn btn-primary", "escape" => false]) ?></small>
    </h1>

</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary well">
                <?php echo $this->Form->create($record, ['class' => '', 'type' => 'file']); ?>
                <div class="box-body">                          
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Heading</label>
                                <?php echo $this->Form->input('heading', ['class' => 'form-control', 'required' => false, 'label' => false, 'div' => false, 'default' => @$record['heading']]); ?>                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type</label>
                                <?php echo $this->Form->input('type', ['type' => 'select', 'options' => $this->Common->getContentType(), 'empty' => 'Please Select', 'class' => 'form-control', 'required' => false, 'label' => false, 'div' => false, 'required' => false]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Content</label>
                                <?php echo $this->Form->input('content', ['type' => 'textarea', 'class' => 'form-control', 'div' => false, 'required' => false, 'label' => false]); ?>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <label><button type="submit" class="btn btn-primary">
                            <?php echo (!empty(@$record['id']) ? "Update" : "Add") . " Content"; ?>
                        </button></label>
                </div>
                <?php echo $this->Form->end(); ?>                  
            </div>
        </div>
    </div>
</section>