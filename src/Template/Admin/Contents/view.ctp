<section class="content-header">
    <h1><?php echo __("Content Details"); ?>
        <small class="pull-right"><?= $this->Html->link(__('<span class="fa fa-arrow-left"></span> Manage Content'), ['action' => 'index'], ["class" => "btn btn-primary", "escape" => false]) ?></small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary well">
                <table class="table table-striped table-responsive">
                    <tr>
                        <th scope="row"><?= __('Heading') ?></th>
                        <td><?= !empty(@$content['heading']) ? @$content['heading'] : NOT_AVAILABLE; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Type') ?></th>
                        <td><?= h($this->Common->getContentType(@$content['type'])) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Content') ?></th>
                        <td><?= @$content['content'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h(@$content['created']) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h(@$content['modified']) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
