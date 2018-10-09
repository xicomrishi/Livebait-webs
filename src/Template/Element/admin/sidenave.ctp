<?php 
         $controller=$this->request->getParam('controller');
         $action=$this->request->getParam('action');
         $image=$this->request->session()->read('Auth.User.image');
         // echo $image; exit;
    ?>
<aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
              <?php 
                    if(!empty($image)){?>
                       <img src="<?=BASE_URL;?>uploads/admin/<?=$image;?>">
              <?php  }
                    else{
                         echo $this->Html->image('admin/user.png', array('alt' => 'user image'));
                    }
              ?>
            </div>
            <div class="pull-left info">
              <p><?php //echo $this->Session->read('Auth.User.first_name') ." ". $this->Session->read('Auth.User.last_name')?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          
          <ul class="sidebar-menu">
            <li class="treeview <?php if($this->request->params['controller'] == "Pages" ) { echo "active"; } ?>" id='a' >
                <?= $this->Html->link('<i class="fa fa-dashboard" aria-hidden="true"></i><span>Dashboard</span>', ["controller" => "Pages", "action" => "dashboard", "prefix" => "admin"], ["escape" => false]); ?>
            </li>
            <li class="treeview <?php if($this->request->params['controller'] == "Users" ) { echo "active"; } ?>" id='a'>
                  <?= $this->Html->link('<i class="fa fa-users"></i><span>Users Manger</span>', ["controller" => "Users", "action" => "index", "prefix" => "admin"], ["escape" => false]); ?>
            </li>
            <li class="treeview <?php if($this->request->params['controller'] == "Requests" ) { echo "active"; } ?>" id='a'>
                  <?= $this->Html->link('<i class="fa fa-exchange" aria-hidden="true"></i><span>Requests</span>', ["controller" => "Requests", "action" => "index", "prefix" => "admin"], ["escape" => false]); ?>
            </li>
            <li class="treeview <?php if($this->request->params['controller'] == "Contents" ) { echo "active"; } ?>" id='a'>
                  <?= $this->Html->link('<i class="fa fa-file-text" aria-hidden="true"></i><span>Content</span>', ["controller" => "Contents", "action" => "index", "prefix" => "admin"], ["escape" => false]); ?>
            </li>
             <li class="treeview <?php if($this->request->params['controller'] == "Feedbacks" ) { echo "active"; } ?>" id='a'>
                  <?= $this->Html->link('<i class="fa fa-envelope" aria-hidden="true"></i><span>Feedbacks</span>', ["controller" => "Feedbacks", "action" => "index", "prefix" => "admin"], ["escape" => false]); ?>
            </li>
            <li class="treeview <?php if($this->request->params['controller'] == "ReportSpams" ) { echo "active"; } ?>" id='a'>
                  <?= $this->Html->link('<i class="fa fa-file" aria-hidden="true"></i><span>Report Manager</span>', ["controller" => "reportSpams", "action" => "index", "prefix" => "admin"], ["escape" => false]); ?>
            </li>
            <li class="treeview <?php if($this->request->params['controller'] == "Blocked" ) { echo "active"; } ?>" id='a'>
                  <?= $this->Html->link('<i class="fa fa-ban" aria-hidden="true"></i><span>Block Manager</span>', ["controller" => "blocked", "action" => "index", "prefix" => "admin"], ["escape" => false]); ?>
            </li>
            <li class="treeview <?php if($this->request->params['controller'] == "Payments" ) { echo "active"; } ?>" id='a'>
                  <?= $this->Html->link('<i class="fa fa-dollar" aria-hidden="true"></i><span>Payments Manager</span>', ["controller" => "payments", "action" => "index", "prefix" => "admin"], ["escape" => false]); ?>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

