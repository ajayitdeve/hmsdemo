<?php

namespace App\Services;

class DiagnosticResultCart
{

    public $opd_billing_id, $service_id, $result_value;
    function __construct($opd_billing_id, $service_id, $result_value)
    {
        $this->opd_billing_id = $opd_billing_id;
        $this->service_id = $service_id;
        $this->result_value = $result_value;
    }
}
