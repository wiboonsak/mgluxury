<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>โชว์รูมรถยนต์ MG ที่ดีที่สูด เราเป็นผู้แทนจำหน่ายรถยนต์เอ็มจี</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="เราเป็นผู้แทนจำหน่ายรถยนต์เอ็มจี ที่มีโชว์รูมและศูนย์บริการมาตรฐานเอ็มจี ที่ดีที่สุด พร้อมให้คุณได้สัมผัสและทดลองขับรถยนต์เอ็มจีทุกรุ่น เรามีสาขาทั้งในกรุงเทพและต่างจังหวัด ที่จะมอบประสบการณ์ใหม่ด้วยบริการที่เหนือระดับจากใจถึงใจ และส่งมอบความประทับใจแบบไม่รู้จบ พร้อมให้คุณเช็คราคา MG สเปครถยนต์เอ็มจีทุกรุ่นได้ที่นี่">
        <meta name="author" content="www.me-fi.com">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('HTML/css/bootstrap.css')?>" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('HTML/css/font-awesome.css')?>" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('HTML/css/superfish.css')?>" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('HTML/css/megafish.css')?>" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('HTML/css/jquery.navgoco.css')?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('HTML/css/owl.carousel.css')?>" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('HTML/css/owl.theme.css')?>" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('HTML/css/jquery.mCustomScrollbar.css')?>" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('HTML/style.css')?>">
        
        <script src="<?php echo base_url('HTML/js/modernizr.custom.js')?>"></script>
		
		<script type="text/javascript" src="https://gateway.autodigi.net/bundle.js?wid=5dfb3a9a31115d001a5dc43e"></script>
		<link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">

        <!--[if lt IE 9]>
            <link rel="stylesheet" href="css/ie.css" type="text/css" media="all" />
        <![endif]-->

        <!--[if IE 9]>
            <link rel="stylesheet" href="css/ie9.css" type="text/css" media="all" />
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url('HTML/img/favicon.ico')?>">
        <link rel="apple-touch-icon" href="<?php echo base_url('HTML/img/icon-72x72.png')?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('HTML/img/icon-72x72.png')?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('HTML/img/icon-114x114.png')?>">		

    </head>
    
