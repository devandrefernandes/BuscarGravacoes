<?php

/**
 * Description of Class
 *
 * @author André Fernandes
 */
class Gravacao {
	
    private $id;
    private $cpf;
    private $nome;
    private $arquivo;
    
    public function __set($attribute, $value) {
        $this->$attribute = $value;
    }

    public function __get($attribute) {
        return $this->$attribute;
    }
}

?>