<?php
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["txtNome"];
    $valorCompra = (float) $_POST["txtValorCompra"];
    $formaPagamento = $_POST["cmbPag"];

    $desconto = 0;
    $formaPagamentoTexto = "";

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

    if ($formaPagamentoTexto != "") {

        $valorFinal = $valorCompra - $desconto;

        $valorCompraFormatado = number_format($valorCompra, 2, ',', '.');
        $descontoFormatado = number_format($desconto, 2, ',', '.');
        $valorFinalFormatado = number_format($valorFinal, 2, ',', '.');

        $mensagem = "
            <div class='resultado-titulo'>🎉 Compra calculada!</div>

            <p>Olá, <strong>$nome</strong>!</p>

            <p>
                Sua compra de <strong>R$ $valorCompraFormatado</strong>
                foi realizada com <strong>$formaPagamentoTexto</strong>.
            </p>

            <div class='resumo'>
                <div>
                    <span>Desconto</span>
                    <strong>R$ $descontoFormatado</strong>
                </div>

                <div>
                    <span>Valor final</span>
                    <strong>R$ $valorFinalFormatado</strong>
                </div>
            </div>
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
            background:
                linear-gradient(rgba(75, 48, 29, 0.25), rgba(75, 48, 29, 0.25)),
                #d9c0a3;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 15px;
        }

        .container {
            width: 470px;
            background: #fffaf4;
            padding: 35px;
            border-radius: 24px;
            box-shadow: 0 15px 40px rgba(60, 35, 20, 0.25);
            position: relative;
            overflow: hidden;
        }

        /* Detalhes decorativos */

        .detalhe {
            position: absolute;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #ead4bb;
            opacity: 0.6;
        }

        .detalhe1 {
            top: -35px;
            left: -35px;
        }

        .detalhe2 {
            bottom: -40px;
            right: -40px;
        }

        .conteudo {
            position: relative;
            z-index: 2;
        }

        .icone {
            text-align: center;
            font-size: 42px;
            margin-bottom: 5px;
        }

        h1 {
            text-align: center;
            color: #5a351f;
            margin: 0;
            font-size: 32px;
        }

        .subtitulo {
            text-align: center;
            color: #806650;
            margin-top: 8px;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .faixa {
            background: #6b4226;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-weight: bold;
            font-size: 14px;
        }

        label {
            display: block;
            margin-top: 16px;
            margin-bottom: 7px;
            font-weight: bold;
            color: #4b3425;
        }

        input,
        select {
            width: 100%;
            padding: 13px;
            border: 1px solid #cbb59d;
            border-radius: 10px;
            font-size: 15px;
            background: white;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #8b5e3c;
            box-shadow: 0 0 0 3px rgba(139, 94, 60, 0.12);
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #6b4226;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #4f301d;
            transform: translateY(-1px);
        }

        /* Cartões de desconto */

        .descontos {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .card {
            flex: 1;
            text-align: center;
            padding: 13px 7px;
            border-radius: 12px;
            background: #f0e1d0;
            border: 1px solid #dec8ae;
        }

        .card .porcentagem {
            font-size: 22px;
            font-weight: bold;
            color: #6b4226;
        }

        .card small {
            display: block;
            margin-top: 4px;
            color: #654b38;
            font-size: 12px;
        }

        /* Resultado */

        .resultado {
            margin-top: 25px;
            padding: 20px;
            background: #edf6ee;
            border: 1px solid #a9c9aa;
            border-radius: 14px;
            color: #315d35;
            line-height: 1.6;
        }

        .resultado-titulo {
            font-size: 19px;
            font-weight: bold;
            color: #315d35;
            margin-bottom: 10px;
        }

        .resumo {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .resumo div {
            flex: 1;
            background: white;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
        }

        .resumo span {
            display: block;
            font-size: 12px;
            color: #777;
        }

        .resumo strong {
            display: block;
            color: #315d35;
            font-size: 17px;
            margin-top: 3px;
        }

        .rodape {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #8a7563;
        }

    </style>

</head>

<body>

    <div class="container">

        <div class="detalhe detalhe1"></div>
        <div class="detalhe detalhe2"></div>

        <div class="conteudo">

            <div class="icone">🪵</div>

            <h1>Madeira & Cia</h1>

            <p class="subtitulo">
                Promoção especial de aniversário 🎉
            </p>

            <div class="faixa">
                🎁 Aproveite nossos descontos!
            </div>

            <form method="POST">

                <label for="nome">
                    Nome do cliente:
                </label>

                <input
                    type="text"
                    id="nome"
                    name="txtNome"
                    placeholder="Digite seu nome"
                    required
                >

                <label for="valor">
                    Valor da compra:
                </label>

                <input
                    type="number"
                    id="valor"
                    name="txtValorCompra"
                    placeholder="Ex: 100.00"
                    step="0.01"
                    min="0"
                    required
                >

                <label for="pagamento">
                    Forma de pagamento:
                </label>

                <select
                    id="pagamento"
                    name="cmbPag"
                    required
                >

                    <option value="">
                        Selecione uma opção
                    </option>

                    <option value="deposito">
                        💰 Depósito
                    </option>

                    <option value="boleto">
                        🧾 Boleto
                    </option>

                    <option value="cartaoCredito">
                        💳 Cartão de crédito
                    </option>

                </select>

                <button type="submit">
                    Calcular desconto ✨
                </button>

            </form>


            <div class="descontos">

                <div class="card">
                    <div class="porcentagem">10%</div>
                    <small>Depósito</small>
                </div>

                <div class="card">
                    <div class="porcentagem">8%</div>
                    <small>Boleto</small>
                </div>

                <div class="card">
                    <div class="porcentagem">0%</div>
                    <small>Cartão</small>
                </div>

            </div>


            <?php if ($mensagem != "") { ?>

                <div class="resultado">

                    <?php echo $mensagem; ?>

                </div>

            <?php } ?>


            <div class="rodape">
                Madeira & Cia • Promoção de Aniversário 🎈
            </div>

        </div>

    </div>

</body>

</html>

<!--

COMENTÁRIO REFLEXIVO

Nesse projeto eu comecei criando o formulário para o cliente
informar o nome, o valor da compra e escolher a forma de pagamento.

Depois de analisar o código que foi passado, percebi que os
descontos do depósito e do boleto estavam trocados. Então corrigi
o depósito para 10% e o boleto para 8%, deixando o cartão de
crédito sem desconto.

Também coloquei o cálculo do valor final, diminuindo o desconto
do valor original da compra. Usei o number_format para deixar os
valores certinhos com duas casas decimais.

Depois fiz a parte visual do formulário usando HTML e CSS.
Tentei deixar o site mais organizado e com uma aparência de
promoção, colocando os cartões com os descontos, emojis e alguns
detalhes para deixar a página mais bonita.

Por último, fiz os testes com depósito, boleto e cartão de
crédito para conferir se cada desconto e o valor final estavam
sendo calculados corretamente.

-->