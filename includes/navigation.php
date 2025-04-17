<?php global $_name; ?>
<nav class="navbar navbar-expand-lg bg-light navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Nots</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav" style="width:100%;">
                <li class="nav-item">
                    <a class="nav-link" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/timetable">Cours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/marks">Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/menu">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/me">Moi</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Plus</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/about">À propos de Nots</a></li>
                        <li><a class="dropdown-item" href="/logout">Déconnexion</a></li>
                    </ul>
                </li>
                <li class="nav-item" style="margin-left: auto;margin-top:7px;">
                    <span class="navbar-text"><?= $_name ?></span>
                </li>
            </ul>
        </div>
    </div>
</nav>