<body class="kopa-home-page">

  	<?php include("header.php"); ?>
    <!-- kopa-page-header -->
	
    <div id="main-content">

        <div class="widget-area-23">

            <div class="widget kopa-sync-2-carousel-widget">
                    <div class="owl-carousel sync5">
                          <?php foreach ($SlideDetail->result() AS $data) {
                                $firstImg = $this->Product_model->getSlideImg($data->id);
                         
?>
                        <div class="item">
                            <article class="entry-item">
                                <div class="entry-thumb">
                                    <a href="#"><img src="<?php echo base_url('uploadfile/banner/'.$firstImg)?>" alt=""></a>
                                    <!--<div class="thumb-hover"></div>-->
                                </div>
                                <div class="entry-content">
                                    <h4 class="entry-title"><a href="<?php echo $data->learnMore?>"><?php echo $data->slide_title?></a></h4>
                                    <h5><span><?php echo $data->slide_detail?></span></h5>
                                </div>
                            </article>
                        </div>
                         <?php } ?>
                    </div>
                    <!-- sync5 -->
                    
                   
                    <div class="loading">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
                <!-- kopa sync carousel widget -->
        
        </div>
        <!-- widget-area-23 -->

        <div class="wrapper mb-30">

            <div class="widget-area-1">  
            
            </div>
            <!-- widget-area-1 -->
        
        </div>
        <!-- wrapper -->

        <div class="wrapper">

			
            <div class="widget-area-24">
				
				<div class="mb-30"></div>

				<div class="widget kopa-product-list-widget">
					<h3 class="widget-title style10" style="border-bottom: none !important">รุ่นรถ MG และราคา</h3>
					<div class="content-wrap" style="padding-top: 50px">

						<div class="row">
						
							<div class="owl-carousel owl-carousel-4">
                                                            <?php foreach ($getproduct_data->result() AS $data){
         $imglist = $this->Product_model->loadProductImg($data->id,'1','1');                         foreach($imglist->result() AS $imglist2){ }                                
                                                                ?>
								<div class="item">
									<article class="entry-item">
										<div class="entry-thumb">
                                                                                    <a href="#"><img src="<?php echo base_url('uploadfile/product/'.$imglist2->imge_name)?>" alt="" ></a>
											<p class="new-icon">
												<span>New!</span>
											</p>
										</div>
										<div class="entry-content">
											<h4 class="entry-title"><a href="#"><?php echo $data->name_th?></a></h4>
											<a href="#" class="entry-categories"><?php echo $data->title?></a> 
											<div class="entry-price-area clearfix">
												<p class="entry-price">เริ่มต้น <?php echo number_format($data->Price,2)?> บาท</p>
											</div>
											<a class="kopa-view-all" href="#">View all<span class="fa fa-chevron-right"></span></a>
										</div>
									</article>
								</div>
                                                            <?php }?>
							</div>
							<!-- owl-carousel-4 -->
						
						</div>
						<!-- row --> 
					</div>
				</div>
				<!-- widget --> 
				
				<div class="mb-30"></div>				

			</div>
			<!-- widget-area-24 -->
			
			<div class="row">
				<div class="widget kopa-product-list-2-widget">
					<ul class="clearfix">
						<li class="col-md-3 col-sm-3 col-xs-3">
							<article class="entry-item">
								<div class="entry-thumb">
									<a href="https://www.youtube.com/watch?time_continue=89&v=ZmatbEyScEk&feature=emb_logo" target="_blank"><img src="<?php echo base_url('HTML/images/i-smart.jpg')?>" alt=""></a>
								</div>
								<h4 class="entry-title"><a href="https://www.youtube.com/watch?time_continue=89&v=ZmatbEyScEk&feature=emb_logo" target="_blank"><span>i-SMART</span></a></h4>
							</article>
						</li>
						<li class="col-md-3 col-sm-3 col-xs-3">
							<article class="entry-item">
								<div class="entry-thumb">
									<a href="https://www.youtube.com/watch?v=SgHP3Bg7LiE&feature=emb_logo" target="_blank"><img src="<?php echo base_url('HTML/images/brit-dynamic.jpg')?>" alt=""></a>
								</div>
								<h4 class="entry-title"><a href="https://www.youtube.com/watch?v=SgHP3Bg7LiE&feature=emb_logo" target="_blank"><span>Brit Dynamic</span></a></h4>
							</article>
						</li>
						<li class="col-md-3 col-sm-3 col-xs-3">
							<article class="entry-item">
								<div class="entry-thumb">
									<a href="https://www.youtube.com/watch?v=ihE3V6e4mpg" target="_blank"><img src="<?php echo base_url('HTML/images/inkanet.jpg')?>" alt=""></a>
								</div>
								<h4 class="entry-title"><a href="https://www.youtube.com/watch?v=ihE3V6e4mpg" target="_blank"><span>MG inkaNET</span></a></h4>
							</article>
						</li>
						<li class="col-md-3 col-sm-3 col-xs-3">
							<article class="entry-item">
								<div class="entry-thumb">
									<a href="https://www.youtube.com/watch?v=SL0rDzWcDOM&feature=emb_logo" target="_blank"><img src="<?php echo base_url('HTML/images/ev_innovation.jpg')?>" alt=""></a>
								</div>
								<h4 class="entry-title"><a href="https://www.youtube.com/watch?v=SL0rDzWcDOM&feature=emb_logo" target="_blank"><span>Innovation of EV</span></a></h4>
							</article>
						</li>
					</ul>
				</div>
				<!-- widget --> 
			</div>
			
			<div class="mb-30"></div>	

            <div class="row">
                <?php 
                        foreach ($referenceDetail->result() AS $referenceDetail2){
                             $firstImg = $this->Product_model->getreferenceImg($referenceDetail2->id);
                            ?>
				 		<div class="widget-area-3 col-md-4 col-sm-6 col-xs-6">

                            <div class="widget kopa-article-list-widget article-list-2">
                                <h3 class="widget-title style1">HOT PROMOTION</h3>
                                <ul class="clearfix">
                                    <li>
                                        <article class="entry-item">
                                            <div class="entry-thumb">
                                                <a href="#"><img src="<?php echo base_url('uploadfile/reference/') . $firstImg ?>" alt=""></a>
                                            </div>
                                            <div class="entry-content">
                                                <div class="content-top">
                                                    <h4 class="entry-title"><a href="#"><?php echo $referenceDetail2->reference_title ?></a></h4>
                                                    <!--<p class="entry-comment"><a href="#">3 Feb 2020</a></p>-->
                                                </div>
                                                <p><?php echo $referenceDetail2->reference_detail ?></p> 
                                                <footer>
                                                    <p class="entry-author"><i class="fa fa-calendar"></i> <?php echo $this->Product_model->getDayMonthYear($referenceDetail2->reference_date_add); ?></p>
                                                </footer>
                                            </div>
                                            <div class="post-share-link style-bg-color">
                                                <span><i class="fa fa-share-alt"></i></span>
                                                <ul>
                                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                                    <li><a href="#" ><img src="<?php echo base_url('HTML/images/line.png')?>"></a></li>
                                                </ul>
                                            </div>
                                        </article>
                                    </li>
                                </ul>
                            </div>
                            <!-- widget --> 
                    
                        </div>
                        <?php }?>
            </div>
            <!-- row --> 
			
			<div class="mb-30"></div>	
			
		</div>
		
		
			<div class="row">
				<div class="widget kopa-tag-line-widget">
					<span></span>
					<div class="widget-content">
						<h2 class="tag-heading">ทดลองขับเอ็มจี</h2>
						<p>ขอเชิญทดลองขับรถยนต์ MG ได้ทุกรุ่นแล้ววันนี้ </p>
						<a href="#">นัดหมายทดลองขับ</a>
					</div>
				</div>
				
				<!-- widget --> 
			</div>
				
		
		<div class="mb-30"></div>	
		
		<div class="wrapper">			
			
           	<section class="kopa-area kopa-area-2">

                <div class="content-wrap">

                    <div class="row">
                    
                        <div class="widget-area-wrap">

                             <div class="widget kopa-article-list-widget article-list-1">
                            <h3 class="widget-title style2">the Latest news</h3>
                            <ul class="clearfix">   
                                 <?php 
                        foreach ($newsDetail->result() AS $newsDetail2){
                             $firstImg = $this->Product_model->getNewsImg($newsDetail2->id);
                            ?>
                                <li>
                                    <article class="entry-item">
                                        <div class="entry-thumb">
                                            <a href="#"><img src="<?php echo base_url('uploadfile/news/') . $firstImg ?>" alt=""></a>
                                        </div>
                                        <div class="entry-content">
                                            <div class="content-top">
                                                <h4 class="entry-title"><a href="#"><?php echo $newsDetail2->news_title ?></a></h4>
                                                <p class="entry-comment"><a href="#"><?php echo $this->Product_model->getDayMonthYear($newsDetail2->news_date_add); ?></a></p>
                                            </div>
                                            <p><?php echo $newsDetail2->news_detail ?></p> 
                                            <footer>
                                                <p class="entry-author">by <a href="#">Admin</a></p>
                                            </footer>
                                        </div>
                                        <div class="post-share-link style-bg-color">
                                            <span><i class="fa fa-share-alt"></i></span>
                                            <ul>
                                                <li><a href="#" class="fa fa-facebook"></a></li>
                                                <li><a href="#" ><img src="<?php echo base_url('HTML/images/line.png')?>"></a></li>
                                            </ul>
                                        </div>
                                    </article>
                                </li>
                        <?php }?>
                            </ul>
                        </div>
                        <!-- widget --> 
                    

                      
                        
                        </div>
                        <!-- widget-area-wrap -->

                        <div class="widget-area-17">

                            <div class="widget kopa-calendar-widget">
                                <h3 class="widget-title style5"><span class="fa fa-calendar"></span>ปฎิทินกิจกรรม</h3>
                                <div class="widget-content">
                                    <ul class="clearfix">
                                        <?php foreach ($activity_list->result() AS $activity_list2){?>
                                        <li>
                                            <div class="cl-item">
                                                <div class="cl-left">
                                                    <h4>10-15</h4>
                                                    <p>Feb 2020</p>
                                                </div>
                                                <div class="cl-right">
                                                    <h5><a href="#"><?php echo $activity_list2->activity_title?></a></h5>
                                                    <!--<a href="#">จังหวัดเลย, อุดรธานี, อุบลราชธานี, พังงา, ชลบุรี, สุราษฎร์ธานี และหาดใหญ่</a>-->
                                                </div>
                                            </div>
                                        </li>
                                        <?php }?>
                                       
                                        
                                        
                                    </ul>
                                </div>
                            </div>
                            <!-- widget -->
                        
                        </div>
                        <!-- widget-area-17 -->

                    </div>
                    <!-- row --> 

                </div>
                <!-- content-wrap -->
                
            </section>
            <!-- kopa-area-2 -->
			


            <section class="kopa-area kopa-area-2" style="background: url(<?php echo base_url('HTML/images/bg_map.jpg')?>) local 50% 50%; background-size: cover;">
                <div class="content-wrap">
                    <div class="row">

                            <div class="widget-area-17">
                                
								<div class="widget widget_search" style="margin-bottom:0px !important">
									<h3 class="widget-title style8"><span class="fa fa-search"></span> โชว์รูมและศูนย์บริการของเรา</h3>
									<div class="search-box">
										<form action="#" class="search-form clearfix" method="get">
											<input type="text" onblur="if (this.value == '') this.value = this.defaultValue;" onfocus="if (this.value == this.defaultValue) this.value = '';" value="Search..." name="s" class="search-text">
											<button type="submit" class="search-submit">
												<span class="fa fa-search"></span>
											</button>
										</form>
										<!-- search-form -->
									</div>
								</div>
								<!-- widget -->
								
								<div class="kopa-accordion">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading active">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne1">
                                                <span class="btn-title"></span>
                                                <span class="tab-title">บริษัท เอ็มจีลักซูรี่ หาดใหญ่ จำกัด</span>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne1" class="panel-collapse collapse in">
                                            <div class="panel-body" style="background-color: #FFFFFF">
                                                <ul style="list-style: none;">
													<li><i class="fa fa-clock-o"></i> 08.00 น. - 18.00 น.</li>
													<li><i class="fa fa-map-marker"></i> 88 หมู่ที่ 7 ตำบลท่าช้าง อำเภอบางกล่ำ จังหวัดสงขลา 90110</li>
													<li><i class="fa fa-phone"></i> 074-801-888</li>
												</ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/panel panel-default-->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo1">
                                                <span class="btn-title"></span>
                                                <span class="tab-title">บริษัท เอ็มจีลักซูรี่ หาดใหญ่ จำกัด ลพบุรีราเมศวร์</span>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo1" class="panel-collapse collapse">
                                            <div class="panel-body" style="background-color: #FFFFFF">
                                               <ul style="list-style: none;">
													<li><i class="fa fa-clock-o"></i> 08.00 น. - 18.00 น.</li>
													<li><i class="fa fa-map-marker"></i> 88 หมู่ที่ 7 ตำบลท่าช้าง อำเภอบางกล่ำ จังหวัดสงขลา 90110</li>
													<li><i class="fa fa-phone"></i> 074-801-888</li>
												</ul>       
                                            </div>
                                        </div>
                                    </div>
                                    <!--/panel panel-default-->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree1">
                                                <span class="btn-title"></span>
                                                <span class="tab-title">บริษัท เอ็มจีลักซูรี่ หาดใหญ่ จำกัด</span>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree1" class="panel-collapse collapse">
                                            <div class="panel-body" style="background-color: #FFFFFF">
                                                <ul style="list-style: none;">
													<li><i class="fa fa-clock-o"></i> 08.00 น. - 18.00 น.</li>
													<li><i class="fa fa-map-marker"></i> 88 หมู่ที่ 7 ตำบลท่าช้าง อำเภอบางกล่ำ จังหวัดสงขลา 90110</li>
													<li><i class="fa fa-phone"></i> 074-801-888</li>
												</ul>          
                                            </div>
                                        </div>
                                    </div>
                                    <!--/panel panel-default-->
                                </div>
                            </div><!--/end .widget kopa-accordion-->


								

                            </div>
                            <!-- widget-area-15 -->

                        <div class="widget-area-25">

                            <div class="widget kopa-calendar-widget">
                                <div class="widget-content">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63358.68773505709!2d100.41287329350374!3d7.018926702031019!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304d2881fd8f9373%3A0xe7b5a2769c3405c9!2zTUcgTFVYVVJZIEhBVFlBSSDguKrguLPguJnguLHguIHguIfguLLguJnguYPguKvguI3guYg!5e0!3m2!1sth!2sth!4v1581134413660!5m2!1sth!2sth" width="600" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
									
                                </div>
                            </div>
                            <!-- widget -->
                        
                        </div>
                        <!-- widget-area-17 -->

                    </div>
                    <!-- row --> 

                </div>
                <!-- content-wrap -->
                
            </section>
            <!-- kopa-area-2 -->
        
			
			
        </div>
        <!-- wrapper -->

    </div>
    <!-- main-content -->
	<?php include("footer.php"); ?>
    
    <script src="<?php echo base_url('HTML/js/jquery-1.11.1.js')?>"></script> 
    <script src="<?php echo base_url('HTML/js/bootstrap.min.js')?>"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="<?php echo base_url('HTML/js/custom.js')?>" charset="utf-8"></script>
    
</body>

</html>
