<?php
class login extends Controller{
	// Constructor
	public function __construct(){

	}

	// Display UI login form
	public function index(){
		// Associative Arrays (arrays with keys)
		$arr_data['name'] = "Vannesa Kilis";
		$arr_data['age'] = "21";
		$arr_data['title'] = "Home Page";
		//var_dump($arr_data);

		// Display page and send data
		$this->display("login/index", $arr_data);
	}

	// handle login user
	public function process(){
		// Start session
		session_start();
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			// validate user input
			$role = $_POST['select-role'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			// check status login in database
			$arr_data['status-login'] = $this->logic("Login_model")->check_login($_POST);
			
			if (!empty($arr_data['status-login'])) {
				// set session variables
				$_SESSION['user-role'] = $role;
				$_SESSION['user-email'] = $email;
				$_SESSION['user-name'] = $arr_data['status-login'][0]["fullname"];
				// redirect to secure page
				header('Location: '.APP_PATH.'/home/index'); // Redirect ke page yang sama/lain.
				exit();
			} else {
				// handle failed login attempt
				$arr_data['error-message'] = "Invalid/unmatched role, email or password.";
				// redirect to secure page
				$this->display("login/index", $arr_data);
			}
		}
	}

	//get student info 
	public function student($email_student = ""){
		//Cek empty 
		if (!empty($email_student)) {
			//Check status login in database
			$arr_data['datainfo'] = $this->logic("Login_model")->get_student_info ($email_student);

			if(!empty($arr_data['datainfo'])) {
				//var_dump($arr_data['datainfo']);

				// to json format
				$json_data = json_encode($arr_data['datainfo']);
				echo $json_data;

			} else {
				echo "EMPTY ROW";
			}
		} else {
			echo "ERROR";
		}
	}
}
?>