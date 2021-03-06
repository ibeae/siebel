<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Domain_model extends CI_Model
{
	private $table;
	private $dbConfig = 'default';
	private $db;

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database($this->dbConfig, TRUE);
		$this->table = $this->uri->segment(1);
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function get($cuno, $id = FALSE, $extra = array()) 
	{
		$table = isset($extra['table']) ? $extra['table'] : $this->table;
		$db = isset($extra['db']) ? $this->load->database($extra['db'], TRUE) : $this->db;
		
		$customernumberColumn = isset($extra['customernumberColumn']) ? $extra['customernumberColumn'] : 'customernumber';
		$db->where($customernumberColumn, $cuno);

		$idColumn = isset($extra['idColumn']) ? $extra['idColumn'] : 'id';
		if($id) {$db->where($idColumn, $id);}
		
		if(array_key_exists('where', $extra)) {
			foreach($extra['where'] as $key => $value) {
				$db->where($key, $value);
			}
		}

		if(isset($extra['order_by'])) {$db->order_by($extra['order_by']);}
		
		$results = $db->get($table)->result();
		return $results;
	}
	
	public function save($id, $saveData, $extra = array()) 
	{
		$table = isset($extra['table']) ? $extra['table'] : $this->table;
		$copy = isset($extra['copy']) ? $extra['copy'] : FALSE;
		$db = isset($extra['db']) ? $this->load->database($extra['db'], TRUE) : $this->db;
		
		if($copy) {
			$id = 'new';
		}
		
		if($id == 'new')
		{
			if($db->insert($table, $saveData)) {return $db->insert_id();}
		}
		else
		{
			$idColumn = isset($extra['idColumn']) ? $extra['idColumn'] : 'id';
			$db->where($idColumn, $id);
			if($db->update($table, $saveData)) {return $id;}

		}
	}
	
	public function delete($id, $extra = array()) 
	{
		$table = isset($extra['table']) ? $extra['table'] : $this->table;
		$db = isset($extra['db']) ? $this->load->database($extra['db'], TRUE) : $this->db;
		
		$db->where('id', $id);
		if($db->update($table, array('delete' => 1)))
		{
			return TRUE;
		};
		
	}
	
	public function getColumns($extra = array()) 
	{
		$table = isset($extra['table']) ? $extra['table'] : $this->table;
		$db = isset($extra['db']) ? $this->load->database($extra['db'], TRUE) : $this->db;

		foreach ($db->list_fields($table) as $key => $value) {
			$return->$value = '';
		}

		return $return;
	}
	
	public function createFields($data, $extra = array()) 
	{
		$columns = $this->getColumns($extra);
		foreach($columns as $field => $value)
		{
			$fields[$field] = array(
				'name'  => $field,
				'id'    => $field,
				'class'    => $field,
				'type'  => 'text',
				'value' => trim($data->$field),
			);
		};
		
		return $fields;

	}
	
	public function row() {
		return 1;
	}
	
	public function two() {
		return 2;
	}
	
}

/* End of file */