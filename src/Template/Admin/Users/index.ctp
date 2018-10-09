<section class="content-header">
    <h1><?php echo __("All Users"); ?>        
    </h1>
    <!-- <p class="pull-right btn btn-primary"><?= $this->Html->link(__('Add New'), ['action' => 'save'] , ['class'=>'addBtn']) ?></p> -->
</section>
<div class="clearfix"></div>
<section class="content-header">
  <?=$this->Form->create('search',['type'=>'get']);?>
      <div class="box-primary well">
        <div class="box-body">
              <div class="col-sm-3">
                <div class="form-group">
                  <?=$this->Form->input('keyword',['class'=>'form-control','placeholder'=>'Type Here ...','value'=>@$search['keyword']]);?>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <?=$this->Form->input('gender',['class'=>'form-control','empty'=>'Select Gender','value'=>@$search['gender'],'options'=>['1'=>'Male','2'=>'Female','3'=>'Diverse']]);?>
                </div>
              </div>
              <div class="col-sm-1">
                <div class="form-group">
                  <?=$this->Form->input('age_from',['class'=>'form-control','value'=>@$search['age_from'],'type'=>'number']);?>
                </div>
              </div>
               <div class="col-sm-1">
                <div class="form-group">
                  <?=$this->Form->input('age_to',['class'=>'form-control','value'=>@$search['age_to'],'type'=>'number']);?>
                </div>
              </div>
              <div class="col-sm-4" style="margin-top:20px;">
               <button type="submit" class="btn btn-primary">Search</button> <?=$this->Html->link('Reset',['action'=>'index'],['class'=>'btn btn-default']);?>
              </div>
              <div class="col-sm-1" style="margin-top:20px;">
              
              </div>
         </div>
       </div>
  <?=$this->Form->end();?>
</section>
<div class="users index large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0" class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col" align="center"><?= $this->Paginator->sort("id", 'User id') ?></th>
                <!-- <th scope="col" align="center"><?= $this->Paginator->sort("profile_image") ?></th> -->
                <th scope="col" align="center"><?= $this->Paginator->sort('username') ?></th>                
                <th scope="col" align="center"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col" align="center"><?= $this->Paginator->sort('phone_number') ?></th>   
                                               
                <th scope="col" align="center"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" align="center"><a > <?= $this->Paginator->sort('unpaid_calls','Free Calls') ?>  </a></th>
                <th scope="col" align="center"><a > <?= $this->Paginator->sort('paid_calls','Paid Calls') ?>  </a></th>
                <th scope="col" align="center"><a > <?= $this->Paginator->sort('subscribed') ?>  </a></th>
                <th scope="col" align="center"><?= $this->Paginator->sort('created') ?></th>
                
                <th scope="col" class="actions" align="center"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
           <?php if(!empty($users)){?>
            <?php foreach ($users as $user): ?>
                    <tr>
                        <td align="left"><?= $this->Number->format($user['id']) ?></td>                       
                        <td align="left"><?= h($user['username']) ?><br> <?= h($user['timezone']) ?></td>                        
                        <td align="left"><?= h($user['email']) ?></td>
                        <td align="left"><?= !empty($user['phone_number']) ? $user['phone_number'] : "-" ?></td>                        
                        <td align="left">
                            <?php if($user['status'] == 1){
                                echo $this->Html->link("<span class='badge bg-light-blue'>Active</span>",['action'=>'changeStatus',$user['id']],['escape'=>false]);
                            }
                            else{
                                echo $this->Html->link("<span class='badge bg-red'>De-Active</span>",['action'=>'changeStatus',$user['id']],['escape'=>false]);
                                }?>
                        </td>
                        <td> <?= $user['unpaid_calls'] ?></td>
                        <td> <?= $user['paid_calls'] ?> </td>
                        <td> <?php if($user['subscribed'] == 1) { echo "Yes<br> Expiry Date : ".$user['unlimited_till']->format('M d, Y'); } else { echo "No"; } ?> </td>
                        <td align="left"><?= $user['created']->nice() ?></td>
                        
                        <td class="actions">                    
                            <?= $this->Html->link(__('View'), ['action' => 'view', $user['id']]) ?>        
                            <!-- <?= $this->Html->link(__('Edit'), ['action' => 'save', $user['id']]) ?> -->
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user['id']], ['confirm' => __('Are you sure you want to delete # {0}?', $user['id'])]) ?>
                            <?= $this->Html->link(__('View Requests'), ['action' => 'request', $user['id']]) ?> 
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
