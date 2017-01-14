<footer>
    <div class="<?php if(!preg_match('/liste.php$/' , "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")) echo 'navbar-fixed-bottom panel-footer'; ?>">
        <p class="navbar-header">
            Veleov project
        </p>
        <img class="navbar-right polytech" src="./media/images/polytech_logo.png">
        </img>
    </div>
</footer>

<script src="style/js/bootstrap.min.js"></script>
<script src="style/js/functions.js"></script>
<?php if(preg_match('/graph.php$/' , "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")) : ?>
    <!-- <script src="style/js/graph.js"></script> -->
<?php endif; ?>

<?php if(preg_match('/liste.php$/' , "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")) : ?>
    <script src="style/js/donnees.js"></script>
<?php endif; ?>
