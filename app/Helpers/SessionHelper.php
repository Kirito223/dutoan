<?php

namespace App\Helpers;

use Session;

class SessionHelper
{
    private $DepartmentId;
    private $Departmentname;
    private $userId;
    public function __construct()
    {
        $this->DepartmentId = Session::get('DepartmentId');
        $this->Departmentname = Session::get('Departmentname');
        $this->userId = Session::get('userId');
    }
    public function DepartmentId()
    {
        return $this->DepartmentId;
    }
    public function Departmentname()
    {
        return $this->Departmentname;
    }
    public function userId()
    {
        return $this->userId;
    }
}
