<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . '/third_party/TCPDF-6.3.5/tcpdf.php';
class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
}
