<section class="content-header">
    <h1><?php echo __("User Details"); ?></h1>
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
                                <td><?= $this->Number->format($user->id) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Name') ?></th>
                                <td><?= h($user->name) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Email') ?></th>
                                <td><?= h($user->email) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Username') ?></th>
                                <td><?= h($user->username) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Phone Number') ?></th>
                                <td><?= h($user->phone_number) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Age') ?></th>
                                <td><?= h($user->age) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Sex') ?></th>
                                <td><?= h($this->Common->getUserSex($user->sex)) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Occupation') ?></th>
                                <td><?= h($user->occupation) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Drink') ?></th>
                                <td><?= h($this->Common->getUserOption($user->drink)) ?></td>
                            </tr>    
                            <tr>
                                <th scope="row"><?= __('Images') ?></th>
                                <td>
                                    <ul class="userImage row">
                                        <?php if(!empty($user->user_images)){
                                               foreach ($user->user_images as $image) {
                                                if(strpos($image['image'], 'http') !== false){
                                        ?>
                                                <li class="col-sm-6"><?= $this->Html->image($image['image'],['class'=>'img-responsive']);?></li>
                                        <?php }else{?>
                                                <li class="col-sm-6"><img src="<?=$this->Url->build('/',true).$image['image'];?>" class='img-responsive'></li>
                                        <?php }}}?>
                                    </ul>
                                </td>
                            </tr>                        
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped table-responsive">
                            <tr>
                                <th scope="row"><?= __('Smoke') ?></th>
                                <td><?= h($this->Common->getUserOption($user->smoke)) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('420') ?></th>
                                <td><?= h($this->Common->getUserNature($user->nature)) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Kids') ?></th>
                                <td><?= h($this->Common->getUserOption($user->kids)) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Account Status') ?></th>
                                <td><?= h($this->Common->getAccountStatus($user->account_status)) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('User Status') ?></th>
                                <td><?= h($this->Common->getUserStatus($user->status)) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Received Video Chat') ?></th>
                                <td><?= h($this->Common->getUserOption($user->received_video_chat)) ?></td>
                            </tr>                                                    
                            <tr>
                                <th scope="row"><?= __('Created') ?></th>
                                <td><?= $user->created->nice() ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Modified') ?></th>
                                <td><?= $user->modified->nice() ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Paid Calls') ?></th>
                                <td><?= h($user->paid_calls) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Un-Paid Calls') ?></th>
                                <td><?= h($user->unpaid_calls) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>
