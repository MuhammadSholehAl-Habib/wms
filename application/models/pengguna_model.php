<?php
class pengguna_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getPengguna()
	{
		    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'pengguna.kd_pengguna';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['cari_pengguna']) ? strval($_POST['cari_pengguna']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $result['total'] = $this->db->get('pengguna')->num_rows();
        $row = array();
        // select data from table product
        $query = "SELECT *
            from pengguna
            where concat(kd_pengguna,'',nama)  like '%$search%' order by $sort $order limit $offset, $rows";
        $country = $this->db->query($query)->result_array();
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

  public function savePengguna()
    {
        $data = [
            'nama' => $this->input->post('nama'),
        ];
        $this->db->insert('pengguna',$data);
        return $this->db->insert_id();
    }
    public function updateCustomer($id)
    {
        $data =  [
            'customerName' => $this->input->post('customerName'),
            'contactFirstName' => $this->input->post('contactFirstName'),
            'contactLastName' => $this->input->post('contactLastName'),
            'phone' => $this->input->post('phone'),
            'addressLine1' => $this->input->post('addressLine1'),
            'addressLine2' => $this->input->post('addressLine2'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'postalCode' => $this->input->post('postalCode'),
            'country' => $this->input->post('country')
        ];
        $this->db->where('customerNumber',$id);
        $this->db->set($data);
        return $this->db->update('customers');
    }
    public function destroyCustomer($id)
    {
        $this->db->where('customerNumber',$id);
        return $this->db->delete('customers');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}
