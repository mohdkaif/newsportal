<?php 
    date_default_timezone_set($website_timezone);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <?php
        if(@$pd['seo_keyword']!=NULL){
          ?>  
            <meta name="keywords" content="<?php echo @$pd['seo_keyword']; ?>" />
            <meta name="description" content="<?php echo @$pd['seo_description']; ?>" />
        <?php
        }
        else if (@$post_meta !=false) {
        ?>
            <meta name="keywords" content="<?php echo @$post_meta['meta_keyword']; ?>" />
            <meta name="description" content="<?php echo @$post_meta['meta_description']; ?>" />
           
        <?php
        } else {
        ?>
             <meta name="keywords" content="<?php echo @$seo['fixed_keyword']; ?> <?php echo @$meta['keyword']; ?>" />
            <meta name="description" content="<?php echo @$meta['description']; ?>" />
        <?php
        }
        ?>
        <!-- facebook meta tag -->
        <?php 
            $this->load->helper('text');
            @$img_url = (is_file('uploads/'. @$image)) ? base_url().'uploads/' . @$image : base_url(). 'uploads/' . @$image;
        ?>
        <meta property="og:title" content="<?php echo @$title; ?>" />
        <meta property="og:description" content='<?php echo strip_tags(word_limiter(@$news, 20)); ?>' />
        <meta property="og:url" content="<?php echo @$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
        <meta property="og:site_name" content="<?php echo base_url(); ?>" />
        <meta property="og:image" content="<?php echo @$img_url; ?>"/>
        <meta property="og:image:width" content="760" />
        <meta property="og:image:height" content="420" />
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo base_url(). @$website_favicon;?>"/>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
       
        <title>
            <?php
            if(isset($title)){
                echo @$title;
            }
            else{
                echo @$website_title;
            }
            ?>
        </title>
         <?php
        if(@$seo['analytics_code']!=NULL){
            echo (@$seo['analytics_code']);
        }
        ?>
        <?php
        if(@$seo['alexa_code']!=NULL){
            echo (@$seo['alexa_code']);
        }
        ?>
        <!-- google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
        <!-- noto font -->
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&amp;subset=devanagari" rel="stylesheet">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/css/bootstrap.min.css">
        <!-- Scrollbar css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/css/jquery.mCustomScrollbar.css"/>
        <!-- Owl Carousel css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/owl-carousel/owl.carousel.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/owl-carousel/owl.theme.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/owl-carousel/owl.transitions.css"/>
        <!-- youtube css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/css/RYPP.css"/>
        <!-- jquery-ui css --> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/css/jquery-ui.css">
           <!-- toster -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/toster/toastr.css">

        <!-- animate -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/css/animate.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/css/comments.css">
        <!-- fonts css -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/css/Pe-icon-7-stroke.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/css/flaticon.css"/>
        <!-- custom css -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/css/style.css">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'application/views/themes/News365-Video/web-assets/jssocials/jssocials.css' ?> ">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'application/views/themes/News365-Video/web-assets/jssocials/jssocials-theme-flat.css' ?>">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo base_url().'application/views/themes/News365-Video/web-assets/clipboard.js-master/dist/clipboard.min.js'; ?>"></script>
        <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.3/clipboard.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>application/views/themes/<?php echo $default_theme; ?>/web-assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().'application/views/themes/News365-Video/web-assets/jssocials/jssocials.js' ?>" ></script>
        <script type="text/javascript">
           $(window).scroll(function() {    
                var windowWidth = $(window).width();
                var scroll = $(window).scrollTop();
                 //>=, not <=
                if (windowWidth <= 991 && scroll >=20) {
                    //clearHeader, not clearheader - caps H
                    $(".main_header").addClass("showTopHeaderIcon");
                }else{
                    $(".main_header").removeClass("showTopHeaderIcon");
                }

              

                
                
            });  




        </script>
        <style type="text/css">
            @import  url('https://fonts.googleapis.com/css?family=Noto+Sans');
        </style>
        
    </head>


    <body>
     <div class="se-pre-con"></div>
      <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <header class="main_header">
            <!-- Mobile Menu Start -->
            <div class="mobile-menu-area navbar-fixed-top hidden-sm hidden-md hidden-lg">
                <nav class="mobile-menu" id="mobile-menu">
                    <div class="sidebar-nav">
                        <div class="sidebar-nav-logo mob-logo">
                            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('application/views/themes/News365-Video/web-assets/images/yugartar_new.png')?>" alt="" /></a>
                            <!-- <h1><a href="<?php //echo base_url(); ?>">युगान्तर प्रवाह</a></h1> -->
                        </div>
                        <ul class="nav side-menu">
                            <li class="sidebar-search">
                                <?php
                                $fa = array('method' =>'GET' ); 
                                echo form_open('search',$fa);?>
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn mobile-menu-btn" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <?php echo form_close();?>
                                <!-- /input-group -->
                            </li>

