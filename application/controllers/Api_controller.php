<?php defined('BASEPATH') or exit('No direct script access allowed');

class Api_controller extends CI_Controller {


#---------------------------------------    
# construction function
#---------------------------------------    
    public function __construct() {
        parent::__construct();
        // loading model
        $this->db  = $this->load->database('default', TRUE);
        $this->load->library('facebook');
        $this->load->helper('url');
        // loading model
        $this->load->model('Ads','ads');
        $this->load->model("Settings",'settings');
        $this->load->model('home_model', 'hm');
        $this->load->model('Pb_function', 'pb');
        $this->load->model('All_cata', 'cata');
        $this->load->model('Common_model', 'cm');
        $this->load->model('Write_setting_model', 'wsm');

    }


/***************************************
 * To veiw all home page Data
****************************************************/

    public function registration() {
       phpinfo();
       die();
        $this->form_validation->set_rules('name', 'Name ', 'required');
        $this->form_validation->set_rules('email', 'Email ', 'trim|required');
        $this->form_validation->set_rules('password', 'Password ', 'trim|required');
       
        if ($this->form_validation->run() == FALSE) {    

            $data['validation_errors'] = validation_errors();
            
        } else {
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $password = md5($this->input->post('password'));

                $check_status = $this->db->select('*')->from('user_info')->where('email',$email)->get()->row();        
                if ($check_status) {
                    $data['message'] = "You already registerd.";
                    //$this->session->set_flashdata('exception', "You already registerd.");
                } else{
                        $user_data = array(
                            'name'      =>$name,
                            'email'     =>$email,
                            'password'  =>$password,
                            'user_type' =>5
                        );
                        $this->db->insert('user_info',$user_data);
                        $data['message'] = "Registration successful.";
                    //$this->session->set_flashdata('message', "Registration successfully.");
                }
               
        }
        

        echo json_encode($data);
    }


 public function login(){

        $data = array(
            'email' => ($this->input->post('email',TRUE)),
            'password' => ($this->input->post('password',TRUE))
        );

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['validation_errors'] = $this->form_validation->errors();
        } else {

        $query = $this->db->select('*')
        ->from('user_info')
        ->where('email', trim($data['email']))
        ->where('password', md5($data['password']))
        ->where('user_type',5)
        ->where('status', 1)
        ->get();

        

            if($query->num_rows()>0){

                $data = $query->row_array(); 

                $session_data = array(

                        'id' => $data['id'],
                        'name' => $data['name'],
                        'pen_name' => $data['pen_name'],
                        'user_type' => $data['user_type'],
                        'email' => $data['email'],
                        'session_id' => session_id(),
                        'logged_in' => TRUE
                );

                $data['user_data'] = $session_data;

            } else{
                 $data['user_data'] = display('log_error_msg');
            
            }

        }   
     
   

    echo json_encode($data);
    }

    public function posts() {

        $data = $this->hm->home_data();
        #---------------------
        # website setting data        
        $data['home_page_positions'] = $this->wsm->home_category_position();
        $data['website_logo'] = $this->wsm->website_logo();
        $data['footer_logo'] = $this->wsm->footer_logo();
        $data['website_favicon'] = $this->wsm->website_favicon();
        $data['website_footer'] = $this->wsm->website_footer();
        $data['website_title'] = $this->wsm->website_title();
        $data['website_timezone'] = $this->wsm->website_timezone();
        $data['lan'] = $this->wsm->lan_data();
        $data['default_theme'] = $this->wsm->theme_data();

        $default_theme = $data['default_theme'];
        #----------------------
        $data['ln'] = $this->cm->latest_news();
        $data['bn'] = $this->cm->breaking_news();
        $data['mr'] = $this->cm->most_read_dbse();
        $data['pull'] = $this->cm->pulling();
        // Getting Seo Properties
        $data['seo']['analytics_code'] = $this->settings->get_previous_settings('settings', 5);
        $data['seo']['alexa_code'] = $this->settings->get_previous_settings('settings', 11);
        $data['seo']['social_sites'] = $this->settings->get_previous_settings('settings', 6);
        $data['seo']['fixed_keyword'] = $this->settings->get_previous_settings('settings', 10);
        $data['social_link'] = $this->settings->get_previous_settings('settings', 111);
        // getting ads
        $data['ads'] = $this->ads->SelectAds();
        $data['Editor'] = $this->hm->home_data('Editor-Choice');
        $data['main_menu'] = $this->settings->main_menu();
        $data['menus'] = $this->settings->menu_position_3();
        $data['footer_menu'] = $this->settings->footer_menu();

       

        
        echo json_encode($data);
    }
}