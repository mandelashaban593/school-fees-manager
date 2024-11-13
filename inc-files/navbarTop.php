  <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="index.php">
                            <img class="img-fluid text-center" src="<?php echo fetchLogo(); ?>" width="70" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>
                    <div class="navbar-container">
                        <ul class="nav-left">
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                        <input type="text"  class="form-control">
                                        <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                           
                            <li class="header-notification">
                                <div class="btn btn-dark btn-round text-white">
                                    Today : <?php echo date("l jS F, Y");?>
                                </div>
                            </li>
                             <li class="header-notification">
                                <div class="btn btn-primary btn-round text-white">
                                    Welcome : <?php echo $_SESSION['USER'];?>
                                </div>
                            </li>
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?php echo fetchLogo(); ?>" class="img-radius"
                                            alt="User-Profile-Image">
                                        <span><?php echo $_SESSION['USERNAME'];?></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            
                                        <!-- <li>
                                            <a href="">
                                                <i class="feather icon-user"></i> Profile
                                            </a>
                                        </li> -->
                                       
                                        <li>
                                            <a href="logout.php" onclick="return confirm('Ar you Sure You want to Log Out of your Account?');">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>