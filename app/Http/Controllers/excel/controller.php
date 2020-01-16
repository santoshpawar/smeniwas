<?
if(!defined('PAGE_STARTED'))
 die();


/**
 * Base controller object
 */
class Controller
{
	protected $load;


	protected $model;


	public $template;
	
	function __construct()
	{
		$this->load = new Loader($this);
		$model = array();
		session_start();

	}



	public static final function getTemplate($action)
	{
		if(stripos(strtolower($action), 'ajax') ===false)
		{
			return 'index.php';
		}
		else
		{
			return 'ajax.php';
		}
	}


	public final function addModel($model,$model_name)
	{
		$modelvar = "$model_name";
		$modelvar = $model;
		$this->{"model_name"}  = $model;
	}

	public final function showError($error)
	{
		$errors[] = $error;
		$this->load->view('error_show', $errors);
	}


	public final function showMessage($message)
	{
		$this->load->view('message',array($message));
	}

	public final function addView($name, $data)
	{
		$this->load->view($name, $data);
	}


	public function booleanToHeader($result)
	{
		if ($result){
			header("HTTP/1.1 201");
		}
		else{
			new Error(new Exception());
		}
	}

	function  __destruct()
	{
		$this->load->template($this->template);
	}


}

















}