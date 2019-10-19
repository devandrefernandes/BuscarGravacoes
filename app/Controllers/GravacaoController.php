<?php
include_once '../BO/GravacaoBO.php';

$metodo  = filter_input(INPUT_POST, 'metodo', FILTER_SANITIZE_STRING);
$cpf     = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
$nome    = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);

$request          = new stdClass();
$request->cpf     = $cpf;
$request->nome    = $nome;

function buscarGravacoes($request) 
{
    $gravacaoBO = new GravacaoBO();
    return $gravacaoBO->buscarGravacoes($request);
}

$return = call_user_func($metodo, $request);
echo json_encode($return);
?>