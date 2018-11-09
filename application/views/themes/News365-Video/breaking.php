<!-- top header -->

<div class="top_header hidden-xs">
    <div class="container-fluid">
        <div class="row">
            <div class="top-header-div col-md-12 col-sm-12">
                <div class="top_header_menu_wrap">
                    <ul class="top-header-menu">
                        <li><?php echo date("l, M j G:i:s T Y"); ?></li>
                        <li><?php if($this->session->userdata('name')!=null)
                        { echo $this->session->userdata('name'); }
                        else{ ?>
                            <a href="<?php echo base_url();?>Registration/index" target="__blank"><span class="glyphicon glyphicon-log-in"></span> LOGIN </a>
                            <?php } ?>
                        </li>

                        <li><?php if($this->session->userdata('name')!=null){?>
                         <a href="<?php echo base_url();?>Signout/index" class="popup-with-zoom-anim">Signout</a></li>
                     <?php }

                        else{ 
                            ?>
                            <li><a href="<?php echo base_url();?>Registration/index" ><?php echo display('login_and_registration');?></a></li>
                        <?php } ?>
                       
                        <li><a href="<?php echo base_url();?>Contact/index"><?php echo display('contact')?></a></li>
                    </ul>
                </div>
            </div>
           
            <script type="text/javascript">
                $("#breaking").hide();
            </script>
            <!--breaking news-->
       <!--      <div id="breaking" class="col-sm-8 col-md-7">
                <img src="<?php echo base_url('/views/themes/News365-Video/web-assets/images/download.jpg');?>" alt=""/>
                <div class="newsticker-inner">

                    <ul class="newsticker">
                        <?php
                        for ($i = 1; $i <= count($bn); $i++) {
                            echo '<li>' . $bn['title_' . $i] . '</li>';
                        }
                        ?>
                    </ul>
                    <div class="next-prev-inner">
                        <a href="#" id="prev-button"><i class='pe-7s-angle-left'></i></a>
                        <a href="#" id="next-button"><i class='pe-7s-angle-right'></i></a>
                    </div>
                </div>
            </div> -->

            <!-- <?php
                @$social_link = json_decode('[' . $social_link . ']');
            ?>
 -->
          <!--   <div class="col-sm-12 col-md-4">
                <div class="top_header_icon">
                    <span class="top_header_icon_wrap">
                        <a target="_blank" href="<?php if (isset($social_link[0]->tw)) echo @$social_link[0]->tw; ?>" title="Twitter"><i class="fa fa-twitter"></i></a>
                    </span>
                    <span class="top_header_icon_wrap">
                        <a target="_blank" href="<?php if (isset($social_link[0]->fb)) echo @$social_link[0]->fb; ?>" title="Facebook"><i class="fa fa-facebook"></i></a>
                    </span>
                    <span class="top_header_icon_wrap">
                        <a target="_blank" href="<?php if (isset($social_link[0]->google)) echo @$social_link[0]->google; ?>" title="Google"><i class="fa fa-google-plus"></i></a>
                    </span>
                    <span class="top_header_icon_wrap">
                        <a target="_blank" href="<?php if (isset($social_link[0]->vimo)) echo @$social_link[0]->vimo; ?>" title="Vimeo"><i class="fa fa-vimeo"></i></a>
                    </span>
                    <span class="top_header_icon_wrap">
                        <a target="_blank" href="<?php if (isset($social_link[0]->pin)) echo @$social_link[0]->pin; ?>" title="Pintereset"><i class="fa fa-pinterest-p"></i></a>
                    </span>
                </div>
            </div> -->
        </div>
    </div>
</div>