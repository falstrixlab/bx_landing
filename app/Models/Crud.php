<?php
    namespace App\Models;
    use CodeIgniter\Model;
    /**
     * [...]
     * Helper query builder on a model system that is connected 
     * to a database that makes it easier for users to use query 
     * methods that are very simple and also {very easy to understand}.
     * And provide shorter and faster code.
     *
     * @author  Naufaltrix
     * @version 1.0.0
     * @since   03/01/2023
     * @copyright 
    */
    class Crud extends Model {

        protected $db;

        public function __construct()
        {
            parent::__construct();
            $this->db = \Config\Database::connect();
        }

        public function replace_rupiah($angka){
            return str_replace(',','',$angka);
        }

        public function rupiah($angka){
            try{
                $hasil = 'Rp '.number_format($angka,0,',',',');
                return $hasil;
            }catch(\Exception $e){
                log_message('error', $e->getMessage());
                return 'Rp 0';
            }
        }

        public function createData($table, $data) {	
            try {
                $builder = $this->db->table($table);
                $builder->insert($data);
                return $this->db->insertID();
            }
            catch(\Exception $e) {
                log_message('error', $e->getMessage());
                return false;
            }
        }

        public function createBatchData($table, $dataBatch) {
            try {
                $builder = $this->db->table($table);
                $builder->insertBatch($dataBatch);
                return $this->db->insertID();    
            }
            catch(\Exception $e) {
                log_message('error', $e->getMessage());
                return false;
            }            
        }

        
        public function readData($select, $from, $wheres = array(), $like = array(), $joinTable = array(), $groupBy = '', $orderBy = array(), $limit = NULL) {
            try {
                $builder = $this->db->table($from);
                if(!empty($select)){
                    $builder->select($select);
                }
                if(!empty($wheres)){
                    foreach ($wheres as $where => $value) {
                        $builder->where($where, $value);
                    }
                }
                if(!empty($like)){
                    foreach ($like as $likeCol => $value) {
                        $builder->like($likeCol, $value);
                    }
                }
                if(!empty($joinTable)){
                    foreach ($joinTable as $join => $value) {
                        $builder->join($join, $value);
                    }
                }
                if ($groupBy !== '') {
                    $builder->groupBy($groupBy);
                }
                if(!empty($orderBy)){
                    foreach ($orderBy as $order => $value) {
                        $builder->orderBy($order, $value);
                    }
                }
                if(!empty($limit)){
                    if (is_array($limit)) {
                        if (isset($limit['limit']) && isset($limit['offset'])) {
                            $builder->limit($limit['limit'], $limit['offset']);
                        } elseif (isset($limit['limit'])) {
                            $builder->limit($limit['limit']);
                        }
                    } else {
                        $builder->limit($limit);
                    }
                }
                $query = $builder->get();
                if ($query === false) {
                    return [];
                }

                return $query->getResultArray();
            }
            catch(\Throwable $e) {
                log_message('error', $e->getMessage());
                return [];
            }
        }

        function updateData($table, $data, $where) {
            try {
                $builder = $this->db->table($table);
                $builder->where($where); 
                $builder->set($data);               
                $builder->update();             
                return $this->db->affectedRows();
            }
            catch(\Exception $e) {
                log_message('error', $e->getMessage());
                return false;
            }            
        }
        function updateDataNoWhere($table, $data) {
            try {
                $builder = $this->db->table($table);
                $builder->set($data);               
                $builder->update();             
                return $this->db->affectedRows();
            }
            catch(\Exception $e) {
                log_message('error', $e->getMessage());
                return false;
            }            
        }
        function deleteData($table, $where) {
            try {
                $builder = $this->db->table($table);
                $builder->where($where);     
                $builder->delete();           
                return $this->db->affectedRows(); 
            }
            catch(\Exception $e) {
                log_message('error', $e->getMessage());
                return false;
            } 
        }	
    
        function countFiltered($select, $from, $where = array(), $join = array(), $like = array()) {		
            try {
                $builder = $this->db->table($from);
                $builder->select($select);
                if (!empty($join)) {
                    foreach ($join as $joinTable => $value) {
                        $builder->join($joinTable, $value);
                    }
                }
                if (!empty($like)) {
                    foreach ($like as $likeCol => $value) {
                        $builder->like($likeCol, $value);
                    }
                }
                if (!empty($where)) {
                    foreach ($where as $whereCol => $value) {
                        $builder->where($whereCol, $value);
                    }
                }
                $query = $builder->get();
                return $query->getNumRows();
            }
            catch(\Exception $e) {
                log_message('error', $e->getMessage());
                return 0;
            }
        }
        public function countDataAll($table = NULL) {
            try {
                return $this->db->table($table)->countAll();
            }
            catch(\Exception $e) {
                log_message('error', $e->getMessage());
                return 0;
            }
        }
    }
?>