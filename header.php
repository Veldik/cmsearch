<?php
echo '
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">
    <img src="/images/logo/small.png" width="40" height="40" alt="" loading="lazy">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="alert(\'soon\')">Updates</a>
      </li>
  </div>
  <form class="form-inline" action="javascript:void(0);" onsubmit="find_player()">
    <input class="form-control mr-sm-2" id="nick_search" type="search" placeholder="Jméno hráče" aria-label="Jméno hráče">
    <button class="btn btn-primary my-2 my-sm-0" type="submit">Vyhledat</button>
  </form>
</nav>
';
