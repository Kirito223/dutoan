<?php

namespace App\Helpers;

use Session;

class SessionHelper
{
    private $DepartmentId;
    private $Departmentname;
    private $userId;
    private $userName;
    private $role;
    public function __construct()
    {
        $this->DepartmentId = Session::get('DepartmentId');
        $this->Departmentname = Session::get('Departmentname');
        $this->userId = Session::get('userId');
        $this->role = Session::get('role');
        $this->userName = Session::get('userName');
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

    public function getRole()
    {
        return json_decode($this->role);
    }

    public function getUserName()
    {
        return $this->userName;
    }
}
