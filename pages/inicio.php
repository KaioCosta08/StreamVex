<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stream Vex</title>
    <link rel="stylesheet" href="../style/global.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>
    

    <!-- NavBar do inicio -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Stream Vex</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Configurações</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search"/>
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
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
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
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- Final do carrosel -->

<div id="box-title-main-inicio">
  <h1>Conheça nossos filmes e séries</h1>
</div>



</main>
<!-- Final do main -->


<!-- Inicio do modal para cadastrar filmes -->
<div id="fundoModal_registerFilme" class="desativarModal">

  <button class="buttonFecharModal">X</button>

  <form action="" method="post" id="modalRegisterMovie">
    <legend>Cadastre um filme ou série</legend>
    <input type="text" name="genero" id="genero" placeholder="Titulo">
    <input type="date" name="anoLancamento" id="anoLancamento" placeholder="Titulo">
    <textarea name="sinopse" id="sinopse" rows="5" cols="40" placeholder="Sinopse"></textarea>
    <input type="number" name="duracao" id="duracao" placeholder="Duração">
    <input type="file" name="imagemFilme" id="imagemFilme" class="buttonFile_RegisterMovie">

    <button type="submit" class="button-modal">Enviar</button>
  </form>
</div>
    <script src="../script/modal_inicio.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>