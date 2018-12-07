<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    // Getting Page data for home
    function page_data_for_home($page_comma_seperator, $limit = 15) {

        $PN = array();
        $bu = base_url();
        $page_list = explode(',', $page_comma_seperator);

        $word_limit = 30;
        $i = 1;
        foreach ($page_list as $page){
            list($page, $position) = explode('~', $page);

            $this->db->select('categories.*');
            $this->db->from('categories');
            $this->db->where('categories.slug', $page);
            @$slug_row = $this->db->get()->row_array();

            $this->db->select('t1.news_id,t1.time_stamp,t1.slug,t1.page,t1.stitle,t1.title,t1.image,t1.videos,t1.news,t1.reference,t1.ref_date,t1.reporter,t1.videos,t1.post_date,t1.post_by,t3.id,t3.photo,t3.name');
            $this->db->from('news_position t2');
            $this->db->where('t2.page', $slug_row['slug']);
            $this->db->where('t2.status', '1');
            $this->db->join('news_mst t1', 't1.news_id=t2.news_id', 'left');
            $this->db->join('user_info t3', 't3.id=t1.post_by');
            $this->db->where('t1.publish_date <=',date("Y-m-d"));
            $this->db->order_by('t2.position', 'ASC');
            $this->db->limit(50);  
            $result = $this->db->get()->result_array();
            $i = 1;
            foreach ($result as $data) {
                /*print_r($data);die();
                $this->db->select('categories.*');
                $this->db->from('categories');
                $this->db->where('categories.category_name', $data['page']);
                @$slugrow = $this->db->get()->row_array();*/

                $news_id = $data['news_id']; 
                $stitle = $data['stitle'];
                $title = $data['title'];
                $ptime = $data['time_stamp'];
                $slug = $data['slug'];
                @$splited_TITLE = $this->explodedtitle($title);
                @$splited_SLUG = $this->explodedtitle($slug);
                $image = $data['image'];
                $videos = $data['videos'];
                $news_dtl = implode(' ', array_slice(explode(' ', $data['news']), 0, $word_limit));
                $news_full = $data['news'];
                @$page = $data['page'];
                $reporter = $data['reporter'];
                $post_by_name = $data['name'];
                $post_by_img = $data['photo'];
                $post_date = $data['post_date'];

                $this->db->select('categories.*');
                $this->db->from('categories');
                $this->db->where('categories.slug', $data['page']);
                @$newrow = $this->db->get()->row_array();
            
            //Category
           
                // category
                $PN['position_' . $position]['category_' . $i] = $page;

                $PN['position_' . $position]['category_name_' . $i] = $newrow['category_name'];
                // category link
                $PN['position_' . $position]['category_link_' . $i] = base_url().$page;
                //Only news ID 
                $PN['position_' . $position]['news_id_' . $i] = $news_id;
                // post by image
                $PN['position_' . $position]['post_by_image_' . $i] = base_url() . $post_by_img;
                // editor name

                if($reporter !=null){
                    $PN['position_' . $position]['post_by_name_' . $i] = $reporter;
                }else{
                    $PN['position_' . $position]['post_by_name_' . $i] = $post_by_name;
                }
                
                // post time
                $PN['position_' . $position]['ptime_' . $i] =  date('l, d M, Y,g:i A', $ptime);
                // post date
                $PN['position_' . $position]['post_date_' . $i] = $post_date;
                // News Title
                $PN['position_' . $position]['news_title_' . $i] = $title;
                // Short Title
                $PN['position_' . $position]['stitle_' . $i] = $stitle;
                // video 
                $PN['position_' . $position]['video_' . $i] = $videos;
                // news splide title
                $PN['position_' . $position]['splted_title_' . $i] = $this->string_clean($splited_TITLE);
                //News Title With Link
                $PN['position_' . $position]['title_' . $i] = '<a href="' . $bu . @$page . '/' . $news_id . '/' . $this->string_clean($splited_TITLE) . '">' . $title . '</a>';
                //Only News With Link 
               /* $PN['position_' . $position]['news_link_' . $i] = base_url() . $page . '/story/' . $news_id.'/'.$this->string_clean($splited_SLUG);*/
               $PN['position_' . $position]['news_link_' . $i] = base_url() . 'Story/' .$data['page'] . '/' . $this->string_clean($splited_SLUG);
                //Short News
                $PN['position_' . $position]['short_news_' . $i] = strip_tags($news_dtl . '<a href="' . base_url() . $page . $news_id . '/' . $splited_TITLE . '" >   </a>','<p><a>');
               // full_news
                $PN['position_' . $position]['full_news_' . $i] = strip_tags($news_full, '<p><a>');     
                 //Thumb Image
                $PN['position_' . $position]['image_check_' . $i] = $image;
                $PN['position_' . $position]['image_thumb_' . $i] = base_url() . 'uploads/thumb/' . $image;
                //Large Image 
                $PN['position_' . $position]['image_large_' . $i] = base_url() . 'uploads/' . $image;
                //Image thumb with link
                $PN['position_' . $position]['image_thumb_link_' . $i] = "<a href='" . @$PN['position_' . $position]['newslink' . $i] . "'><img src='" . base_url() . 'uploads/thumb/' . $image . "' alt='" . $splited_TITLE . "' class='img-responsive bdtask_image_thumb'></a>";
                //Image large with link
                $PN['position_' . $position]['image_large_link_' . $i] = "<a href='" . @$PN['position_' . $position]['newslink' . $i] . "'><img src='" . base_url() . 'uploads/' . $image . "' alt='" . $splited_TITLE . "' class='img-responsive bdtask_image_large'></a>";

               

                ### Image Group End  ###
                 $i++;

                if ($i > $limit) {
                    break;
                }
            }
        }    
        return $PN;
}
#------------------------------------------------
# gatting home data
#------------------------------------------------    
    public function home_data($page = 'home') {    

/*
        $this->db->select('categories.*');
        $this->db->from('categories');
        $this->db->where('categories.category_name', $page);
        @$slug_row = $this->db->get()->row_array();*/

        $result = $this->db->select('t1.news_id,t1.slug,t1.post_date,t1.time_stamp,t1.page,t1.stitle,t1.title,t1.image,t1.news,t1.reference,t1.ref_date,t1.publish_date,t1.post_by,t1.reporter,t1.status,t1.videos,t3.id,t3.name,t3.photo')
                ->from('news_position t2')
                ->join('news_mst t1', 't1.news_id=t2.news_id', 'left')
                ->join('user_info t3', 't3.id=t1.post_by')
                ->where('t1.publish_date <=',date("Y-m-d"))
                ->where('t2.page', $page)
                ->where('t1.status', '0')
                ->limit(10)
                ->order_by('t2.position', 'ASC')
                ->order_by('t2.news_id', 'DESC')
                ->get()
                ->result();
               
        $bu = base_url();
        $i = 1;
        @$HN = array();

        foreach ($result as $key => $value1) {
             
            /*print_r($value1);die();
            $this->db->select('categories.*');
            $this->db->from('categories');
            $this->db->where('categories.category_name', $value1->page);
            @$slugrow = $this->db->get()->row_array();
*/
            $this->db->select('categories.*');
            $this->db->from('categories');
            $this->db->where('categories.slug', $value1->page);
            @$newrow = $this->db->get()->row_array();
            
            //Category
            $HN['category_' . $i] = $value1->page;
            $HN['category_name_' . $i] = $newrow['category_name'];
            //category link
            $HN['category_link_' . $i] = base_url().$value1->page;
            // video id
            $HN['video_' . $i] = $value1->videos;
            //Ptime
            $HN['ptime_' . $i] = $value1->time_stamp;
            //post date
            $HN['post_date_' . $i] = $value1->post_date;
            $HN['publish_date_' . $i] = $value1->publish_date; 
            // post by images
            $HN['post_by_image_' . $i] =  base_url() . $value1->photo;
            // post by name
            if($value1->reporter !=null){
                $HN['post_by_name_' . $i] = $value1->reporter;
            }else{
                $HN['post_by_name_' . $i] = $value1->name;
            }

            
            //Only news ID 
            $HN['news_id_' . $i] = $value1->news_id;
            //post Title
            $HN['news_title_' . $i] = $value1->title;
            //Short Title
            $HN['stitle_' . $i] = $value1->stitle;
             //Slug Title
            $HN['slug_' . $i] = $this->explodedtitle($value1->slug);
            //Spilt Title;              
             $HN['TITLE_'.$i] = $this->explodedtitle($HN['news_title_' . $i]);

             $HN['splited_title_' . $i] = $this->string_clean($HN['TITLE_'.$i]);

             $HN['splited_slug_' . $i] = $this->string_clean($HN['slug_'.$i]);

            //post Title With Link
            $HN['title_' . $i] = '<a href="' . $bu . $HN['category_' . $i] . '/' . $HN['news_id_' . $i] . '/' . $HN['splited_title_' . $i] . '">' . $HN['news_title_' . $i] . '</a>';
            //Only News Link 
            /*$HN['news_link_' . $i] = base_url() .$HN['category_' . $i] . '/story/' . $HN['news_id_' . $i] . '/' . $HN['splited_slug_' . $i];*/
            $HN['news_link_' . $i] = base_url()  . 'Story/'  . $value1->page . '/' . $HN['splited_slug_' . $i];
            //full news
            $HN['full_news_' . $i] = strip_tags($value1->news, '<p><a>'); //$value1->news                           
            //Image ID
            $HN['image_' . $i] = $value1->image;
            $HN['image_check_' . $i] = $value1->image;
            //Thumb Image Link
            $HN['image_thumb_' . $i] = base_url() . 'uploads/thumb/' . $HN['image_' . $i];
            //Large Image 
            $HN['image_large_' . $i] = base_url() . 'uploads/' . $HN['image_' . $i];
            //Image thumb with with link
            $HN['image_thumb_link_' . $i] = "<a href=" . $bu . $HN['category_' . $i] . '/' . $HN['news_id_' . $i] . '/' . $HN['splited_title_' . $i] ."><img src='" . base_url() . 'uploads/thumb/' . $HN['image_' . $i] . "' alt='" . $HN['splited_title_' . $i] . "'></a>";
            //Image large with with link
            $HN['image_large_link_' . $i] = "<a href=" . $bu . $HN['category_' . $i] . '/' . $HN['news_id_' . $i] . '/' . $HN['splited_title_' . $i] ."><img src='" . base_url() . 'uploads/' . $HN['image_' . $i] . "' alt='" . $HN['splited_title_' . $i] . "'></a>";
            ### Image Group End  ###
            $i++;
        }
  
        $home_page_position = $this->add_home_category_position_data();
        // print_r($home_page_position);exit;
        if ($home_page_position) {
            foreach ($home_page_position as $key1 => $va) {
                foreach ($va as $key => $value) {
                   $cat_list[] = trim($value['slug']) . '~' . $key;
                } 
            }
           
            @$CI = array();
            foreach($cat_list as $key => $value){
                $value = substr($value, 0, strpos($value, "~"));
                
                $this->db->select('category_imgae');
                $this->db->from('categories');
                $this->db->where('slug ', $value);
                $result_category = $this->db->get()->result_array();
                
                foreach ($result_category as $data_cat) {
                    $CI['category_image_'. ($key+1)] = $data_cat['category_imgae'];
                }

            }
           
           
            
            $cat_list = implode(',', $cat_list);
            @$PN = $this->page_data_for_home($cat_list);
           
        } else {
            $PN = '';
        }
        return array('hn' => $HN, 'pn' => $PN , 'ci' => $CI);
    }


