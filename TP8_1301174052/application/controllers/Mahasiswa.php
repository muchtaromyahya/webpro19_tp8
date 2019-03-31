<?php
 // write your name and student id here
class Mahasiswa extends CI_Controller
{

	public function __construct()
	{
		//load model "Mahasiswa_model"
		//load library form validation
		parent::__construct();
		$this->load->model("Mahasiswa_model");
		$this->load->library('form_validation');
	}


	public function index()
	{

		$data['judul'] = 'Daftar Mahasiswa';
		$data['mahasiswa'] = $this->Mahasiswa_model->getAllMahasiswa();
		if ($this->input->post('keyword')) {
			$data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('mahasiswa/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$data['judul'] = 'Form Tambah Data Mahasiswa';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/footer');
		//from library form_validation, set rules for nama, nim, email = required
		$this->form_validation->set_rules('nama','nama lengkap','required');
		$this->form_validation->set_rules('nim','NIM','required');
		$this->form_validation->set_rules('email','Email','required');
		//conditon in form_validation, if user input form = false, then load page "tambah" again
		if($this->form_validation->run() == false){
			$this->load->view('mahasiswa/tambah');
		} else{
			$this->Mahasiswa_model->tambahDataMahasiswa();
			$this->session->set_flashdata('flash','ditambah');
			redirect(base_url('mahasiswa'));
		}
		//else, when successed {
		//call method "tambahDataMahasiswa" in Mahasiswa_model
		//use flashdata to to show alert "added success"
		//back to controller mahasiswa }
	}

	public function hapus($id)
	{
		//call method hapusDataMahasiswa with parameter id from mahasiswa_model
		//use flashdata to show alert "dihapus"
		//back to controller mahasiswa
		$this->Mahasiswa_model->hapusDataMahasiswa($id);
		$this->session->set_flashdata('flash','dihapus');
		redirect(base_url('mahasiswa'));

	}

	public function ubah($id)
	{
		$data['judul'] = 'Form Ubah Data Mahasiswa';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/footer');
		$data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
		$data['jurusan'] = ['Teknik Informatika', 'Teknik Industri', 'Teknik Elektro', 'DKV', 'MBTI'];
		//from library form_validation, set rules for nama, nim, email = required
		$this->form_validation->set_rules('nama','nama lengkap','required');
		$this->form_validation->set_rules('nim','NIM','required');
		$this->form_validation->set_rules('email','Email','required');
		//conditon in form_validation, if user input form = false, then load page "ubah" again
		if($this->form_validation->run() == false){
			$this->load->view('mahasiswa/ubah',$data);
		} else{
			$this->Mahasiswa_model->tambahDataMahasiswa();
			$this->session->set_flashdata('flash','diubah');
			redirect(base_url('mahasiswa'));
		}
		//else, when successed {
		//call method "ubahDataMahasiswa" in Mahasiswa_model
		//use flashdata to to show alert "data changed successfully"
		//back to controller mahasiswa }
	}
}
