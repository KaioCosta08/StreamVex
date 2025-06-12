<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stream Vex</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

  <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      #body_inicio{
        background-color: #050505;
      }

       
      .carroselFilmes img{
        height: 60vh;
      }

      #box-title-main-inicio {
        height: 15vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: #fff;
      }

      .buttonFecharModal{
        width: 30px;
        height: 30px;
        background-color: red;
        border-radius: 50%;
        border: none;
        position: relative;
        top: 10px;
        left: 20px;
        color: #fff;
        text-align: center;
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

      /* Isso irá ativar o modal de escolha de cadastro de filme ou série */
      .ativarModal {
        display: block;
      }

      /* Isso irá desativar o modal de escolha de cadastro de filme ou série */
      .desativarModal {
        display: none;
      }

      /* Caixa de tilte  */
      .filmes-box {
        margin-top: 10px;
        text-align: center;
      }

      .series-box {
        margin-top: 10px;
        text-align: center;
      }

      .filmes-box legend{
        font-family: 'Poppins', sans-serif;
        color: white;
        text-transform: uppercase;
        font-weight: 600;
        font-style: oblique;
        font-size: 3.1rem;
      }

      .series-box legend{
        font-family: 'Poppins', sans-serif;
        color: white;
        text-transform: uppercase;
        font-weight: 600;
        font-style: oblique;
        font-size: 3.1rem;
      }

      .linha-red{
        width: 250px;
        height: 4px;
        background-color: red;
        margin: 0 auto;
      }

      /* Imagem do filme/série */
  .fotoFilme {
    width: 100%;
    height: 300px; /* Tamanho fixo para uniformidade */
    object-fit: cover;
    border-radius: 10px;
  }

  /* Card base */
  .card-movie,
  .card-serie {
    background-color: #800000;
    font-family: 'Poppins', sans-serif;
    color: #fff;
    padding: 20px;
    border-radius: 15px;
    width: 100%;
    max-width: 400px;
    min-height: 750px; /* Altura fixa para consistência */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Espaça melhor o conteúdo */
    box-sizing: border-box;
  }

  /* Título do card */
  .card-title {
    font-size: 1.8rem;
    margin: 10px 0;
    text-align: center;
  }

  /* Texto dos detalhes */
  .card-movie p,
  .card-serie p {
    font-size: 0.95rem;
    line-height: 1.4;
    margin: 4px 0;
  }

  /* Botões */
  .buttonAssistirFilme,
  .buttonAtualizarFilme,
  .btn_apagarFilme {
    padding: 10px;
    border: none;
    border-radius: 8px;
    font-size: 0.95rem;
    cursor: pointer;
    margin-top: 10px;
    width: 100%;
    transition: background-color 0.2s ease;
  }

  .buttonAssistirFilme {
    background-color: #28a745;
    color: white;
  }

  .buttonAssistirFilme:hover {
    background-color: #218838;
  }

  .buttonAtualizarFilme {
    background-color: #007bff;
    color: white;
  }

  .buttonAtualizarFilme:hover {
    background-color: #0056b3;
  }

  .btn_apagarFilme {
    background-color: #dc3545;
    color: white;
  }

  .btn_apagarFilme:hover {
    background-color: #c82333;
  }

  /* Corrige form para alinhar botão */
  form {
    margin: 0;
  }

  /* Containers das seções */
  #box-filmes,
  #box-serie {
    display: flex;
    flex-wrap: nowrap;
    gap: 30px;
    overflow-x: auto;
    padding: 20px;
    box-sizing: border-box;
  }

  /* Scroll horizontal estilizado (opcional) */
  #box-filmes::-webkit-scrollbar,
  #box-serie::-webkit-scrollbar {
    height: 8px;
  }

  #box-filmes::-webkit-scrollbar-thumb,
  #box-serie::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.3);
    border-radius: 4px;
  }


  </style>

</head>