#-----------------------------------------------
#       hoem page positionign data
#-----------------------------------------------    
  public function add_home_category_position_data() {
    
        $settings = $this->check_settings_exist(4);
        
        if ($settings != false) {
            $setting_details = $this->object_to_Array(json_decode('[' . $settings . ']'));
            return $setting_details;
        } else {
            return '';
        }
    }
#----------------------------------------------
   function object_to_Array($object) {
        if (!is_object($object) && !is_array($object))
            return $object;
        return array_map('self::object_to_Array', (array) $object);
    }

#--------------------------------------------
    public function check_settings_exist($id) {
        $query = $this->db->select('*')
        ->from('settings')
        ->where('id',$id)
        ->get();
        
        $num_rows = $query->num_rows();
      
        if ($num_rows == 1) {
            $fetch_settings = $query->row();
            return $fetch_settings->details;
        } else {
            return false;
        }
    }
#-----------------------------------------
    // explode Title
#-----------------------------------------    
    function explodedtitle($title) {

        return @trim(@implode('-', @preg_split("/[\s,-\:,()]+/", @$title)), '');
    }
#----------------------------------------
    function string_clean($string) {

        $string1 = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
  
       return $text = preg_replace('/[^A-Za-z0-9\-]/', '', $string1); // Removes special chars.
    

    }

}

?>