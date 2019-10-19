<?php
include_once '../config/Connect.php';
include_once '../config/helpers.php';
include_once '../Models/GravacaoModel.class.php';

/**
 * Description of Class 
 *
 * @author André Fernandes
 */
class GravacaoRepository 
{
    private static $instance;
 
    public function __construct() {
        //
    }
 
    public static function getInstance() {
        if (!isset(self::$instance))
        {
            self::$instance = Connection::getInstance();
        }
 
        return self::$instance;
    }

    public function buscarGravacoes($request)
    {
        try 
        {
            $sql   = "SELECT id, 
                             cpf, 
                             nome, 
                             arquivo,
                             fone,
                             resultado_hora,
                             status,
                             dac_operador_nome
                        FROM gravacoes.gravacao ";
            $where = $this->montarCondicoes($request);

            $query = $this->getInstance()->prepare($sql.$where);
            
            $cpf  = $request->cpf;
            $nome = $request->nome;
            if ($this->verificaCampo($cpf)) $query->bindValue(':cpf', somenteNumeros($cpf), PDO::PARAM_STR);
            if ($this->verificaCampo($nome)) $query->bindValue(':nome', "%{$nome}%", PDO::PARAM_STR);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_CLASS, "Gravacao");
        } 
        catch (PDOException $e) 
        {
            return "Error!: " . $e->getMessage();
        }
    }

    private function montarCondicoes($request)
    {
        $cpf  = $request->cpf;
        $nome = $request->nome;
        $where  = '';
        if ($this->verificaCampo($cpf))
        {
            $where .= " WHERE cpf = :cpf";
        }
        if ($this->verificaCampo($nome))
        {
            $whereAnd = ($this->verificaCampo($cpf)) ? 'AND' : 'WHERE';
            $where .= " {$whereAnd} nome LIKE :nome";
        }
        return $where;
    }

    private function verificaCampo($campo)
    {
	return (isset($campo) && !empty($campo));
    }
}
?>
