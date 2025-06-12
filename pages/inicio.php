<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stream Vex</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

  <style>
      /* Isso irá ativar o modal*/
      .ativarModal {
        display: block;
      }

      /* Isso irá desativar o modal */
      .desativarModal {
        display: none;
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
        <form method="post" class="d-flex" role="search">
          <input name="pesquisar" class="form-control me-2" type="search" placeholder="Pesquisar filmes/séries"
            aria-label="Search"
            value="<?php echo isset($_POST['pesquisar']) ? htmlspecialchars($_POST['pesquisar']) : ''; ?>">
          <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
      </div>
    </div>
  </nav>
  <!-- NavBar do fim -->
  
  <?php
  
  require_once '../conexaoStreamVex.php';

  // Verifica se foi enviado um termo de pesquisa
  $termoPesquisa = isset($_POST['pesquisar']) ? trim($_POST['pesquisar']) : '';

  // Se houver termo de pesquisa, mostra apenas os resultados
  if (!empty($termoPesquisa)) {
    $termoLike = "%$termoPesquisa%";

    // Busca em filmes
    $sqlFilmes = "SELECT id_filme, titulo, nomeDiretor, classificacaoIndicativa, sinopse, genero, duracao, anoLancamento, imagem 
                        FROM filme 
                        WHERE titulo LIKE :termo OR genero LIKE :termo OR nomeDiretor LIKE :termo";
    $stmtFilmes = $conn->prepare($sqlFilmes);
    $stmtFilmes->bindParam(":termo", $termoLike, PDO::PARAM_STR);
    $stmtFilmes->execute();
    $resultadosFilmes = $stmtFilmes->fetchAll(PDO::FETCH_ASSOC);

    // Busca em séries
    $sqlSeries = "SELECT id_serie, titulo, nomeDiretor, temporadas, classificacaoIndicativa, sinopse, genero, duracao, anoLancamento, imagem 
                        FROM serie 
                        WHERE titulo LIKE :termo OR genero LIKE :termo OR nomeDiretor LIKE :termo";
    $stmtSeries = $conn->prepare($sqlSeries);
    $stmtSeries->bindParam(":termo", $termoLike, PDO::PARAM_STR);
    $stmtSeries->execute();
    $resultadosSeries = $stmtSeries->fetchAll(PDO::FETCH_ASSOC);

    // Mostra os resultados da pesquisa
    echo '<div class="box-movies">';
    echo '<div class="box-title-movies">';
    echo '<legend>Resultados da pesquisa para "' . htmlspecialchars($termoPesquisa) . '"</legend>';
    echo '</div>';

    if (!empty($resultadosFilmes) || !empty($resultadosSeries)) {
      // Mostrar filmes encontrados
      foreach ($resultadosFilmes as $resultado) {
        echo "<div class='card-movie'>";
        echo "<img src='../" . htmlspecialchars($resultado['imagem']) . "' alt='Capa do filme'>";
        echo "<h1 class='card-title'>" . htmlspecialchars($resultado['titulo']) . "</h1>";
        echo "<p><strong>Gênero: </strong>" . htmlspecialchars($resultado['genero']) . "</p>";
        echo "<p><strong>Lançamento: </strong>" . htmlspecialchars($resultado['anoLancamento']) . "</p>";
        echo "<p><strong>Sinopse: </strong>" . htmlspecialchars($resultado['sinopse']) . "</p>";
        echo "<p><strong>Duração: </strong>" . htmlspecialchars($resultado['duracao']) . "</p>";
        echo "<p><strong>Classificação: </strong>" . htmlspecialchars($resultado['classificacaoIndicativa']) . "</p>";
        echo "<p><strong>Diretor: </strong>" . htmlspecialchars($resultado['nomeDiretor']) . "</p>";
        echo "<button class='btn_assistirMovie'>Assistir ao filme</button>";

         echo "<button type='button' class='btn btn-primary btnAtualizarFilme' data-bs-toggle='modal' data-bs-target='#modalAtualizarFilme' 
                  data-id='" . htmlspecialchars($resultado['id_filme']) . "' 
                  data-titulo='" . htmlspecialchars($resultado['titulo']) . "' 
                  data-ano='" . htmlspecialchars($resultado['anoLancamento']) . "' 
                  data-genero='" . htmlspecialchars($resultado['genero']) . "' 
                  data-sinopse='" . htmlspecialchars($resultado['sinopse']) . "' 
                  data-classificacao='" . htmlspecialchars($resultado['classificacaoIndicativa']) . "' 
                  data-diretor='" . htmlspecialchars($resultado['nomeDiretor']) . "' 
                  data-duracao='" . htmlspecialchars($resultado['duracao']) . "'>Atualizar filme</button>";

        // Botão de apagar um filme
        echo "<form method='POST' onsubmit='return confirm(\"Quer mesmo excluir esse filme?\");'>";
        echo "<input type='hidden' name='id_filme_delete' value='" . htmlspecialchars($resultado['id_filme']) . "'>";
        echo "<button class='btn_apagarFilme'>Apagar filme</button>";
        echo "</form>";
      }

      // Mostrar séries encontradas
      foreach ($resultadosSeries as $resultado) {
        echo "<div class='card-serie'>";
        echo "<img src='../" . htmlspecialchars($resultado['imagem']) . "' alt='Capa da serie'>";
        echo "<h1 class='card-title'>" . htmlspecialchars($resultado['titulo']) . "</h1>";
        echo "<p><strong>Gênero: </strong>" . htmlspecialchars($resultado['genero']) . "</p>";
        echo "<p><strong>Lançamento: </strong>" . htmlspecialchars($resultado['anoLancamento']) . "</p>";
        echo "<p><strong>Sinopse: </strong>" . htmlspecialchars($resultado['sinopse']) . "</p>";
        echo "<p><strong>Duração: </strong>" . htmlspecialchars($resultado['duracao']) . "</p>";
        echo "<p><strong>Classificação: </strong>" . htmlspecialchars($resultado['classificacaoIndicativa']) . "</p>";
        echo "<p><strong>Temporadas: </strong>" . htmlspecialchars($resultado['temporadas']) . "</p>";
        echo "<p><strong>Diretor: </strong>" . htmlspecialchars($resultado['nomeDiretor']) . "</p>";
        echo "<button class='btn_assistirSerie'>Assistir a série</button>";
       
        // Botão de atualização de série
        echo "<button type='button' class='btn btn-primary btnAtualizarSerie' data-bs-toggle='modal' data-bs-target='#modalAtualizarSerie' 
                  data-id='" . htmlspecialchars($resultado['id_serie']) . "' 
                  data-titulo='" . htmlspecialchars($resultado['titulo']) . "' 
                  data-ano='" . htmlspecialchars($resultado['anoLancamento']) . "' 
                  data-genero='" . htmlspecialchars($resultado['genero']) . "' 
                  data-sinopse='" . htmlspecialchars($resultado['sinopse']) . "' 
                  data-classificacao='" . htmlspecialchars($resultado['classificacaoIndicativa']) . "' 
                  data-diretor='" . htmlspecialchars($resultado['nomeDiretor']) . "' 
                  data-duracao='" . htmlspecialchars($resultado['duracao']) . "' 
                  data-temporadas='" . htmlspecialchars($resultado['temporadas']) . "'>Atualizar série</button>";

        // botão excluir série
        echo "<form method='POST' onsubmit='return confirm(\"Quer mesmo excluir essa série?\");'>";
        echo "<input type='hidden' name='id_serie_delete' value='" . htmlspecialchars($resultado['id_serie']) . "'>";
        echo "<button class='btn_assistirMovie'>Apagar série</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
      }
    } else {
      echo '<p class="text-center">Nenhum resultado encontrado para "' . htmlspecialchars($termoPesquisa) . '"</p>';
    }
    echo '</div>';
  } else {
    //Se não houver pesquisas mostra isso aqui
  ?>

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

  <main id="area_filmes_series">

        <!-- Essa section guarda todas os filmes -->
        <section id="box-filmes">
          <?php
            require_once '../conexaoStreamVex.php';

            // Esse bloco de script tem como função excluir um determinado filme
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_filme'])) {
              if (isset($_POST['id_filme'])) {
                $id = intval($_POST['id_filme']);

                $sql = "DELETE FROM filme WHERE id_filme = :id_filme";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id_filme", $id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                  echo "<script>alert('Filme excluido com sucesso!')  window.location.href = window.location.href;</script>";
                } else {
                  echo "<script>alert('Erro ao excluir o filme.');</script>";
                }
              }

            }

            // Seleciona os dados para exibir na página
            $sql = "SELECT id_filme, titulo, nomeDiretor, classificacaoIndicativa, sinopse, genero, duracao, anoLancamento, imagem FROM filme";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Criação de um loop para colocar os filmes cadastrados e retornalos para o front-end
            foreach ($resultados as $resultado) {


              // Card do filme
              echo "<div class='card-movie'>";
              
              echo    "<img src='../" . htmlspecialchars($resultado['imagem']) . " ' alt='Capa do filme' ";
              echo    "<h1 class='title-filme'> " . htmlspecialchars($resultado['titulo']) . "</h1>";
              echo    "<p>" . "<strong>Gênero: </strong>" . htmlspecialchars($resultado['genero']) . "</p>";
              echo    "<p>" . "<strong>Lançamento: </strong>" . htmlspecialchars($resultado['anoLancamento']) . "</p>";
              echo    "<p>" . "<strong>Sinopse: </strong>" . htmlspecialchars($resultado['sinopse']) . "</p>";
              echo    "<p>" . "<strong>Duração: </strong>" . htmlspecialchars($resultado['duracao']) . "</p>";
              echo    "<p>" . "<strong>Classificação: </strong>" . htmlspecialchars($resultado['classificacaoIndicativa']) . "</p>";
              echo    "<p>" . "<strong>Diretor: </strong>" . htmlspecialchars($resultado['nomeDiretor']) . "</p>";

              echo    "<button type='button' class='buttonAssistirFilme' >Assistir o Filme</button>";
              echo "<button type='button' class='btn btn-primary btnAtualizarFilme' data-bs-toggle='modal' data-bs-target='#modalAtualizarFilme' 
                    data-id='" . htmlspecialchars($resultado['id_filme']) . "' 
                    data-titulo='" . htmlspecialchars($resultado['titulo']) . "' 
                      data-ano='" . htmlspecialchars($resultado['anoLancamento']) . "' 
                    data-genero='" . htmlspecialchars($resultado['genero']) . "' 
                    data-sinopse='" . htmlspecialchars($resultado['sinopse']) . "' 
                    data-classificacao='" . htmlspecialchars($resultado['classificacaoIndicativa']) . "' 
                    data-diretor='" . htmlspecialchars($resultado['nomeDiretor']) . "' 
                    data-duracao='" . htmlspecialchars($resultado['duracao']) . "'>Atualizar filme</button>";

              // Funcionamento do button de apagar um filme
              echo    "<form method='POST' action=''>";
              echo    "<input type='hidden' name='id_filme' value='" . htmlspecialchars($resultado['id_filme']) . "'>";
              echo    "<button class='btn_apagarFilme'>Apagar filme</button>";
              echo    "</form>";

              echo "</div>";

            }
            ?>

            <!-- Modal para atualizar o filme -->
        <div class="modal fade" id="modalAtualizarFilme" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form id="formAtualizarFilme" method="POST" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title">Atualizar Filme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id_filme" id="update_id_filme">

                <div class="mb-3">
                  <label for="update_titulo" class="form-label">Título</label>
                  <input type="text" class="form-control" id="update_titulo" name="titulo">
                </div>

                <div class="mb-3">
                  <label for="update_anoLancamento" class="form-label">Ano de Lançamento</label>
                  <input type="date" class="form-control" id="update_anoLancamento" name="anoLancamento">
                </div>

                <div class="mb-3">
                  <label for="update_genero" class="form-label">Gênero</label>
                  <input type="text" class="form-control" id="update_genero" name="genero">
                </div>

                <div class="mb-3">
                  <label for="update_duracao" class="form-label">Duração</label>
                  <input type="text" class="form-control" id="update_duracao" name="duracao">
                </div>

                <div class="mb-3">
                  <label for="update_classificacao" class="form-label">Classificação Indicativa</label>
                  <input type="text" class="form-control" id="update_classificacao" name="classificacaoIndicativa">
                </div>

                <div class="mb-3">
                  <label for="update_nomeDiretor" class="form-label">Diretor</label>
                  <input type="text" class="form-control" id="update_nomeDiretor" name="nomeDiretor">
                </div>

                <div class="mb-3">
                  <label for="update_sinopse" class="form-label">Sinopse</label>
                  <textarea class="form-control" id="update_sinopse" name="sinopse" rows="3"></textarea>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Salvar alterações</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
          </div>
        </div>
      </div>	
      </div>
        </section>


        <!-- Essa section guarda todas as séries -->
        <section id="box-series">
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
                 // Botão de atualização de série
                echo "<button type='button' class='btn btn-primary btnAtualizarSerie' data-bs-toggle='modal' data-bs-target='#modalAtualizarSerie' 
                data-id='" . htmlspecialchars($resultado['id_serie']) . "' 
                data-titulo='" . htmlspecialchars($resultado['titulo']) . "' 
                data-ano='" . htmlspecialchars($resultado['anoLancamento']) . "' 
                data-genero='" . htmlspecialchars($resultado['genero']) . "' 
                data-sinopse='" . htmlspecialchars($resultado['sinopse']) . "' 
                data-classificacao='" . htmlspecialchars($resultado['classificacaoIndicativa']) . "' 
                data-diretor='" . htmlspecialchars($resultado['nomeDiretor']) . "' 
                data-duracao='" . htmlspecialchars($resultado['duracao']) . "' 
                data-temporadas='" . htmlspecialchars($resultado['temporadas']) . "'>Atualizar série</button>";

                // Funcionamento do button de apagar um filme
                echo "<form method='POST'>";
                echo "<input type='hidden' name='id_serie' value='" . htmlspecialchars($resultado['id_serie']) . "'>";
                echo "<button class='btn_apagarFilme'>Apagar filme</button>";
                echo "</form>";
            echo "</div>";

            }
          ?>
        </section>

        <!-- Modal para atualizar as informações das séries -->
        <div class="modal fade" id="modalAtualizarSerie" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form id="formAtualizarSerie" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                  <h5 class="modal-title">Atualizar Série</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="id_serie" id="update_id_serie">

                  <div class="mb-3">
                    <label for="update_titulo_serie" class="form-label">Título</label>
                    <input type="text" class="form-control" id="update_titulo_serie" name="titulo">
                  </div>

                  <div class="mb-3">
                    <label for="update_anoLancamento_serie" class="form-label">Ano de Lançamento</label>
                    <input type="date" class="form-control" id="update_anoLancamento_serie" name="anoLancamento">
                  </div>

                  <div class="mb-3">
                    <label for="update_genero_serie" class="form-label">Gênero</label>
                    <input type="text" class="form-control" id="update_genero_serie" name="genero">
                  </div>

                  <div class="mb-3">
                    <label for="update_duracao_serie" class="form-label">Duração</label>
                    <input type="text" class="form-control" id="update_duracao_serie" name="duracao">
                  </div>

                  <div class="mb-3">
                    <label for="update_classificacao_serie" class="form-label">Classificação
                      Indicativa</label>
                    <input type="text" class="form-control" id="update_classificacao_serie"
                      name="classificacaoIndicativa">
                  </div>

                  <div class="mb-3">
                    <label for="update_nomeDiretor_serie" class="form-label">Diretor</label>
                    <input type="text" class="form-control" id="update_nomeDiretor_serie" name="nomeDiretor">
                  </div>

                  <select name="temporadas" id="temporadas" class="selectSerie">

                    <option value="#" selected disabled>Selecione a quantidade</option>
                    <option value="1 temporada">1 temporada</option>
                    <option value="2 temporada">2 temporada</option>
                    <option value="3 temporada">3 temporada</option>
                    <option value="4 temporada">4 temporada</option>
                    <option value="5 temporada">5 temporada</option>
                    <option value="6 temporada">6 temporada</option>
                    <option value="7 temporada">7 temporada</option>
                    <option value="8 temporada">8 temporada</option>
                    <option value="9 temporada">9 temporada</option>
                    <option value="10 temporada">10 temporada</option>
                    <option value="11 temporada">11 temporada</option>
                    <option value="12temporada">12 temporada</option>
                    <option value="13 temporada">13 temporada</option>
                    <option value="14 temporada">14 temporada</option>
                    <option value="15 temporada">15 temporada</option>
                    <option value="16 temporada">16 temporada</option>
                    <option value="17 temporada">17 temporada</option>
                    <option value="18 temporada">18 temporada</option>
                  </select>

                  <div class="mb-3">
                    <label for="update_sinopse_serie" class="form-label">Sinopse</label>
                    <textarea class="form-control" id="update_sinopse_serie" name="sinopse" rows="3"></textarea>
                  </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  </div>
              </form>
            </div>
          </div>
    <?php } // Fecha o else que verifica se há pesquisa ?>
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


  <!-- Script de direcionamento para a page filme -->
  <script>
    const filmeEscolhido = document.querySelector('.escolhaFilme');

    filmeEscolhido.addEventListener('click', (e) => {
      e.preventDefault();
      window.location.href = '../register/filme.php';
    })
  </script>

  <!-- Script de direcionamento para a page serie -->
  <script>

    const serieEscolhido = document.querySelector('.escolhaSerie');

    serieEscolhido.addEventListener('click', (e) => {
      e.preventDefault();
      window.location.href = '../register/serie.php';
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

  <!-- Esse script faz com que seja enviado uma mensagem ao clicar no button 
  de assistir filme -->
  <script>
    const msgAssistir = document.querySelectorAll('.buttonAssistirFilme');

    msgAssistir.forEach((msg) => {
      msg.addEventListener('click', (e)=> {
        e.preventDefault();
        alert('Esse site é ficticio. Desenvolvido para fins educacionais. Agradecemos por escolher a StreamVex!');
      })
    })
  </script>

  <script>
      // Atualizar filme
      const botoesAtualizarFilme = document.querySelectorAll('.btnAtualizarFilme');
      botoesAtualizarFilme.forEach(btn => {
        btn.addEventListener('click', () => {
          document.getElementById('update_id_filme').value = btn.dataset.id;
          document.getElementById('update_titulo').value = btn.dataset.titulo;
          document.getElementById('update_anoLancamento').value = btn.dataset.ano;
          document.getElementById('update_genero').value = btn.dataset.genero;
          document.getElementById('update_sinopse').value = btn.dataset.sinopse;
          document.getElementById('update_classificacao').value = btn.dataset.classificacao;
          document.getElementById('update_nomeDiretor').value = btn.dataset.diretor;
          document.getElementById('update_duracao').value = btn.dataset.duracao;
        });
      });

      // Atualizar série
      const botoesAtualizarSerie = document.querySelectorAll('.btnAtualizarSerie');
      botoesAtualizarSerie.forEach(btn => {
        btn.addEventListener('click', () => {
          document.getElementById('update_id_serie').value = btn.dataset.id;
          document.getElementById('update_titulo_serie').value = btn.dataset.titulo;
          document.getElementById('update_anoLancamento_serie').value = btn.dataset.ano;
          document.getElementById('update_genero_serie').value = btn.dataset.genero;
          document.getElementById('update_sinopse_serie').value = btn.dataset.sinopse;
          document.getElementById('update_classificacao_serie').value = btn.dataset.classificacao;
          document.getElementById('update_nomeDiretor_serie').value = btn.dataset.diretor;
          document.getElementById('update_duracao_serie').value = btn.dataset.duracao;
          document.getElementById('update_temporadas_serie').value = btn.dataset.temporadas;
        });
      });
    </script>

  <!-- Script do bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>

<?php
    require_once "../conexaoStreamVex.php";
    
    // atualiza filme
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_filme']) && !isset($_POST['id_serie'])) {
      $id_filme = $_POST['id_filme'];
      $titulo = $_POST['titulo'];
      $anoLancamento = $_POST['anoLancamento'];
      $genero = $_POST['genero'];
      $sinopse = $_POST['sinopse'];
      $classificacaoIndicativa = $_POST['classificacaoIndicativa'];
      $nomeDiretor = $_POST['nomeDiretor'];
      $duracao = $_POST['duracao'];

      $sql = "UPDATE filme SET
                titulo = :titulo,
                nomeDiretor = :nomeDiretor,
                anoLancamento = :anoLancamento,
                classificacaoIndicativa = :classificacaoIndicativa,
                genero = :genero,
                sinopse = :sinopse,
                duracao = :duracao";

      $sql .= " WHERE id_filme = :id_filme";

      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":titulo", $titulo);
      $stmt->bindParam(":nomeDiretor", $nomeDiretor);
      $stmt->bindParam(":anoLancamento", $anoLancamento);
      $stmt->bindParam(":classificacaoIndicativa", $classificacaoIndicativa);
      $stmt->bindParam(":genero", $genero);
      $stmt->bindParam(":sinopse", $sinopse);
      $stmt->bindParam(":duracao", $duracao);
      $stmt->bindParam(":id_filme", $id_filme);

      if ($stmt->execute()) {
        echo "<script>alert('Filme atualizado com sucesso!'); window.location.href = window.location.href;</script>";
      } else {
        echo "<script>alert('Erro ao atualizar o filme!');</script>";
      }
    }
