<?php
class Message{

    public function success_msg(){
        return "<font color='black'>Data telah tersimpan</font>";
    }

    public function error_msg($errmsg){
        return "<font color='red'>".$errmsg."</font>";
    }

    public function delete_msg(){
        return "<font color='black'>Data berhasil terhapus</font>";
    }

    public function error_delete_msg(){
        return "<font color='white'>Data gagal/sudah terhapus</font>";
    }

    public function active_msg(){
        return "<font color='black'>Data telah aktif</font>";
    }

    public function error_active_msg(){
        return "<font color='orange'>Data gagal/sudah aktif</font>";
    }
}
?>