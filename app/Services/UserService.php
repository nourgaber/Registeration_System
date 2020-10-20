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
        dd('user');
        $user = $this->userRepository->getUserByEmail($email);
        if(count($user) > 0){
            return false;
        }
        $user = $this->userRepository->createUser($name, $email, $password);
        return $user;
    }

    public function updateUserById($id, array $options)
    {
        $userOptions = array();
        if(!is_null($options['email'])){
            $userOptions['email'] = $options['email'];
        }

        if(!is_null($options['first_name'])){
            $userOptions['first_name'] = $options['first_name'];
        }

        if(!is_null($options['last_name'])){
            $userOptions['last_name'] = $options['last_name'];
        }
        if(!is_null($options['mobile'])){
            $userOptions['mobile'] = $options['mobile'];
        }
  
      
        $user = $this->userRepository->updateUserById($id, $userOptions);
        return $user;

    }


}