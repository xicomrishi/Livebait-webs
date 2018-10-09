<section class="content-header">
    <h1><?php echo __("Dashboard"); ?>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">          
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $totalUsers; ?></h3>

                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                <a href="<?= $this->Url->build('/admin/users/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">          
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $totalRequests; ?></h3>

                    <p>Total Requests</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-list"></i>
                </div>
                <a href="<?= $this->Url->build('/admin/requests/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">          
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= $todayUsers; ?></h3>

                    <p>Users Register Today</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="<?= $this->Url->build('/admin/users/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?= $todayRequests; ?></h3>

                    <p>Request Placed Today</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-list-outline"></i>
                </div>
                <a href="<?= $this->Url->build('/admin/requests/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</section>