<?php
    $bu = base_url();
    if (isset($ads) && is_array($ads)) {
        extract($ads);
    }

$menu_slug = $this->uri->segment(1);
$selected = 'style="background-color:#f60d2b;color:#fff;"';

?>
                             
        <li class="active"><a href="<?php echo $bu ?>" class="active"><?php echo @$lan['home']?></a></li>
            <?php
                $i = 2;
                foreach ($main_menu as $key => $value) {
                    $query1 = $this->db->query("SELECT * FROM menu_content WHERE parents_id='$value->menu_content_id' ORDER BY menu_position ASC");
                    $num_rows1 = $query1->result();

                    if($value->slug!=NULL){
                        $slug1 = $bu.$value->slug;
                    }elseif ($value->link_url!=NULL) {
                        $slug1 = $value->link_url;
                    }else{
                        $slug1 = $bu."#";
                    }

                    if ($num_rows1) {
                        echo '<li>';
                        echo '<a  href="' . $slug1 . '">' . $value->menu_lavel . '<span class="fa arrow"></span></a>';
                        echo '<ul class="nav nav-third-level">';
                        foreach ($num_rows1 as $key1 => $value1) {

                            if($value1->slug!=NULL){
                                $slug2 = $bu.$value1->slug;
                            }elseif ($value1->link_url!=NULL) {
                                $slug2 = $value1->link_url;
                            }else{
                                $slug2 = $bu."#";
                            }

                            echo' <li><a '.(($slug2 == $menu_slug) ? $selected : '').' href="' .  $slug2. '">' . $value1->menu_lavel. '</a></li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<li> <a '.(($slug1 == $menu_slug) ? $selected : '').' href="' . $slug1 . '">' . $value->menu_lavel . '</a>';
                    }
                    echo '</li>';
                }
                ?>

                        </ul>
                    </div>
                </nav>

                <div class="container">
                    <div class="top_header_icon">
                        <div class="social">
                            <ul>
                                <li><a href="<?php if (isset($social_link[0]->fb)) echo @$social_link[0]->fb; ?>" class="facebook"><i class="fa  fa-facebook"></i> </a></li>
                                <li><a href="<?php if (isset($social_link[0]->tw)) echo @$social_link[0]->tw; ?>" class="twitter"><i class="fa  fa-twitter"></i></a></li>
                                <li><a href="<?php if (isset($social_link[0]->google)) echo @$social_link[0]->google; ?>" class="google"><i class="fa  fa-google-plus"></i></a></li>
                                <!-- <li><a href="<?php if (isset($social_link[0]->flickr)) echo @$social_link[0]->flickr; ?>" class="flickr"><i class="fa fa-flickr"></i></a></li> -->
                                <li><a href="<?php if (isset($social_link[0]->youtube)) echo @$social_link[0]->youtube; ?>" class="youtube"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="<?php if (isset($social_link[0]->instagram)) echo @$social_link[0]->instagram; ?>" class="instagram"><i class="fa fa-instagram"></i></a></li>
                                 <!-- <li><a href="<?php if (isset($social_link[0]->vk)) echo @$social_link[0]->vk; ?>" class="vk"><i class="fa fa-vk"></i></a></li> -->
                            </ul>
                        </div>
                        <!-- <span class="top_header_icon_wrap">
                        <a target="_blank" href="<?php if (isset($social_link[0]->tw)) echo @$social_link[0]->tw; ?>" title="Twitter"><i class="fa fa-twitter"></i></a>
                        </span>
                        <span class="top_header_icon_wrap">
                            <a target="_blank" href="<?php if (isset($social_link[0]->fb)) echo @$social_link[0]->fb; ?>" title="Facebook"><i class="fa fa-facebook"></i></a>
                        </span>
                        <span class="top_header_icon_wrap">
                            <a target="_blank" href="<?php if (isset($social_link[0]->google)) echo @$social_link[0]->google; ?>" title="Google"><i class="fa fa-google-plus"></i></a>
                        </span>
                        <span class="top_header_icon_wrap">
                            <a target="_blank" href="<?php if (isset($social_link[0]->instagram)) echo @$social_link[0]->instagram; ?>" title="Instagram"><i class="fa fa-instagram"></i></a>
                        </span>
                        <span class="top_header_icon_wrap">
                            <a target="_blank" href="<?php if (isset($social_link[0]->pin)) echo @$social_link[0]->pin; ?>" title="Pintereset"><i class="fa fa-pinterest-p"></i></a>
                        </span> -->
                    </div>
                    <div class="mob-logo">
                        <!-- <?php  echo '<h2 class="white-text">YUGANTARPRAVAH</h2>'?> -->
                        <div class="logo_img">
                            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('application/views/themes/News365-Video/web-assets/images/yugantarpravahlogo.jpg')?>" alt="" /></a>
                        </div>
                        <!-- <h1><a href="<?php echo base_url(); ?>">युगान्तर प्रवाह</a></h1> -->
                    </div>
                    <div id="showLeft" class="nav-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>

            <div class="social_media_icons">
                <div class="mobile-menu-area navbar-fixed-top hidden-sm hidden-md hidden-lg">
                    <div class="container-fluid top_banner_wrap"> 
                            <div class="row">
                              <!--   <div class="col-xs-12 col-md-4 col-sm-4">
                                    <div class="header-logo">  <!-- logo -->
                                    <!--     <a href="<?php echo $bu; ?>">
                                            <img class="td-retina-data img-responsive"  src="<?php echo base_url() . @$website_logo; ?>" alt="">
                                        </a>
                                    </div>
                                </div> --> 
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <?php
                                    @$social_link = json_decode('[' . $social_link . ']');
                                ?>

                               
                                    <div class="top_header_icon">
                                        <div class="social">
                                            <ul>
                                                <li><a href="<?php if (isset($social_link[0]->fb)) echo @$social_link[0]->fb; ?>" class="facebook"><i class="fa  fa-facebook"></i> </a></li>
                                                <li><a href="<?php if (isset($social_link[0]->tw)) echo @$social_link[0]->tw; ?>" class="twitter"><i class="fa  fa-twitter"></i></a></li>
                                                <li><a href="<?php if (isset($social_link[0]->google)) echo @$social_link[0]->google; ?>" class="google"><i class="fa  fa-google-plus"></i></a></li>
                                                <!-- <li><a href="<?php if (isset($social_link[0]->flickr)) echo @$social_link[0]->flickr; ?>" class="flickr"><i class="fa fa-flickr"></i></a></li> -->
                                                <li><a href="<?php if (isset($social_link[0]->youtube)) echo @$social_link[0]->youtube; ?>" class="youtube"><i class="fa fa-youtube"></i></a></li>
                                                <li><a href="<?php if (isset($social_link[0]->instagram)) echo @$social_link[0]->instagram; ?>" class="instagram"><i class="fa fa-instagram"></i></a></li>
                                                 <!-- <li><a href="<?php if (isset($social_link[0]->vk)) echo @$social_link[0]->vk; ?>" class="vk"><i class="fa fa-vk"></i></a></li> -->
                                            </ul>

                                        </div>
                                        <?php
                                            $fa = array('method' =>'GET' ); 
                                            echo form_open('search',$fa);?>
                                            <div class="input-group custom-search-form">
                                                <input type="text" class="form-control" placeholder="Search...">
                                                <span class="input-group-btn">
                                                    <button class="btn mobile-menu-btn" type="button">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        <?php echo form_close();?>
<!--                                         <span class="top_header_icon_wrap">
                                            <a target="_blank" href="<?php if (isset($social_link[0]->tw)) echo @$social_link[0]->tw; ?>" title="Twitter"><i class="fa fa-twitter"></i></a>
                                        </span>
                                        <span class="top_header_icon_wrap">
                                            <a target="_blank" href="<?php if (isset($social_link[0]->fb)) echo @$social_link[0]->fb; ?>" title="Facebook"><i class="fa fa-facebook"></i></a>
                                        </span>
                                        <span class="top_header_icon_wrap">
                                            <a target="_blank" href="<?php if (isset($social_link[0]->google)) echo @$social_link[0]->google; ?>" title="Google"><i class="fa fa-google-plus"></i></a>
                                        </span>
                                        <span class="top_header_icon_wrap">
                                            <a target="_blank" href="<?php if (isset($social_link[0]->instagram)) echo @$social_link[0]->instagram; ?>" title="Instagram"><i class="fa fa-instagram"></i></a>
                                        </span>
                                        <span class="top_header_icon_wrap">
                                            <a target="_blank" href="<?php if (isset($social_link[0]->youtube)) echo @$social_link[0]->youtube; ?>" title="Youtube"><i class="fa fa-youtube"></i></a>
                                        </span> -->
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu End -->
