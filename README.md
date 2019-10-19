# BuscarGravacoes
Busca dos nomes dos arquivos das gravações, utilizando PHP e MySql

## Configurações
```bash
Informar os dados de conexão com o banco de dados, 
no arquivo app/config/Connect.php

Executar script de banco -> app/config/database.sql

Executar o sistema pelo localhost: http://localhost/gravacoes_algar
```
## Estrutura
```bash
Arquivo index.html requisita o o Controller da api via ajax(jquery)

Controller requisita BO(regras de negócios)

BO requisita Repository(interação com o banco de dados)

APP
  Controllers
    GravacaoController.php
  BO
    GravacaoBO.php
  Repositories
    GravacaoRepository.php
  Models
    GravacaoModel.php
