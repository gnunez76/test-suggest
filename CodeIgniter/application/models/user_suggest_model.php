<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_Suggest_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}


	public function setUser ($dataUser, $provider) {

		try {

			if (isset ($dataUser->email)) {
				$sql = "INSERT INTO usr_users (usr_identifier, usr_profileURL, usr_photoURL, usr_name, usr_email, usr_provider)
						VALUES (".$this->db->escape($dataUser->identifier)."," 
							.$this->db->escape($dataUser->profileURL)."," 
							.$this->db->escape($dataUser->photoURL)."," 
							.$this->db->escape($dataUser->displayName).","
							.$this->db->escape($dataUser->email).","
							.$this->db->escape($provider).");";
			}
			else {	
				$sql = "INSERT INTO usr_users (usr_identifier, usr_profileURL, usr_photoURL, usr_name, usr_provider)
						VALUES (".$this->db->escape($dataUser->identifier)."," 
							.$this->db->escape($dataUser->profileURL)."," 
							.$this->db->escape($dataUser->photoURL)."," 
							.$this->db->escape('@'.$dataUser->displayName).","
							.$this->db->escape($provider).");";
			}
			
			$this->benchmark->mark('insert_user_profile_start');
			$query = $this->db->query($sql);
			$this->benchmark->mark('insert_user_profile_end');
		}
		catch (Exception $e) {
			log_message('error', 'model.User_Suggest_Model.setUser: Error al insertar usuario en la BD');
			log_message('error', $e->getFile() . " - " . $e->getLine() . " - " . $e->getMessage());
			trigger_error($e->getFile() . " - " . $e->getLine() . " - " . $e->getMessage(), E_USER_ERROR);
		}
		
		
	}

	public function userExists ($userId) {

		try {
			$sql = "SELECT usr_identifier FROM usr_users
					WHERE usr_identifier='".$userId."'";

			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {

				//El usuario existe
				return true;
			}
			else {

				//El usuario no existe
				return false;
			}
		}
		catch (Exception $e) {
			var_dump ($e);

		}
	}

	public function getRateUserItem ($game_id, $usrIdentifier) {

		try {
			$sql="SELECT g.game_id, g.game_rating FROM 
				usr_users_games g 
				WHERE g.game_id=".$this->db->escape($game_id)."
					AND g.usr_identifier=".$this->db->escape($usrIdentifier).";";
	
			log_message('debug', 'models.User_Suggest_Model.getRateUserGame query: '.$sql);
			
			$query = $this->db->query($sql);
			
			if ($query = $this->db->query($sql)) {
				if ($row = $query->row_array()) {
					return $row['game_rating'];
				}
				else {
					return false;
				}
			}
			
			return false;
		}
		catch (Exception $e) {
			log_message('error', $e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function setRateUserItem ($game_id, $usrIdentifier, $ratingValue) {
	
		try {
			$sql="INSERT INTO usr_users_games (usr_identifier, game_id, game_rating)
				VALUES (".$this->db->escape($usrIdentifier).","
					.$this->db->escape($game_id).","
					.$this->db->escape($ratingValue).")";
				
			log_message('debug', 'models.User_Suggest_Model.setRateUserGame query: '.$sql);
				
			$query = $this->db->query($sql);
				
			return true;
		}
		catch (Exception $e) {
			log_message('error', $e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	/*
	 * Actualiza la valoracion del usuario de un item
	 */
	public function updateRateUserItem ($game_id, $usrIdentifier, $ratingValue) {
	
		try {
			$sql="UPDATE usr_users_games SET game_rating=".$this->db->escape($ratingValue).
					"WHERE usr_identifier=".$this->db->escape($usrIdentifier).
					" AND game_id=".$this->db->escape($game_id).";";
	
			log_message('debug', 'models.User_Suggest_Model.updateRateUserItem query: '.$sql);
	
			$query = $this->db->query($sql);
	
			return true;
		}
		catch (Exception $e) {
			log_message('error', $e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	/*  
	 * Modifica el numero de votos totales de un item cuando un usuario
	 * modifica la valoraci�n que habia realizado del mismo.
	 * NO MODIFICA el total de votos. 
	 */
	public function modifyItemTotalRating ($game_id, $ratingValue) {
	
		try {

			if ($ratingValue > 0) {
				$sql="UPDATE sg_games SET game_totalRating=game_totalRating+".$ratingValue.
					" WHERE game_id=".$this->db->escape($game_id).";";
			}
			else {
				$sql="UPDATE sg_games SET game_totalRating=game_totalRating".$ratingValue.
				" WHERE game_id=".$this->db->escape($game_id).";";
			}
				
				
			log_message('debug', 'models.User_Suggest_Model.modifyTotalRating query: '.$sql);
	
			$query = $this->db->query($sql);
	
			return true;
		}
		catch (Exception $e) {
			log_message('error', $e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	
	}
	
	/**
	 * Valora el item inicialmente. A�ade el valor de la puntucion e incremente en uno
	 * el numero de votos realizados
	 */
	public function updateItemTotalRating ($game_id, $ratingValue) {

		try {
			
			$sql="UPDATE sg_games SET game_totalRating=game_totalRating+".$ratingValue.", game_totalVotes=game_totalVotes+1
					WHERE game_id=".$this->db->escape($game_id).";";
					
					
			log_message('debug', 'models.User_Suggest_Model.updateGameTotalRating query: '.$sql);
		
			$query = $this->db->query($sql);
	
			return true;
		}
		catch (Exception $e) {
			log_message('error', $e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
	}
	
	/*
	 * Devuelve el review de un Item
	 */
	public function getReviewUserItem ($itemId, $usrIdentifier) {
	
		try {
			
			$sql="SELECT comment_id, comment_title, comment_text, comment_votes, comment_date FROM
				si_comments sic
				WHERE sic.game_id=".$this->db->escape($itemId)."
					AND sic.comment_parent_id=0 AND sic.usr_identifier=".$this->db->escape($usrIdentifier).";";
	
			log_message('debug', 'models.User_Suggest_Model.getReviewUserGame query: '.$sql);
				
//			$query = $this->db->query($sql);
				
			if ($query = $this->db->query($sql)) {
				if ($row = $query->row_array()) {
					return $row;
				}
				else {
					return false;
				}
			}
				
			return false;
		}
		catch (Exception $e) {
			log_message('error', $e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	
	
	/*
	 * Inserta la revision de un usuario
	 */
	public function setReviewUserItem ($itemId, $usrIdentifier, $titulo, $texto) {
	
		try {
			$sql="INSERT INTO si_comments (usr_identifier, game_id, comment_type_id, comment_title, 
					comment_text, comment_parent_id, comment_date)
				VALUES (".$this->db->escape($usrIdentifier).","
						.$this->db->escape($itemId).","
						.SI_REVIEW_COMMENT.","
						.$this->db->escape($titulo).","
						.$this->db->escape($texto).","
						."0,"
						."NOW())";
	
			log_message('debug', 'models.User_Suggest_Model.setReviewUserGame query: '.$sql);
	
			$query = $this->db->query($sql);
	
			return true;
		}
		catch (Exception $e) {
			log_message('error', $e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	/*
	 * Inserta la revision de un usuario
	*/
	public function setCommentUserReview ($itemId, $usrIdentifier, $texto, $parentId) {
	
		try {
			$sql="INSERT INTO si_comments (usr_identifier, game_id, comment_type_id, comment_title,
					comment_text, comment_parent_id, comment_date)
				VALUES (".$this->db->escape($usrIdentifier).","
					.$this->db->escape($itemId).","
					.SI_COMMENT_COMMENT.","
					.$this->db->escape('').","
					.$this->db->escape($texto).","
					.$this->db->escape($parentId).","
					."NOW())";
	
			log_message('debug', 'models.User_Suggest_Model.setCommentUserReview query: '.$sql);
	
			$query = $this->db->query($sql);
			
	
			return true;
		}
		catch (Exception $e) {
			log_message('error', $e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	/*
	 * Actualiza la review del usuario de un item
	*/
	public function updateReviewUserItem ($itemId, $usrIdentifier, $titulo, $texto) {
	
		try {
			$sql="UPDATE si_comments SET comment_title=".$this->db->escape($titulo).
				", comment_text=".$this->db->escape ($texto).
				", comment_date=NOW() ".
				"WHERE comment_parent_id=0 AND usr_identifier=".$this->db->escape($usrIdentifier).
				" AND game_id=".$this->db->escape($itemId).";";
	
			log_message('debug', 'models.User_Suggest_Model.updateReviewUserItem query: '.$sql);
	
			$query = $this->db->query($sql);
	
			return true;
		}
		catch (Exception $e) {
			log_message('error', $e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}



	
	/*
	 * Obtener todos los comentarios de una review
	*/
	public function getAllCommentsReviews ($itemId, $orderBy = "comment_votes DESC, comment_date DESC", $commentParentId) {
	
		try {
				
			$sql="SELECT comment_id, usr_name, usr_photoURL, comment_title, comment_text, comment_votes,
					DATE_FORMAT (comment_date, '%d-%m-%Y') as fecha, game_rating, game_timeplayed
					FROM si_comments s
					INNER JOIN usr_users u ON u.usr_identifier=s.usr_identifier
					LEFT JOIN usr_users_games ug ON ug.usr_identifier=s.usr_identifier
					WHERE s.game_id=".$this->db->escape($itemId)." AND s.comment_parent_id=".$commentParentId;

				
			if (!is_null ($orderBy)) {
	
				$sql .= " ORDER BY ".$orderBy;
			}
				
	
			log_message('debug', 'models.User_Suggest_Model.getAllReviewsItem query: '.$sql);
	
			if ($query = $this->db->query($sql)) {
	
	
				if ($row = $query->result_array()) {
					return $row;
				}
				else {
					return false;
				}
	
			}
			else{
	
				return false;
			}
				
		}
		catch (Exception $e) {
			log_message('error', $e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	/*
	 * Obtener todas las reviews de un Item
	*/
	public function getAllReviewsItem ($itemId, $orderBy = "comment_votes DESC, comment_date DESC") {
	
		$data = array ();
		try {
			
			$sql="SELECT comment_id, usr_name, usr_photoURL, comment_title, comment_text, comment_votes, 
					DATE_FORMAT (comment_date, '%d-%m-%Y') as fecha, game_rating, game_timeplayed 
					FROM si_comments s
					INNER JOIN usr_users u ON u.usr_identifier=s.usr_identifier
					LEFT JOIN usr_users_games ug ON ug.usr_identifier=s.usr_identifier
					WHERE s.game_id=".$this->db->escape($itemId)." AND s.comment_parent_id=0";
			
			if (!is_null ($orderBy)) {
				
				$sql .= " ORDER BY ".$orderBy;
			}
					
						
			log_message('debug', 'models.User_Suggest_Model.getAllReviewsItem query: '.$sql);
	
			if ($query = $this->db->query($sql)) {

				foreach ($query->result_array() as $row) {
					
					$row ['hijos'] = $this->getAllCommentsReviews ($itemId, $orderBy, $row['comment_id']);
					$data [] = $row;
				}
				
				return $data;						
			}
			else{
				
				return false;
			}
					
		}
		catch (Exception $e) {
			log_message('error', $e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	

}
/* End of file item_model.php */
/* Location: ./application/model/item_model.php */
