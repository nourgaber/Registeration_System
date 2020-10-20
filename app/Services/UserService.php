<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;


/**       
 * Class UserService
 * This class contains all user actions
 * @package App\Services
 */
class UserService  
{
    protected $userRepository;
    /**
     * UserService constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser($name, $email, $password)
    {
        
        $user = $this->userRepository->createUser($name, $email, $password);
        return $user;
    }

    public function getUnactiveUsers()
    {
        return $this->userRepository->getUnactiveUsers();
    }

    public function deleteUsersByIds(array $ids){
        return $this->userRepository->deleteUsersByIds($ids);
    }

    public function updateUserById($id, array $options)
    {
        $userOptions = array();
        if(isset($options['email'])){
            $userOptions['email'] = $options['email'];
        }

        if(isset($options['first_name'])){
            $userOptions['first_name'] = $options['first_name'];
        }

        if(isset($options['last_name'])){
            $userOptions['last_name'] = $options['last_name'];
        }
        if(isset($options['mobile'])){
            $userOptions['mobile'] = $options['mobile'];
        }
        if(isset($options['last_login_at'])){
            $userOptions['last_login_at'] = $options['last_login_at'];
        }
        
      
        $user = $this->userRepository->updateUserById($id, $userOptions);
        return $user;

    }


}