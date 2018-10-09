<section class="content-header">
    <h1><?php echo __("All Calling Requests"); ?>        
    </h1>
</section>
<div class="clearfix"></div>
<!-- <section class="content-header">
  <?=$this->Form->create();?>
      <div class="box-primary well">
        <div class="box-body">
              <div class="col-sm-4">
                <div class="form-group">
                  <?=$this->Form->input('name',['class'=>'form-control']);?>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <?=$this->Form->input('email',['class'=>'form-control','type'=>'text']);?>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <?=$this->Form->input('phone',['class'=>'form-control']);?>
                </div>
              </div>
        </div>
        <div class="search-footer">
            <label><button type="submit" class="btn btn-primary">Search</button></label>
            <label><?=$this->Html->link('Reset',['action'=>'index'],['class'=>'btn btn-primary']);?></label>
        </div>
      </div>
  <?=$this->Form->end();?>
</section> -->
<div class="users index large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0" class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col" align="center"><?= $this->Paginator->sort("id", 'Request id') ?></th>                
                <th scope="col" align="center"><?= $this->Paginator->sort('user_from_id','From') ?></th>                
                <th scope="col" align="center"><?= $this->Paginator->sort('user_to_id','To') ?></th>                                           
                <th scope="col" align="center"><?= $this->Paginator->sort('accept','Request Status') ?></th>
                <th scope="col" align="center"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" align="center"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions" align="center"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
           <?php if(!empty($requests)){?>
            <?php foreach ($requests as $key => $request): ?>
                    <tr>
                        <td align="left"><?= $this->Number->format($request->id) ?></td>                        
                        <td align="left"><?= h($request->users_from->name) ?></td>                        
                        <td align="left"><?= h($request->users_to->name) ?></td>                                               
                        <td align="left">
                            <?php if($request->status == REQUEST_STATUS_ACCEPT){
                                echo "<span class='badge bg-light-blue'>Accept</span>";
                            }
                            elseif($request->status == REQUEST_STATUS_REJECT){
                                echo "<span class='badge bg-red'>Reject</span>";
                            }
                            elseif($request->status == REQUEST_STATUS_PENDING){
                                echo "<span class='badge bg-green'>Pending</span>";
                            }
                            else{
                                echo "<span class='badge badge-inverse'>Not Interseted</span>";
                            }?>
                        </td>
                        <td align="left"><?= h($user['created']) ?></td>
                        <td align="left"><?= h($user['modified']) ?></td>
                        <td class="actions">                    
                            <?= $this->Html->link(__('View'), ['controller'=>'requests','action' => 'view', $request->id]) ?>                                                                
                        </td>
                    </tr>
                <?php endforeach; ?>
             <?php }else{?>
             <tr>
                 <td colspan="9">No users found</td>
             </tr>
             <?php }?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('First')) ?>
            <?= $this->Paginator->prev('< ' . __('Previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Next') . ' >') ?>
            <?= $this->Paginator->last(__('Last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
