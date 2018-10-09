<!-- <header class="main-header"> -->
<a href="#" class="logo">
    <span class="logo-mini"><b>LiveB</b></span>
    <span class="logo-lg">
        <b><?= "LiveBait";?></b>
    </span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">

        <!-- User Account: style can be found in dropdown.less -->
        <ul class="nav navbar-nav">
            <li><?= $this->Html->link('Profile',['controller'=>'Admins','action'=>'save',$this->request->session()->read('Auth.User.id')]);?></li>
            <li>
                <a href="<?php echo $this->url->build(['controller' => 'admins', 'action' => 'logout']); ?>" title="Logout">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>                
            </li>            
        </ul>
    </div>
</nav>
<!-- </header> -->