<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$header['title'] = 'Nipe Fagio | ';
		$this->db->order_by('id','desc');
		$this->db->limit(3);
		$data['news'] = $this->db->get('nf_news');
		
		$this->db->where('identifier','HOME');
		$pages = $this->db->get('nf_pages');
		$data['home'] = $pages->row()->text;
		$header['title'] .= $data['title'] = $pages->row()->title;
		
		//$this->db->where('featured',1);
		$this->db->order_by('id','desc');
		$this->db->limit(3);
		$data['featured_projects'] = $this->db->get('nf_projects');
		
		$partner_ids = array();
		
		$partners_obj = $this->db->get('nf_projects_partners');
		foreach($partners_obj->result() as $partner)
		{
			$partner_ids[] = $partner->partner;
		}
		
		$this->db->where('logo <>', '');
		$this->db->where_in('id',$partner_ids);
		$data['partners'] = $this->db->get('nf_directory');
				
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		
		$this->load->view('Header',$header);
		$this->load->view('Home', $data);
		$this->load->view('Footer');
		//$this->load->view('index');
	}
	
	public function login()
	{
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		
		$this->load->view('Header',$header);
		$this->load->view('Login');
		$this->load->view('Footer');
	}
	
	function login_user()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
			$identity = $_POST['email'];
			$password = $_POST['password'];
			$remember = false; // remember the user
			if($this->ion_auth->login($identity, $password, $remember))
				redirect(base_url());
			
			else
				redirect('login/1');
		}
		else
			$this->login();
	}
	
	function logout()
	{
		if($this->ion_auth->logout())
			redirect('login/2');
	}
	
	public function get_projects($section)
	{
	
		if($section == 1)
			$url = "projects";
		else
			$url = "publications";
			
		$this->db->where('parent_category',0);
		$this->db->where('section',$section);
		$parent_categories = $this->db->get('nf_projects_and_publications');
		
		$this->db->where('parent_category >',0);
		$this->db->where('section',$section);
		$this->db->order_by('parent_category');
		$child_categories = $this->db->get('nf_projects_and_publications');
		
		$children = array();
		foreach($child_categories->result() as $child)
		{
			$children[$child->parent_category][$child->url] = $child->title;
			
		}
		
		
		$cats = "<ul class='dropdown-menu'>";
		
		foreach ($parent_categories->result() as $project_category)
		{
			if(isset($children[$project_category->id]))
			{
				$cats .= "<li><a href = '#'>" . $project_category->title . "<i class='icon-arrow-right'></i></a>";
				$cats .= '<ul class="dropdown-menu sub-menu">';
				


				foreach($children[$project_category->id] as $key => $value)
				{
					
					$cats .= "<li><a href = '". $url . "/" . $key ."'>" . $value . "</a></li>";
					
				}
				$cats .= "</ul>";
			}
			else
				$cats .= "<li><a href = '" . $url . "/" . $project_category->url . "'>" . $project_category->title . "</a>";
			
			$cats .= "</li>";
		}
		

		$cats .= "</ul>";
		return $cats;
	}
	
	
	public function fetch_page($identifier)
	{
		$this->db->where('identifier',$identifier);
		$content = $this->db->get('nf_pages');
		return $content->row();
	}
	
	public function about()
	{		
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		$data['details'] = $this->fetch_page('ABOUT');
		$header['title'] = $data['details']->title;
		$this->load->view('Header',$header);
		$this->load->view('Page',$data);
		$this->load->view('Footer');
	}
	
	
	public function blog()
	{
		$data['title'] =$header['title'] = 'Nipe Fagio Blog';
		
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);	
		$this->load->view('Header',$header);
		$this->load->view('Blog',$data);
		$this->load->view('Footer');
	}	
	
	public function news()
	{
		$data['title'] =$header['title'] = 'Nipe Fagio News';
		$this->db->order_by('date','desc');
		$data['news'] = $this->db->get('nf_news');
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
			
		$this->load->view('Header',$header);
		$this->load->view('News',$data);
		$this->load->view('Footer');
	}	
	
	public function newsletter()
	{
		$data['title'] =$header['title'] = 'Nipe Fagio Newsletter';
		

		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
			
		$this->load->view('Header',$header);
		$this->load->view('Newsletter',$data);
		$this->load->view('Footer');
	}
	
	public function nl($url)
	{
		$this->db->where('identifier',$url);
		$newsletter = $this->db->get('nf_newsletters');

		$data['subject'] = $newsletter->row()->newsletter_subject;
	
		$this->db->order_by('priority');
		$this->db->where('newsletter_id',$newsletter->row()->id);
		$news = $this->db->get('nf_newsletter_news');
		
		$articles = array();
		foreach ($news->result() as $article)
			$articles[] = $article->news_id;
		
		//print_r($articles);
		$this->db->where_in('id',$articles);
		$data['news'] = $this->db->get('nf_news');
		
		$this->load->view('NewsletterTemplate',$data);
	}
	
	public function article($url)
	{
		$this->db->where('url',$url);
		$article = $this->db->get('nf_news');
		

		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		if($article->num_rows() == 0)
			show_404('article/' . $url );//$this->news();
		else
		{
			$data['details'] = $article->row();
			$header['title'] = $data['details']->title;
			$this->load->view('Header',$header);
			$this->load->view('Page',$data);
			$this->load->view('Footer');
		}
	}
	
	public function projects($url)
	{
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		
		$this->db->where('url',$url);
		$details = $this->db->get('nf_projects_and_publications');
		
		if($details->num_rows() == 0)
			show_404('projects/' . $url );
		else
		{
			$data['title'] = $header['title'] = $details->row()->title;

			$this->db->where('category',$details->row()->id);
			$data['projects'] = $this->db->get('nf_projects');
			
			$this->load->view('Header',$header);
			$this->load->view('Projects',$data);
			$this->load->view('Footer');
		}
	}
	
	public function project($url)
	{
		$this->db->where('url',$url);
		$article = $this->db->get('nf_projects');

		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		if($article->num_rows() == 0)
			show_404('project/' . $url );
		else
		{
			$data['details'] = $article->row();
			$header['title'] = $data['details']->title;
			$this->load->view('Header',$header);
			$this->load->view('Page',$data);
			$this->load->view('Footer');
		}
	}
	
	function the_directory()
	{
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		
		//$this->db->order_by('company_name');
	//	$data['partners'] = $this->db->get('nf_directory');
		
		$query = "select dir.*, nct.title company_type, ncs.title sector from nf_directory dir, nf_company_sectors ncs, nf_company_types nct where nct.id = dir.company_type and ncs.id = dir.sector order by company_name";
		
		$data['partners'] = $this->db->query($query);
		
		$data['details'] = $this->fetch_page('DIRECTORY');
		$header['title'] = $data['details']->title;
		$data['text'] =$data['details']->text;
		
		//$data['title'] = $header['title'] = "Directory of our Partners";

		//$data['text'] = "Some introductory text, blah blah blah.";
		
		$this->load->view('Header',$header);
		
		$this->load->view('Directory',$data);
		$this->load->view('Footer');
		

	}
	
	public function publications($url)
	{
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		
		$this->db->where('url',$url);
		$details = $this->db->get('nf_projects_and_publications');
		if($details->num_rows() == 0)
			show_404('projects/' . $url );
		else
		{
			$data['title'] = $header['title'] = $details->row()->title;

			$this->db->where('category',$details->row()->id);
			$data['publications'] = $this->db->get('nf_publications');
			
			$this->load->view('Header',$header);
			
			$this->load->view('Publications',$data);
			$this->load->view('Footer');
		}
	}
	
	public function album($id)
	{
		$this->db->where('album',$id);
		$this->db->order_by('priority');
		$data['images'] = $this->db->get('nf_images');
		
		$this->db->where('id',$id);
		$album = $this->db->get('nf_albums');
		
		if($album->num_rows() == 0)
			$this->gallery();
		else
		{
			$data['title'] = $header['title'] = $album->row()->title;
			$data['description'] = $album->row()->description;
			
			$this->load->view('Header',$header);
			$this->load->view('Gallery',$data);
			$this->load->view('Footer');
		}
	}
	
	private function randomAlphaNum($length){ 

		/*$rangeMin = pow(36, $length-1); //smallest number to give length digits in base 36 
		$rangeMax = pow(36, $length)-1; //largest number to give length digits in base 36 
		$base10Rand = mt_rand($rangeMin, $rangeMax); //get the random number 
		$newRand = base_convert($base10Rand, 10, 36); //convert it 
		
		return $newRand; //spit it out */
		
		$arr = str_split('ABCDEFGHJKMNPQRSTUVWXYZ23456789'); // get all the characters into an array
		shuffle($arr); // randomize the array
		$arr = array_slice($arr, 0, $length); // get the first six (random) characters out
		return implode('', $arr); // smush them back into a string

	} 
	
	public function contact($item='',$id=0)
	{
	
		$word = strtoupper($this->randomAlphaNum(7));
		
		
		$this->load->helper('captcha');
		$vals = array(
		'word' => $word,
		'img_path'	 => './captcha/',
		'img_url'	 => 'captcha/',
		'font_path'	 => './captcha/fonts/arial.ttf',
		'img_width'	 => '200',
		'img_height' => 50,
		);
		
		$data['cap'] = create_captcha($vals);
	
		$cap_data = array(
		'captcha_time'	=> $data['cap']['time'],
		'ip_address'	=> $this->input->ip_address(),
		'word'	 => $data['cap']['word']
		);
		
		$query = $this->db->insert_string('nf_captcha', $cap_data);	
		$this->db->query($query);
		
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		
		switch($item)
		{
			case 'activity':
				
				$this->db->where('id',$id);
				$activities = $this->db->get('nf_activities');
				$activity = $activities->row();
									
				if($activity->contact_intro != '')
					$data['contact_intro'] = $activity->contact_intro;
				else
					$data['details'] = $this->fetch_page('CONTACT');
				
				$data['details']->title = $header['title'] = $activity->title;
				$data['subject'] = $activity->link_text;
			break;
			
			default:
				
				$data['details'] = $this->fetch_page('CONTACT');
				$data['title'] = $header['title'] = $data['details']->title;
			break;
		}
		//$data['details'] = $this->fetch_page('CONTACT');
		//$data['title'] = $header['title'] = $data['details']->title;
		$this->load->view('Header',$header);
		$this->load->view('Contact',$data);
		$this->load->view('Footer');
	}
	
	function validate_captcha($captcha)
	{
		$expiration = time()-7200; // Two hour limit
		$this->db->query("DELETE FROM nf_captcha WHERE captcha_time < ".$expiration);	

	
		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM nf_captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		
		
		if($row->count == 0){		// validate??
			$this->form_validation->set_message('validate_captcha', 'You Entered Incorrect Captcha');
			return FALSE;
		}else{
			return TRUE;
		}
		
	}
	
	function send_message()
	{
		if(isset($_POST))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('message', 'The Message', 'required');
			$this->form_validation->set_rules('captcha', 'The Captcha', 'required|callback_validate_captcha');
			
			$this->form_validation->set_error_delimiters('<li>','</li>');
			
			if ($this->form_validation->run() == TRUE)
			{	
				
				$this->db->where('id',1);
				$obj = $this->db->get('nf_settings');
				$email = $obj->row()->value;
				
				
				$this->db->where('setting','CCEMAIL');
				$ccemails = $this->db->get('nf_settings');
				
				//echo "Not Configured";
				$this->load->library('email');
				
				$config['protocol'] = 'mail';
				$config['smtp_host'] = 'auth.smtp.1and1.com';
				$config['smtp_user'] = 'info@nipefagio.com';
				$config['smtp_pass'] = 'nipefagio123';
				$config['smtp_port'] = '25';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$config['charset']='utf-8';  
				$config['newline']="\r\n";  

				$this->email->initialize($config);

				$this->email->from('info@nipefagio.com', 'NipeFagio');
				$this->email->bcc('terence@zoomtanzania.com'); 
				
				$this->email->to($email); 
				
				foreach($ccemails->result() as $ccemail)
				{
					$this->email->cc($ccemail->value); 
				}
				
				
				$this->email->subject($_POST['subject']);
				$message = '<html><head></head><body>';
				$message .= 'Name: ' . $_POST['name'] . '<br><br>';
				$message .= 'E-mail: ' . $_POST['email'] . '<br><br>';
				if(isset($_POST['phone']))
					$message .= 'Phone: ' . $_POST['phone'] . '<br><br>';
				$message .= 'Subject: ' . $_POST['subject'] . '<br><br>';
				$message .= 'Message: '. $_POST['message'] . '<br><br>';
				$message .= '</body></html>';	
				$this->email->message($message);	

				if($this->email->send())
				{
					
					
					$this->db->where('identifier','MESSAGE_SENT');
					$details = $this->db->get('nf_pages');
					
					$header['projects'] = $this->get_projects(1);
					$header['publications'] = $this->get_projects(2);	
					$data['details'] = $details->row();
					$header['title'] = $details->row()->title;
					$this->load->view('Header',$header);
					$this->load->view('Page',$data);
					$this->load->view('Footer');
				}
				else
					$this->contact(2);
				
			}
			
			else
				$this->contact(2);
		}
		
		else
			redirect('contact/3');
	}
	
	function the_team()
	{
		$this->db->where('identifier','TEAM');
		$details = $this->db->get('nf_pages');
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);	
		$data['details'] = $details->row();
		$header['title'] = $details->row()->title;
		
		$data['team'] = $this->db->get('nf_team');
		$this->load->view('Header',$header);
		$this->load->view('Team',$data);
		$this->load->view('Footer');
	}
	
	/*function validate_captcha()
	{
	}*/
	
// 	function register_test()
// 	{
// 		$username = 'satya@nabaki.com';
// 		$email = 'satya@nabaki.com';
// 		$password = 'nIp3F@giO';
// 		$additional_data = array(
// 			'first_name' => 'Satya',
// 		);								
// //		$group = array('1'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default

// 		$id = $this->ion_auth->register($username, $password, $email, $additional_data);
// 		echo($id);		
		
		
// 	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */