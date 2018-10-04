<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="index.html">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Dashboard</span>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE BASE CONTENT -->
<!-- BEGIN DASHBOARD STATS 1-->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="1349"><?php echo $job_order; ?></span>
                </div>
                <div class="desc"> Job Orders </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="12,5"><?php echo $customer; ?></span> </div>
                <div class="desc"> Customers </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green-haze" href="#">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="549"><?php echo $vendor; ?></span>
                </div>
                <div class="desc"> Vendors </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="89"></span><?php echo $consignee; ?> </div>
                <div class="desc"> Consignee </div>
            </div>
        </a>
    </div>
</div>
<div class="clearfix"></div>
<!-- END DASHBOARD STATS 1-->
<div class="row">
    <div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-cursor font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase">General Stats</span>
                </div>
                <div class="actions">
                    <a href="javascript:;" class="btn btn-sm btn-circle green-jungle easy-pie-chart-reload">
                        <i class="fa fa-repeat"></i> Reload </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="easy-pie-chart">
                            <div class="number visits" data-percent="55">
                                <span>+55</span>% </div>
                            <a class="title" href="javascript:;"> Network
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="margin-bottom-10 visible-sm"> </div>
                    <div class="col-md-4">
                        <div class="easy-pie-chart">
                            <div class="number transactions" data-percent="35">
                                <span>+35</span>% </div>
                            <a class="title" href="javascript:;"> CPU Load
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="margin-bottom-10 visible-sm"> </div>
                    <div class="col-md-4">
                        <div class="easy-pie-chart">
                            <div class="number bounce" data-percent="46">
                                <span>-46</span>% </div>
                            <a class="title" href="javascript:;"> Load Rate
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xs-12 col-sm-12">
      <div class="m-heading-1 border-green m-bordered">
        <p> PT. DIAN SANTOSA LOGISTIK </p>
      </div>
      <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">Users</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-yellow-lemon icon-users"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-body-stat"><?php echo $user; ?></span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">Product</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-green-jungle icon-layers"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-body-stat"><?php echo $product; ?></span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
      </div>
    </div>
    </div>
</div>
