<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stream Vex</title>
  <link rel="stylesheet" href="../style/global.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      .carroselFilmes img{
        height: 60vh;
      }

      #box-title-main-inicio {
        height: 15vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      #fundoModal_registerFilme{
        z-index: 5;
        background: rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100vh;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }

      #box-form-escolhaFilmeOrSerie{
        background-color: #fff;
        width: 100%;
        max-width: 500px;
        height: 22vh;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 10px;
      }

      #box-form-escolhaFilmeOrSerie h1 {
        text-align: center;
        font-size: 1.9rem;
        margin-top: 20px;
      }

      .box-buttons-escolha {
        margin-top: 60px;
        display: flex;
        justify-content: space-around;
      }

      .box-buttons-escolha button {
        width: 130px;
        height: 50px;
        border: none;
        border-radius: 10px;
        transition: 1s;
        transform: scale(1.2);
      }

      .box-buttons-escolha button:hover {
        background-color: #4169E1;
        color: #fff;
        transition: 1s;
        transform: scale(1.2);
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


  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Stream Vex</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link cadastrarFilmes" href="#">Cadastrar Filmes/Séries</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Mais
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Filmes</a></li>
              <li><a class="dropdown-item" href="#">Séries</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Configurações</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
          <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
      </div>
    </div>
  </nav>
  <!-- NavBar do fim -->

  <main>
    <!-- Carrosel ilustrando algumas capas de filmes que temos -->
    <div id="carouselExampleCaptions" class="carousel slide carroselFilmes">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
          aria-label="Slide 4"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../images/Avatar.png" class="d-block w-100" alt="avatar">
          <div class="carousel-caption d-none d-md-block">
            <h5>Avatar - The Way of Water</h5>
          </div>
        </div>
        <div class="carousel-item">
          <img src="../images/Avangers.png" class="d-block w-100" alt="avengers">
          <div class="carousel-caption d-none d-md-block">
            <h5>Avengers - Ultimato</h5>
          </div>
        </div>
        <div class="carousel-item">
          <img src="../images/theOffice.png" class="d-block w-100" alt="office">
          <div class="carousel-caption d-none d-md-block">
            <h5>The Office</h5>
          </div>
        </div>
        <div class="carousel-item">
          <img src="../images/theLastOfUs.png" class="d-block w-100" alt="lastOfUs">
          <div class="carousel-caption d-none d-md-block">
            <h5>The Last Of Us</h5>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- Final do carrosel -->

    <div id="box-title-main-inicio">
      <h1>Conheça os filmes mais acessados</h1>
    </div>

    <!-- Essa div guarda todas as séries -->
    <div class="box-movies">
      <?php    
        require_once '../conexaoStreamVex.php';

          $sql = "SELECT titulo, nomeDiretor, classificacaoIndicativa, sinopse, genero, duracao, anoLancamento, imagem FROM filme";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

          foreach($resultados as $resultado){

              echo "<div class='card-movie'>";
              echo "<img src='../" . htmlspecialchars($resultado['imagem']) .  " ' alt='Capa do filme'>";
              echo "<h1 class='card-title'> " . htmlspecialchars($resultado['titulo']) . "</h1>";
              echo "<p>" . "<strong>Gênero: </strong>" . htmlspecialchars($resultado['genero']) . "</p>";
              echo "<p>". "<strong>Lançamento: </strong>" . htmlspecialchars($resultado['anoLancamento']) . "</p>";
              echo "<p>". "<strong>Sinopse: </strong>" . htmlspecialchars($resultado['sinopse']) . "</p>";
              echo "<p>". "<strong>Duração: </strong>" . htmlspecialchars($resultado['duracao']) . "</p>";
              echo "<p>". "<strong>Classificação: </strong>" . htmlspecialchars($resultado['classificacaoIndicativa']) . "</p>";
              echo "<p>". "<strong>Diretor: </strong>" . htmlspecialchars($resultado['nomeDiretor']) . "</p>";

              echo "<button class='btn_assistirMovie'>Assistir ao filme</button>";
              echo "</div>";
              
          }
      ?>
    </div>

    <!-- Essa div guarda todas as séries -->
    <div class="box-series">
        <?php    
          require_once '../conexaoStreamVex.php';

          $sql = "SELECT titulo, nomeDiretor, classificacaoIndicativa, sinopse,  genero, duracao, anoLancamento, imagem FROM serie";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

          foreach($resultados as $resultado){

              echo "<div class='card-serie'>";
              echo "<img src='../" . htmlspecialchars($resultado['imagem']) .  " ' alt='Capa da serie'>";
              echo "<h1 class='card-title'> " . htmlspecialchars($resultado['titulo']) . "</h1>";
              echo "<p>" . "<strong>Gênero: </strong>" . htmlspecialchars($resultado['genero']) . "</p>";
              echo "<p>". "<strong>Lançamento: </strong>" . htmlspecialchars($resultado['anoLancamento']) . "</p>";
              echo "<p>". "<strong>Sinopse: </strong>" . htmlspecialchars($resultado['sinopse']) . "</p>";
              echo "<p>". "<strong>Duração: </strong>" . htmlspecialchars($resultado['duracao']) . "</p>";
              echo "<p>". "<strong>Classificação: </strong>" . htmlspecialchars($resultado['classificacaoIndicativa']) . "</p>";
              echo "<p>". "<strong>Diretor: </strong>" . htmlspecialchars($resultado['nomeDiretor']) . "</p>";

              echo "<button class='btn_assistirMovie'>Assistir ao filme</button>";

              echo "</div>";
              

          }
      ?>
    </div>

  </main>
  <!-- Final do main -->

  <div id="fundoModal_registerFilme" class="desativarModal">

      <button class="buttonFecharModal">X</button>

      <form action="#" id="box-form-escolhaFilmeOrSerie">
        <h1>Escolha se é um filme ou série!</h1>
          <div class="box-buttons-escolha">
              <button class="escolhaFilme">Filme</button>
            <button class="escolhaSerie">Série</button>
          </div>
      </form>
  </div>

  <!-- Script de direcionamento para a page serie -->
  <script>
    //Está levando o button filme para a page filme.php
    const filmeEscolhido = document.querySelector('.escolhaFilme');

    filmeEscolhido.addEventListener('click', (e)=> {
      e.preventDefault();
      window.location.href = '../modal/filme.php';
    })
  </script>

  <!-- Script de direcionamento para a page serie -->
  <script>
    //Está levando o button serie para a page serie.php
    const serieEscolhido = document.querySelector('.escolhaSerie');

    serieEscolhido.addEventListener('click', (e)=> {
      e.preventDefault();
      window.location.href = '../modal/serie.php';
    })

  </script>

  <script>
    const btnAbrirModal = document.querySelector('.cadastrarFilmes');
    const btnFecharModal = document.querySelector('.buttonFecharModal');
    const fundoModal = document.getElementById('fundoModal_registerFilme');

    // Abrir o modal
    btnAbrirModal.addEventListener('click', (e) => {
        e.preventDefault(); // evita que o link recarregue a página
        fundoModal.classList.remove('desativarModal');
        fundoModal.classList.add('ativarModal');
    });

    // Fechar o modal
    btnFecharModal.addEventListener('click', (e) => {
        e.preventDefault();
        fundoModal.classList.remove('ativarModal');
        fundoModal.classList.add('desativarModal');
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous">
  </script>
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
    $nomeDiretor = $_POST['nomeDiretor'];
    $duracao = $_POST['duracao'];


    $pastaUpload = '../images_upload/';
    $arquivoTemporario = $_FILES['imagemFilme']['tmp_name'];
    $nomeOriginal = $_FILES['imagemFilme']['name'];
    $novoNome = uniqid() . '_' . $nomeOriginal;
    $caminhoFinal = $pastaUpload . $novoNome;


        if (move_uploaded_file($arquivoTemporario, $caminhoFinal)) {
            $caminhoImagemBanco = 'images_upload/' . $novoNome;

            $sql = "INSERT INTO filme (classificacaoIndicativa, titulo, imagem, nomeDiretor, anoLancamento, genero, sinopse, duracao) VALUES (:classificacaoIndicativa, :titulo, :imagem, :nomeDiretor, :anoLancamento, :genero, :sinopse, :duracao)";
            $stmt = $conn->prepare($sql);


            $stmt->bindParam(':classificacaoIndicativa', $classificacaoIndicativa);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':imagem', $caminhoImagemBanco);
            $stmt->bindParam(':nomeDiretor', $nomeDiretor);
            $stmt->bindParam(':anoLancamento', $anoLancamento);
            $stmt->bindParam(':genero', $genero);
            $stmt->bindParam(':sinopse', $sinopse);
            $stmt->bindParam(':duracao', $duracao);

            if ($stmt->execute()) {
                echo "<script>alert('Filme cadastrado com sucesso!'); window.location.href = 'inicio.php';</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar o filme.');</script>";
            }
        }
    }      
?>