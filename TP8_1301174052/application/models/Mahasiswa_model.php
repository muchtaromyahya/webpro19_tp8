<?php
 // write your name and student id here
 
class Mahasiswa_model extends CI_model
{

	public function getAllMahasiswa()
	{
		//use query builder to get data table "mahasiswa"
		$result = $this->db->get('mahasiswa');
		return $result->result_array();

	}

	public function tambahDataMahasiswa()
	{
		$data = [
			"nama" => $this->input->post('nama', true),
			"nim" => $this->input->post('nim', true),
			"email" => $this->input->post('email', true),
			"jurusan" => $this->input->post('jurusan', true),
		];
		$this->db->insert('mahasiswa', $data);
		//use query builder to insert $data to table "mahasiswa"
	}

	public function hapusDataMahasiswa($id)
	{
		//use query builder to delete data based on id 
		$this->db->where('id',$id);
		$this->db->delete('mahasiswa');

	}

	public function getMahasiswaById($id)
	{
		//get data mahasiswa based on id 
		$this->db->where('id',$id);
		return $this->db->get('mahasiswa')->row_array();

	}

	public function ubahDataMahasiswa()
	{
		$data = [
			"nama" => $this->input->post('nama', true),
			"nim" => $this->input->post('nim', true),
			"email" => $this->input->post('email', true),
			"jurusan" => $this->input->post('jurusan', true),
		];
		//use query builder class to update data mahasiswa based on id
		$this->db->where('id',$id);
		$this->db->update('mahasiswa',$data);
	}

	public function cariDataMahasiswa()
	{
		$keyword = $this->input->post('keyword', true);
		//use query builder class to search data mahasiswa based on keyword "nama" or "jurusan" or "nim" or "email"
		$this->db->like('nama',$keyword);
		$this->db->or_like('nim',$keyword);
		$this->db->or_like('email',$keyword);
		$this->db->or_like('jurusan',$keyword);
		return $this->db->get('mahasiswa')->result_array();
		//return data mahasiswa that has been searched
	}
}
