<?php

class SingletonDb {

    /**
     * @var SingletonDb
     * @access private
     * @static
     */
    private static $_instance = null;


    protected $pdo;


    public function __construct()
    {
        $configuration = new Configuration();

        $this->pdo = new PDO
        (
            $configuration->get('database', 'dsn'),
            $configuration->get('database', 'user'),
            $configuration->get('database', 'password')
        );

        $this->pdo->exec('SET NAMES UTF8');
    }


    /**
     * Méthode qui crée l'unique instance de la classe
     * si elle n'existe pas encore puis la retourne.
     *
     * @param void
     * @return Singleton
     */
    public static function getInstance() {

        if(is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function executeSQL($query, $array) {

        $query = $this->pdo->prepare($query);

        if ($query->execute($array)) {

            if ($query->columnCount()) { // Le nombre de colonnes = nature de la query (> 0 = select)
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return $query->rowCount();
            }


        } else {
            throw new DomainException(print_r($query->errorInfo(), true));
        }

    }
}