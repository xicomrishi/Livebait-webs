<section class="content-header">
    <h1><?php echo __("Manage Feedbacks"); ?>
        
    </h1>
</section>
<div class="users index large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0" class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col"><?= __("#") ?></th>
                <th scope="col"><?= __("User") ?></th>
                <th scope="col"><?= __("Message") ?></th>
                <th scope="col"><?= __("Created") ?></th>
                <th scope="col"><?= __("Modified") ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($results)) { ?>
                    <?php $i = $this->Paginator->counter("{{start}}"); foreach ($results as $result):?>
                        <tr>
                            <td><?= h(@$i++) ?></td>
                            <td><?= h(@$result["user"]['name']) ?></td>
                            <td><?= substr($result["message"],0,80); ?>...</td>                           
                            <td><?= $result["created"]->format('M d, Y') ?></td>
                            <td><?= $result["modified"]->format('M d, Y') ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $result->id]) ?>
                                <?= $this->Form->postLink('Delete', ['action' => 'delete', $result['id']], ['confirm' => __('Are you sure you want to delete this feedback?'), 'escape' => false]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <tr><td colspan="8">No record found.</td></tr>

                <?php } ?>
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
