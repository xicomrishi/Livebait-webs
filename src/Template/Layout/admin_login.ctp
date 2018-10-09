<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>
            <?= APP_NAME ?>
        </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <?php
            echo $this->Html->meta('favicon.png', 'img/admin/favicon.png', array('type' => 'icon'));
            echo $this->Html->css('admin/docs.min');
            echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
            echo $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
            echo $this->Html->css('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
            echo $this->Html->css('admin/dist/css/AdminLTE.min.css');
            echo $this->Html->css('admin/dist/css/skins/_all-skins.min.css');
            echo $this->Html->css('admin/style');
            // echo $this->Html->css('admin/login');
        ?>
    </head>
    <body class="hold-transition login-page">
    <div class="login-box">
       <!--  <div class="wrapper"> -->
            
                <?= $this->Flash->render();?>
                <?= $this->fetch('content') ?>
        
        <!-- </div>./wrapper -->
        </div>
    </body>
</html>