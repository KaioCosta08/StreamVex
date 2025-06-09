<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stream Vex</title>
  <link rel="stylesheet" href="../style/inicio.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
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

    <!-- Essa div guarda todas as séries -->
    <div class="box-movies">

      <div class="box-title-movies">
        <legend>Confira nossos filmes!</legend>
      </div>

      <?php
      require_once '../conexaoStreamVex.php';

      $sql = "SELECT id_filme, titulo, nomeDiretor, classificacaoIndicativa, sinopse, genero, duracao, anoLancamento, imagem FROM filme";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

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


      foreach ($resultados as $resultado) {

        echo "<div class='card-movie'>";
        echo "<img src='../" . htmlspecialchars($resultado['imagem']) . " ' alt='Capa do filme'>";
        echo "<h1 class='card-title'> " . htmlspecialchars($resultado['titulo']) . "</h1>";
        echo "<p>" . "<strong>Gênero: </strong>" . htmlspecialchars($resultado['genero']) . "</p>";
        echo "<p>" . "<strong>Lançamento: </strong>" . htmlspecialchars($resultado['anoLancamento']) . "</p>";
        echo "<p>" . "<strong>Sinopse: </strong>" . htmlspecialchars($resultado['sinopse']) . "</p>";
        echo "<p>" . "<strong>Duração: </strong>" . htmlspecialchars($resultado['duracao']) . "</p>";
        echo "<p>" . "<strong>Classificação: </strong>" . htmlspecialchars($resultado['classificacaoIndicativa']) . "</p>";
        echo "<p>" . "<strong>Diretor: </strong>" . htmlspecialchars($resultado['nomeDiretor']) . "</p>";

        echo "<button class='btn_assistirMovie'>Assistir ao filme</button>";
        echo "<button class='btn_VerMais'>View more</button>";
        echo "<button class='btn_AtualizarFilme'>Atualizar filme</button>";

        // botão excluir
        echo "<form method='POST' onsubmit='confirm(\Quer mesmo excluir esse filme?\");'>";
        echo "<input type='hidden' name='id_filme' value='" . htmlspecialchars($resultado['id_filme']) . "'>";
        echo "<button class='btn_apagarFilme'>Apagar filme</button>";
        echo "</form>";
        echo "</div>";


      }
      ?>
    </div>

    <!-- Essa div guarda todas as séries -->
    <div class="box-series">
      <div class="box-title-movies">
        <legend>Confira nossos série!</legend>
      </div>
      <?php
      require_once '../conexaoStreamVex.php';

      $sql = "SELECT id_serie, titulo, nomeDiretor, temporadas, classificacaoIndicativa, sinopse,  genero, duracao, anoLancamento, imagem FROM serie";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

      ''
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

        echo "<button class='btn_assistirSerie'>Assistir a série</button>";
        echo "<button class='btn_verMaisSerie'>View more</button>";

        echo "<button class='btn_atualizarFilme'>Atualizar filme</button>";

        
        // botão excluir
        echo "<form method='POST' onsubmit='confirm(\Quer mesmo excluir essa série?\");'>";
        echo "<input type='hidden' name='id_serie' value='" . htmlspecialchars($resultado['id_serie']) . "'>";
        echo "<button class='btn_assistirMovie'>Apagar série</button>";
        echo "</form>";
        echo "</div>";

      }
      ?>
    </div>
  
  </main>
  <!-- Final do main -->

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

  <!-- Modal para assistir o filme -->
   <!-- <div id="fundoModal_VerFilme" class="desativarModal">

    <button class="buttonFecharModalFilme">X</button>

      
     <iframe width="560" height="315" 
     src="https://www.youtube.com/embed/V9jcViHHvrQ?si=-87DU3Kbq2yZNErI" 
     title="YouTube video player" 
     frameborder="0" 
     allow="accelerometer; autoplay; clipboard-write; 
     encrypted-media; gyroscope; picture-in-picture; web-share" 
     referrerpolicy="strict-origin-when-cross-origin" 
     allowfullscreen>
    </iframe>

  </div> -->
  <!-- Final do modal para assistir o filme -->

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

    <!-- Script  que abre um modal para assistir um video aleatorio-->
     <script>
        // const btnFecharModalFilme = document.querySelector('.buttonFecharModalFilme');
        // const fundoModalFilme = document.getElementById('fundoModal_VerFilme');
        // const btnAbrirModalVideo = document.querySelector('.btn_assistirMovie');

        // btnAbrirModalVideo.addEventListener('click', (e) => {
        //   e.preventDefault();
        //   fundoModalFilme.classList.remove('desativarModal');
        //   fundoModalFilme.classList.add('ativarModal');
        // });

        // btnFecharModalFilme.addEventListener('click', (e) => {
        //   e.preventDefault();
        //   fundoModalFilme.classList.remove('ativarModal');
        //   fundoModalFilme.classList.add('desativarModal');
        // });
     </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>