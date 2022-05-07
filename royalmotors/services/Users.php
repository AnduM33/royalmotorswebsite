<?php
/**
 * Lucrul cu baza de date
 */

// Set second-level namespace
// https://www.php.net/manual/ro/language.namespaces.php
namespace services;

class Users
{
    // Protected PDO variable to hold the PDO instance
    protected $pdo;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        // Get PDO connection
        $this->pdo = Database::getPDO();
    }

    /**
     * Get all users data from the database ordered ascending by last_name
     *
     * @return array Array of results
     */
    public function getAll()
    {
        // Query
        $query = "SELECT * FROM `users` ORDER BY `last_name` ASC";

        // Uncomment to enable error warnings
        // $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);

        // Prepare query (sends query to database)
        // https://www.php.net/manual/ro/pdo.prepare.php
        $statement = $this->pdo->prepare($query);
        // Run query
        // https://www.php.net/manual/ro/pdostatement.execute.php
        $statement->execute();
        
        // Count returned database rows
        $count = $statement->rowCount();

        // Check if we have exactly more than 0 rows
        if ($count > 0) {
            // Fetch data as object
            // https://www.php.net/manual/ro/pdostatement.fetchobject.php
            while ($row = $statement->fetchObject()) {
                // Create an array with autoindex which is increased on every loop
                $rows[] = $row;
            }
            
            // Return array of rows
            return $rows;
        }

        // Not successful
        return false;
    }

    /**
     * Get user by id
     *
     * @param int $user_id User ID
     * @return mixed Row object or false
     */
    public function getUser($user_id)
    {
        // Query
        $query = "SELECT * FROM `users` WHERE `user_id` = :user_id";

        // Uncomment to enable error warnings
        // $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);

        // Prepare query (sends query to database)
        // https://www.php.net/manual/ro/pdo.prepare.php
        $statement = $this->pdo->prepare($query);
        // Bind parameters to query (sends parameters to database)
        // https://www.php.net/manual/ro/pdostatement.bindparam.php
        $statement->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
        // Run query
        // https://www.php.net/manual/ro/pdostatement.execute.php
        $statement->execute();
        
        // Count returned database rows
        $count = $statement->rowCount();
        // Check if we have exactly 1 row
        if ($count === 1) {
            // Fetch data as object
            // https://www.php.net/manual/ro/pdostatement.fetchobject.php
            $row = $statement->fetchObject();

            // Return row object
            return $row;
        }

        // Not successful
        return false;
    }

    /**
     * Add user
     *
     * @param array $data POST array
     * @return bool Add result
     */
    public function addUser($data)
    {
        // Hash password to store it encrypted in the database
        // https://php.net/manual/ro/function.password-hash.php
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $query = 'INSERT INTO `users` (`first_name`, `last_name`, `email`, `username`, `password`) VALUES (:first_name,:last_name, :email, :username, :password)';

        // Uncomment to enable error warnings
        // $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
        
        // Prepare query (sends query to database)
        // https://www.php.net/manual/ro/pdo.prepare.php
        $statement = $this->pdo->prepare($query);
        
        // Bind parameters to query (sends parameters to database)
        // https://www.php.net/manual/ro/pdostatement.bindparam.php
        $statement->bindParam(':first_name', $data['first_name'], \PDO::PARAM_STR);
        $statement->bindParam(':last_name', $data['last_name'], \PDO::PARAM_STR);
        $statement->bindParam(':email', $data['email'], \PDO::PARAM_STR);
        $statement->bindParam(':username', $data['username'], \PDO::PARAM_STR);
        $statement->bindParam(':password', $password, \PDO::PARAM_STR);
        
        // Run query
        // https://www.php.net/manual/ro/pdostatement.execute.php
        if ($statement->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Edit user
     *
     * @param array $data POST array
     * @return bool Edit result
     */
    public function editUser($data)
    {
        $query = 'UPDATE `users` SET `first_name` = :first_name, `last_name` = :last_name, `email` = :email, `username` = :username WHERE `user_id` = :user_id';

        // Uncomment to enable error warnings
        // $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);

        // Prepare query (sends query to database)
        // https://www.php.net/manual/ro/pdo.prepare.php
        $statement = $this->pdo->prepare($query);

        // Bind parameters to query (sends parameters to database)
        // https://www.php.net/manual/ro/pdostatement.bindparam.php
        $statement->bindParam(':user_id', $data['user_id'], \PDO::PARAM_INT);
        $statement->bindParam(':first_name', $data['first_name'], \PDO::PARAM_STR);
        $statement->bindParam(':last_name', $data['last_name'], \PDO::PARAM_STR);
        $statement->bindParam(':email', $data['email'], \PDO::PARAM_STR);
        $statement->bindParam(':username', $data['username'], \PDO::PARAM_STR);
        
        // Run query
        // https://www.php.net/manual/ro/pdostatement.execute.php
        if ($statement->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Delete user
     *
     * @param int $user_id
     * @return bool Delete result
     */
    public function deleteUser($user_id)
    {
        $query = 'DELETE FROM `users` WHERE `user_id` = :user_id';

        // Uncomment to enable error warnings
        // $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
        
        // Prepare query (sends query to database)
        // https://www.php.net/manual/ro/pdo.prepare.php
        $statement = $this->pdo->prepare($query);
        
        // Bind parameters to query (sends parameters to database)
        // https://www.php.net/manual/ro/pdostatement.bindparam.php
        $statement->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
        
        // Run query
        // https://www.php.net/manual/ro/pdostatement.execute.php
        if ($statement->execute()) {
            return true;
        }

        return false;
    }
}
