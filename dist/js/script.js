function buscarGravacoes(dataTable) {
    $.ajax({
        url: "app/Controllers/GravacaoController.php",
        type: "POST",
        dataType: 'json',
        data: {
            metodo: 'buscarGravacoes',
            cpf: $('#cpf').val(),
            nome: $('#nome').val()
        },
        success: function(response) {
            $.each(response, function(key, valor){
                var result = [];
                result.push(valor.id);
                result.push(valor.cpf);
                result.push(valor.nome);
                result.push(valor.arquivo);
                result.push(valor.fone);
                result.push(valor.resultado_hora);
                result.push(valor.status);
                result.push(valor.dac_operador_nome);

                dataTable.row.add(result);
            });
            dataTable.draw();

            $("#form-pesquisa").fadeOut('slow');
            setTimeout(function() {
                $("#table-registros").fadeIn('slow');
            }, 1000);
        }
    });
}

$(document).ready(function() {
    var dataTable = $('#table-gravacoes').DataTable({
        "oLanguage": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            }
        }
    });

    $(document).on('click', '#btn-pesquisar', function() {
        buscarGravacoes(dataTable);
    });

    $(document).on('click', '.btn-close', function() {
        $("#table-registros").fadeOut('slow');
        setTimeout(function() {
            $("#form-pesquisa").fadeIn('slow');
            dataTable.clear();
        }, 1000);
    });
});

// docs - https://fabiobmed.com.br/2012/07/16/excelente-codigo-para-mascara-e-validacao-de-cnpj-cpf-cep-data-e-telefone/
//adiciona mascara ao CPF
function MascaraCPF(cpf){
    if(mascaraInteiro(cpf)==false){
            event.returnValue = false;
    }       
    return formataCampo(cpf, '000.000.000-00', event);
}

//valida numero inteiro com mascara
function mascaraInteiro(){
    if (event.keyCode < 48 || event.keyCode > 57){
            event.returnValue = false;
            return false;
    }
    return true;
}

//formata de forma generica os campos
function formataCampo(campo, Mascara, evento) { 
    var boleanoMascara; 

    var Digitato = evento.keyCode;
    exp = /\-|\.|\/|\(|\)| /g
    campoSoNumeros = campo.value.toString().replace( exp, "" ); 

    var posicaoCampo = 0;    
    var NovoValorCampo="";
    var TamanhoMascara = campoSoNumeros.length;; 

    if (Digitato != 8) { // backspace 
            for(i=0; i<= TamanhoMascara; i++) { 
                    boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".")
                                                            || (Mascara.charAt(i) == "/")) 
                    boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(") 
                                                            || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " ")) 
                    if (boleanoMascara) { 
                            NovoValorCampo += Mascara.charAt(i); 
                              TamanhoMascara++;
                    }else { 
                            NovoValorCampo += campoSoNumeros.charAt(posicaoCampo); 
                            posicaoCampo++; 
                      }              
              }      
            campo.value = NovoValorCampo;
              return true; 
    }else { 
            return true; 
    }
}