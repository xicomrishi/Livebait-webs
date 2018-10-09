<section class="content-header">
    <h1><?php echo __("All Pages"); ?>        
    </h1>
</section>

<div class="users index large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0" class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col" align="center"><?= $this->Paginator->sort("id", 'Page id') ?></th>
                <th scope="col" align="center"><?= $this->Paginator->sort("title") ?></th>
                <th scope="col" align="center"><?= $this->Paginator->sort("content") ?></th>
                <th scope="col" align="center"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" align="center"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions" align="center"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
           <?php if(!empty($pages)){?>
            <?php foreach ($pages as $page): ?>
                    <tr>
                        <td align="center"><?= $this->Number->format($page['id']) ?></td>
                        <td align="center"><?= h($page['title']) ?></td>
                        <td align="center"><?= substr($page['content'],0,60)."..."; ?></td>                        
                        <td align="center"><?= h($page['created']) ?></td>
                        <td align="center"><?= h($page['modified']) ?></td>
                        <td class="actions" align="center">                            
                            <?= $this->Html->link(__('Edit'), ['action' => 'save', $page['id']]) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
             <?php }else{?>
             <tr>
                 <td colspan="6">No record found</td>
             </tr>
             <?php }?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
