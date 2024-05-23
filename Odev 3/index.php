<?php

    require "libs/vars.php";
    require "libs/functions.php";  

?>

<!-- blogApp içerisinde _title.php ana sayfada görüntülenen film kadar açıklama yazsın 
ÖRN:(5 kategoriden 3 film listelenmiştir.) -->

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>

<div class="container my-3">

    <div class="row">

        <div class="col-3">
            <?php include "views/_menu.php" ?>     

            
        </div>
        <div class="col-9">

            <?php include "views/_title.php" ?>   
            <?php include "views/_blog-list.php" ?>   

        </div>    
    
    </div>

</div>

<?php include "views/_footer.php" ?>

