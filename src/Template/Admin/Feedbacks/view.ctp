<section class="content-header">
    <h1><?php echo __("View Feedback"); ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary well">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-striped table-responsive">
                            <tr>
                                <th scope="row"><?= __('Id') ?></th>
                                <td><?= $this->Number->format($data->id) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('User') ?></th>
                                <td><?= h($data->user->name) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Message') ?></th>
                                <td><?= h($data->message) ?></td>
                            </tr>
                                                                                                                     
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped table-responsive">                              
                            <tr>
                                <th scope="row"><?= __('Created') ?></th>
                                <td><?= h($data->created) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Modified') ?></th>
                                <td><?= h($data->modified) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>
