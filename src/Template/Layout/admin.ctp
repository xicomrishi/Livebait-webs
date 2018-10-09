<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title><?= APP_NAME ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <?php
            echo $this->Html->meta('favicon.png', 'img/admin/favicon.png', array('type' => 'icon'));
            echo $this->Html->css('admin/docs.min');
            echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
            echo $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
            echo $this->Html->css('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
            echo $this->Html->css('admin/dist/css/AdminLTE.min.css');
            echo $this->Html->css('admin/dist/css/skins/_all-skins.min.css');
            echo $this->Html->css('admin/style.css');
        ?>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">

                <?= $this->element('admin/header'); ?>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <?php
                    echo $this->element('admin/sidenave');
                ?>				
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?= $this->Flash->render();?>
                <?= $this->fetch('content') ?>
            </div><!-- /.content-wrapper -->
            <footer class="main-footer" id="footer">
                <strong>Copyright © 2017 LiveBait. All Rights Reserved.</strong>
            </footer>
            <!--</form>-->

        </div><!-- ./wrapper -->
        <script type = 'text/javascript' src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <?= $this->Html->script('admin/dist/js/app.min.js'); ?>
    </body>
</html>