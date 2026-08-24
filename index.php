<?php
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["txtNome"];
    $valorCompra = (float) $_POST["txtValorCompra"];
    $formaPagamento = $_POST["cmbPag"];

    $desconto = 0;

    if ($formaPagamento == "deposito") {
        $desconto = $valorCompra * 0.10;
        $formaPagamentoTexto = "depósito";

    } elseif ($formaPagamento == "boleto") {
        $desconto = $valorCompra * 0.08;
        $formaPagamentoTexto = "boleto";

    } elseif ($formaPagamento == "cartaoCredito") {
        $desconto = 0;
        $formaPagamentoTexto = "cartão de crédito";

    } else {
        $mensagem = "Forma de pagamento inválida.";
    }

    if ($formaPagamento != "") {

        $valorFinal = $valorCompra - $desconto;

        $valorCompraFormatado = number_format($valorCompra, 2, ',', '.');
        $descontoFormatado = number_format($desconto, 2, ',', '.');
        $valorFinalFormatado = number_format($valorFinal, 2, ',', '.');

        $mensagem = "
            <strong>Olá, $nome!</strong><br><br>
            Sua compra de <strong>R$ $valorCompraFormatado</strong>
            foi realizada com <strong>$formaPagamentoTexto</strong>.<br>
            Seu desconto é de <strong>R$ $descontoFormatado</strong>.<br>
            O valor final da compra é
            <strong>R$ $valorFinalFormatado</strong>.
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Madeira & Cia - Promoção</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f3e7d3;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 420px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        h1 {
            text-align: center;
            color: #6b4226;
            margin-bottom: 5px;
        }

        .subtitulo {
            text-align: center;
            color: #777;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
            color: #4b3425;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #c9b7a3;
            border-radius: 8px;
            font-size: 15px;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #6b4226;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #4f301d;
        }

        .resultado {
            margin-top: 20px;
            padding: 15px;
            background: #e8f5e9;
            border: 1px solid #9ccc9c;
            border-radius: 8px;
            color: #285b2a;
            line-height: 1.6;
        }

        .promocao {
            text-align: center;
            margin-top: 20px;
            color: #6b4226;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Madeira & Cia</h1>

        <p class="subtitulo">
            Promoção de Aniversário 🎉
        </p>

        <form method="POST">

            <label for="nome">Nome do cliente:</label>

            <input
                type="text"
                id="nome"
                name="txtNome"
                placeholder="Digite seu nome"
                required
            >

            <label for="valor">Valor da compra:</label>

            <input
                type="number"
                id="valor"
                name="txtValorCompra"
                placeholder="Ex: 100.00"
                step="0.01"
                min="0"
                required
            >

            <label for="pagamento">Forma de pagamento:</label>

            <select
                id="pagamento"
                name="cmbPag"
                required
            >
                <option value="">Selecione uma opção</option>
                <option value="deposito">Depósito</option>
                <option value="boleto">Boleto</option>
                <option value="cartaoCredito">
                    Cartão de crédito
                </option>
            </select>

            <button type="submit">
                Calcular desconto
            </button>

        </form>

        <?php if ($mensagem != "") { ?>

            <div class="resultado">
                <?php echo $mensagem; ?>
            </div>

        <?php } ?>

        <p class="promocao">
            Depósito: 10% de desconto |
            Boleto: 8% |
            Cartão: sem desconto
        </p>

    </div>

</body>
</html>

<!--
COMENTÁRIO REFLEXIVO

Durante o desenvolvimento do projeto, primeiro criei um formulário
para receber o nome do cliente, o valor da compra e a forma de
pagamento.

Depois analisei o código recebido e identifiquei que os valores dos
descontos de depósito e boleto estavam invertidos. Corrigi o depósito
para 10% e o boleto para 8%, mantendo o cartão de crédito sem desconto.

Também criei o cálculo do valor final da compra, subtraindo o desconto
do valor original. Para deixar os valores mais organizados, utilizei
a função number_format para exibir os preços com duas casas decimais.

Por fim, personalizei o formulário utilizando CSS e realizei testes
com as três formas de pagamento para verificar se os descontos e o
valor final estavam sendo calculados corretamente.
-->