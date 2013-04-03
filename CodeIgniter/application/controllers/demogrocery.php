<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Demogrocery extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
 
        $this->load->database();
		$this->load->library('grocery_CRUD');
 
    }
 
    public function index()
    {
		echo "<h3>Bienvenido al mundo de Codeigniter</h3>";//Solo un ejemplo!
		die();
 
    }
 
    public function games()
    {
        $crud = new grocery_CRUD();
 
        $crud->set_table('sg_games');
		$crud->columns('disenador', 'game_id' ,'game_description');
		$crud->display_as('game_id','Id.');
		$crud->display_as('game_description','Descripción');
		$crud->set_relation_n_n('disenador', 'sg_games_gamedesigner', 'sg_gamedesigner', 'game_id', 'gamedesigner_id', 'designer_name');
//		$crud->fields('game_id','game_description');

		$crud->set_relation('game_id','sg_gamename','game_name');


//		$crud->set_relation('officeCode','offices','city');
//		$crud->fields('field_name1','field_name2','field_name3','field_name4');
        $output = $crud->render();

		$this->_example_output ($output);
    //    echo $output;
    }
 
    function _example_output($output = null)
    {
        $this->load->view('editorgames.php',$output);    
    }    
}
 
/* End of file main.php */
/* Location: ./application/controllers/main.php */?>
