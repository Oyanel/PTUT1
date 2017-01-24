<!DOCTYPE html>
<html lang="fr">
<?php include_once './includes/head.php' ?>
<body>
<div class="background-image container-fluid"></div>
<div class="content container-fluid">
    <?php include_once './includes/header.html' ?>
    <div class="centered container-fluid">
        <h1 class="h1">Où allons nous ?</h1>
        <div class="row">
            <div class="">
                <div class="btn-group" role="group">
                    <div class="btn-group search-panel">
                        <button type="button" class="btn btn-lg btn-default material_button filter_commune">Commune&nbsp;/&nbsp;Arrondissement</button>
                        <button type="button" class="btn btn-lg btn-primary dropdown-toggle material_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu filter_commune" role="menu">
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <!-- @TODO : populate -->
                        </ul>
                    </div>
                    <div class="btn-group search-panel">
                        <button type="button" class="btn btn-lg btn-default material_button filter_station">Station</button>
                        <button type="button" class="btn btn-lg btn-primary dropdown-toggle material_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu filter_station" role="menu">
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <li><a href="#">hello</a></li>
                            <!-- @TODO : populate -->
                        </ul>
                        <button class="btn btn-lg btn-primary btn-default material_button submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once './includes/footer.php' ?>
</div>
</body>
</html>
