<?php

namespace App\Repositories\Auth\Service;

use Exception;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Users\UserInterface;

use App\Repositories\Auth\Contract\AuthRepository;

/**
 * Class AuthRepositorySentinel
 * @package namespace App\Repositories\Auth\Service;
 */
class AuthRepositorySentinel implements AuthRepository
{
    private $user = null;
	/**
	 * @var $model
	 */
	
	public function __construct()
	{
        
	}

    /**
     * Check a user's credentials
     *
     * @param  array  $credentials
     * @return bool
     */
    public function byCredentials(array $credentials = [])
    {
        try {
            $user = Sentinel::stateless($credentials);
            return $user instanceof UserInterface;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Authenticate a user via the id
     *
     * @param  mixed  $id
     * @return bool
     */
    public function byId($id)
    {
        try {
            $user = Sentinel::findById($id);
            Sentinel::login($user);
            return $user instanceof UserInterface && Sentinel::check();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get the currently authenticated user
     *
     * @var boolean $cache Get from cache/as previously set attribute.
     * @return mixed
     */
    public function user($cache = TRUE)
    {
        if ($cache == TRUE && !empty($this->user))
            return $this->user;

        $this->user = Sentinel::getUser();
        return $this->user;
    }

    /**
     * Get role slug list from current User
     *
     * @return mixed
     */
    public function getRoles()
    {
        $user = $this->user();

        if ($user)
        {
            $userRoles = $user->roles;
            if (count($userRoles))
            {
                foreach ($userRoles as $role) {
                    $roles = $role->slug;
                }
            }
        }

        return $roles;
    }

    public function getUserType()
    {
        $status = Sentinel::inRole('super-admin');

        // TODO
        // Devnote:
        // User Type checking determined from `is_customer` attribute.
        // Can use: Sentinel::check()->is_customer

        if ($status) {
            $userType = "admin";
        } else {
            $userType = "customer";
        }

        return $userType;
    }

    /**
     * Get user Info
     *
     * @param string $column
     * @return void
     */
    public function getUserInfo($column = null)
    {
        $user = $this->user();

        if ($user)
        {
            if (is_null($column)) {
                return $user;
            }

            if ($column == 'role') {
                return $this->getRoles();
            }

            return $user->{$column};
        }

        return null;
    }
}
