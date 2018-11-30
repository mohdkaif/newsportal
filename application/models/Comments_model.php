<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments_model extends CI_Model {
	
	#================Get total table row==========#
	public function total_comments($slug=NULL){

		$actual_slug = str_replace("-"," ",$slug);
		$this->db->select('news_mst.*');
        $this->db->from('news_mst');
        $this->db->where('news_mst.slug',$actual_slug);
        @$slug_row = $this->db->get()->row_array();


    	$query = $this->db->where('news_id', $slug_row['news_id'])->where('com_status','1')->get('comments_info');
		return $query->num_rows();
	}

	#============Show All comment ===================#
	public function view_data_comments($slug=null){
		
		$actual_slug = str_replace("-"," ",$slug);
		$this->db->select('news_mst.*');
        $this->db->from('news_mst');
        $this->db->where('news_mst.slug',$actual_slug);
        @$slug_row = $this->db->get()->row_array();

		$this->db->select('user_info.id,user_info.name,user_info.photo,comments_info.*');
		$this->db->from('comments_info');
		$this->db->join('user_info', 'comments_info.com_user_id = user_info.id');
		$this->db->where('com_status',1);
		$this->db->where('com_replay_id',0);
		$this->db->where('comments_info.news_id',$slug_row['news_id']);
		return $this->db->get()->result();
	}

}