<script src="style/js/bootstrap.min.js"></script>
<script src="style/js/donnees.js"></script>
<script src="style/js/functions.js"></script>
<?php if(preg_match('/graph.php$/' , "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")) : ?>
    <script src="style/js/graph.js"></script>
<?php endif; ?>
<?php if(preg_match('/map.php$/' , "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")) : ?>
    <script src="style/js/map.js"></script>
<?php endif; ?>