?>

<?php
  require_once "../conexaoStreamVex.php";


    // atualiza serie
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_serie']) && !isset($_POST['id_filme'])) {
      $id_serie = $_POST['id_serie'];
      $titulo = $_POST['titulo'];
      $anoLancamento = $_POST['anoLancamento'];
      $genero = $_POST['genero'];
      $sinopse = $_POST['sinopse'];
      $classificacaoIndicativa = $_POST['classificacaoIndicativa'];
      $temporadas = $_POST['temporadas'];
      $nomeDiretor = $_POST['nomeDiretor'];
      $duracao = $_POST['duracao'];
      $caminhoImagemBanco = '';

      $sql = "UPDATE serie SET
                titulo = :titulo,
                nomeDiretor = :nomeDiretor,
                anoLancamento = :anoLancamento,
                classificacaoIndicativa = :classificacaoIndicativa,
                temporadas = :temporadas,
                genero = :genero,
                sinopse = :sinopse,
                duracao = :duracao";


      $sql .= " WHERE id_serie = :id_serie";

      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":titulo", $titulo);
      $stmt->bindParam(":nomeDiretor", $nomeDiretor);
      $stmt->bindParam(":anoLancamento", $anoLancamento);
      $stmt->bindParam(":classificacaoIndicativa", $classificacaoIndicativa);
      $stmt->bindParam(":temporadas", $temporadas);
      $stmt->bindParam(":genero", $genero);
      $stmt->bindParam(":sinopse", $sinopse);
      $stmt->bindParam(":duracao", $duracao);
      $stmt->bindParam(":id_serie", $id_serie);



      if ($stmt->execute()) {
        echo "<script>alert('Série atualizada com sucesso!'); window.location.href = window.location.href;</script>";
      } else {
        echo "<script>alert('Erro ao atualizar a série!');</script>";
      }
    }
?>