<body id="body_inicio">

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
        <input name="pesquisar" class="form-control me-2" type="search" placeholder="Pesquisar filmes/séries" 
                 aria-label="Search" value="<?php echo isset($_POST['pesquisar']) ? htmlspecialchars($_POST['pesquisar']) : ''; ?>">
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

  
  </main>
  <!-- Final do main -->

    <main style="width: 100%; max-width: 1800px; margin: 0 auto;">

        <div class="filmes-box">
          <legend>Confira nossos filmes!</legend><br>
          <div class="linha-red"></div>
        </div>

        <!-- Essa div guarda todas os filmes -->
        <section id="box-filmes">

          <?php
            require_once '../conexaoStreamVex.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_filme'])) {
              if (isset($_POST['id_filme'])) {
                $id = intval($_POST['id_filme']);

                $sql = "DELETE FROM filme WHERE id_filme = :id_filme";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id_filme", $id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                  echo "<script>alert('Filme excluido com sucesso!');</script>";
                } else {
                  echo "<script>alert('Erro ao excluir o filme.');</script>";
                }
              }

            }

            $sql = "SELECT id_filme, titulo, nomeDiretor, classificacaoIndicativa, sinopse, genero, duracao, anoLancamento, imagem FROM filme";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            


            foreach ($resultados as $resultado) {

              // Card criado com php dentro do carrosel do bootstrap

              echo "<div class='card-movie'>";
              
              echo    "<img src='../" . htmlspecialchars($resultado['imagem']) . " ' alt='Capa do filme' class='fotoFilme'>";
              echo    "<h1 class='card-title'> " . htmlspecialchars($resultado['titulo']) . "</h1>";
              echo    "<p>" . "<strong>Gênero: </strong>" . htmlspecialchars($resultado['genero']) . "</p>";
              echo    "<p>" . "<strong>Lançamento: </strong>" . htmlspecialchars($resultado['anoLancamento']) . "</p>";
              echo    "<p>" . "<strong>Sinopse: </strong>" . htmlspecialchars($resultado['sinopse']) . "</p>";
              echo    "<p>" . "<strong>Duração: </strong>" . htmlspecialchars($resultado['duracao']) . "</p>";
              echo    "<p>" . "<strong>Classificação: </strong>" . htmlspecialchars($resultado['classificacaoIndicativa']) . "</p>";
              echo    "<p>" . "<strong>Diretor: </strong>" . htmlspecialchars($resultado['nomeDiretor']) . "</p>";

              echo    "<button type='button' class='buttonAssistirFilme' >Assistir o Filme</button>";
              echo    "<button type='button' class='buttonAtualizarFilme'>Atualizar filme</button>";

                      // Funcionamento do button de apagar um filme
              echo    "<form method='POST' onsubmit='return confirm('Quer mesmo excluir esse filme?');'>";
              echo    "<input type='hidden' name='id_filme' value='" . htmlspecialchars($resultado['id_filme']) . "'>";
              echo    "<button class='btn_apagarFilme'>Apagar filme</button>";
              echo    "</form>";

              echo "</div>";

            }
            ?>

        </section>




        <!-- Essa div guarda todas as séries -->
        <div class="series-box">
          <legend>Confira nossas séries!</legend>
          <div class="linha-red"></div>
        </div><br>

        <section id="box-serie">
          <?php
          require_once '../conexaoStreamVex.php';

          if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_serie'])) {
            if (isset($_POST['id_serie'])) {
              $id = intval($_POST['id_serie']);

              $sql = "DELETE FROM serie WHERE id_serie = :id_serie";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(":id_serie", $id, PDO::PARAM_INT);

              if ($stmt->execute()) {
                echo "<script>alert('Filme excluido com sucesso!');</script>";
              } else {
                echo "<script>alert('Erro ao excluir o filme.');</script>";
              }
            }

          }

          $sql = "SELECT id_serie, titulo, nomeDiretor, temporadas, classificacaoIndicativa, sinopse,  genero, duracao, anoLancamento, imagem FROM serie";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

          
          foreach ($resultados as $resultado) {

            echo "<div class='card-serie'>";
            echo "<img src='../" . htmlspecialchars($resultado['imagem']) . " ' alt='Capa da serie'>";
            echo "<h1 class='card-title'> " . htmlspecialchars($resultado['titulo']) . "</h1>";
            echo "<p>" . "<strong>Gênero: </strong>" . htmlspecialchars($resultado['genero']) . "</p>";
            echo "<p>" . "<strong>Lançamento: </strong>" . htmlspecialchars($resultado['anoLancamento']) . "</p>";
            echo "<p>" . "<strong>Sinopse: </strong>" . htmlspecialchars($resultado['sinopse']) . "</p>";
            echo "<p>" . "<strong>Duração: </strong>" . htmlspecialchars($resultado['duracao']) . "</p>";
            echo "<p>" . "<strong>Classificação: </strong>" . htmlspecialchars($resultado['classificacaoIndicativa']) . "</p>";
            echo "<p>" . "<strong>Temporadas: </strong>" . htmlspecialchars($resultado['temporadas']) . "</p>";
            echo "<p>" . "<strong>Diretor: </strong>" . htmlspecialchars($resultado['nomeDiretor']) . "</p>";

          echo "<button type='button' class='buttonAssistirFilme'>Assistir o Filme</button>";
          echo "<button type='button' class='buttonAtualizarFilme'>Atualizar filme</button>";

          // Funcionamento do button de apagar um filme
          echo "<form method='POST' onsubmit='return confirm(\Quer mesmo excluir esse filme?\");'>";
          echo "<input type='hidden' name='id_serie' value='" . htmlspecialchars($resultado['id_serie']) . "'>";
          echo "<button class='btn_apagarFilme'>Apagar filme</button>";
          echo "</form>";

            }
          ?>
        </section>
  </main>

  <!-- Modal de escolha de cadastro (Filme ou série) -->
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
  <!-- Fim do modal de escolha de cadastro (Filme ou série) -->

  <!-- Script de direcionamento para a page serie -->
  <script>
    //Está levando o button filme para a page filme.php
    const filmeEscolhido = document.querySelector('.escolhaFilme');

    filmeEscolhido.addEventListener('click', (e) => {
      e.preventDefault();
      window.location.href = '../modal/filme.php';
    })
  </script>

  <!-- Script de direcionamento para a page serie -->
  <script>
    //Está levando o button serie para a page serie.php
    const serieEscolhido = document.querySelector('.escolhaSerie');

    serieEscolhido.addEventListener('click', (e) => {
      e.preventDefault();
      window.location.href = '../modal/serie.php';
    })

  </script>

    <!-- Script que faz com que o modal de opção abra -->
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
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>