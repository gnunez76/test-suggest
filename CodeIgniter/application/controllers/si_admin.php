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
		
		$this->output->enable_profiler(PROFILER_ENABLE);
		
		
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

		
		$this->output->enable_profiler(PROFILER_ENABLE);
		
		
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
	
	
		$this->output->enable_profiler(PROFILER_ENABLE);
	
	
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
			$data ["expansions"] = $this->si_admin_model->getExpansions ($itemId);
			$data ["idiomas"] = $this->si_admin_model->getAllLanguages ();
			$data ["descripciones"] = $this->si_admin_model->getOtherItemDescriptions ($itemId);
			$data ["titulos"] = $this->si_admin_model->getOtherItemTitles ($itemId);
			$data ["reviews"] = $this->si_admin_model->getNoReviews ($itemId);

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
		
		if($this->session->userdata('logged_in'))
		{

			$this->load->model ('si_admin_model');
			$this->si_admin_model->updateItem ($_POST);
			$this->si_admin_model->updateItemLanDep ($_POST);
			$this->si_admin_model->updateItemDescriptions ($_POST);
			$this->si_admin_model->updateItemTitles ($_POST);
				
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
	 * Bloque mecanicas
	*/
	public function getBlockExpansion ($itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
	
			$this->load->model ('si_admin_model');
			$data ["expansions"] = $this->si_admin_model->getExpansions ($itemId);
			$this->load->view ('admin/items/expansionblock', $data);
		}
	}
	
	/*
	 * Bloque descriptiones en otros idiomas
	 */
	public function getBlockDescriptionLan ($itemId) {

		if($this->session->userdata('logged_in'))
		{
		
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
		
			$this->load->model ('si_admin_model');
			$data ["descripciones"] = $this->si_admin_model->getOtherItemDescriptions ($itemId);
			$this->load->view ('admin/items/descriptionlanblock', $data);
		}
		
	}
	
	
	/*
	 * Bloque titulo en otros idiomas
	*/
	public function getBlockTitleLan ($itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
	
			$this->load->model ('si_admin_model');
			$data ["titulos"] = $this->si_admin_model->getOtherItemTitles ($itemId);
			$this->load->view ('admin/items/titlelanblock', $data);
		}
	
	}
	
	/*
	 * Bloque de imagenes del item
	*/
	public function getBlockImages ($itemId) {
		
		if($this->session->userdata('logged_in'))
		{
		
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
		
			$this->load->model ('si_admin_model');
			$data = $this->si_admin_model->getItem ($itemId);
			$this->load->view ('admin/items/imageblock', $data);
		}
	
	}
	
	

	/*
	 * Desactivar expansiones
	*/
	public function deactivateExpansion ($id, $itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveExpansion($id, $itemId, 0);
		}
	}
	
	/*
	 * Activar expansiones
	*/
	public function activateExpansion ($id, $itemId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->changeActiveExpansion($id, $itemId, 1);
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

	
	/*
	 * Añade un nombre al item
	 */
	public function addNameItem () {
		
		if($this->session->userdata('logged_in'))
		{
		
			$this->load->model ('si_admin_model');
			$this->si_admin_model->insertNewName($_POST['itemId'], $_POST['nameItem']);
		}
				
	}
	
	/*
	 * Devuelve la busqueda predictiva de autores
	 */
	public function getAutores () {

		if($this->session->userdata('logged_in'))
		{
		
			$this->load->model ('si_admin_model');
			$data = $this->si_admin_model->predictiveSearchAutorResult($_GET['term']);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}		
	}
	
	
	/*
	 * Añade un diseñador al item
	 */
	public function addDesigner ($itemId, $designerId) {
		
		if($this->session->userdata('logged_in'))
		{
		
			$this->load->model ('si_admin_model');
			$this->si_admin_model->addDesignerToItem ($itemId, $designerId);
		}
	}
	

	
	/*
	 * Devuelve la busqueda predictiva de ilustradores
	*/
	public function getIlustradores () {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$data = $this->si_admin_model->predictiveSearchArtistResult($_GET['term']);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
	
	
	/*
	 * Añade un diseñador al item
	*/
	public function addArtist ($itemId, $artistId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->addArtistToItem ($itemId, $artistId);
		}
	}
	

	
	/*
	 * Devuelve la busqueda predictiva de editoriales
	*/
	public function getEditoriales () {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$data = $this->si_admin_model->predictiveSearchEditorialResult($_GET['term']);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
	
	
	/*
	 * Añade un editorial al item
	*/
	public function addEditorial ($itemId, $editorialId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->addEditorialToItem ($itemId, $editorialId);
		}
	}
	

	/*
	 * Devuelve la busqueda predictiva de mecanicas
	*/
	public function getMecanicas () {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$data = $this->si_admin_model->predictiveSearchMechanicResult($_GET['term']);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
	
	
	/*
	 * Añade una mecanica al item
	*/
	public function addMechanic ($itemId, $mechanicId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->addMechanicToItem ($itemId, $mechanicId);
		}
	}
	
	/*
	 * Devuelve la busqueda predictiva de categorias
	*/
	public function getCategorias () {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$data = $this->si_admin_model->predictiveSearchCategoryResult($_GET['term']);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
	
	
	/*
	 * Anade una mecanica al item
	*/
	public function addCategory ($itemId, $categoryId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->addCategoryToItem ($itemId, $categoryId);
		}
	}
	
	/*
	 * Devuelve la busqueda predictiva de expansiones
	*/
	public function getExpansiones () {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$data = $this->si_admin_model->predictiveSearchItemResult($_GET['term']);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
	
	/*
	 * Devuelve la busqueda predictiva de items
	*/
	public function getItems () {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$data = $this->si_admin_model->predictiveSearchItemResult($_GET['term']);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
	
	
	/*
	 * Anade una expansion al item
	*/
	public function addExpansion ($itemId, $expansionId) {
	
		if($this->session->userdata('logged_in'))
		{
	
			$this->load->model ('si_admin_model');
			$this->si_admin_model->addExpansionToItem ($itemId, $expansionId);
		}
	}
	
	/*
	 * A�ade una nueva descripcion
	 */
	public function addDescription () {
		
		if($this->session->userdata('logged_in'))
		{
		
			//var_dump ($_POST);
			
			$this->load->model ('si_admin_model');
			echo $this->si_admin_model->addDescriptionToItem ($_POST['itemId'], $_POST['newDescription'], $_POST['lanNewDescription']);
			
		}
	}

	/*
	 * A�ade titulos en otros idiomas
	*/
	public function addTitleLan () {
	
		if($this->session->userdata('logged_in'))
		{
	
			//var_dump ($_POST);
				
			$this->load->model ('si_admin_model');
			echo $this->si_admin_model->addTitleLanToItem ($_POST['itemId'], $_POST['newTitle'], $_POST['lanNewTitle']);
				
		}
	}
	
	
	/*
	 * Upload de imagenes al servidor
	 */
	public function uploadfilestoserver ($itemId) {
	
		$this->load->library ('UploadHandlerLib');
		if($this->session->userdata('logged_in')) {

			$configUpload = array(
					'script_url' => $this->uploadhandlerlib->get_full_url().'/',
					//            'upload_dir' => dirname($_SERVER['SCRIPT_FILENAME']).'/files/',
					'upload_dir' => CIPATH.'assets/images/games/',
					'upload_url' => $this->uploadhandlerlib->get_full_url().'/files/',
					'upload_url' => '/assets/images/games/',
					'user_dirs' => false,
					'mkdir_mode' => 0755,
					'param_name' => 'files',
					// Set the following option to 'POST', if your server does not support
					// DELETE requests. This is a parameter sent to the client:
					'delete_type' => 'DELETE',
					'access_control_allow_origin' => '*',
					'access_control_allow_credentials' => false,
					'access_control_allow_methods' => array(
							'OPTIONS',
							'HEAD',
							'GET',
							'POST',
							'PUT',
							'PATCH',
							'DELETE'
					),
					'access_control_allow_headers' => array(
							'Content-Type',
							'Content-Range',
							'Content-Disposition'
					),
					// Enable to provide file downloads via GET requests to the PHP script:
					'download_via_php' => false,
					// Defines which files can be displayed inline when downloaded:
					'inline_file_types' => '/\.(gif|jpe?g|png)$/i',
					// Defines which files (based on their names) are accepted for upload:
					'accept_file_types' => '/.+$/i',
					// The php.ini settings upload_max_filesize and post_max_size
					// take precedence over the following max_file_size setting:
					'max_file_size' => 500000,
					'min_file_size' => 1,
					// The maximum number of files for the upload directory:
					'max_number_of_files' => null,
					// Image resolution restrictions:
					'max_width' => 1024,
					'max_height' => 762,
					'min_width' => 1,
					'min_height' => 1,
					// Set the following option to false to enable resumable uploads:
					'discard_aborted_uploads' => true,
					// Set to true to rotate images based on EXIF meta data, if available:
					'orient_image' => false,
					'image_versions' => array(
						// Uncomment the following version to restrict the size of
						// uploaded images:
						/*
						 '' => array(
						 		'max_width' => 1920,
						 		'max_height' => 1200,
						 		'jpeg_quality' => 95
						 ),
						*/
						// Uncomment the following to create medium sized images:
						/*
						'medium' => array(
						'max_width' => 800,
						'max_height' => 600,
						'jpeg_quality' => 80
						),
						*/
						'thumbnail' => array(
						// Uncomment the following to force the max
						// dimensions and e.g. create square thumbnails:
						//'crop' => true,
						'max_width' => 200,
						'max_height' => 200
						)
					)
				);			
			
			$this->load->library('HybridAuthLib');

			$this->uploadhandlerlib->setOptions ($configUpload);
			$this->uploadhandlerlib->setItemId ($itemId);
			$this->uploadhandlerlib->setAdminUpload();
				
			$this->load->database();
			$this->uploadhandlerlib->setDb ($this->db);
				
			$this->uploadhandlerlib->iniciar();
		}	
	}
	
	/*
	 * Resto de editores mas simples realizados con Grocery CRUD
	 */
	
	/*
	 * Editor mecanicas
	 */
	public function gridMechanics () {

		if($this->session->userdata('logged_in'))
		{
			
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			
			$this->load->library('grocery_CRUD');
			
			$crud = new grocery_CRUD();
			$crud->unset_delete();
				
			
			$crud->set_table('sg_gamemechanic');
			$crud->columns('mechanic_name');
			$crud->fields('mechanic_name');
			$crud->display_as('mechanic_name','Mec&aacute;nica');
			
			$output = $crud->render();
			
			$this->load->view('admin/header_admin', $data);
			$this->load->view('admin/items/mechaniceditor.php',$output);
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
	}
	
	/*
	 * Editor categorias
	*/
	public function gridCategories () {
	
		if($this->session->userdata('logged_in'))
		{
				
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
				
			$this->load->library('grocery_CRUD');
				
			$crud = new grocery_CRUD();
			$crud->unset_delete();
	
				
			$crud->set_table('sg_gamecategory');
			$crud->columns('category_name');
			$crud->fields('category_name');
			$crud->display_as('category_name','Categor&iacute;a');
				
			$output = $crud->render();
				
			$this->load->view('admin/header_admin', $data);
			$this->load->view('admin/items/mechaniceditor.php',$output);
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
	}
	
	/*
	 * Editor editorial
	*/
	public function gridEditorial () {
	
		if($this->session->userdata('logged_in'))
		{
				
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
				
			$this->load->library('grocery_CRUD');
				
			$crud = new grocery_CRUD();
			$crud->unset_delete();
	
				
			$crud->set_table('sg_gameeditorial');
			$crud->columns('editorial_name');
			$crud->fields('editorial_name');
			$crud->display_as('editorial_name','Editorial');
				
			$output = $crud->render();
				
			$this->load->view('admin/header_admin', $data);
			$this->load->view('admin/items/editorialeditor.php',$output);
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
	}
	
	
	/*
	 * Editor mecanicas
	*/
	public function gridLanguagedep () {
	
		if($this->session->userdata('logged_in'))
		{
				
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
				
			$this->load->library('grocery_CRUD');
				
			$crud = new grocery_CRUD();
			$crud->unset_delete();
	
				
			$crud->set_table('sg_gamelanguagedep');
			$crud->columns('language_name');
			$crud->fields('language_name');
			$crud->display_as('language_name','Dependencia del lenguaje');
				
			$output = $crud->render();
				
			$this->load->view('admin/header_admin', $data);
			$this->load->view('admin/items/mechaniceditor.php',$output);
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
	}
	
	/*
	 * Editor ilustradores
	*/
	public function gridArtists () {
	
		if($this->session->userdata('logged_in'))
		{
				
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
				
			$this->load->library('grocery_CRUD');
				
			$crud = new grocery_CRUD();
			$crud->unset_delete();
	
				
			$crud->set_table('sg_gameartist');
			$crud->columns('artist_name');
			$crud->fields('artist_name');
			$crud->display_as('artist_name','Ilustrador');
				
			$output = $crud->render();
				
			$this->load->view('admin/header_admin', $data);
			$this->load->view('admin/items/artisteditor.php',$output);
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
	}
	
	/*
	 * Editor Dise�adores
	*/
	public function gridDesigners () {
	
		if($this->session->userdata('logged_in'))
		{
			$this->output->enable_profiler(PROFILER_ENABLE);
				
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
				
			$this->load->library('grocery_CRUD');
				
			$crud = new grocery_CRUD();
			$crud->unset_delete();
	
				
			$crud->set_table('sg_gamedesigner');
			$crud->columns('designer_name');
			$crud->fields('designer_name');
			$crud->display_as('designer_name','Dise&ntilde;ador');
				
			$output = $crud->render();
				
			$this->load->view('admin/header_admin', $data);
			$this->load->view('admin/items/designereditor.php',$output);
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
	}

	/*
	 * Editor nombre juego
	*/
	public function gridNames () {
	
		if($this->session->userdata('logged_in'))
		{
				
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
				
			$this->load->library('grocery_CRUD');
				
			$crud = new grocery_CRUD();
			$crud->unset_delete();
	
				
			$crud->set_table('sg_gamename');
			$crud->columns('game_name');
			$crud->fields('game_name');
			$crud->display_as('game_name','T&iacute;tulo');
				
			$output = $crud->render();
				
			$this->load->view('admin/header_admin', $data);
			$this->load->view('admin/items/mechaniceditor.php',$output);
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
	}
	
	/*
	 * Editor usuarios
	*/
	public function gridUsers () {
	
		if($this->session->userdata('logged_in'))
		{
				
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
				
			$this->load->library('grocery_CRUD');
				
			$crud = new grocery_CRUD();
			//$crud->unset_delete();
	
				
			$crud->set_table('usr_users');
			$crud->columns('usr_identifier', 'usr_name', 'usr_email');
			$crud->display_as('usr_identifier','Id.');
			$crud->display_as('usr_name','Nombre');
			$crud->display_as('usr_email','E-Mail');
				
			$output = $crud->render();
				
			$this->load->view('admin/header_admin', $data);
			$this->load->view('admin/items/mechaniceditor.php',$output);
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
	}
	
	/*
	 * Editor SuperUsuarios
	*/
	public function gridSuperUser () {
	
		if($this->session->userdata('logged_in'))
		{
			$this->output->enable_profiler(PROFILER_ENABLE);
	
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
	
			$this->load->library('grocery_CRUD');
	
			$crud = new grocery_CRUD();
			$crud->unset_delete();
	
	
			$crud->set_table('au_admin_users');			
			$crud->columns('au_username','au_realname','au_active');
			$crud->fields('au_username','au_realname','au_password','au_active');
			$crud->change_field_type('au_password','password');
			$crud->callback_before_insert(array($this,'encrypt_password_callback'));
			$crud->callback_before_update(array($this,'encrypt_password_callback'));
			$crud->display_as('au_username', 'Nick');
			$crud->display_as('au_realname', 'Nombre');
			$crud->display_as('au_password', 'Password');
			$crud->display_as('au_active', 'Activo');
			
			/*
			$crud->fields('designer_name');
			$crud->display_as('designer_name','Dise&ntilde;ador');
	*/
			$output = $crud->render();
	
			$this->load->view('admin/header_admin', $data);
			$this->load->view('admin/items/mechaniceditor.php',$output);
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
	}

	/*
	 * Metodo de encriptaci�n para superuser
	 */
	public function encrypt_password_callback ($post_array, $primary_key = null) {
		
		$post_array['au_password'] = md5($post_array['au_password']);
		return $post_array;
	} 
	
	
	/*
	 * GRID reviews
	 */
	public function gridReviews ($itemId=null) {

		if($this->session->userdata('logged_in'))
		{
			$this->output->enable_profiler(PROFILER_ENABLE);
		
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
		
			$this->load->library('grocery_CRUD');
		
			$crud = new grocery_CRUD();
			$crud->unset_delete();
			$crud->unset_add();
		
		
			$crud->set_table('si_comments');				
			$crud->where('comment_type_id', 1);
			$crud->where('game_id', $itemId);
			
			$crud->columns('comment_id', 'game_id', 'comment_title', 'comments');
			$crud->fields('game_id', 'comment_title', 'comment_text', 'comment_notes', 'comment_votes');


			
			
			$crud->display_as('comment_id', 'ID');
			$crud->display_as('game_id', 'Juego');
			$crud->display_as('comment_title', 'T&iacute;tulo');
			$crud->display_as('comment_text', 'Rese&ntilde;a');
			$crud->display_as('comment_votes', 'Votos');
			$crud->display_as('comment_notes', 'Notas privadas');
			$crud->display_as('comments', 'Comentarios');
			
			
			$crud->callback_column('game_id',array($this,'item_column_name_callback'));
			$crud->callback_field('game_id',array($this,'item_name_callback'));

			$crud->callback_column('comments',array($this,'item_column_comments_callback'));
				
			
			/*
			 $crud->fields('designer_name');
			$crud->display_as('designer_name','Dise&ntilde;ador');
			*/
			$output = $crud->render();
		
			$this->load->view('admin/header_admin', $data);
			$this->load->view('admin/items/mechaniceditor.php',$output);
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
		
		
	}

	
	/*
	 * GRID reviews
	*/
	public function gridCommentsReviews ($reviewId=null) {
	
		if($this->session->userdata('logged_in'))
		{
			$this->output->enable_profiler(PROFILER_ENABLE);
	
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
	
			$this->load->library('grocery_CRUD');
	
			$crud = new grocery_CRUD();
			$crud->unset_delete();
			$crud->unset_add();
	
	
			$crud->set_table('si_comments');
			$crud->where('comment_type_id', 2);
			$crud->where('comment_parent_id', $reviewId);
				
			$crud->columns('comment_id', 'comment_parent_id', 'comment_text');
			$crud->fields('comment_parent_id', 'comment_text' );
	
	
			$crud->display_as('comment_id', 'ID');
			$crud->display_as('comment_parent_id', 'Review');
			$crud->display_as('comment_text', 'Comentario');
				


			$crud->callback_column('comment_parent_id',array($this,'item_column_commentParent_callback'));
			$crud->callback_field('comment_parent_id',array($this,'item_commentParent_callback'));
/*	
			$crud->callback_column('comments',array($this,'item_column_comments_callback'));
*/
			
			$output = $crud->render();
	
			$this->load->view('admin/header_admin', $data);
			$this->load->view('admin/items/mechaniceditor.php',$output);
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
	
	
	}
		
	/*
	 * Metodo devuelve el item name
	*/
	public function item_name_callback ($value, $primaryKey = null) {
		
		$this->load->model ('si_admin_model');
		$data = $this->si_admin_model->getGameNames ($value);
		
		return $data[0]['game_name'];	
	}

	/*
	 * Metodo devuelve el item name
	*/
	public function item_column_name_callback ($value, $row) {
	
		$this->load->model ('si_admin_model');
		$data = $this->si_admin_model->getGameNames ($value);

		return $data[0]['game_name'];
	}
	

	/*
	 * Metodo devuelve el numero de comentarios de una review
	*/
	public function item_comments_callback ($value, $primaryKey = null) {
	
		$this->load->model ('si_admin_model');
		$data = $this->si_admin_model->getGameNames ($value);
	
		return $data[0]['game_name'];
	}
	
	/*
	 * Metodo devuelve el numero de comentarios de una review
	*/
	public function item_column_comments_callback ($value, $row) {
	
	
		$this->load->model ('si_admin_model');
		
		$data = $this->si_admin_model->getReviewComments($row->comment_id);
	
		//return $data[0]['total'];
		return '<a href="/si_admin/gridCommentsReviews/'.$row->comment_id.'/" target="_blank">Ver los '.$data[0]['total']." comentarios</a>";
			
	}

	
	/*
	 * Metodo devuelve el titulo de la review
	*/
	public function item_commentParent_callback ($value, $primaryKey = null) {
	
		$this->load->model ('si_admin_model');
		$data = $this->si_admin_model->getReviewTitle ($value);
	
		return $data[0]['titulo'];
	}
	
	/*
	 * Metodo devuelve el titulo de la review
	*/
	public function item_column_commentParent_callback ($value, $row) {
	
		$this->load->model ('si_admin_model');
		$data = $this->si_admin_model->getReviewTitle ($value);
		
		return '<a href="/si_admin/gridReviews/'.$row->game_id.'/edit/'.$value.'/" target="_blank">Editar review '.$data[0]['titulo']."</a>";
	}
	

	
	
}

/* End of file si_admin.php */
/* Location: ./application/controllers/si_admin.php */
