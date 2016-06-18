<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Category_model extends My_Model
{
	/**
	* function to add category
	* Param Array new data to add
	*/
	public function add_category($dataArr=''){
			//$this->db->insert(CATEGORY,$dataArr);
			$this->db->insert(CATEGORY_EN,$dataArr);
	}
	
	public function add_category_languge($table,$dataArr=''){
		$this->db->insert($table,$dataArr);
	}
	
	/**
	* function to edit category
	* Param Array new data to add
	* Param String condition 
	*/
	public function edit_category($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(CATEGORY_EN,$dataArr);
			//$this->db->update(CATEGORY,$dataArr);
	}
	
	public function edit_category_language($table,$dataArr='',$condition=''){
		$this->db->where($condition);
		$this->db->update($table,$dataArr);
	}
	
	/**
	* function to view category
	* Param String condition 
	*/
	public function view_category($condition=''){
			//return $this->db->get_where(CATEGORY,$condition);
			return $this->db->get_where(CATEGORY_EN,$condition);
			
	}
	
	// Category Count
	

	 /* get all drafts Count */
    function get_all_counts($catid = '',$seller_id = '')
    {	
		
		
		//echo $catid; die;
/*		$query = " SELECT count(post_status) as disp FROM orders,company
WHERE orderID = 1 AND FIND_IN_SET(companyID, attachedCompanyIDs)";
		return $this->ExecuteQuery($Query);*/
		
		
		//echo $table; die;
		//$_SESSION['userId'] = '42';
		$this->db->select('count(category_id) as disp');
		$this->db->from(PRODUCT);
		if($seller_id != ''){
			$this->db->where('user_id',$seller_id);	
		}	
		if($catid != ''){
		$where = "FIND_IN_SET('".$catid."', category_id)";  
         $this->db->where($where);
		}
		$this->db->where('status','Publish');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$countall = $query->result_array(); 
		
			//print_r($countall); die;
		return $countall;
	
		
		}
	/**
	* function to view main category 
	* Param Int category Id
	* Param String value
	* Param Array Newdata 
	*/
	public function view_category_list_main($CatRow,$val,$arr_val){
	
	$SubcatView ='';
	//,(select count(id) from ".PRODUCT." c where FIND_IN_SET(a.id ,c.category_id) ) as catCount
	
	$select_qry = "select count(id) as catCount from ".PRODUCT." where FIND_IN_SET('".$CatRow->id."' ,category_id)";
	$catCountval = $this->ExecuteQuery($select_qry);
	
	if($catCountval->row()->catCount !=''){ $CatCnt = $catCountval->row()->catCount; }else{ $CatCnt = 0;}
		$SubcatView .= '<div style="float:left;width:100%;background-color:#f2f2f2;border-bottom:1px solid #c8c7c7;"><span class="maincat"><input name="checkbox_id[]" type="checkbox"  value="'.$CatRow->id.'"><strong>'.$CatRow->cat_name.' &nbsp; ('.$CatCnt.')</strong></span>
		<div class="posView">
			<input title="Category Position" class="tipTop" type="text" name="cat_position" value="'.$CatRow->cat_position.'"/>
			<a href="javascript:void(0)" title="Change position" class="tipTop" onclick="javascript:changeCatPos(this,\''.$CatRow->id.'\')">Update</a>
			<img src="images/site/spinner.gif" style="display:none;"/>
		</div>	
		<div class="mainview">';
					if ($arr_val == '1' || in_array('2', $arr_val)){
					$mode = ($CatRow->status == 'Active')?'0':'1';
					$statusMode = 'javascript:confirm_status("admin/category/change_category_status/'.$mode.'/'.$CatRow->id.'")';
					
					if ($mode == '0'){
					$SubcatView .= '<span><a title="Click to inactive" class="action-icons c-approve" href='.$statusMode.'><span class="badge_style b_done">'.$CatRow->status.'</span></a></span><span>';
                    }else{
                    $SubcatView .= '<span><a title="Click to active" class="action-icons c-pending" href='.$statusMode.'><span class="badge_style">'.$CatRow->status.'</span></a></span>';
                    }
					
					}else {
					
					$SubcatView .= '<span class="badge_style b_done">'.$CatRow->status.'</span>';
					}
					
				if ($arr_val == '1' || in_array('2', $arr_val)){
					$SubcatView .= '<span class="view_cat"><a class="action-icons c-edit" href="admin/category/edit_category_form/'.$CatRow->id.'" title="Edit">Edit</a></span>';
				}
					$SubcatView .= '<span class="view_cat"><a class="action-icons c-suspend" href="admin/category/view_category/'.$CatRow->id.'" title="View">View</a></span>';
				if ($arr_val == '1' || in_array('3', $arr_val)){
					$DeleteMode = 'javascript:confirm_delete("admin/category/delete_category/'.$CatRow->id.'")';
					$SubcatView .= '<span class="view_cat"><a class="action-icons c-delete" href='.$DeleteMode.' title="Delete">Delete</a></span>';
				}	
				
				$SubcatView .= '</div><div class="mainshow"><div class="dropdown-button" id="ShowCat_'.$CatRow->id.'" onClick="javascript:showCategoryView('.$CatRow->id.');" title="ShowDown"></div></div></div>';
			
		return $SubcatView;					
	}
	/**
	* function to view sub category 
	* Param Int category Id
	* Param String value
	* Param Array value 
	*/
	public function view_category_list_sub($CatRow,$val,$arr_val){
	$SubcatView ='';
	
	
	$select_qry = "select count(id) as catCount from ".PRODUCT." where FIND_IN_SET('".$CatRow->id."' ,category_id)";
	$catCountval = $this->ExecuteQuery($select_qry);
	
	if($catCountval->row()->catCount !=''){ $CatCnt = $catCountval->row()->catCount; }else{ $CatCnt = 0;}
	
			
		$SubcatView .= '<span class="subcat'.$val.'"><input name="checkbox_id[]" type="checkbox" value="'.$CatRow->id.'"><strong>'.$CatRow->cat_name.' &nbsp; ('.$CatCnt.')</strong></span>
			<div class="subview'.$val.'">';
					if ($arr_val == '1' || in_array('2', $arr_val)){
					$mode = ($CatRow->status == 'Active')?'0':'1';
					$statusMode = 'javascript:confirm_status("admin/category/change_category_status/'.$mode.'/'.$CatRow->id.'")';
					
					if ($mode == '0'){
					$SubcatView .= '<span><a title="Click to inactive" class="action-icons c-approve" href='.$statusMode.'><span class="badge_style b_done">'.$CatRow->status.'</span></a></span><span>';
                    }else{
                    $SubcatView .= '<span><a title="Click to active" class="action-icons c-pending" href='.$statusMode.'><span class="badge_style">'.$CatRow->status.'</span></a></span>';
                    }
					}else {
					
					$SubcatView .= '<span class="badge_style b_done">'.$CatRow->status.'</span>';
					}
					
				if ($arr_val == '1' || in_array('2', $arr_val)){
					$SubcatView .= '<span class="view_cat"><a class="action-icons c-edit" href="admin/category/edit_category_form/'.$CatRow->id.'" title="Edit">Edit</a></span>';
				}
					$SubcatView .= '<span class="view_cat"><a class="action-icons c-suspend" href="admin/category/view_category/'.$CatRow->id.'" title="View">View</a></span>';
				if ($arr_val == '1' || in_array('3', $arr_val)){
						
					$DeleteMode = 'javascript:confirm_delete("admin/category/delete_category/'.$CatRow->id.'")';
					$SubcatView .= '<span class="view_cat"><a class="action-icons c-delete" href='.$DeleteMode.' title="Delete">Delete</a></span>';
				}	
				
				$SubcatView .= '</div><hr style="float:left;width:100%;background-color:#EFF0F7;border:none;height:1px;">';
			
		return $SubcatView;					
	}
	/**
	* function to view category count
	*/	
	public function get_total_category_count(){
		$select_qry = "select count(id) as totalCount from ".CATEGORY." where rootID='0'";
		$categoryList = $this->ExecuteQuery($select_qry);
		return $categoryList->row()->totalCount;
	}
	/**
	* function to view category Details
	* Param Int No of Items per page
	* Param Int list of pages
	*/
	public function view_category_details($searchPerPage=0,$paginationNo=0){
		
		if($searchPerPage > 0){
		$select_qry = "select * from ".CATEGORY." where rootID=0 order by cat_position asc limit ".$paginationNo.",".$searchPerPage."";
		}else{
		$select_qry = "select * from ".CATEGORY." where rootID=0 order by cat_position asc";
		}
		$categoryList = $this->ExecuteQuery($select_qry);
		
		//,(select count(id) from ".PRODUCT." c where FIND_IN_SET(a.id ,c.category_id) ) as catCount
		
		$catView='';$Admpriv = 0;$SubPrivi = '';
			
		if ($this->session->userdata('shopsy_session_admin_name') == $this->config->item('admin_name')){
			$Admpriv = '1';
		}
		
		if($Admpriv==1){
				
		foreach ($categoryList->result() as $CatRow){
			
			$catView .= $this->view_category_list_main($CatRow,'','1');		
			
			$sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."'  ";	
			$SubList = $this->ExecuteQuery($sel_qry);	
			
			$catView .= '<div style="display:none;" id="ShowSub_'.$CatRow->id.'">';
			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->view_category_list_sub($SubCatRow,'1','1');	
				
				$sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."'  ";		
				$SubList1 = $this->ExecuteQuery($sel_qry1);	
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->view_category_list_sub($SubCatRow1,'2','1');	
					
					$sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."'  ";	
					$SubList2 = $this->ExecuteQuery($sel_qry2);	
		
					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->view_category_list_sub($SubCatRow2,'3','1');	

					}			
				}
			}
			$catView .= '</div>';
		}
					
		}else{
			$newSubAdmin = $this->session->userdata('shopsy_session_admin_privileges'); 
			
			
			foreach ($categoryList->result() as $CatRow){
			
			$catView .= $this->view_category_list_main($CatRow,'',$newSubAdmin['category']);		
			
			$sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."'  ";
			$SubList = $this->ExecuteQuery($sel_qry);	
			
			$catView .= '<div style="display:none;" id="ShowSub_'.$CatRow->id.'">';
			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->view_category_list_sub($SubCatRow,'1',$newSubAdmin['category']);	
					
				$sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."'  ";
				$SubList1 = $this->ExecuteQuery($sel_qry1);	
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->view_category_list_sub($SubCatRow1,'2',$newSubAdmin['category']);	
					
					$sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."'  ";	
					$SubList2 = $this->ExecuteQuery($sel_qry2);	
		
					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->view_category_list_sub($SubCatRow2,'3',$newSubAdmin['category']);	

					}			
				}
			}
			$catView .= '</div>';
		}
			
		}
			
			return $catView;
					

			
	}
	/**
	* function to view attribute for category 
	* Param String Condition
	*/
	public function getAttrubteValues($condition){
		$sel = 'select * from '.LIST_VALUES.' '.$condition.' ';
		return $this->ExecuteQuery($sel);
	}
	/**
	* function to view category details 
	*/
	
	public function view_category_details_old(){
	
		$select_qry = "select a.*,(select count(id) from ".PRODUCT." c where FIND_IN_SET(a.id ,c.category_id) ) as catCount from ".CATEGORY." a where a.rootID=0 order by a.cat_position asc";
		$categoryList = $this->ExecuteQuery($select_qry);
		
		//echo '<pre>'; print_r($categoryList->result());die;
		
		$catView='';$Admpriv = 0;$SubPrivi = '';
			
		if ($this->session->userdata('shopsy_session_admin_name') == $this->config->item('admin_name')){
			$Admpriv = '1';
		}
		
		if($Admpriv==1){
				
		foreach ($categoryList->result() as $CatRow){
			
			$catView .= $this->view_category_list_main($CatRow,'','1');		
			
			$sel_qry = "select a.*,(select count(id) from ".PRODUCT." c where FIND_IN_SET(a.id ,c.category_id) ) as catCount from ".CATEGORY." a where a.rootID='".$CatRow->id."'  ";	
			$SubList = $this->ExecuteQuery($sel_qry);	
			
			$catView .= '<div style="display:none;" id="ShowSub_'.$CatRow->id.'">';
			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->view_category_list_sub($SubCatRow,'1','1');	
				
				$sel_qry1 = "select a.*,(select count(id) from ".PRODUCT." c where FIND_IN_SET(a.id ,c.category_id) ) as catCount from ".CATEGORY." a where a.rootID='".$SubCatRow->id."'  ";		
				$SubList1 = $this->ExecuteQuery($sel_qry1);	
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->view_category_list_sub($SubCatRow1,'2','1');	
					
					$sel_qry2 = "select a.*,(select count(id) from ".PRODUCT." c where FIND_IN_SET(a.id ,c.category_id) ) as catCount from ".CATEGORY." a where a.rootID='".$SubCatRow1->id."'  ";	
					$SubList2 = $this->ExecuteQuery($sel_qry2);	
		
					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->view_category_list_sub($SubCatRow2,'3','1');	

					}			
				}
			}
			$catView .= '</div>';
		}
					
		}else{
			$newSubAdmin = $this->session->userdata('shopsy_session_admin_privileges'); 
			
			
			foreach ($categoryList->result() as $CatRow){
			
			$catView .= $this->view_category_list_main($CatRow,'',$newSubAdmin['category']);		
			
			//$sel_qry = "select a.*,b.catCount from ".CATEGORY." a LEFT JOIN (select category_id,count(*) as catCount from ".PRODUCT_CATEGORY." GROUP BY product_id) b on a.id = b.category_id where a.rootID='".$CatRow->id."'  ";	
			$sel_qry = "select a.*,(select count(id) from ".PRODUCT." c where FIND_IN_SET(a.id ,c.category_id) ) as catCount from ".CATEGORY." a where a.rootID='".$CatRow->id."'  ";
			$SubList = $this->ExecuteQuery($sel_qry);	
			
			$catView .= '<div style="display:none;" id="ShowSub_'.$CatRow->id.'">';
			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->view_category_list_sub($SubCatRow,'1',$newSubAdmin['category']);	
					
				//$sel_qry1 = "select a.*,b.catCount from ".CATEGORY." a LEFT JOIN (select subcategory_id,count(*) as catCount from ".PRODUCT_CATEGORY." GROUP BY product_id) b on a.id = b.subcategory_id where a.rootID='".$SubCatRow->id."'  ";	
				$sel_qry1 = "select a.*,(select count(id) from ".PRODUCT." c where FIND_IN_SET(a.id ,c.category_id) ) as catCount from ".CATEGORY." a where a.rootID='".$SubCatRow->id."'  ";
				$SubList1 = $this->ExecuteQuery($sel_qry1);	
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->view_category_list_sub($SubCatRow1,'2',$newSubAdmin['category']);	
					
					//$sel_qry2 = "select a.*,b.catCount from ".CATEGORY." a LEFT JOIN (select subcategory_id,count(*) as catCount from ".PRODUCT_CATEGORY." GROUP BY product_id) b on a.id = b.subcategory_id where a.rootID='".$SubCatRow1->id."'  ";
					$sel_qry2 = "select a.*,(select count(id) from ".PRODUCT." c where FIND_IN_SET(a.id ,c.category_id) ) as catCount from ".CATEGORY." a where a.rootID='".$SubCatRow1->id."'  ";	
					$SubList2 = $this->ExecuteQuery($sel_qry2);	
		
					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->view_category_list_sub($SubCatRow2,'3',$newSubAdmin['category']);	

					}			
				}
			}
			$catView .= '</div>';
		}
			
		}
			
			return $catView;
					

			
	}


	
}

?>