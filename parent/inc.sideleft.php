<?php $iCurrentFileName = basename($_SERVER['PHP_SELF']); ?>

<div class="left side-menu">
  <div class="sidebar-inner slimscrollleft">
    <div class="user-details">
      <div class="pull-left raju"> <img src="../uploads/<?php echo $iLoginUserDetail['profileimage'] ?>" style="height:50px;"> </div>
      <div class="user-info">
        <div class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <?php echo $iLoginUserDetail['fullname']; ?>School</a>
        </div>
      </div>
    </div>
    <div id="sidebar-menu">
      <ul>
        <li class="text-muted menu-title"></li>
        <li><a href="login_profile.php" class="waves-effect <?php if($iCurrentFileName=='login_profile.php') { echo "active"; } ?>"><i class="ti-home"></i> <span> User </span> </a></li>
        <ul class="list-unstyled">
          <li class=""> <a href="login_profile.php" class="waves-effect <?php if($iCurrentFileName=='login_profile.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Profile</span> </a></li>
        </ul>
        <li class="has_sub"> <a href="javascript:void(0);" class="waves-effect <?php if($iCurrentFileName=='products_seller_live.php' || $iCurrentFileName=='products_seller_inactive.php') { echo "active"; } ?>"><i class="fa fa-th"></i> <span> Result </span> <span class="menu-arrow"></span> </a>
          <ul class="list-unstyled">
            <li class=""> <a href="term_result.php" class="waves-effect <?php if($iCurrentFileName=='term_result.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Term Result</span> </a></li>
            
            <!---<li class=""> <a href="cumulative_result.php" class="waves-effect <?php if($iCurrentFileName=='cumulative_result.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Cumulative Result</span> </a></li>--->
            
          </ul>
        </li>
        <li class=""> <a href="logout.php" class="waves-effect <?php if($iCurrentFileName=='logout.php') { echo "active"; } ?>"><i class="fa fa-sign-out"></i> <span>Logout</span> </a></li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
