<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(-1);
/*
 *
 * This model contains all db functions related to offer management
 * @author casperon
 *
 */
class Support_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	// FUNCTION TO FRESH DESK ACCOUNT FOR SELLER
	function freshdesk_create_user($user_email,$user_name){
		if($user_email != ''){
			
			$freshdesk_link=$this->config->item('fresh_desk_link');
			$freshdesk_key=$this->config->item('fresh_desk_key');

			$data = array("user" => array("email"=>$user_email,"name"=>$user_name));
		
			//encoding to json format
			 $jsondata= json_encode($data);
			 
			#echo "START....<br /> ";

			$header[] = "Content-type: application/json";
			$connection = curl_init();
			curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($connection, CURLOPT_HTTPHEADER, $header);
			curl_setopt($connection, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($connection, CURLOPT_HEADER, false);
			curl_setopt($connection, CURLOPT_USERPWD, $freshdesk_key);

			curl_setopt($connection, CURLOPT_POST, 1);
			curl_setopt($connection, CURLOPT_POSTFIELDS, $jsondata);
			curl_setopt($connection, CURLOPT_VERBOSE, 1);

			//replace your domain url below.
			curl_setopt($connection, CURLOPT_URL, $freshdesk_link."/contacts.json");
			$response = curl_exec($connection);		
			
			return true;
		}
	}
	
	// FRESH DESK TICKET CREATION
	function freshdesk_create_ticket($ticket_data=array()){
		
		#echo '<pre>'; print_r($ticket_data); die;

		if(!empty($ticket_data)){
			$fd_domain = $this->config->item('fresh_desk_link');
			$token = $this->config->item('fresh_desk_key');
			#var_dump($ticket_data); die;
			$json_body = json_encode($ticket_data);

			$header[] = "Content-type: application/json";
			$connection = curl_init("$fd_domain/helpdesk/tickets.json");
			curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($connection, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($connection, CURLOPT_HTTPHEADER, $header);
			curl_setopt($connection, CURLOPT_HEADER, false);
			curl_setopt($connection, CURLOPT_USERPWD, "$token");
			curl_setopt($connection, CURLOPT_POST, true);
			curl_setopt($connection, CURLOPT_POSTFIELDS, $json_body);
			curl_setopt($connection, CURLOPT_VERBOSE, 1);

			$response = curl_exec($connection);
			 return $result=json_decode($response);
			
		}
	}
	
	// FRESH DESK VIEW MESSAGE USING TICKET ID
	function freshdesk_view_message($ticket_data){
		if(!empty($ticket_data)){
			$fd_domain = $this->config->item('fresh_desk_link');
			$token = $this->config->item('fresh_desk_key');
			$json_body = json_encode($ticket_data);
			$id=$ticket_data['display_id'];
			$header[] = "Content-type: application/json";
			$connection = curl_init("$fd_domain/helpdesk/tickets/".$id.".json");
			curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($connection, CURLOPT_CUSTOMREQUEST, "GET");	
			curl_setopt($connection, CURLOPT_HTTPHEADER, $header);
			curl_setopt($connection, CURLOPT_HEADER, false);
			curl_setopt($connection, CURLOPT_USERPWD, "$token");
			curl_setopt($connection, CURLOPT_POST, true);
			curl_setopt($connection, CURLOPT_POSTFIELDS,$json_body);
			curl_setopt($connection, CURLOPT_VERBOSE, 1);
			$response = curl_exec($connection);
			$result=json_decode($response); 
			return $result;
			}
		}
		
	// FRESH DESK VIEW TICKET LIST BY EMAIL	
	function freshdesk_view_ticket($ticket_data){
	
		if(!empty($ticket_data)){
	
			$fd_domain = $this->config->item('fresh_desk_link');
			$token = $this->config->item('fresh_desk_key');
			
			#$fd_domain = "http://varathan.freshdesk.com";
			#$token = "cBwQpcWYjbPSshLJqKyX";
			
			$json_body = json_encode($ticket_data);
			$header[] = "Content-type: application/json";
			$connection = curl_init("$fd_domain/helpdesk/tickets.json");
			curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($connection, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($connection, CURLOPT_HTTPHEADER, $header);
			curl_setopt($connection, CURLOPT_HEADER, false);
			curl_setopt($connection, CURLOPT_USERPWD, "$token");
			curl_setopt($connection, CURLOPT_POST, true);
			curl_setopt($connection, CURLOPT_POSTFIELDS,$json_body);
			curl_setopt($connection, CURLOPT_VERBOSE, 1);
			$response = curl_exec($connection);
			$result=json_decode($response);
			return $result;
		}
	}	
	
	// FRESH DESK TICKET CREATION  WITH ATTACHMENT
	function freshdesk_create_ticket_with_attachements($ticket_data,$attach){   //var_dump($ticket_data); die;
		$API_KEY = $this->config->item('fresh_desk_key');
		$FD_ENDPOINT =$this->config->item('fresh_desk_link');  // verify if you are using https, and change accordingly!
		$mode=0;
		$eol = "\r\n";	
		$mime_boundary = md5(time());
		$data='';
		$data .= '--' . $mime_boundary . $eol;
		$data .= 'Content-Disposition: form-data; name="helpdesk_ticket[email]"' . $eol . $eol;
		$data .= $ticket_data['helpdesk_ticket']['email'] . $eol;
		
		/* $data .= '--' . $mime_boundary . $eol;
		$data .= 'Content-Disposition: form-data; name="helpdesk_ticket[group_id]"' . $eol . $eol;
		$data .= $ticket_data['group_id'] . $eol; */

		$data .= '--' . $mime_boundary . $eol;
		$data .= 'Content-Disposition: form-data; name="helpdesk_ticket[subject]"' . $eol . $eol;
		$data .= $ticket_data['helpdesk_ticket']['subject'] . $eol;

		$data .= '--' . $mime_boundary . $eol;
		$data .= 'Content-Disposition: form-data; name="helpdesk_ticket[description]"' . $eol . $eol;
		$data .= $ticket_data['helpdesk_ticket']['description'] . $eol;
		foreach($attach as $file){
			$data .= '--' . $mime_boundary . $eol;
			$data .= 'Content-Disposition: form-data; name="helpdesk_ticket[attachments][][resource]"; filename="' . $file['name'] . '"' . $eol;
			$data .= "Content-Type: ".$file['type'] . $eol . $eol;
			$data .= file_get_contents($file['path']) . $eol;
			
		} 		
		$data .= "--" . $mime_boundary . "--" . $eol . $eol;
		$header[] = "Content-type: multipart/form-data; boundary=" . $mime_boundary;
		$url = "$FD_ENDPOINT/helpdesk/tickets.json";

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
		curl_setopt($ch, CURLOPT_USERPWD, "$API_KEY:X");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$server_output = curl_exec($ch);

		$response = json_decode($server_output);
		return $response; 
		curl_close($ch);

	}	
	
	// FUNCTION TO FIND MIME TYPES OF ATTACHMENT
	public function get_file_mime_type($file){
		$filename=$file;
		$mime_types = array(
			'txt' => 'text/plain',
			'htm' => 'text/html',
			'html' => 'text/html',
			'php' => 'text/html',
			'css' => 'text/css',
			'js' => 'application/javascript',
			'json' => 'application/json',
			'xml' => 'application/xml',
			'swf' => 'application/x-shockwave-flash',
			'flv' => 'video/x-flv',

			// images
			'png' => 'image/png',
			'jpe' => 'image/jpg',
			'jpeg' => 'image/jpg',
			'jpg' => 'image/jpg',
			'gif' => 'image/gif',
			'bmp' => 'image/bmp',
			'ico' => 'image/vnd.microsoft.icon',
			'tiff' => 'image/tiff',
			'tif' => 'image/tiff',
			'svg' => 'image/svg+xml',
			'svgz' => 'image/svg+xml',

			// archives
			'zip' => 'application/zip',
			'rar' => 'application/x-rar-compressed',
			'exe' => 'application/x-msdownload',
			'msi' => 'application/x-msdownload',
			'cab' => 'application/vnd.ms-cab-compressed',

			// audio/video
			'mp3' => 'audio/mpeg',
			'qt' => 'video/quicktime',
			'mov' => 'video/quicktime',

			// adobe
			'pdf' => 'application/pdf',
			'psd' => 'image/vnd.adobe.photoshop',
			'ai' => 'application/postscript',
			'eps' => 'application/postscript',
			'ps' => 'application/postscript',

			// ms office
			'doc' => 'application/msword',
			'rtf' => 'application/rtf',
			'xls' => 'application/vnd.ms-excel',
			'ppt' => 'application/vnd.ms-powerpoint',
			'docx' => 'application/msword',
			'xlsx' => 'application/vnd.ms-excel',
			'pptx' => 'application/vnd.ms-powerpoint',


			// open office
			'odt' => 'application/vnd.oasis.opendocument.text',
			'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

		$ext = strtolower(array_pop(explode('.',$filename)));
	
 
		 if(function_exists('mime_content_type')&&$mode==0){ 
				$mimetype = mime_content_type($filename); 
				$mt= $mimetype; 

		}elseif(function_exists('finfo_open')&&$mode==0){ 
				$finfo = finfo_open(FILEINFO_MIME); 
				$mimetype = finfo_file($finfo, $filename); 
				finfo_close($finfo); 
				$mt= $mimetype; 
		}elseif(array_key_exists($ext, $mime_types)){ 
				$mt= $mime_types[$ext]; 
		}else { 
				$mt= 'application/octet-stream'; 
		}
		return $mt;
	}
	
	
}	