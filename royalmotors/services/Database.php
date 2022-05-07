<?php
/**
 * Connect to database using PDO
 * This class must be singleton to be able to share the database connection
 * See: https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
 */

// Set second-level namespace
// https://www.php.net/manual/ro/language.namespaces.php
namespace services;

class Database
{
    // Protected variable to hold the class instance
    protected static $instance = null;
    // Public PDO variable to hold the PDO instance
    public static $pdo;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        // Define server type, database name, host, username, password
        $connection = 'mysql:dbname=' . DB_DATABASE . ';host=' . DB_HOST;
        $user = DB_USERNAME;
        $password = DB_PASSWORD;
        
        // Try to connect and catch errors (like in Java)
        try {
            // Self Instantiate PDO
            // https://www.php.net/manual/ro/book.pdo.php
            self::$pdo = new \PDO($connection, $user, $password);
            // Catch error
            // PDOException: https://www.php.net/manual/ro/class.pdoexception.php
        } catch (PDOException $error) {
            return $error->getMessage();
        }
    }
    
    /**
     * Instantiate PDO
     *
     * @return void
     */
    public static function getPDO()
    {
        // The object is created from within the class itself, only if the class in not yet instantiated
        if (self::$instance === null) {
            self::$instance = new Database;
        }
        return self::$pdo;
    }
}
