<?php
if (isset($this->session->userdata['logged_status'])) {
    //Menggabungkan semua bagian halaman
    require_once('header.php');

    // if ($this->uri->segment(1) != "reservasi") {
    require_once('sidebar.php');
    // }

    if (isset($content)) {
        $this->load->view($content);
    }
    //if (isset($this->session->userdata['logged_status'])) {
    require_once('footer.php');
    //}
} else {
    require_once('header.php');
    if (isset($content)) {
        $this->load->view($content);
    }
    require_once('footer.php');
}
