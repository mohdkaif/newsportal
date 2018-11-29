<?php
$bu = base_url();
if (isset($ads) && is_array($ads)) {
    extract($ads);
}

    $menu_slug = $this->uri->segment(1);
    $selected = 'style="background-color:#f60d2b;color:#fff;"';
?>

<div class="container-fluid top_banner_wrap">
   
        <div class="row">
          <!--   <div class="col-xs-12 col-md-4 col-sm-4">
                <div class="header-logo">  <!-- logo -->
                <!--     <a href="<?php echo $bu; ?>">
                        <img class="td-retina-data img-responsive"  src="<?php echo base_url() . @$website_logo; ?>" alt="">
                    </a>
                </div>
            </div> --> 
            <div class=" col-md-3 col-sm-4 col-xs-12">
                
                <div class="header-bann">
                    <!-- <?php  echo '<h2 class="white-text">YUGANTARPRAVAH</h2>'?> -->
                    <div class="logo_img">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('application/views/themes/News365-Video/web-assets/images/yugantarlogo.png')?>" alt="" /></a>
                    </div>
                    <h1><a href="<?php echo base_url(); ?>">युगान्तर प्रवाह</a></h1>
                </div>
            </div>
            <div class="col-md-9 col-sm-8 col-xs-12">
                <?php
                @$social_link = json_decode('[' . $social_link . ']');
            ?>

           
                <div class="top_header_icon">
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
                        <a target="_blank" href="<?php if (isset($social_link[0]->youtube)) echo @$social_link[0]->youtube; ?>" title="Youtube"><i class="fa fa-youtube"></i></a>
                    </span> -->
                    <div class="social">
                            <ul class="web-social">
                                <li><a href="<?php if (isset($social_link[0]->fb)) echo @$social_link[0]->fb; ?>" class="facebook"><i class="fa  fa-facebook"></i> </a></li>
                                <li><a href="<?php if (isset($social_link[0]->tw)) echo @$social_link[0]->tw; ?>" class="twitter"><i class="fa  fa-twitter"></i></a></li>
                                <li><a href="<?php if (isset($social_link[0]->google)) echo @$social_link[0]->google; ?>" class="google"><i class="fa  fa-google-plus"></i></a></li>
                                <!-- <li><a href="<?php if (isset($social_link[0]->flickr)) echo @$social_link[0]->flickr; ?>" class="flickr"><i class="fa fa-flickr"></i></a></li> -->
                                <li><a href="<?php if (isset($social_link[0]->youtube)) echo @$social_link[0]->youtube; ?>" class="youtube"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="<?php if (isset($social_link[0]->instagram)) echo @$social_link[0]->instagram; ?>" class="instagram"><i class="fa fa-instagram"></i></a></li>
                                 <!-- <li><a href="<?php if (isset($social_link[0]->vk)) echo @$social_link[0]->vk; ?>" class="vk"><i class="fa fa-vk"></i></a></li> -->
                            </ul>
                    </div>
                </div>
            </div>
        </div>
</div>


<?php 

?>
<!-- navber -->
<div class="container-fluid hidden-xs">
    <nav class="navbar">
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
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
                        echo '<li class="dropdown">';
                        echo '<a  href="' . $slug1 . '" class="dropdown-toggle ' . $i++ . '" data-toggle="dropdown">' . $value->menu_lavel . '<span class="pe-7s-angle-down"></span></a>';
                        echo '<ul class="dropdown-menu menu-slide">';
                        foreach ($num_rows1 as $key1 => $value1) {
                            if($value1->slug!=NULL){
                                $slug2 = $bu.$value1->slug;
                            }elseif ($value1->link_url!=NULL) {
                                $slug2 = $value1->link_url;
                            }else{
                                $slug2 = $bu."#";
                            }
                            echo' <li><a '.(($value1->slug == $menu_slug) ? $selected : '').' href="' . $slug2. '">' . $value1->menu_lavel . '</a></li>';
                        }
                        echo '</ul>';
                    } else {
                        if($value->parents_id!=NULL){

                        }else{
                        echo '<li> <a '.(($value->slug == $menu_slug) ? $selected : '').' href="' . $slug1 . '" class="' . $i++ . '">' . $value->menu_lavel . '</a>';
                            }            
                        }
                    echo '</li>';
                }
                ?>
            </ul>
        </div> 
    </nav>
</div>



</header>   