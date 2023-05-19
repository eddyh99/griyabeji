<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laundry extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
            redirect(base_url());
        }
        $this->load->model('admin/mdl_laundry', 'laundry');
        $this->load->model('admin/mdl_items', 'items');
    }

    public function index()
    {

        $data    = array(
            'title'         => NAMETITLE,
            'content'     => 'laundry/index',
            'extra'         => 'laundry/js/js_index',
            'side17'     => 'active',
            'breadcrumb' => 'Laundry'
        );
        $this->load->view('layout/wrapper', $data);
    }

    public function Listdata()
    {
        $result = $this->laundry->listData();
        echo json_encode($result);
    }

    public function tambah()
    {
        $items = $this->items->listitems();
        $data = array(
            'title'         => NAMETITLE,
            'content'     => 'laundry/tambah',
            'extra'         => 'laundry/js/js_index',
            'side17'         => 'active',
            'breadcrumb' => 'Laundry / Tambah Data',
            'items'      => $items,
        );
        $this->load->view('layout/wrapper', $data);
    }

    public function simpandata()
    {
        $data = json_decode($this->security->xss_clean($this->input->post('data')));

        $master        = array(
            "tanggal"   => date("y-m-d H:i:s"),
            "status"    => "no",
            "userid"    => $_SESSION["logged_status"]["username"]
        );
        $result        = $this->laundry->insertData($master, $data);

        if ($result["code"] == 0) {
            $this->session->set_flashdata('message', "Data Berhasil disimpan!");
            echo '0';
        } else {
            $this->session->set_flashdata('message', "Data gagal disimpan!");
            echo 'Gagal!';
        }
    }

    public function detail($id)
    {
        $id    = base64_decode($this->security->xss_clean($id));
        $master        = $this->laundry->getDataByid($id);
        $items        = $this->laundry->getDataListItems($id);

        $data        = array(
            'title'         => NAMETITLE,
            'content'     => 'laundry/detail',
            'extra'         => 'laundry/js/js_index',
            'side17'         => 'active',
            'breadcrumb' => 'Laundry / Detail Data',
            'master'      => $master,
            'items'      => $items,
        );
        $this->load->view('layout/wrapper', $data);
    }

    public function upStatus($status, $id)
    {
        $data = array();
        $msg = "";
        if ($status == 'kembali') {
            $data = array(
                "status"  => 'yes',
            );
            $msg = "diproses!";
        }

        if ($status == 'delete') {
            $data = array(
                "is_deleted"  => 'yes',
            );
            $msg = "dihapus!";
        }

        $id    = base64_decode($this->security->xss_clean($id));
        $result = $this->laundry->updateData($data, $id);

        if ($result["code"] == 0) {
            $this->session->set_flashdata('message', "Data berhasil " . $msg);
            redirect("laundry");
        } else {
            $this->session->set_flashdata('message', "Data berhasil " . $msg);
            redirect("laundry");
        }
    }
}
