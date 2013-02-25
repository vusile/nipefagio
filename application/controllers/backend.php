<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		
		$this->load->library('grocery_CRUD');	
				
		$this->load->library('image_CRUD');

	}
	
	function _example_output($output = null)
	{
		if ($this->ion_auth->logged_in())
			$this->load->view('example.php',$output);
		else
			redirect('login');
	}	
	
	function nf_settings()
	{
		$this->grocery_crud->unset_delete();
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	
	function nf_directory()
	{
		
		$this->grocery_crud->set_relation('company_type','nf_company_types','title');
		$this->grocery_crud->set_relation('sector','nf_company_sectors','title');
		$this->grocery_crud->set_field_upload('logo', 'images');
		$this->grocery_crud->callback_after_insert(array($this, 'directory_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'directory_callback'));
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}	
	
	function directory_callback($post_array, $primary_key)
	{
		$this->db->where('id',$primary_key);
		$directories= $this->db->get('nf_directory');
		
		
		
		$directory = $directories->row();
		
		$logo = $directory->logo;
		
		//echo $logo;
		
		
		$this->load->library('image_moo');
		$sizes = getimagesize('images/' . $logo);
		
		$source_image = 'images/' . $logo;
		
		$width = $sizes[0];
		$height = $sizes[1];
		

		/*
		if($width >= $height and $width > 200 and ($width-$height>=100))				
			$this->image_moo->load($source_image)->resize(200,999999999999)->save( $source_image,$overwrite=TRUE);
		else if($width <= $height and $height > 100 )
			$this->image_moo->load($source_image)->resize(999999999999,100)->save( $source_image,$overwrite=TRUE);	
			*/

		//if($width >= $height and $width > 200 and ($width-$height>=100))				
		$this->image_moo->load($source_image)->set_background_colour("#FFF")->resize(200,100,TRUE)->save( $source_image,$overwrite=TRUE);
		//else if($width <= $height and $height > 100 )
		//	$this->image_moo->load($source_image)->set_background_colour("#FFF")->resize(200,100,TRUE)->save( $source_image,$overwrite=TRUE);
			
			
		//else
		
		//$this->image_moo->load($source_image)->resize(250,100)->save( $source_image,$overwrite=TRUE);
	}
	
	function nf_newsletters()
	{
		$this->grocery_crud->unset_fields('url','identifier');
		$this->grocery_crud->set_relation_n_n('news_articles','nf_newsletter_news','nf_news','newsletter_id','news_id','title','priority');
		$this->grocery_crud->callback_after_insert(array($this, 'generate_newsletter_url'));
		$this->grocery_crud->callback_after_update(array($this, 'generate_newsletter_url'));
		$this->grocery_crud->unset_columns('identifier');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}
	

	function generate_newsletter_url($post_array,$primary_key)
	{

		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('nf_newsletters');
		

		$data['url'] = base_url() . 'nl/' . $this->convert_url($title_obj->row()->newsletter_subject, 'nf_newsletters', $primary_key );
		$data['identifier'] =$this->convert_url($title_obj->row()->newsletter_subject, 'nf_newsletters', $primary_key );
		$this->db->where('id',$primary_key);
		$this->db->update('nf_newsletters',$data);

		
		
		return true;
	}
	
	function nf_pages()
	{
		$this->grocery_crud->unset_delete();
		$this->grocery_crud->unset_fields('thumb_nail','identifier');
		$this->grocery_crud->unset_columns('thumb_nail','identifier');
		$this->grocery_crud->callback_after_insert(array($this, 'generate_thumb'));
		$this->grocery_crud->callback_after_update(array($this, 'generate_thumb'));
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}	
	
	function generate_thumb($post_array,$primary_key)
	{
		$doc = new DOMDocument();
		@$doc->loadHTML($post_array['text']);

		$tags = $doc->getElementsByTagName('img');
		$count = 0;
		
		if(count($tags)>0)
		{
			foreach ($tags as $tag) {
				if($count > 0)
					break;
				else
					$src =  $tag->getAttribute('src');
					
				$count++;
			}
			
			$name = explode('/',$src);
			
			$index = count($name);
			
			$data['thumb_nail'] = $name[$index-1];	
			
			$this->db->where('id',$primary_key);
			$this->db->update('nf_pages',$data);
		}
		
	}
	
	function nf_company_sectors()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);

	}	
	
	function nf_team()
	{
		$this->grocery_crud->callback_after_insert(array($this, 'team_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'team_callback'));
		$this->grocery_crud->set_field_upload('photo', 'images');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	function team_callback($post_array, $primary_key)
	{
		$this->db->where('id',$primary_key);
		$members= $this->db->get('nf_team');
		
		
		
		$member = $members->row();
		
		$photo = $member->photo;
		
		//echo $logo;
		
		
		$this->load->library('image_moo');
		$sizes = getimagesize('images/' . $photo);
		
		$source_image = 'images/' . $photo;
		
		$width = $sizes[0];
		$height = $sizes[1];
		
		//echo $width;
		
		//die();
		
		if($width >= $height and $width > 400)				
			$this->image_moo->load($source_image)->resize(400,999999999999)->save( $source_image,$overwrite=TRUE);
		else if($width <= $height and $height > 400)
			$this->image_moo->load($source_image)->resize(999999999999,400)->save( $source_image,$overwrite=TRUE);
	}
	
	function nf_company_types()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);

	}

	
	function nf_projects_and_publications($section)
	{
		$this->grocery_crud->set_relation('parent_category','nf_projects_and_publications','title',array('section' => $section, 'parent_category' =>''));
	
		$this->grocery_crud->unset_fields('section','url','link');
		$this->grocery_crud->unset_columns('section','url');		
		
		if($section == 1)
		{
			$this->grocery_crud->display_as ( 'link' , 'Projects' );
			$this->grocery_crud->callback_after_insert(array($this, 'generate_projects_link'));
			$this->grocery_crud->callback_after_update(array($this, 'generate_projects_link'));
			
		}
		else if($section == 2)
		{
			$this->grocery_crud->display_as ( 'link' , 'Publications' );
			$this->grocery_crud->callback_after_insert(array($this, 'generate_publications_link'));
			$this->grocery_crud->callback_after_update(array($this, 'generate_publications_link'));
		}	
			
		$this->db->where('nf_projects_and_publications.section',$section);
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	function nf_publications($id)
	{
		
		$this->grocery_crud->set_field_upload('publication_file','publications');
		$this->grocery_crud->callback_after_insert(array($this, 'set_publications_category'));
		$this->grocery_crud->callback_after_update(array($this, 'set_publications_category'));
		
		$this->grocery_crud->where('category',$id);
		$this->grocery_crud->unset_fields('category','thumb_nail');
		$this->grocery_crud->unset_columns('category','thumb_nail');	
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}
	
	function nf_projects($id)
	{
		
		$this->grocery_crud->set_relation_n_n('partners','nf_projects_partners','nf_directory','project','partner','company_name');
		$this->grocery_crud->set_relation('featured','nf_options','title');
		$this->grocery_crud->callback_after_insert(array($this, 'set_projects_category'));
		$this->grocery_crud->callback_after_update(array($this, 'set_projects_category'));
		$this->grocery_crud->where('category',$id);
		$this->grocery_crud->display_as('text','Project Description');
		$this->grocery_crud->unset_fields('url','category','thumb_nail');
		$this->grocery_crud->unset_columns('url','category','thumb_nail');	
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}
	
	function set_publications_category($post_array,$primary_key)
	{
		$data = array (
			'category' => $this->uri->segment(3)
		);
		
		
		$doc = new DOMDocument();
		@$doc->loadHTML($post_array['text']);

		$tags = $doc->getElementsByTagName('img');
		$count = 0;
		
		if(count($tags)>0)
		{
			foreach ($tags as $tag) {
				if($count > 0)
					break;
				else
					$src =  $tag->getAttribute('src');
					
				$count++;
			}
			
			$name = explode('/',$src);
			
			$index = count($name);
			
			$data['thumb_nail'] = $name[$index-1];	

		}
		
		
		$this->db->where('id',$primary_key);
		$this->db->update('nf_publications',$data);

		return true;
	}
	
	function set_projects_category($post_array,$primary_key)
	{
		$data = array (
			'category' => $this->uri->segment(3)
		);
		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('nf_projects');
		

		$data['url'] = $this->convert_url($title_obj->row()->title , 'nf_projects', $primary_key );
	
		
		
		$doc = new DOMDocument();
		@$doc->loadHTML($post_array['text']);

		$tags = $doc->getElementsByTagName('img');
		$count = 0;
		
		if(count($tags)>0)
		{
			foreach ($tags as $tag) {
				if($count > 0)
					break;
				else
					$src =  $tag->getAttribute('src');
					
				$count++;
			}
			
			$name = explode('/',$src);
			
			$index = count($name);
			
			$data['thumb_nail'] = $name[$index-1];	

		}

		
		$this->db->where('id',$primary_key);
		$this->db->update('nf_projects',$data);
		
		if($post_array['featured'] == 1)
		{
			$featured = array (
				'featured' => 2
			);
			$this->db->where('id <>',$primary_key);
			$this->db->update('nf_projects',$featured);
		}
		
		return true;
	}
	
	function convert_url($title, $table, $id)
	{
		
		$url = strtolower(url_title($title));
		

		$this->db->where('url',$url);
		$obj=$this->db->get($table);
		
		if($obj->num_rows() > 0)
		{
			$this->db->where('id',$id);
			$this->db->where('url',$url);
			$obj=$this->db->get($table);
			
			if( $obj->num_rows() == 0 )
				$url = $this->make_url_from_title($url . '-' . $url,$table,$id);
		}
		
		return $url;	
		
	}
	
	
	function generate_publications_link($post_array,$primary_key)
	{	
	
		$data = array (
			'link' => '<a target = "_blank" href = "' . base_url() . 'backend/nf_publications/' . $primary_key .'">Publications</a>',
			'section' => $this->uri->segment(3)
		);
		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('nf_projects_and_publications');
		

		$data['url'] = $this->convert_url($title_obj->row()->title, 'nf_projects_and_publications', $primary_key );

		
		
		$this->db->where('id',$primary_key);
		$this->db->update('nf_projects_and_publications',$data);
		
		return true;
	}	
	
	function generate_projects_link($post_array,$primary_key)
	{
		
		$data = array (
			'link' => '<a target = "_blank" href = "' . base_url() . 'backend/nf_projects/' . $primary_key .'">Projects</a>',
			'section'=> $this->uri->segment(3)
		);
		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('nf_projects_and_publications');
		

		$data['url'] = $this->convert_url($title_obj->row()->title, 'nf_projects_and_publications', $primary_key );

		
		$this->db->where('id',$primary_key);
		$this->db->update('nf_projects_and_publications',$data);
		
		return true;
	}
	
	function nf_news()
	{
		
		$this->grocery_crud->unset_fields('url','date','thumb_nail');
		$this->grocery_crud->unset_columns('url','thumb_nail');	
		$this->grocery_crud->order_by('date','desc');	
		$this->grocery_crud->callback_after_insert(array($this, 'add_url_to_news'));
		$this->grocery_crud->callback_after_update(array($this, 'add_url_to_news'));
		
		
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}
	
	function add_url_to_news($post_array,$primary_key)
	{
	
		$doc = new DOMDocument();
		@$doc->loadHTML($post_array['text']);

		$tags = $doc->getElementsByTagName('img');
		$count = 0;
		
		if(count($tags)>0)
		{
			foreach ($tags as $tag) {
				if($count > 0)
					break;
				else
					$src =  $tag->getAttribute('src');
					
				$count++;
			}
			
			$name = explode('/',$src);
			
			$index = count($name);
			
			$data['thumb_nail'] = $name[$index-1];
			
			
			/*$this->load->library('image_moo');
			$sizes = getimagesize($src);
			
			$width = $sizes[0];
			$height = $sizes[1];
			
			if($width >= $height and $width > 90)				
				$this->image_moo->load($source_image)->resize(90,999999999999)->save('thumb_' . $source_image,$overwrite=TRUE);
			else if($width <= $height and $height > 90)
				$this->image_moo->load($source_image)->resize(999999999999,90)->save('thumb_' . $source_image,$overwrite=TRUE);*/
		}
		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('nf_news');
		
		$data['date'] = date('Y-m-d');

		$data['url'] = $this->convert_url( $title_obj->row()->title, 'nf_news', $primary_key);

		
		$this->db->where('id',$primary_key);
		$this->db->update('nf_news',$data);
		return true;
		
	}
	
	function nf_home()
	{
		$this->grocery_crud->unset_delete();
		$this->grocery_crud->set_field_upload('image', 'img');
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}
	
	function index()
	{
		if ($this->ion_auth->logged_in())
			$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		else
			redirect('login');
	}	
	
	
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	

	
}