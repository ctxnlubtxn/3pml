<?php

namespace Tokalink\Starter\Controllers;

use Illuminate\Http\Request;
use Tokalink\Starter\Controllers\CustomController;
use Illuminate\Support\Facades\DB;

class CekdptController extends CustomController
{
    public function init()
    {
        $this->table = 'data_pemilihs';
        $this->button_add = false;
        $this->button_edit = false;
        $this->button_delete = true;
        $this->button_detail = false;
        $this->button_show = true;
        $this->button_filter = true;
        $this->filter_by = ["created_at"=> '$data'];
        $this->button_import = false;
        $this->button_export = false;
        $this->paginate = 10;
        $this->data_where = null;
        $this->title = "Data Cekdpt";

        $this->col = [];
        $this->col[] = ["label" => "Nik", "data" => "nik"];
        $this->col[] = ["label" => "Nama", "data" => "nama"];
        $this->col[] = ["label" => "kabupaten", "data" => "kabupaten"];
        $this->col[] = ["label" => "kecamatan", "data" => "kecamatan"];
        $this->col[] = ["label" => "kelurahan", "data" => "kelurahan"];
        $this->col[] = ["label" => "tps", "data" => "tps"];
        $this->col[] = ["label" => "alamat", "data" => "alamat"];

        $this->form = [];
        $this->form[] = ["label" => "label", "name" => "created_at", "type" => "text", "placeholder" => "Name", "required" => true];
    }
}
