<?php 

namespace App\Auth;
use App\User;
use Carbon\Carbon; 
use Illuminate\Auth\GenericUser; 
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use App\Auth\TeamForgeApiToken;

class TeamForgeAuthApiUserProvider implements UserProvider {

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        //\Log::info('function called TeamForge retrieveById');
        $users = User::all();
        foreach ($users as $user) {
            if($user->id == $identifier){
                return $user;
            }
        }
        return null;
    }

    /**
     * Retrieve a user by by their unique identifier and "remember me" token.
     *
     * @param  mixed $identifier
     * @param  string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        \Log::info('function called TeamForge retrieveByToken');
        // TODO: Implement retrieveByToken() method.
        return null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        \Log::info('function called TeamForge updateRememberToken');
        // TODO: Implement updateRememberToken() method.
        //$user->setRememberToken($token);
        //$user->save();

    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        // TODO: Implement retrieveByCredentials() method.
        \Log::info('function called TeamForge retrieveByCredentials');
        
        //Check if credentials match teamforge credentials
        if(TeamForgeApiToken::requestToken($credentials[0]) == NULL){
            return NULL;
        }

        \Log::info('TeamForge Credentials are vaild');
        $users = User::all();
        foreach ($users as $user) {
            if($user->username == $credentials[0]->username) {
                \Log::info('TeamForge Credentials are vaild');
                return $user;
            }
        }
        
        \Log::info('TeamForge Credentials are vaild but user not found i database');
        \Log::info('Trying to create a new user');
        return User::create(['username' => $credentials[0]->username, 'password' => '']);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // TODO: Implement validateCredentials() method.
        //\Log::info('function called TeamForge validateCredentials');
        // Lets ignore credentials validation :P
        return true;
    }
}

?>