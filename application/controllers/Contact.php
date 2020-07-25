<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {
	public $data = array();
	public function __construct()

	{
		parent::__construct();
                   if (!$_SESSION) {
                    session_start();
                }
                 
                date_default_timezone_set('UTC');
                $this->load->model(array('backend/Model_menu_frontend','web/Model_register'));
                $this->load->helper(array('funcglobal','menu','accessprivilege','alias','url','email')); 
                $this->data['controller'] = $this->uri->segment(1);
                $this->data["module_location"]=105;
                $this->data['menuActive'] = '';  
               
                
	}

	

   
        function postMsg()
    {
        if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            //your site secret key
            $secret         = SECRET_KEY;
            //get verify response data
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $from           = $this->security->xss_clean(trim($_POST['contact_from']));
            $name           = $this->security->xss_clean(trim($_POST['contact_name']));
            $email          = $this->security->xss_clean(trim($_POST['contact_email']));
            $subject        = $this->security->xss_clean(trim($_POST['contact_subject']));
            $message        = $this->security->xss_clean(trim($_POST['contact_message']));
            // Insert user record  
            $last_id        = $this->Model_register->AddContactUs($from, $name, $email, $subject, $message);
            $subjects        = $subject;
            $message_email  = '<h1>Contact Form ' . $from . '</h1><br/>';
            $message_email .= '<p>From</p>';
            $message_email .= 'Name : ' . $name . '<br/>';
            $message_email .= 'Email : ' . $email . ' <br/>';
            $message_email .= 'Messages : ' . $message . ' <br/>';
            $header = "";
            $header .= "Reply-To: vania.id <noreply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
            $header .= "Return-Path: vania.id <noreply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
            $header .= "From: vania.id <noreply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
            $header .= "Organization: " . $_SERVER['SERVER_NAME'] . " \r\n";
            $header .= "X-Priority: 3\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
               
            $mail   = mail(MAIL_CONT, $subjects, $message_email, $header);
            $result = 'success';
        } else {
            $result = 'check_captcha';
        }
        echo json_encode($result);
    }
    function subscribe()
    {
        if ($_POST) {
            $email     = $this->security->xss_clean(trim($_POST['subs_email']));
            $checkmail = $this->Model_register->checkSubs($email);
            if ($checkmail) {
                $resultsubs = 0;
            } else {
                $insert        = $this->Model_register->insertSubscribe($email);
                $subject       = 'New Subscriber';
                $message_email = "<h3>New Subscriber</h3><br>";
                $message_email .= "Email : " . $email . "<br>";
                $header = "";
                $header .= "Reply-To: vania.id <noreply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
                $header .= "Return-Path: vania.id <noreply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
                $header .= "From: vania.id <noreply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
                $header .= "Organization: " . $_SERVER['SERVER_NAME'] . " \r\n";
                $header .= "X-Priority: 3\r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                // Insert user record     
                $mail = mail(MAIL_SUBS, $subject, $message_email, $header);
                if ($mail) {
                    $resultsubs = 1;
                } else {
                    $resultsubs = 0;
                }
                $resultsubs = 1;
            }
        } else {
            $resultsubs = 0;
        }
        echo json_encode($resultsubs);
    }
    function cataloque()
    {
        if ($_POST) {
            $name      = $this->security->xss_clean(trim($_POST['catalogue_name']));
            $phone     = $this->security->xss_clean(trim($_POST['catalogue_phone']));
            $email     = $this->security->xss_clean(trim($_POST['catalogue_email']));
            $category  = $this->security->xss_clean(trim($_POST['category']));
            $checkmail = $this->Model_register->checkMember($email);
            if ($checkmail) {
                $this->Model_register->updateMember($name, $phone, $email);
            } else {
                $last_id = $this->Model_register->AddMember($name, $phone, $email);
            }
            $rsCatalogue = $this->Model_register->getCatalogue($category);
            if ($rsCatalogue) {
                $linkfile = BASE_URL . $rsCatalogue[0]['catalogue_file'];
                $title    = $rsCatalogue[0]['catalogue_title'];
                $this->sendmailAdmin($name, $phone, $email, $category);
                $this->sendmail($name, $phone, $email, $category, $linkfile, $title);
                $resultc = 1;
            } else {
                $resultc = 0;
            }
        } else {
            $resultc = 0;
        }
        echo json_encode($resultc);
    }
    function sendmailAdmin($name, $phone, $email, $category)
    {
        if ($category == 1) {
            $type = 'Contract';
        } else {
            $type = 'Retail';
        }
        $subject       = 'Download Calaogue';
        $message_email = '<h1>NEW Download Calaogue</h1><br/>';
        $message_email .= '<p>From</p>';
        $message_email .= 'Name : ' . $name . '<br/>';
        $message_email .= 'Phone : ' . $phone . ' <br/>';
        $message_email .= 'Email : ' . $email . ' <br/>';
        $message_email .= 'Catalogue : ' . $type . ' <br/>';
        $header = "";
        $header .= "Reply-To: vania.id <noreply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
        $header .= "Return-Path: vania.id <noreply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
        $header .= "From: vania.id <noreply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
        $header .= "Organization: " . $_SERVER['SERVER_NAME'] . " \r\n";
        $header .= "X-Priority: 3\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Insert user record     
        $mail = mail(MAIL_CAT, $subject, $message_email, $header);
    }
    function sendmail($name, $phone, $email, $category, $linkfile, $title)
    {
        if ($category == 1) {
            $type = 'Contract';
        } else {
            $type = 'Retail';
        }
        $subject       = 'Cataloque download request';
        $message_email = "Dear <br>";
        $message_email .= "" . $name . " " . $phone . "<br>";
        $message_email .= "Tanks for request  cataloque" . $type . "<br>";
        $message_email .= "Please click link below to download file <br>";
        $message_email .= "<a href=" . $linkfile . ">";
        $message_email .= $title . 'Catalogue';
        $message_email .= "</a> <br>";
        $header = "";
        $header .= "Reply-To: vania.id <noreply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
        $header .= "Return-Path: vania.id <noreply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
        $header .= "From: vania.id <noreply@" . $_SERVER['SERVER_NAME'] . ">\r\n";
        $header .= "Organization: " . $_SERVER['SERVER_NAME'] . " \r\n";
        $header .= "X-Priority: 3\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Insert user record     
        $mail = mail($email, $subject, $message_email, $header);
    }
   
    function subscribedddd()
    {
        if ($_POST) {
            $email     = $this->security->xss_clean(trim($_POST['subs_email']));
            $checkmail = $this->Model_register->checkSubs($email);
            if ($checkmail) {
                $resultsubs = 0;
            } else {
                $insert     = $this->Model_register->insertSubscribe($email);
                $resultsubs = 1;
            }
        } else {
            $resultsubs = 0;
        }
        echo json_encode($resultsubs);
    }
       
}


