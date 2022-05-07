<?php
/**
 * Authentication / registration functions
 */

// Set second-level namespace
// https://www.php.net/manual/ro/language.namespaces.php
namespace services;

class Auth
{
    // Protected PDO variable to hold the PDO instance
    protected $pdo;
 
    /**
     * Constructor
     */
    public function __construct()
    {
        // Load PDO connection
        $this->pdo = Database::getPDO();
    }

    /**
     * Logins user
     *
     * @param array $data Login info array
     * @return bool Login result
     */
    public function login($data)
    {
        // If the array has username and password set
        if (isset($data['username']) && isset($data['password'])) {
            // Get data from array
            $username = $data['username'];
            
            // Query
            $query = 'SELECT user_id, password FROM users WHERE username = :username';
            
            // Uncomment to enable error warnings
            // $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);

            // Prepare query (sends query to database)
            // https://www.php.net/manual/ro/pdo.prepare.php
            $statement = $this->pdo->prepare($query);
            // Bind parameters to query (sends parameters to database)
            // https://www.php.net/manual/ro/pdostatement.bindparam.php
            $statement->bindParam(':username', $username, \PDO::PARAM_STR);
            // Run query
            // https://www.php.net/manual/ro/pdostatement.execute.php
            $statement->execute();
            // Get row count
            $count = $statement->rowCount();

            // Check if we have exactly one row
            if ($count === 1) {
                // Fetch data as object
                // https://www.php.net/manual/ro/pdostatement.fetchobject.php
                $rows = $statement->fetchObject();
                // Verify if password matches the one in the database
                // https://www.php.net/manual/ro/function.password-verify.php
                if (password_verify($data['password'], $rows->password)) {
                    $token = $this->SetToken($rows->user_id);
                    // If token succeeeded
                    if ($token) {
                        return true;
                    }
                }
            }
        }
        
        // Not successfull
        return false;
    }

    /**
     * Sets Auth token in database and $_SESSION
     *
     * @param int $user_id User id
     * @return bool Result
     */
    public function setToken($user_id)
    {
        // Create a token based on the $user_id and a random number
        $token = hash_hmac('sha512', $user_id, rand());
        // Create an expiration date 4 hours into the future
        // https://www.php.net/manual/ro/function.date.php
        // https://www.php.net/manual/ro/function.strtotime.php
        $token_expiration = date('Y-m-d H:i:s', strtotime('+4 hours'));
        
        // Query
        $query = 'UPDATE users SET token = :token, token_expiration = :token_expiration WHERE user_id = :user_id';
        
        // Uncomment to enable error warnings
        // $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
        
        // Prepare query (sends query to database)
        // https://www.php.net/manual/ro/pdo.prepare.php
        $statement = $this->pdo->prepare($query);
        // Bind parameters to query (sends parameters to database)
        // https://www.php.net/manual/ro/pdostatement.bindparam.php
        $statement->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
        $statement->bindParam(':token', $token, \PDO::PARAM_STR);
        $statement->bindParam(':token_expiration', $token_expiration, \PDO::PARAM_STR);
        
        // If query excecution succeds
        // https://www.php.net/manual/ro/pdostatement.execute.php
        if ($statement->execute()) {
            // Save $token and $user_id in session
            $_SESSION['token'] = $token;
            $_SESSION['user_id'] = $user_id;
            
            return true;
        }
        
        // Not successful
        return false;
    }

    /**
     * Logout
     *
     * @param int $user_id User id
     * @return bool Result
     */
    public function logout($user_id)
    {
        // Create an expiration date 4 hours into the past
        // https://www.php.net/manual/ro/function.date.php
        // https://www.php.net/manual/ro/function.strtotime.php
        $token_expiration = date('Y-m-d H:i:s', strtotime('-4 hours'));
        
        // Query (sets expiration token)
        $query = 'UPDATE users SET token_expiration = :token_expiration WHERE user_id = :user_id';
        
        // Uncomment to enable error warnings
        // $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);

        // Prepare query (sends query to database)
        // https://www.php.net/manual/ro/pdo.prepare.php
        $statement = $this->pdo->prepare($query);
        // Bind parameters to query (sends parameters to database)
        // https://www.php.net/manual/ro/pdostatement.bindparam.php
        $statement->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
        $statement->bindParam(':token_expiration', $token_expiration, \PDO::PARAM_STR);
        
        // If query excecution succeds
        // https://www.php.net/manual/ro/pdostatement.execute.php
        if ($statement->execute()) {
            // Delete all session variables
            session_unset();
            
            return true;
        }

        // Not successful
        return false;
    }

    /**
     * Check authentication status by comparing token in the $_SESSION with
     * the one in the database
     *
     * @return bool Authentication result
     */
    public function checkAuth()
    {
        // Checks if token is present in the session
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];

            // Query (checks if token_expiration is in the future)
            $query = 'SELECT first_name FROM users WHERE token = :token AND token_expiration > NOW()';

            // Uncomment to enable error warnings
            // $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            
            // Prepare query (sends query to database)
            // https://www.php.net/manual/ro/pdo.prepare.php
            $statement = $this->pdo->prepare($query);
            // Bind parameters to query (sends parameters to database)
            // https://www.php.net/manual/ro/pdostatement.bindparam.php
            $statement->bindParam(':token', $token, \PDO::PARAM_STR);
            // Execute query
            // https://www.php.net/manual/ro/pdostatement.execute.php
            $statement->execute();
            
            // Count returned database rows
            $count = $statement->rowCount();
            
            // Check if we have exactly one row
            if ($count === 1) {
                return true;
            }
        }
        
        // Not successful
        return false;
    }
}
