<header class="kopa-header">

        <div class="kopa-header-top">  

            <div class="wrapper">

                <div class="header-top-left">
                    
                    <!-- <div class="kopa-user">
                        <ul class="clearfix">
                            <li><a href="#">Sign in</a></li>
                            <li>&nbsp;|&nbsp;</li>
                            <li><a href="#">Register</a></li>
                        </ul>
                    </div>
                    kopa-user -->

                    <div class="social-links style-color">
                        <ul class="clearfix">
                            <li><a href="https://www.facebook.com/MGLuxuryHatyai/" target="_blank" class="fa fa-facebook"></a></li>
                            <li><a href="https://www.twitter.com" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-youtube"></a></li>
                            <li><a href="#" class="fa fa-instagram"></a></li>
                        </ul>
                    </div>
                    <!-- social-links -->

                </div> 
                <!-- header-top-left -->  

                <div class="header-top-right">

                    <div class="header-top-list">
                        <ul class="clearfix">
                            <li><a href="#"><span><i class="fa fa-car"></i><span>ทดลองขับเอ็มจี</span></span></a></li>
                            <li><a href="#"><span><i class="fa fa-search"></i><span>ค้นหาผู้จำหน่ายเอ็มจี</span></span></a></li>
							<li><a href="#"><span><i class="fa fa-phone"></i><span>074-221899</span></span></a></li>
                            <!--<li>
                                <a href="#"><span><i class="fa fa-language"></i><span>Language</span></span></a>
                                <ul>
                                    <li>
                                        <a href="#"><img src="http://placehold.it/21x14" alt="">Eng</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="http://placehold.it/21x14" alt="">Vie</a>
                                    </li>
                                </ul>
                            </li>-->
                        </ul>
                    </div>
                    <!-- header-top-list -->
                </div>
               <!-- header-top-right -->   

            </div>  
            <!-- wrapper -->

        </div>
        <!-- kopa-header-top -->

        <div class="kopa-header-middle">

            <div class="wrapper">

                <div class="kopa-logo">
                    <a href="#"><img src="<?php echo base_url('HTML/images/logo-5.png')?>" alt="MG LUXURY HATYAI"></a>
                </div>
                <!-- logo -->

                <nav class="kopa-main-nav">
                    <ul class="main-menu sf-menu">
						<li class="current-menu-item"><a href="index.php"><span>หน้าแรก</span></a></li>
                       <li>
                           <a href="<?php echo base_url('Product')?>"><span>รุ่นรถและราคา</span></a>
                            <ul class="sub-menu">
                                <?php $cardata = $this->Product_model->get_product('-100','-100');
 foreach ($cardata->result() AS $cardata2){
                                ?>
                                <li><a href="#"><?php echo $cardata2->name_th?></a></li>
 <?php }?>					
                            </ul>
                        </li>
						<li><a href="#"><span>โปรโมชั่น</span></a></li>
						<li><a href="#"><span>ข่าวสาร</span></a></li>
						<li><a href="#"><span>กิจกรรม</span></a></li>
						<li><a href="#"><span>ฝ่ายบริการ</span></a></li>
						<li><a href="#"><span>ศูนย์ซ่อมสีและตัวถัง</span></a></li>
						<li><a href="#"><span>ติดต่อเรา</span></a></li>
                    </ul>                
                </nav>
                <!--/end main-nav-->

                <nav class="main-nav-mobile clearfix">
                    <a class="pull fa fa-bars"></a>
                    <ul class="main-menu-mobile">
						<li class="current-menu-item"><a href="index.php"><span>หน้าแรก</span></a></li>
                       <li>
                            <a href="#"><span>รุ่นรถและราคา</span></a>
                            <ul class="sub-menu">
                                <li><a href="#">ALL NEW MG 31</a></li>
								<li><a href="#">NEW MG ZS1</a></li>
								<li><a href="#">NEW MG ZS EV1</a></li>
								<li><a href="#">NEW MG HS1</a></li>
								<li><a href="#">NEW MG EXTENDER1</a></li>
								<li><a href="#">NEW MG V801</a></li>
								<li><a href="#">NEW MG GS 1.5 L TURBO1</a></li>
								<li><a href="#">NEW MG GS 2.0 L TURBO1</a></li>
                            </ul>
                        </li>
						<li><a href="#"><span>โปรโมชั่น</span></a></li>
						<li><a href="#"><span>ข่าวสาร</span></a></li>
						<li><a href="#"><span>กิจกรรม</span></a></li>
						<li><a href="#"><span>ฝ่ายบริการ</span></a></li>
						<li><a href="#"><span>ศูนย์ซ่อมสีและตัวถัง</span></a></li>
						<li><a href="#"><span>ติดต่อเรา</span></a></li>
					</ul>  
                </nav>
                <!--/main-menu-mobile-->

            </div>
            <!-- wrapper -->

        </div>
        <!-- kopa-header-middle -->

        <div class="kopa-header-bottom">

            <div class="wrapper">

                <nav class="kopa-main-nav-2">
                    <ul class="main-menu-2 sf-menu">
                         <li><a href="#"><span>เกี่ยวกับเรา</span></a></li>
                        <li>
                            <a href="#"><span>โชว์รูม & สาขา</span></a>
                        </li>
                        <li><a href="#"><span>INSIDE 360º</span></a></li>
                        <li><a href="#"><span>แกลลอรี่</span></a></li>
                        <li><a href="#"><span>บทความ</span></a></li>
                    </ul>                
                </nav>
                <!--/end main-nav-2-->

                <nav class="main-nav-mobile style2 clearfix">
                    <a class="pull">categories<i class="fa fa-angle-down"></i></a>
                    <ul class="main-menu-mobile">
                        <li><a href="#"><span>เกี่ยวกับเรา</span></a></li>
                        <li> <a href="#"><span>โชว์รูม & สาขา</span></a></li>
                        <li><a href="#"><span>INSIDE 360º</span></a></li>
                        <li><a href="#"><span>แกลลอรี่</span></a></li>
                        <li><a href="#"><span>บทความ</span></a></li>
                    </ul>    
                </nav>
                <!--/main-menu-mobile-2-->
                
            </div>
            <!-- wrapper -->

        </div>
        <!-- kopa-header-bottom -->

    </header>