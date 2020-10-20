<?php

namespace App\Services;

use App\Models\Admin;
use App\Repositories\AdminRepository;


/**       
 * Class AdminService
 * This class contains admin actions
 * @package App\Services
 */
class AdminService  
{
    protected $adminRepository;
    /**
     * AdminService constructor.
     */
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function createAdmin($name, $email, $password)
    {
        $admin = $this->adminRepository->createAdmin($name, $email, $password);
        return $admin;
    }

    public function updateAdminById($id, array $options)
    {
        $adminOptions = array();
        if(!is_null($options['email'])){
            $adminOptions['email'] = $options['email'];
        }

        if(!is_null($options['first_name'])){
            $adminOptions['first_name'] = $options['first_name'];
        }

        if(!is_null($options['last_name'])){
            $adminOptions['last_name'] = $options['last_name'];
        }
        if(!is_null($options['mobile'])){
            $adminOptions['mobile'] = $options['mobile'];
        }
      
        $admin = $this->adminRepository->updateAdminById($id, $adminOptions);
        return $admin;

    }


}