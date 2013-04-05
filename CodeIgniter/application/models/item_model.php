<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Item_Model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }


	public function getItem ($itemId) {


		$sql = "SELECT sg_games.game_id, sg_gamename.game_name, sg_games.game_description, sg_games.game_thumbnail, sg_games.game_yearpub
				FROM sg_games
				INNER JOIN sg_games_gamename ON sg_games_gamename.game_id = sg_games.game_id and gamename_priority='1'
				INNER JOIN sg_gamename ON sg_gamename.gamename_id = sg_games_gamename.gamename_id
				WHERE sg_games.game_id = '13'";


		if ($query = $this->db->query($sql)) {	
			$row = $query->row_array();
			return $row;
		}

		return false;

	}

}
/* End of file item_model.php */
/* Location: ./application/model/item_model.php */
