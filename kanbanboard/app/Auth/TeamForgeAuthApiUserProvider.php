<?php 

namespace App\Auth;
use App\User;
use Carbon\Carbon; 
use Illuminate\Auth\GenericUser; 
use Illuminate\Contracts\Auth\Authenticatable;
 use Illuminate\Contracts\Auth\UserProvider;

class TeamForgeAuthApiUserProvider implements UserProvider {

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        \Log::info('function called TeamForge retrieveById');
        // TODO: Implement retrieveById() method.
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
        $url = 'https://teamforge.srv247.se/oauth/auth/token';
        $data = array(
        'grant_type' => 'password',
        'client_id' => 'api-client',
        'scope' => 'urn:ctf:services:ctf',
        'username' => $credentials[0]->username,
        'password' => $credentials[0]->password
        );

        $options = array(
          'http' => array(
              'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
              'method'  => 'POST',
              'content' => http_build_query($data),
          ),
          'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name'=>false,
          )
        );
        $context  = stream_context_create($options);
        try {
            $result = file_get_contents($url, false, $context);

            if ($result === FALSE) { 
              \Log::warning('Authentication with teamforge failed Failed');
              return null;
            }
            else
            {
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
        } catch (\Exception $e) {
            \Log::error('Caught an exception... probbably 400 because invalid teamforge credentials');
            \Log::error($e->getMessage());
            return null;
        }

        
        return null;
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