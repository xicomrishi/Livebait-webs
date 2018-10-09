<section class="content-header">
    <h1><?php echo __("All Users"); ?>
        <!-- <small><?= $this->Html->link(__('Add New'), ['action' => 'save']) ?></small> -->
    </h1>
</section>
<div class="users index large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0" class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort("id", 'User id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>                
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $this->Number->format($user->id) ?></td>
                        <td><?= h($user->name) ?></td>                        
                        <td><?= h($user->email) ?></td>
                        <td><?= h($user->created) ?></td>
                        <td><?= h($user->modified) ?></td>
                        <td class="actions">                            
                            <?= $this->Html->link(__('Edit'), ['action' => 'save', $user->id]) ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
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
