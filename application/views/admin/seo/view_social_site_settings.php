<?php
$user_id = $this->session->userdata('id');
$this->load->view('admin/view_left_menu');
?>
<aside class="right-side">
    <section class="content col-sm-12">
        <div class="col-sm-8">
            <?php
            $settings = json_decode('[' . 

$previous_settings . ']');
            ?>
            <div class="page_heading"><i 

class="glyphicon glyphicon-cog"></i>&nbsp; <?php 

echo display('social_site_settings')?> </div>
            <?php
            if ($this->session->flashdata('message')) {
                echo '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><b>';
                echo $this->session->flashdata('message');
                echo '</b></div>';
            }
            $attributs = array('method' =>'post' );
            echo form_open('admin/Seo/update_social_site_settings',$attributs);
            ?>
                <!--facebook-->
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4"><label><?php echo display('facebook_url')?></label></div>
                        <div class="col-sm-8">
                            
                            
                            
                            <input name="xyz" id="xyz" class="form-control" type="text">
                            <textarea name="fb[URL]" class="form-control" rows="6" readonly="readonly">
                                <?php if (isset($settings[0]->fb->URL)) echo @$settings[0]->fb->URL; ?>
                            </textarea>
                     
                            
                        </div>                                        
                    </div>   
                </div>   
                <br/>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4"><label><?php echo display('show_on')?></label></div>
                        <div class="col-sm-8">
                            <input type="checkbox" name="fb[h_p]" value="1" <?php if (@$settings[0]->fb->h_p == 1) echo 'checked'; ?>>&nbsp;<?php echo display('home')?> &nbsp;
                            <input type="checkbox" name="fb[c_p]" value="1" <?php if (@$settings[0]->fb->c_p == 1) echo 'checked'; ?>>&nbsp;<?php echo display('category')?> &nbsp;
                            <input type="checkbox" name="fb[d_p]" value="1" <?php if (@$settings[0]->fb->d_p == 1) echo 'checked'; ?>>&nbsp;<?php echo display('details')?> 
                        </div>                                        
                    </div>   
                </div>   
                <hr/>
                <br/>

              
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label></label>
                            <input type="submit" name="save" value="<?php echo display('update')?>" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                            <script type="text/javascript">
                                var $stt="";
                                $("#xyz").keyup(function(event) 

{
                                    $stt = $(this).val();
                                    alert($stt);
                                    /*$("div").text(stt);*/
                                    var $x ='<div class="fb-page" data-href="'+$stt+'" data-tabs="timeline" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="'+$stt+'" class="fb-xfbml-parse-ignore"><a href="'+ $stt+'">Bdtask</a></blockquote></div>';
                                    alert($x);
                                    
                                    $('textarea[name="fb[URL]"]').text($x);
                                    alert($('textarea[name="fb[URL]"]').val());
                                    //$(['name=']).text($x);
                                    
                                });
                            </script>
            <?php echo form_close();?>
        </div>
    </section>
</aside>