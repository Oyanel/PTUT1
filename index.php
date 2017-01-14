<!DOCTYPE html>
<html lang="fr">
    <?php  include_once './head.html'?>
    <body>
    <div class="background-image"></div>
        <div class="content container">
            <?php  include_once './header.html'?>
            <div class="centered container-fluid">
                <div class="row">
                    <div class="">
                        <div class="btn-group" role="group">
                            <div class="btn-group search-panel">
                                <button type="button" class="btn btn-lg btn-default">Arrondissement</button>
                                <button type="button" class="btn btn-lg btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <!-- @TODO : populate -->
                                </ul>
                            </div>
                            <div class="btn-group search-panel">
                                <button type="button" class="btn btn-lg btn-default">Station</button>
                                <button type="button" class="btn btn-lg btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <!-- @TODO : populate -->
                                </ul>
                            </div>
                            <button class="btn btn-lg btn-primary btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php  include_once './footer.html'?>
        </div>
    </body>
</html>
