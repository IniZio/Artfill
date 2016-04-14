<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_pagination {
    
    private $total_results;
    private $maximum_per_page;
    private $total_pages;
    private $maximum_links;
    private $pg;
	private $pagination;
	public $limit;
    
    public function paginate($total_results, $maximum_per_page, $maximum_links, $style = "Light",$url) {
        
        $this->total_results  = $total_results;
        $this->maximum_per_page = $maximum_per_page;
        $this->total_pages  = ceil($this->total_results / $this->maximum_per_page);
        $this->maximum_links      = $maximum_links / 2;
		
		// Dynamic styling
		switch ($style) {
		case "Light":
			$style_main = "pagination";
			$style_active = "page active";
			$style_page = "page";
			break;
		case "Dark":
			$style_main = "pagination dark";
			$style_active = "page dark active";
			$style_page = "page dark";
			break;
		default:
			$style_main = "pagination";
			$style_active = "page active";
			$style_page = "page";
			break;
		}
		
        // If not detected "pg" means we are on page one
        if (isset($_GET["pg"])) {
            $this->pg = $_GET["pg"];
        } else {
            $this->pg = 1;
        }
		#if(strpos('?', $url) || strpos('??', $url)){
		if(strpos($url,'?') !== false){
			$pageQry='&pg';
		}else{
			$pageQry='?pg';
		}
		
		
		// Object containing the clause limit
		$this->limit =$this->maximum_per_page * $this->pg - $this->maximum_per_page;	// For Codeigniter
		#$this->limit =$this->maximum_per_page * $this->pg - $this->maximum_per_page.",".$this->maximum_per_page; //For Core Php
        
        $offset_izq = ($this->pg - $this->maximum_links) < 0 ? $this->pg - $this->maximum_links : 0;
        $offset_der = ($this->total_pages - $this->pg) < $this->maximum_links ? $this->maximum_links - ($this->total_pages - $this->pg) : 0;
        
		
			$this->pagination ="<link href='".base_url()."css/default/front/pagination_style.css' rel='stylesheet'><div id='container'><div class='".$style_main."'>";
		
			// Left Arrow
			if ($this->pg == 1) {
				$this->pagination.= "<div class='".$style_active."'> Previous </div>";
			} else {
				$pagina_anterior = $this->pg - 1;
				$this->pagination.= " <a href='" . $url . "$pageQry=$pagina_anterior' class='".$style_page."'> Previous </a> ";
			}
        
        // Loop that makes the links
			for ($i = 1; $i <= $this->total_pages; $i++) {
				if ($i <= ($this->pg - $this->maximum_links) - $offset_der || $i > ($this->pg + $this->maximum_links) - $offset_izq) {
					continue;
				}
				
				// Condition that makes or not the link to the current page
				if ($i == $this->pg) {
					$this->pagination.= " <span class='".$style_active."'>" .$i. "</span>";
				} else {
					$this->pagination.= " <a href='" . $url. "$pageQry=$i' class='".$style_page."'>" . $i . "</a> ";
				}
			}
			
			// Right arrow
			if ($this->pg == $this->total_pages) {
				$this->pagination.= " <div class='".$style_active."'> Next </div>";
			} else {
				$pagina_posterior = $this->pg + 1;
				$this->pagination.= " <a href='" . $url . "$pageQry=$pagina_posterior' class='".$style_page."'> Next </a> ";
			}
			
			$this->pagination.= "</div></div>";
		
		return $this->pagination;
    }
}
/* EOF */