<?php
include_once '../Models/GravacaoModel.class.php';
include_once '../Repositories/GravacaoRepository.php';

/**
 * Description of Class 
 *
 * @author André Fernandes
 */
class GravacaoBO
{
    public function __construct() 
    {
        
    }

    public function buscarGravacoes($request) 
    {
        $gravacaoRepository = new GravacaoRepository();
        $gravacaoLista      = $gravacaoRepository->buscarGravacoes($request);
        $arrayRetorno       = [];
        foreach ($gravacaoLista as $key => $value)
        {
            $arrayRetorno[$key]['id']                = $value->id;
            $arrayRetorno[$key]['nome']              = $value->nome;
            $arrayRetorno[$key]['cpf']               = $value->cpf;
            $arrayRetorno[$key]['arquivo']           = $value->arquivo;
            $arrayRetorno[$key]['fone']              = $value->fone;
            $arrayRetorno[$key]['resultado_hora']    = $value->resultado_hora;
            $arrayRetorno[$key]['status']            = $value->status;
            $arrayRetorno[$key]['dac_operador_nome'] = $value->dac_operador_nome;
        }
        return $arrayRetorno;
    }
}
?>