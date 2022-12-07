<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
	
	public function create($formArray)
    {
        $this->db->insert('categories',$formArray);
       
        
    }
    public function getCategories($params=[])
    {
        if(!empty($params['q']))
        {
            $this->db->like('name',$params['q']);
        }
        $admin=$this->db->get('categories')->result_array();
        return $admin;
    }
    public function getCategory($id)
    {
       
       $this->db->where('id',$id);
       $admin=$this->db->get('categories')->row_array();
        return $admin;
    }
    public function update($id,$formArray)
    {
       
       $this->db->where('id',$id);
      $this->db->update('categories',$formArray);
       
    }
    public function delete($id)
    {
       
       $this->db->where('id',$id);
      $this->db->delete('categories');
       
    }
    public function getCategoriesFront($params=[]){
        $this->db->where('categories.status',1);
        $result = $this->db->get('categories')->result_array();
        //echo $this->db->last_query();
        return $result;
    }
}