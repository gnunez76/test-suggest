<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// Administracion
class SI_Admin extends CI_Controller {

	
	public function __construct() 
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->model('si_admin_model');
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->load->helper('form');
		$this->load->view('admin/admin_login');		
	}

	function verifylogin()
	{
		$this->load->model('si_admin_model','',TRUE);
			
		//This method will have the credentials validation
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

		
		
		
		if($this->form_validation->run() == FALSE)
		{
			
			//Field validation failed.&nbsp; User redirected to login page
			$this->load->view('admin/admin_login');
		}
		else
		{
			
			//Go to private area
			redirect('/si_admin/home', 'refresh');
		}

	}

	function check_database($password)
	{
		//Field validation succeeded.&nbsp; Validate against database
		$username = $this->input->post('username');

		//query the database
		$result = $this->si_admin_model->login($username, $password);

		if($result)
		{
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array(
						'id' => $row->au_id,
						'username' => $row->au_username,
						'name' => $row->au_realname
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}
		
	function home()
	{
		
		$this->output->enable_profiler(TRUE);
		
		
		if($this->session->userdata('logged_in'))
		{
			
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			
			redirect ('/si_admin/items/');
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
	}
	
	
	
	/*
	 * Listado items para el backend 
	 *
	 */
	public function items ($page=0) {

		
		$this->output->enable_profiler(TRUE);
		
		
		if($this->session->userdata('logged_in'))
		{
				
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
				
			$this->load->view('admin/header_admin', $data);
			
			
			$this->load->library('pagination');
			$this->load->model ('si_admin_model');
			
			$config['base_url'] = '/si_admin/items/';
			$config['total_rows'] = $this->si_admin_model->getNumItems ();
			$config['per_page'] = 25;
			
			$this->pagination->initialize($config);
			
			$rows ['pagination'] =  $this->pagination->create_links();
		
			$rows ['items'] = $this->si_admin_model->getItems($page);			
			$this->load->view ('admin/items/itemsgrid', $rows);
			
			
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
		
		
	}
	
	
	/*
	 * Editar item
	 */
	public function editarItem ($itemId) {
	
	
		$this->output->enable_profiler(TRUE);
	
	
		if($this->session->userdata('logged_in'))
		{
	
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
	
			$this->load->view('admin/header_admin', $data);
				
			$this->load->model ('si_admin_model');
			
			$data = $this->si_admin_model->getItem ($itemId);
			$data ["itemnames"] = $this->si_admin_model->getGameNames ($itemId); 
			$data ["autores"] = $this->si_admin_model->getItemCreator ($itemId);
			$data ["editoriales"] = $this->si_admin_model->getItemEditorial ($itemId);
			$data ["artists"] = $this->si_admin_model->getItemArtist ($itemId);
			$data ["mechanics"] = $this->si_admin_model->getItemMechanical ($itemId);
			$data ["categories"] = $this->si_admin_model->getItemCategory ($itemId);
			$data ["languages"] = $this->si_admin_model->getItemLanguageDep ($itemId);
			$data ["allLanDep"] = $this->si_admin_model->getAllLanDep ($itemId);
			

			$this->load->view ('admin/items/edititem', $data);
					
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
	
	
	}
	
	/*
	 * Actualiza el item editado
	 */
	public function updateItem () {
		$this->output->enable_profiler(TRUE);
		if($this->session->userdata('logged_in'))
		{

			$this->load->model ('si_admin_model');
			$this->si_admin_model->updateItem ($_POST);
			$this->si_admin_model->updateItemLanDep ($_POST);
				
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
		
	}

	/*
	 * Bloque de nombres de item
	 */
	public function getBlockItemName ($itemId) {

		if($this->session->userdata('logged_in'))
		{
		
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
		
			$this->load->model ('si_admin_model');
			$data ["itemnames"] = $this->si_admin_model->getGameNames ($itemId);
			$this->load->view ('admin/items/itemnameblock', $data);				
		}
	}
	
	/*
	 * Bloque autor item
	 */
	public function getBlockAutor ($itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
	
			$this->load->model ('si_admin_model');
			$data ["autores"] = $this->si_admin_model->getItemCreator ($itemId);
			$this->load->view ('admin/items/autorblock', $data);
		}
	}
	
	/*
	 * Bloque  diseñador
	*/
	public function getBlockIlustrador ($itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
	
			$this->load->model ('si_admin_model');
			$data ["artists"] = $this->si_admin_model->getItemArtist ($itemId);
			$this->load->view ('admin/items/ilustradorblock', $data);
		}
	}
	
	
	/*
	 * Bloque editorial
	*/
	public function getBlockEditorial ($itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
	
			$this->load->model ('si_admin_model');
			$data ["editoriales"] = $this->si_admin_model->getItemEditorial ($itemId);
			$this->load->view ('admin/items/editorialblock', $data);
		}
	}	
	
	/*
	 * Bloque mecanicas
	*/
	public function getBlockMecanicas ($itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
	
			$this->load->model ('si_admin_model');
			$data ["mechanics"] = $this->si_admin_model->getItemMechanical ($itemId);
			$this->load->view ('admin/items/mechanicblock', $data);
		}
	}
	
	/*
	 * Bloque mecanicas
	*/
	public function getBlockCategorias ($itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
	
			$this->load->model ('si_admin_model');
			$data ["categories"] = $this->si_admin_model->getItemCategory ($itemId);
			$this->load->view ('admin/items/categoriasblock', $data);
		}
	}
	
	/*
	 * Desactivar autor
	 */
	public function deactivateAutor ($id, $itemId) {

		if($this->session->userdata('logged_in'))
		{
		
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveAutor($id, $itemId, 0);
		}
	}
	
	/*
	 * Activar autor
	 */
	public function activateAutor ($id, $itemId) { 

		if($this->session->userdata('logged_in'))
		{
		
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveAutor($id, $itemId, 1);
		}
	}
	
	
	/*
	 * Desactivar nombre Item
	*/
	public function deactivateItemName ($id, $itemId) {
	
		if($this->session->userdata('logged_in'))
		{
		
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveItemName($id, $itemId, 0);
		}
	}
		
	/*
	 * Activar nombre Item
	*/
	public function activateItemName ($id, $itemId) {
	
		if($this->session->userdata('logged_in'))
		{
		
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveItemName($id, $itemId, 1);
		}
	}
	

	/*
	 * Desactivar ilustrador
	*/
	public function deactivateIlustrador ($id, $itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveArtist($id, $itemId, 0);
		}
	}
	
	/*
	 * Activar ilustrador
	*/
	public function activateIlustrador ($id, $itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveArtist($id, $itemId, 1);
		}
	}
	
	
	/*
	 * Desactivar editorial
	*/
	public function deactivateEditorial ($id, $itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveEditorial($id, $itemId, 0);
		}
	}
	
	/*
	 * Activar editorial
	*/
	public function activateEditorial ($id, $itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveEditorial($id, $itemId, 1);
		}
	}

	
	/*
	 * Desactivar mecanicas
	*/
	public function deactivateMecanica ($id, $itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveMechanic($id, $itemId, 0);
		}
	}
	
	/*
	 * Activar mecanicas
	*/
	public function activateMecanica ($id, $itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveMechanic($id, $itemId, 1);
		}
	}

	/*
	 * Desactivar categorias
	*/
	public function deactivateCategoria ($id, $itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveCategory($id, $itemId, 0);
		}
	}
	
	/*
	 * Activar mecanicas
	*/
	public function activateCategoria ($id, $itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveCategory($id, $itemId, 1);
		}
	}
		
	
	
/*
	public function getItemsGrid () {
		
		$this->load->model ('si_admin_model');
		$rows ['items'] = $this->si_admin_model->getItems(0);
		
		$salida = $this->load->view ('admin/items/itemsgrid', $rows, true);
		
		return $salida;
		
	}
*/



	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('si_admin/home', 'refresh');
	}

	
	
	
		
	

}

/* End of file si_admin.php */
/* Location: ./application/controllers/si_admin.php */
