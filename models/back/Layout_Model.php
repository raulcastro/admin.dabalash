<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root.'/Framework/Back_Default_Header.php';

/**
 * Contains the methods for interact with the databases
 *
 * @package    Reservation System
 * @subpackage Tropical Casa Blanca Hotel
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Raul Castro <rd.castro.silva@gmail.com>
 */
class Layout_Model
{
    private $db; 
	
    /**
     * Initialize the MySQL Link
     */
	public function __construct()
	{
		$this->db = new Mysqli_Tool(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	}
	
	/**
	 * getGeneralAppInfo
	 *
	 * get all the info that from the table app_info, this is about the application
	 * the name, url, creator and so
	 *
	 * @return array row containing the info
	 */
	
	public function getGeneralAppInfo()
	{
		try {
			$query = 'SELECT * FROM app_info';
	
			return $this->db->getRow($query);
	
		} catch (Exception $e) {
			return false;
		}
	}
	
	/**
	 * Get the user info
	 * 
	 * Get's the user detail {user_id, name, ...}
	 * 
	 * @return mixed|bool An array of info or false
	 */
	public function getUserInfo()
	{
		try {
			$query = "SELECT 
					u.user_id,
					u.type,
					d.name,
					d.avatar,
					u.type, 
					ue.email as user_email, 
					ue.inbox
					FROM users u 
					LEFT JOIN user_detail d ON u.user_id = d.user_id 
					LEFT JOIN user_emails ue ON u.user_id = ue.user_id
					WHERE u.user_id = ".$_SESSION['userId'];
			return $this->db->getRow($query);
			
		} catch (Exception $e) {
			return false;
		}
	}
	
	/**
	 * Get only the active users
	 * 
	 * @return mixed|bool An array of info or false
	 */
	public function getActiveUsers()
	{
		try {
			$query = 'SELECT 
					ud.user_id, 
					ud.name 
					FROM users u 
					LEFT JOIN user_detail ud ON ud.user_id = u.user_id
					WHERE u.active = 1 AND third_user = 0
					';
			return $this->db->getArray($query);
			
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function getActiveStores()
	{
		try {
			$query = 'SELECT * FROM stores
					WHERE active = 1
					';
			
			return $this->db->getArray($query);
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function addStore($data)
	{
		try {
			$query = 'INSERT INTO stores(store, store_url) VALUES(?, ?)';
				
			$prep=$this->db->prepare($query);
	
			$prep->bind_param('ss', $data['storeName'], $data['storeUrl']);
	
			if ($prep->execute())
			{
				return $prep->insert_id;
			}
			else
			{
				printf("Errormessage: %s\n", $prep->error);
			}
				
		} catch (Exception $e) {
			return false;
		}
	}
	
	function getStoreByStoreId($storeId)
	{
		try {
			$query = 'SELECT * FROM stores WHERE store_id = '.$storeId;
			return $this->db->getRow($query);
		} catch (Exception $e) {
			return false;
		}
	}
	
	function updateStore($data)
	{
		try {
			$query = 'UPDATE stores SET store = ?, store_url = ? WHERE store_id = '.$data['storeId'];

			$prep = $this->db->prepare($query);
			
			$prep->bind_param('ss', $data['storeName'], $data['storeUrl']);
			
			return $prep->execute();
		} catch (Exception $e) {
			return false;
		}
	}
	
	function deleteStore($storeId)
	{
		$storeId = (int) $storeId;
		try {
			$query = 'DELETE FROM stores WHERE store_id = '.$storeId;
			
			return $this->db->run($query);
			
		} catch (Exception $e) {
			return false;
		}
	}
	
	function addSlider($storeId, $slider)
	{
		try {
			$query = 'INSERT INTO sliders(store_id, slider) VALUES(?, ?)';
			
			$prep = $this->db->prepare($query);
			
			$prep->bind_param('is', $storeId, $slider);
			
			return $prep->execute();
			
		} catch (Exception $e) {
			return false;
		}
	}
	
	function getSliders($storeId)
	{
		try {
			$storeId = (int) $storeId;
			
			$query = 'SELECT * FROM sliders WHERE store_id = '.$storeId.' ORDER BY slider_id DESC';
			
			return $this->db->getArray($query);
			
		} catch (Exception $e) {
			return false;
		}
	}
	
	function deleteSlider($sliderId)
	{
		try {
			$sliderId = (int) $sliderId;
			
			$query = 'DELETE FROM sliders WHERE slider_id = '.$sliderId;
			
			return $this->db->run($query);
		} catch (Exception $e) {
			return false;
		}
	}
	
	function updateSlider($data)
	{
		try {
			$query = 'UPDATE sliders SET title_slider = ?, content_slider = ?, url_slider = ? WHERE slider_id = ?';
			
			$prep = $this->db->prepare($query);
			
			$prep->bind_param('sssi', $data['sliderTitle'], $data['sliderContent'], $data['sliderUrl'], $data['sliderId']);
			
			return $prep->execute();
			
		} catch (Exception $e) {
			return false;
		}
	}
	
	function addPlace($data)
	{
		try {
			$query = 'INSERT INTO places(place) VALUES(?)';
			
			$prep = $this->db->prepare($query);
			
			$prep->bind_param("s", $data['placeName']);
			
			return $prep->execute();
			
		} catch (Exception $e) {
			return false;
		}
	}
	
	function getPlaces()
	{
		try {
			$query = 'SELECT * FROM places ORDER BY place_id DESC';
			return $this->db->getArray($query);
			
		} catch (Exception $e) {
			return false;
		}
	}
	
	function deletePlace($placeId)
	{
		try {
			$placeId = (int) $placeId;
			
			$query = 'DELETE FROM places WHERE place_id = '.$placeId;
			
			return $this->db->run($query);
		} catch (Exception $e) {
			return false;
		}
	}
	
	function addSub($data)
	{
		try {
			$query = 'INSERT INTO subplaces(place_id, place_title, place_content) VALUES(?, ?, ?)';
			$prep = $this->db->prepare($query);
				
			$prep->bind_param("iss", $data['placeId'], $data['subTitle'], $data['subContent']);
			
			return $prep->execute();
		} catch (Exception $e) {
			return false;
		}
	}
	
	function getSubs($placeId)
	{
		try {
			$placeId = (int) $placeId;
			
			$query = 'SELECT * FROM subplaces WHERE place_id = '.$placeId.' ORDER BY subplace_id DESC';
			
			return $this->db->getArray($query);
		} catch (Exception $e) {
			return false;
		}
	}
	
	function  deleteSub($subId)
	{
		try {
			$query = 'DELETE FROM subplaces WHERE subplace_id = '.$subId;
			
			return $this->db->run($query);
		} catch (Exception $e) {
			return false;
		}
	}
	
	function getSubBySubId($subId)
	{
		try {
			$query = 'SELECT * FROM subplaces WHERE subplace_id = '.$subId;
			return $this->db->getRow($query);
		} catch (Exception $e) {
			return false;
		}
	}
	
	function editSub($data)
	{
		try {
			$query = 'UPDATE subplaces SET place_title = ?, place_content = ? WHERE subplace_id = ?';
			
			$prep = $this->db->prepare($query);
			
			$prep->bind_param("ssi", $data['subTitle'], $data['subContent'], $data['subId']);
			
			return $prep->execute();
		} catch (Exception $e) {
			return false;
		}
	}
}









































