<?
if(!defined('PAGE_STARTED'))die();

class About extends Controller
{



	function index()
	{
		$data['content'] = 'about';
		$data['title'] = 'About';
		$this->load->template('index.php',$data);
	}
}