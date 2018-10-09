<section class="content-header">
    <h1><?php echo __("Manage Content"); ?>
        <small><?= $this->Html->link(__('Add New'), ['action' => 'save']) ?></small>
    </h1>
</section>
<div class="users index large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0" class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col"><?= __("#") ?></th>
                <th scope="col"><?= __("Heading") ?></th>
                <th scope="col"><?= __("Type") ?></th>
                <th scope="col"><?= __("Content") ?></th>                
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
                            <td><?= h(@$result["heading"]) ?></td>
                            <td><?= h($this->Common->getContentType(@$result['type'])) ?></td>
                            <td><?= substr($result["content"],0,150); ?></td>                           
                            <td><?= h(@$result["created"]) ?></td>
                            <td><?= h(@$result["modified"]) ?></td>
                            <td class="actions">
                                <?= $this->Html->link('View', ['action' => 'view', $result['id']], ['escape' => false]) ?>
                                <?= $this->Html->link('Edit', ['action' => 'save', $result['id']], ['escape' => false]) ?>
                                <?= $this->Form->postLink('Delete', ['action' => 'delete', $result['id']], ['confirm' => __('Are you sure you want to delete content for this page?'), 'escape' => false]) ?>
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
