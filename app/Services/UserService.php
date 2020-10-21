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
     *
     * @param \App\Repositories\UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $name
     * @param $email
     * @param $password
     *
     * @return \App\Models\User
     */
    public function createUser($name, $email, $password)
    {

        $user = $this->userRepository->createUser($name, $email, $password);
        return $user;
    }

    /**
     * @return mixed
     */
    public function getUnactiveUsers()
    {
        return $this->userRepository->getUnactiveUsers();
    }

    /**
     * @param array $ids
     */
    public function deleteUsersByIds(array $ids){
        return $this->userRepository->deleteUsersByIds($ids);
    }

     /**
     * @param  $id
     */
    public function getUserById( $id){
        return $this->userRepository->getUserById($id);
    }

    /**
     * @param       $id
     * @param array $options
     *
     * @return mixed
     */
    public function updateUserById($id, array $options)
    {
        $userOptions = array();
        if(isset($options['email'])){
            $userOptions['email'] = $options['email'];
        }

        if(isset($options['last_login_at'])){
            $userOptions['last_login_at'] = $options['last_login_at'];
        }

        $user = $this->userRepository->updateUserById($id, $userOptions);
        return $user;

    }


}
