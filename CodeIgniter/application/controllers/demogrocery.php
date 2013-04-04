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
		//echo "<h3>Bienvenido al mundo de Codeigniter</h3>";//Solo un ejemplo!
		die();
 
    }
 
    public function games()
    {
        $crud = new grocery_CRUD();
 
        $crud->set_table('sg_games');
		$crud->order_by('game_id');
		$crud->columns('juego', 'disenador', 'categoria','game_description');
		$crud->display_as('juego','Juego');
		$crud->display_as('disenador','Diseñador');
		$crud->display_as('categoria','Categoría');
		$crud->display_as('game_description','Descripción');
		$crud->set_relation_n_n('disenador', 'sg_games_gamedesigner', 'sg_gamedesigner', 'game_id', 'gamedesigner_id', 'designer_name');
		$crud->set_relation_n_n('juego', 'sg_games_gamename', 'sg_gamename', 'game_id', 'gamename_id', 'game_name');
		$crud->set_relation_n_n('categoria', 'sg_games_gamecategory', 'sg_gamecategory', 'game_id', 'gamecategory_id', 'category_name');


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
