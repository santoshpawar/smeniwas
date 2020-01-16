<?
if(!defined('PAGE_STARTED'))die();

class Pages extends Controller
{


	protected $page;

	function index()
	{

		$this->load->model('Page');
		$data['content'] = 'calc';
		$data['title'] = $this->Page->GetTitle();
		$this->load->template('index.php',$data);
	}


	function about()
	{
		$data['content'] = 'about';
		$data['title'] = 'About';
	}
}