<?php
include_once "../controller/conexao/Conexao.php";
include_once "../app/model/funcoes/produtoDao.php";
include_once "../app/model/classes/Produto.php";

//instancia as classes
$produto = new Produto();
$produtodao = new ProdutoDao();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
    <link rel="icon" href="../public/img/logo.png" >
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <title>Produtos</title>

</head>
<body>

<?php session_start(); ?>

<!-- Caixa para a mensagem de erro que pode ser sido armazenada na sessão -->
<center>
    <b>
        <?php if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            $_SESSION['msg'] = "";
        }?>
    </b>
</center>

    <div class="container">
        <div class="menu-toggle">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div class="cabecalho">
            </br>
            <p>Produtos</p>
        </div>
            <button class="botaoSair" onclick="openModal()"><i class="bi bi-box-arrow-right"></i></button>

    </div>    

    <div class="menu">
        <a href="../view/painelUser.php"><i class="bi bi-house-door d-none d-lg-block"></i> Painel</a>
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
    <div class="card-conteudo">

        <?php foreach ($produtodao->read() as $produto) : ?>
            <div class="card">
           
                <img data-label="Foto" src="<?= $produto->getFoto() ?>" alt="Imagem do Cartão 1">
                <h2 data-label="Produto"><?= $produto->getProduto() ?></h2>
                <p data-label="Preco"><?= $produto->getPreco() ?></p></br>
            
            </div>
						

        <?php endforeach ?>    
    </div>
            </div>
           
            <div class="main_footer">
                
                <p class="m-b-footer"> Sistema de Gestão - 2023, &copy todos os direitos reservados.</p> 
                <p class="by"><i class="icon icon-heart-3"></i> Desenvolvido por: <a href="https://talentosdoifsp.gru.br/inovatech/" title="INOVATECH">INOVATECH</a></p>
            
            </div>

    <script type="text/javascript">
    $("#fileFoto").change(function() {

        var formData = new FormData();
        formData.append('file', $('#fileFoto')[0].files[0]);

        $.ajax({
            url: 'upload.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                data = JSON.parse(data);
                if (data.error === 0) {
                    // Se o upload for bem-sucedido, atualiza a imagem exibida e o campo de valor da foto
                    $("#imageFoto").attr("src", data.path);
                    $("#foto").val(data.path);
                } else {
                    // Se houver um erro, exibe um alerta com a mensagem de erro
                    alert("Erro ao fazer upload da foto: " + data.message);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                // Em caso de erro na requisição AJAX, exibe um alerta com informações de erro
                alert("Erro ao fazer upload da Foto: " + status + " - " + error);
            }
        });
    });

    $(document).ready(function() {
        $(".menu1").click(function() {
            $(".keep").toggleClass("width");
        });
    });
    </script>

<!--<script  src="../js/js.js"></script>-->
    <script src="../public/js/js.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>