<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 **/

class Search extends MY_Controller {   
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('product_model','seller_model');
		$this->load->model('user_model');
		$this->load->model('landing_model');
			
		$this->data['loginCheck'] = $this->checkLogin('U');		
		
    }
	
	/**
	 * 
	 * This function return the search the shop and people
	 * 
	 */
	public function find(){
	
	
		$searchkey=$this->uri->segment(2, 0); 
		if($searchkey=='people'){
			$search_query=trim(urldecode($this->input->get('search_query')));
			$group=$this->input->get('group');
			if($group==0){
				$group='`group`="User" or `group`="Seller"';
			}else if($group==1){
				$group='`group`="Seller"';
			}else if($group==2){
				$group='`group`="User"';
			}
			$order=$this->input->get('order');
			if($order==0){
				$order='ORDER BY `user_name` asc';
			}else if($order==1){
				$order='';
			}
			$this->search_people($search_query,$order,$group);
		}
		if($searchkey=='shop'){
			$search_query=urldecode(trim($this->input->get('search_query')));			
			$order=$this->input->get('order');
			if($order==0){
				$order='';
			}else if($order==1){
				$order='ORDER BY s.created desc';
			}else if($order==2){
				$order='ORDER BY s.seller_businessname asc';
			}
			$this->search_shop($search_query,$order,$group);
		}
		if($searchkey=='local'){
				$this->load->view('site/search/local_search',$this->data);
		}
    }
	
	/**
	 * 
	 * This function return the search the people
	 * @param String $search_query
	 * @param String $order
	 * @param String $group
	 * 
	 */
	public function search_people($search_query='',$order='0',$group='0'){
		
		if(isset($_SERVER['HTTPS'])){
        	$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
	    }else{
			$protocol = 'http://';
	    }	
		$CUrurl = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		#$curUrl = @explode('?pg=',$CUrurl);
		if(substr_count($CUrurl,'?pg=') == 0){
			$curUrl = @explode('&pg=',$CUrurl);
		} else {
			$curUrl = @explode('?pg=',$CUrurl);
		}

		if($this->input->get('pg') != ''){
			$paginationVal = $this->input->get('pg') * 10;
			$limitPaging = $paginationVal.',10 ';
		} else {
			$limitPaging = ' 10';
		}
		
		$newPage = $this->input->get('pg')+1;
		#$qry_str = $curUrl[0].'?pg='.$newPage;
		if(substr_count($curUrl[0],'?') >= 1){
			$qry_str = $curUrl[0].'&pg='.$newPage;
		} else {
			$qry_str = $curUrl[0].'?pg='.$newPage;
		}
		
		
		
		if($search_query!='' && $search_query!=NULL){
			$this->data['start']=0;
			$this->data['search_query']=$search_query;			
			$this->data['group']=$group;
			
			$newVal = 0;
			
			$userList= $this->user_model->get_search_user_list_search(mysql_real_escape_string($search_query),'0',$order,$group,$limitPaging);		
			$this->data['found']=$userList->num_rows;
			$this->data['userList']=$userList->result();
			$this->data['UserDetails'] = $UserDetails =$userList;
			if ($userList->num_rows()>0){			
				foreach ($UserDetails->result() as $UserRow){
					$this->data['UserfavDetails'][$UserRow->id] = $this->user_model->get_userfav_products($UserRow->id);
					$this->data['UserfavProdDetails'][$UserRow->id] = $this->user_model->get_userfav_products($UserRow->id)->result_array();
				}
			}
			$this->data['UserfavDetails']=$this->data['UserfavDetails'];
			$this->data['UserfavProdDetails']=$this->data['UserfavProdDetails'];
			$newVal = $userList->num_rows();
		}
		else{
			$this->data['start']=1;
		}
		
		 if($newVal > 0){
			$paginationDisplay  = '<div class="clear"></div><a title="'.$newPage.'" class="landing-btn-more" href="'.$qry_str.'" style="display: none;">See More Products</a>';
		}else{
			$paginationDisplay  = '<div class="clear"></div><a title="'.$newPage.'" class="landing-btn-more" style="display: none;">No More Products</a>';
		}	
		$this->data['paginationDisplay'] = $paginationDisplay; 
		
		$this->load->view('site/search/people_search',$this->data);
	}
	
	
	/**
	 * 
	 * This function return the search the shop
	 * @param String $search_query
	 * @param String $order
	 * 
	 */
	public function search_shop($search_query='',$order='0'){

		if(isset($_SERVER['HTTPS'])){
        	$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
	    }else{
			$protocol = 'http://';
	    }	
		$CUrurl = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		#$curUrl = @explode('?pg=',$CUrurl);
		if(substr_count($CUrurl,'?pg=') == 0){
			$curUrl = @explode('&pg=',$CUrurl);
		} else {
			$curUrl = @explode('?pg=',$CUrurl);
		}

		if($this->input->get('pg') != ''){
			$paginationVal = $this->input->get('pg') * 10;
			$limitPaging = $paginationVal.',10 ';
		} else {
			$limitPaging = ' 10';
		}
		
		$newPage = $this->input->get('pg')+1;
		#$qry_str = $curUrl[0].'?pg='.$newPage;
		if(substr_count($curUrl[0],'?') >= 1){
			$qry_str = $curUrl[0].'&pg='.$newPage;
		} else {
			$qry_str = $curUrl[0].'?pg='.$newPage;
		}
	
		if($search_query!='' && $search_query!=NULL){
			$this->data['start']=0;
			$this->data['search_query']=$search_query;	
			
			$shopList= $this->user_model->get_search_shop_list_search(mysql_real_escape_string($search_query),'1',$order,$limitPaging);		
			$this->data['found']=$shopList->num_rows;
			$this->data['shopList']=$shopList->result();
			$this->data['ShopDetails'] = $ShopDetails =$shopList;			
			/* if ($shopList->num_rows>0){			
				foreach ($ShopDetails->result() as $ShopRow){
					$condition=array('user_id' => $ShopRow->sellerid,'status'=>'Publish','pay_status'=>'Paid');
					$this->data['ShopListDetails'][$ShopRow->sellerid] = $this->user_model->get_all_details(PRODUCT,$condition);						
					$this->data['ShopListProdDetails'][$ShopRow->sellerid] = $this->user_model->get_all_details(PRODUCT,$condition)->result_array();
				}
			}
			$this->data['ShopListDetails']=$this->data['ShopListDetails'];
			$this->data['ShopListProdDetails']=$this->data['ShopListProdDetails']; */
		}
		else{
			$shopList= $this->user_model->get_search_shop_list_search('','0',$order,$limitPaging);		
			$this->data['found']=$shopList->num_rows;
			$this->data['shopList']=$shopList->result();
			$this->data['ShopDetails'] = $ShopDetails =$shopList;	
			
			/* if ($shopList->num_rows>0){			
				foreach ($ShopDetails->result() as $ShopRow){
					$condition=array('user_id' => $ShopRow->sellerid,'status'=>'Publish','pay_status'=>'Paid');
					$this->data['ShopListDetails'][$ShopRow->sellerid] = $this->user_model->get_all_details(PRODUCT,$condition);	
					
					//echo $this->db->last_query(); die;					
					$this->data['ShopListProdDetails'][$ShopRow->sellerid] = $this->user_model->get_all_details(PRODUCT,$condition)->result_array();
					echo '<pre>';print_r($this->data['ShopListDetails'][$ShopRow->sellerid]);
					echo '<pre>';print_r($this->data['ShopListProdDetails'][$ShopRow->sellerid]);
					die;
					
				}
			} */
			//$this->data['ShopListDetails']=$this->data['ShopListDetails'];
			//$this->data['ShopListProdDetails']=$this->data['ShopListProdDetails'];
			$this->data['start']=0;
		}
		
		if($shopList->num_rows() > 0){
			$paginationDisplay  = '<div class="clear"></div><a title="'.$newPage.'" class="landing-btn-more" href="'.$qry_str.'" style="display: none;">See More Products</a>';
		}else{
			$paginationDisplay  = '<div class="clear"></div><a title="'.$newPage.'" class="landing-btn-more" style="display: none;">No More Products</a>';
		}	
		$this->data['paginationDisplay'] = $paginationDisplay;
		
		#echo "<pre>"; print_r($ShopDetails); die;
		$this->load->view('site/search/shop_search',$this->data);
	}
	
	
	/**
	 * 
	 * This function return the autosuggestion for search option
	 * @param String $search_query
	 * 
	 */
	public function autosuggest_list($search_key=''){	
		#echo $search_key;
		$shopList= $this->landing_model->listitemsuggest(trim($search_key))->result_array();
		#echo $this->db->last_query(); die;
		
		$suggestList='<ul class="search-dropdown">';
		foreach($shopList as $list){
			$suggestList.='<li>
				<div class="li-suggest">
					<div class="name-suggestion">
						<!--<a href="search/all?item='.$search_key.'"><span class="suggest">'.$list["product_name"].'</span></a> -->
						<a href="products/'.$list["seourl"].'"><span class="suggest">'.$list["product_name"].'</span></a> 
					</div>
				</div>
			</li>';
		}
		$suggestList.='<li><div class="li-suggest"><div class="name-suggestion"><a href="find/shop?search_query='.urldecode($search_key).'&order=0">find shop names containing - <span class="suggest">'.urldecode($search_key).'</span></a></div></div></li>';
		$suggestList.='</ul>';
		echo $suggestList;
	}
	
	
	
	
}
/*End of file search.php */
/* Location: ./application/controllers/site/search.php */