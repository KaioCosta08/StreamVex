<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream Vex - Register Movie</title>

    <style>

    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');    


    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }

    .voltarInicio{
        width: 70px;
        height: 40px;
        border-radius: 10px;
        cursor: pointer;
        border: none;
        position: relative;
        left: 20px;
        top: 20px;
        background-color: gray;
        color: #fff;
    }

    #fundoModal_registerFilme{
        z-index: 1;
        width: 100%;
        min-height: 100vh;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, 0.8);
    }

    #modalRegisterMovie {
        box-shadow: 0 0 10px 2px black;
        background-color: #DCDCDC;
        border-radius: 10px;
        width: 100%;
        max-width: 600px;
        height: 95vh;
        padding: 20px 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        flex-direction: column;
        z-index: 10;
    } 

    .legendForm {
        font-size: 1.5rem;
        font-family: "Poppins", sans-serif;
    }

    #modalRegisterMovie input {
        margin-top: 10px;
        height: 7vh;
        padding: 10px 10px;
        border: none;
        outline: none;
        border-radius: 8px;
    }

    #modalRegisterMovie textarea {
        margin-top: 10px;
        height: 15vh;
        padding: 10px 10px;
        border: none;
        outline: none;
        border-radius: 8px;
    }

    #modalRegisterMovie select {
        margin-top: 10px;
        height: 7vh;
        padding: 10px 10px;
        border: none;
        outline: none;
        border-radius: 8px;
    }

    #modalRegisterMovie button {
        margin-top: 10px;
        height: 7vh;
        padding: 10px 10px;
        border: none;
        outline: none;
        border-radius: 8px;
        transition: 1s;
        cursor: pointer;
    }

    #modalRegisterMovie button:hover {
        background-color: #000;
        color: #fff;
        transition: 1s;
    }

    .ativarModal {
        display: block;
    }

    .desativarModal {
        display: none;
    }
    </style>

</head>
<body>
    
    <!-- Inicio do modal para cadastrar filmes -->

    <!-- Button para fechar o modal -->
    <form action="../pages/inicio.php">
        <button class="voltarInicio">Voltar</button>
    </form>

    <form action="" method="post" enctype="multipart/form-data" id="modalRegisterMovie">

      <!-- Titulo do formulário -->
      <legend class="legendForm">Cadastre a série!</legend>

      <!-- Inputs do formulário -->
      <input type="text" name="titulo" id="titulo" placeholder="Titulo">
      <input type="date" name="anoLancamento" id="anoLancamento" placeholder="Ano Lançamento">
      <input type="text" name="genero" id="genero" placeholder="Gênero">
      <textarea name="sinopse" id="sinopse" rows="30" cols="40" placeholder="Sinopse"></textarea>
      <input type="text" name="classificacaoIndicativa" id="classificacaoIndicativa" placeholder="Indicação Indicativa">
      <input type="text" name="nomeDiretor" id="nomeDiretor" placeholder="Nome do Diretor">

      <select name="temporadas" id="temporadas" class="selectSerie">

      <option value="#" selected disabled>Selecione a quantidade</option>
      <option value="#">1 temporada</option>
      <option value="#">2 temporada</option>
      <option value="#">3 temporada</option>
      <option value="#">4 temporada</option>
      <option value="#">5 temporada</option>
      <option value="#">6 temporada</option>
      <option value="#">7 temporada</option>
      <option value="#">8 temporada</option>
      <option value="#">9 temporada</option>
      <option value="#">10 temporada</option>
      <option value="#">11 temporada</option>
      <option value="#">12 temporada</option>
      <option value="#">13 temporada</option>
      <option value="#">14 temporada</option>
      <option value="#">15 temporada</option>
      <option value="#">16 temporada</option>
      <option value="#">17 temporada</option>
      <option value="#">18 temporada</option>
      </select>

      <input type="text" name="duracao" id="duracao" placeholder="Duração">
      <input type="file" name="imagemFilme" id="imagemFilme" class="buttonFile_RegisterMovie">


      <!-- Button para enviar o formulário -->
      <button type="submit" class="button-modal">Enviar</button>

    </form>

</body>
</html>


<?php
require_once "../conexaoStreamVex.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
    $anoLancamento = $_POST['anoLancamento'];
    $genero = $_POST['genero'];
    $sinopse = $_POST['sinopse'];
    $classificacaoIndicativa = $_POST['classificacaoIndicativa'];
    $temporadas = $_POST['temporadas'];
    $nomeDiretor = $_POST['nomeDiretor'];
    $duracao = $_POST['duracao'];


    $pastaUpload = '../images_upload/';
    $arquivoTemporario = $_FILES['imagemFilme']['tmp_name'];
    $nomeOriginal = $_FILES['imagemFilme']['name'];
    $novoNome = uniqid() . '_' . $nomeOriginal;
    $caminhoFinal = $pastaUpload . $novoNome;


        if (move_uploaded_file($arquivoTemporario, $caminhoFinal)) {
            $caminhoImagemBanco = 'images_upload/' . $novoNome;

            $sql = "INSERT INTO serie (classificacaoIndicativa, temporadas, titulo, imagem, nomeDiretor, anoLancamento, genero, sinopse, duracao) VALUES (:classificacaoIndicativa, :temporadas, :titulo, :imagem, :nomeDiretor, :anoLancamento, :genero, :sinopse, :duracao)";
            $stmt = $conn->prepare($sql);


            $stmt->bindParam(':classificacaoIndicativa', $classificacaoIndicativa);
            $stmt->bindParam(':temporadas', $temporadas);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':imagem', $caminhoImagemBanco);
            $stmt->bindParam(':nomeDiretor', $nomeDiretor);
            $stmt->bindParam(':anoLancamento', $anoLancamento);
            $stmt->bindParam(':genero', $genero);
            $stmt->bindParam(':sinopse', $sinopse);
            $stmt->bindParam(':duracao', $duracao);

            if ($stmt->execute()) {
                echo "<script>alert('Série cadastrado com sucesso!'); window.location.href = '../pages/inicio.php';</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar o série.');</script>";
            }
        }
    }      
?>