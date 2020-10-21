<?php

namespace App\Services;

use App\Models\Admin;
use App\Repositories\AdminRepository;


/**
 * Class AdminService
 * This class contains admin actions
 *
 * @package App\Services
 */
class AdminService
{
    /**
     * @var \App\Repositories\AdminRepository
     */
    protected $adminRepository;

    /**
     * AdminService constructor.
     *
     * @param \App\Repositories\AdminRepository $adminRepository
     */
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * @param $name
     * @param $email
     * @param $password
     *
     * @return \App\Models\Admin
     */
    public function createAdmin($name, $email, $password)
    {
        $admin = $this->adminRepository->createAdmin($name, $email, $password);
        return $admin;
    }

    /**
     * @param       $id
     * @param array $options
     *
     * @return mixed
     */
    public function updateAdminById($id, array $options)
    {
        $adminOptions = array();
        if (!is_null($options['email'])) {
            $adminOptions['email'] = $options['email'];
        }

        $admin = $this->adminRepository->updateAdminById($id, $adminOptions);
        return $admin;

    }


}
