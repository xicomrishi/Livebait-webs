<section class="content-header">
    <h1><?php echo __("Calling Request Details"); ?></h1>
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
                                <td><?= $this->Number->format($request->id) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('From') ?></th>
                                <td><?= h($request->users_from->name) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('To') ?></th>
                                <td><?= h($request->users_to->name) ?></td>
                            </tr> 
                            <tr>
                                <th scope="row"><?= __('Duration') ?></th>
                                <td>
                                   <?= !empty($request->duration) ? $request->duration : "-";?>
                                </td>
                            </tr>                                                      
                            <tr>
                                <th scope="row"><?= __('Status') ?></th>
                                <td> 
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
                            </tr>                                                                                              
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped table-responsive">                              
                            <tr>
                                <th scope="row"><?= __('Created') ?></th>
                                <td><?= h($request->created) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Modified') ?></th>
                                <td><?= h($request->modified) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>
