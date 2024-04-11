<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio PHP 004</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <h1>Conversor de Moedas v1.0</h1>
        <?php
        $dataInicio = date("m-d-Y", strtotime("- 7 days"));
        $dataFim = date("m-d-Y");
        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\'' . $dataInicio . '\'&@dataFinalCotacao=\'' . $dataFim . '\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
        $dados = json_decode(file_get_contents($url), true);
        // var_dump($dados); --> para ver o array 
        $cotacao = $dados["value"][0]["cotacaoCompra"];
        $real = $_GET["real"];
        $dolar = $real / $cotacao;
        $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
        echo "Seus " . numfmt_format_currency($padrao, $real, "BRL") . " equivalem a <strong> " . numfmt_format_currency($padrao, $dolar, "USD") . "    *</strong>";
        echo "<p> <small> *Cotação de $cotacao obtida diretamente do <a href='https://www.bcb.gov.br/'><strong>Banco Central do Brasil </strong></a>  </small></p>";
        echo "<button type='button' onclick='javascript:history.go(-1)'>Voltar</button>";
        ?>
    </main>

</body>