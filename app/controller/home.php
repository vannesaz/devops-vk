<?php
class home extends Controller{
	// Constructor
	public function __construct(){

	}

	// Default method
	public function index($name="Vannesa", $age="21"){
		// Associative Arrays (arrays with keys)
		$arr_data['name'] = $name;
		$arr_data['age'] = $age;
		$arr_data['title'] = "Home Page";
		// Display page and send data
		$this->display('template/header', $arr_data);
		$this->display("home/default", $arr_data);
		$this->display('template/footer');
	}

	public function page($current_page=2, $next_page=3, $prev_page=1){
		// Associative Arrays (arrays with keys)
		$arr_data['current'] = $current_page;
		$arr_data['next'] = $next_page;
		$arr_data['previous'] = $prev_page;
		$arr_data['title'] = "Personal Page";
		// Display page and send data
		$this->display('template/header', $arr_data);
		$this->display("home/page", $arr_data);
		$this->display('template/footer');
	}

	// Get status
	private function _status(){
		echo "This is home/status.";
	}

	// input new student
	public function inputstudent(){
		// Start session
		session_start();
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			// check status login in database
			$status = $this->logic("Home_model")->input_data($_POST);

			if($status === "SUCCESS"){
				echo "You have successfully input new data.";
			}

			if($status === "FAILED"){
				echo "The data can't be inputed in the database.";
			}

			if($status === "ERROR"){
				echo "We found an error while input the data.";
			}
		} else {
			echo "MUST REQUEST POST";
		}
	}
}
?>