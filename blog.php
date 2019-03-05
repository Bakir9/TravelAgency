<?php 
	 include('db/konekcija.php');
	 if (session_status() == PHP_SESSION_NONE) {
	  session_start();
	}  
	  $query = "SELECT * FROM blog LIMIT 4"; 
      $res = mysqli_query($conn, $query);
      
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'templates/headerPage.php'; ?>
    <title>Blog</title>
</head>
<body>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
    
      
    <?php  include 'templates/header.php'; ?> 

    <div class="row">
        <div class="col s12 center-align" style="padding:0;">
            <p class="blog">BLOG</p>
        </div>
    </div>
    <div class="row">
        <?php  include 'sideMenu.php'; ?> 
        
            
        <div class="col s8" style="padding:0;">
                <?php 
                    if(mysqli_num_rows($res) > 0){
                        while( $row = mysqli_fetch_array($res)){
                            ?>
            <img src="images/<?php echo $row['slika']?>" width="900px" height="400px" alt="">
            <p class="blogTitle"><?php echo $row['naziv_bloga']?></p>
            <div class="row">
                <div class="col s2">
                    <p class="blogDatum"><?php echo $row['datum_postavljanja'] ?></p>
                </div>
                <div class="col s6" style="margin-top:8px;">
                    <p class="blogPosted">Posted by <span class="posted"> <?php echo $row['ime_korisnika']?></span></p>
                </div>
            </div>
            <div class="row" style="border-bottom: 1px solid #0277bd;">
                <div class="col s12">
                        <p class="blogText" style="margin-bottom:15px;">
                            <?php echo $row['text_bloga'] ?>
                            <a href="blogPregled.php?id=<?= $row['id_bloga'] ?>" class="blogPregled" href="blogPregled.php">Read more...</a>
                        </p>
                        
                </div>
            </div>
                    <!--
                    <div class="row" style="margin-bottom: 0;">
                        <div class="col s2">
                            <p onclick="toogle_div_fun('sekcijaKomentar')" class="comment"><i class="inline-icon material-icons">message</i>Add comment</p>
                        </div>
                    </div>
                   <div class="row" style="margin-bottom: 0; display: none;" id="sekcijaKomentar">
                        <div  class="input-field col s6" style="margin-top: 0px;">
                            <textarea id="textarea1" class="materialize-textarea"></textarea>
                            <label for="textarea1">Your Comment</label>
                        </div>
                        <div class="col s2 valign-wrapper">
                            <a class="waves-effect waves-light btn" style="margin-top: 45px;">POST</a>
                        </div>
                    </div>-->
            <?php  
                }
            }
        ?>
        </div>
        
    </div>
    
    <?php  include 'templates/footer.php'; ?> 
	
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript">
        function toogle_div_fun(id){
            var divelement = document.getElementById(id);
            if(divelement.style.display == 'none')
            divelement.style.display = 'block';
            
            else 
                divelement.style.display = 'none';
        }
    </script>
</body>
</html>