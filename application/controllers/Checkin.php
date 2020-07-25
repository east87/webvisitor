<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkin extends CI_Controller {

	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public function __construct()

	{
		parent::__construct();
                $this->load->model('web/Model_checkin');
		 $this->load->helper(array('form','funcglobal','url'));
                 error_reporting(E_ERROR | E_WARNING | E_PARSE);
                
                $module_name=  $this->uri->segment(1);
		$this->data['controller'] = $module_name;   
		if(!$_SESSION)
                {
                    session_start();
                }
             include 'checkSession.php';   
	}
        
	public function index()
	{     
        
        if($_SESSION['user_data']){
            redirect(BASE_URL.'/session');
        } else {
           //  session_destroy();
            $this->load->view('vcheckin',$this->data);
        }
        
        }
    
        
        public function session()
	{
        if($_SESSION['user_data']){
             $checkin_date= $this->data["checkin_date"];
             $this->load->view('vsession',$this->data);
        } else {
           // session_destroy();
            redirect(BASE_URL);
        }
                
		
	}
    
    public function getLocations()
    {
        if ($_POST) {
            $lat         = $this->input->post("lat");
            $long        = $this->input->post("long");
            $ListShowroom              = $this->Model_checkin->getLocations($lat, $long);
            echo json_encode($ListShowroom);
        }
    }
        
        
        
    function doCheckin(){
      
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

    // Build POST request:
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = SECRET_KEY;
    $recaptcha_response = $_POST['recaptcha_response'];

    // Make and decode POST request:
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);
       
    // Take action based on the score returned:
    if ($recaptcha->score > 0.5) {
    $quest_name = $this->security->xss_clean(trim($_POST['quest_name']));
    $quest_type = $this->security->xss_clean(trim($_POST['quest_type']));
    $showroom_id=base64_decode($_POST['showroom_id']);
    $quest_idcard = $this->security->xss_clean(trim($_POST['quest_id']));
    $quest_phone = $this->security->xss_clean(trim($_POST['quest_phone']));
    $quest_email = $this->security->xss_clean(trim($_POST['quest_email']));
    $quest_temp = $_POST['quest_temp'];
    $quest_validation = $this->security->xss_clean(trim($_POST['quest_validation']));
    $checkin_date = date("Y-m-d H:i:s");
    $check_showroom = $this->Model_checkin->checkShowroom($showroom_id,$quest_validation);
        if ($check_showroom) {
             $showroom_name =$check_showroom[0]['showroom_name'];
             $showroom_address =$check_showroom[0]['showroom_address'];
               // untuk check data
             $checkQuest    = $this->Model_checkin->checkQuest($quest_idcard, $quest_phone, $quest_email);
               if ($checkQuest) {
                   //if untuk check daftar
                   $quest_id=$checkQuest[0]['quest_id'];
                   $doUpdate    = $this->Model_checkin->updateQuest($quest_id,$quest_type, $quest_name, $quest_idcard, $quest_phone, $quest_email);
                   $checkCheckin    = $this->Model_checkin->checkCheckin($quest_id, $showroom_id);
                   if($checkCheckin){
                       $checkin_id=$checkCheckin[0]['checkin_id'];
                        $session_quest = $quest_id."|".$quest_name."|".$quest_phone."|".$quest_email."|".$checkin_date."|".$showroom_name."|".$showroom_address."|".$checkin_id;
                        $_SESSION['user_data'] = $session_quest; 
                       $result=2;
                   }
                   else {
                      $checkin_id    = $this->Model_checkin->addCheckin($quest_id, $showroom_id,$quest_temp,$checkin_date); 
                      $session_quest = $quest_id."|".$quest_name."|".$quest_phone."|".$quest_email."|".$checkin_date."|".$showroom_name."|".$showroom_address."|".$checkin_id;
                      $_SESSION['user_data'] = $session_quest;
                     // $this->sendmailAdmin($showroom_name, $quest_type, $quest_name, $quest_temp,$quest_phone, $quest_email, $checkin_date);
                      $result=3;
                   }
               }
               else {
                $quest_id    = $this->Model_checkin->addQuest($quest_type, $quest_name, $quest_idcard, $quest_phone, $quest_email);
                
                if($quest_id){
                            $checkin_id    = $this->Model_checkin->addCheckin($quest_id, $showroom_id,$quest_temp,$checkin_date);  
                            $session_quest = $quest_id."|".$quest_name."|".$quest_phone."|".$quest_email."|".$checkin_date."|".$showroom_name."|".$showroom_address."|".$checkin_id;
                            $_SESSION['user_data'] = $session_quest; 

                         //$this->sendmailAdmin($showroom_name, $quest_type, $quest_name, $quest_temp,$quest_phone, $quest_email, $checkin_date);
                      //$this->sendMail($name, $last, $email,$email_verification_code);
                 
                            
                }
                     $result=1;
               }
             
            
        } else {

            $result = 4;
        }

  
    } else {
       $result=5;
    }

    }
     else {
         $result=6;
    }
  echo json_encode($result);
}
function sendmailAdmin($showroom_name, $quest_type, $quest_name, $quest_temp,$quest_phone, $quest_email, $checkin_date){
    if($showroom_name !='' && $quest_name !='' ){
     $subject= 'Checkin from '. $showroom_name;
                $htmlLocation = '<b>Visitor Notification</b><br/>';
                $htmlLocation .= 'Nama : '.$quest_name.'<br/>';
                $htmlLocation .= 'Type : '.returnType($quest_type).' <br/>';
                 $htmlLocation .= 'Phone : '.$quest_phone.' <br/>';
                $htmlLocation .= 'Email : '.$quest_email.' <br/>';
                $htmlLocation .= 'Temp : '.$quest_temp.' &#x2103; <br/>'; 
                $htmlLocation .= 'Checkin : '.$checkin_date.' <br/>'; 
                $config = array();
                $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
                $config['smtp_host']    = "smtp.googlemail.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
                $config['smtp_user']    = "visitorvania@gmail.com"; // client email gmail id
                $config['smtp_pass']    = "V3n0m4nc3r1"; // client password
                $config['smtp_port']    =  587;
                $config['smtp_crypto']  = 'TLS';
                $config['smtp_timeout'] = "4";
                $config['mailtype']     = "html";
                $config['charset']      = "iso-8859-1";
                $config['newline']      = "\r\n";
                $config['wordwrap']     = TRUE;
                $config['validate']     = FALSE;
                $this->load->library('email', $config);

				// Load library email dan konfigurasinya
            $this->load->library('email', $config);  
            $this->email->to('hl.prbadolsa@gmail.com');
            $this->email->cc('arifwibo@gmail.com');
            $this->email->from('visitorvania@gmail.com' , 'Visitor');
            $this->email->subject($subject);
            $this->email->message($htmlLocation);
            $this->email->send();
           } 
}
	function checkout()

	{
	    
	if($_SESSION['user_data']){
        $quest_id   =$this->data["quest_id"];
        $checkin_id =$this->data["checkin_id"];
        $checkout_date =date("Y-m-d H:i:s");       
        $updateCheckout    = $this->Model_checkin->updateCheckin($quest_id,$checkin_id,$checkout_date);  
		//$this->session->unset_userdata(array("searchkey" => '', "searchby" => ''));
		session_destroy();
	    redirect(BASE_URL.'/checkin/success');
        } else {
           // session_destroy();
            redirect(BASE_URL);
        	exit();
        }
	}
   public function success()
	{ 
        if($_SESSION['user_data']){
             $checkin_date= $this->data["checkin_date"];
             $this->load->view('vsession',$this->data);
            }  
         $this->load->view('vsuccess',$this->data);	
	}   
        
        function cronCheckout()

	{
                $checkout_now =date("Y-m-d H:i:s"); 
                $checkQuest    = $this->Model_checkin->cronCheckin($checkout_now);
               
                if($checkQuest){
                

                
                foreach ($checkQuest as $ck) {
                    
                $date2 = $ck['checkin_date']; 
                 $diff = strtotime($checkout_now) - strtotime($date2);
                 $jam   = $diff / (60 * 60);
                    if($jam > 8){
                    $checkout = new DateTime($ck['checkin_date']);
                    $checkout->add(new DateInterval('PT8H')); 
                    $checkout_date = $checkout->format('Y-m-d H:i:s');
                    } else {
                        $checkout_date=$checkout_now;
                    }
              
                $updateCheckout    = $this->Model_checkin->updateCheckin($ck['quest_id'], $ck['checkin_id'],$checkout_date);   
                } 
                
            }
	}
        
        
      function sendmailS(){
            $subject= 'Checkin from ';
                $htmlLocation = '<b>Contact Form</b><br/>';
                $htmlLocation .= 'Nama : sssss<br/>';
                $htmlLocation .= 'Type : sssss <br/>';
                 $htmlLocation .= 'Phone : ssssssss <br/>';
                $htmlLocation .= 'Email : ssssssss <br/>';
                $htmlLocation .= 'Tenp : sss <br/>'; 
                $htmlLocation .= 'Checkin : dasdas&#x2103; <br/>'; 
                  // $this->load->library('email');   
                $config = array();
                $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
                $config['smtp_host']    = "smtp.googlemail.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
                $config['smtp_user']    = "visitorvania@gmail.com"; // client email gmail id
                $config['smtp_pass']    = "V3n0m4nc3r1"; // client password
                $config['smtp_port']    =  587;
                $config['smtp_crypto']  = 'TLS';
                $config['smtp_timeout'] = "4";
                $config['mailtype']     = "html";
                $config['charset']      = "iso-8859-1";
                $config['newline']      = "\r\n";
                $config['wordwrap']     = TRUE;
                $config['validate']     = FALSE;
                $this->load->library('email', $config);

				// Load library email dan konfigurasinya
        
            $this->email->to('hl.prbadolsa@gmail.com');
            //$this->email->cc(MAIL_CC);
            $this->email->from('web@vania.id' , 'Vania visitor');
            $this->email->subject($subject);
            $this->email->message($htmlLocation);
             if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
             echo $this->email->print_debugger();
        }
    }

function phpInfo(){
  $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = SECRET_KEY;
    $recaptcha_response ='03AGdBq25BBe3G1kMI_EyayeTctgQBKoa6AwMkQWa2oKCJiYcxHkAD-itmElfDeMop2r_WsjwL2vB2T7irmo5XO0Qe9hYcHaSHczadXTBW6F_yExQmQTVKxS_tR_b2fUQl-h7AtJ2w5u93r4lqQHBBeJnPz3mtEti_i96eCxIqdExC30LXKFBj_cRk1hO--j0wYe_t5iD0w2RhKrUazPM7CmZ1aq58lqB89v0xxXBkGCCJdhN-LorCCEBw1ehax6GnTFOPHU7bh98uwvJLz-7x3RfGNfNZ1pya7a0sXicVSC-7H5ffDa0hkCjuip9LvHWc5QzEe_KvX46V4UHDkU1VYeJ-SWpzHIl5FIifqI48zsFCEzzstjfqega3n9UUSVXzW4Yg8RfABWgp';
    // Make and decode POST request:
     $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);
    echo '<pre>';
    print_r($recaptcha);
}
}