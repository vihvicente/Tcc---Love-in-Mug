<?php
include_once "../controller/conexao/Conexao.php";
include_once "../app/model/funcoes/pedidoDao.php";
include_once "../app/model/classes/Pedido.php";

//instancia as classes
$pedido = new Pedido();
$pedidodao = new PedidoDAO();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">  
    <link rel="icon" href="../public/img/logo.png" >
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Painel</title>
</head>
<body>
    
<?php session_start(); ?>

<!-- Caixa para a mensagem de erro que pode ser sido armazenada na sess찾o -->
<center>
    <b>
        <?php if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            $_SESSION['msg'] = "";
        }?>
    </b>
</center>    

    <div class="container">
    <div id="my-button" class="menu-toggle">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
    <div class="cabecalho">
        </br>
        <p>Painel de controle</p>
    </div>
    <button class="botaoSair" onclick="openModal()"><i class="bi bi-box-arrow-right"></i></button>
</div>

    <div class="menu">
        <a href="#"><i class="bi bi-house-door d-none d-lg-block"></i> Painel</a>
        <a href="../view/pedidosUser.php"><i class="bi bi-reception-3"></i> Pedidos</a>
        <a href="../view/produtosUser.php"><i class="bi bi-heart"></i> Produtos</a>
        <a href="../view/clienteUser.php"><i class="bi bi-person"></i> Cliente</a>
    </div>
    <div id="myModal" class="modal">
    <div class="modal-content">
        <p>Tem certeza de que deseja sair?</p>
        <button class="botaoCan" onclick="closeModal()">Cancelar</button>
        <button class="botaoSair" onclick="confirmExit()">Sair</button>
    </div>
</div>
    <div id="conteudo">
        <div class="atalho">
            <div class="icone">
                <img src="../public/img/imagem4.png" alt="icone de painel" >
                <a href="#"><p>Painel</p></a>
            </div>
            <div class="icone">
                <img src="../public/img/imagem1.png" alt="icone de cliente" >
                <a href="../view/clienteUser.php"><p>Cliente</p></a>
            </div>
            <div class="icone">
                <img src="../public/img/imagem2.png" alt="icone de produto">
                <a href="../view/produtosUser.php"><p>Produto</p></a>
            </div>
            <div class="icone">
                <img src="../public/img/imagem3.png" alt="icone de pedido">
                <a href="../view/pedidosUser.php"><p>Pedido</p></a>
            </div>
        </div>
        <div id="conteudo">
        <div class="iniciotable">
            <div class="titulo" style="margin-top: 3%;">
                <a href="../view/pedidos.php"><p>Últimos Pedidos</p></a>
            </div>
                <table>
                    <thead>
                        <tr style="color: #863D3D; margin-left: 10px;">
                            <th>Todos</th>
                        </tr>
                        <tr style="background: #f8f8f8; text-align: center; color: #863D3D;" >
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php foreach ($pedidodao->readIndex() as $pedido) : ?>
                                <tr >
                                    <td data-label="Data"><?= $pedido->getData() ?></td>
                                    <td data-label="Cliente"><?= $pedido->getCliente() ?></td>
                                    <td data-label="Produto"><?= $pedido->getProduto() ?></td>
                                    <td data-label="Quantidade"><?= $pedido->getQuantidade()?></td>
                                    <td data-label="Valor"><?= $pedido->getPreco()?></td>
                                    <td data-label="Status"><?= $pedido->getStatus()?></td>
                                   
                                    </td>
                                </tr>

                                
                       
                        
                            <?php endforeach ?>
                    </tbody>
                </table>
    </div>
</div>
</div>
<div class="main_footer">
        
    <p class="m-b-footer"> Sistema de Gestão - 2023, &copy todos os direitos reservados.</p> 
    <p class="by"><i class="icon icon-heart-3"></i> Desenvolvido por: <a href="https://talentosdoifsp.gru.br/inovatech/" title="INOVATECH">INOVATECH</a></p>

</div>

    <script src="../public/js/js.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>