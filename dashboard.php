<?php
session_start();

if(!$_SESSION['logged_in']){
  header('Location: error.php');
  exit();
}
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
  <!--<div class="flex items-center justify-center h-screen bg-discord-gray flex-col">
    <div class="text-white text-3xl">Welcome to the dashboard, </div>
    <div class="flex items-center mt-4">
      <img class="rounded-full w-12 h-12 mr-3" src="<?php echo $avatar_url?>" />
      <span class="text-3xl text-white font-semibold"><?php echo $name;?></span>
    </div>
    <a href="logout.php" class="mt-5 text-gray-300">Logout</a>
  </div>-->

  <script>
    function changeTab(tabRole) {
      var i;
      var x = document.getElementsByClassName("role");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      document.getElementById(tabRole).style.display = "block";
    }
  </script>

  <div class="gallery">
    <div class="w3-bar w3-black">
      <button class="w3-bar-item w3-button" onclick="changeTab('Public')">Public</button>
      <?php
        // If proper role is set, add tabs
        //Standard role
        if ($_SESSION['roleValue'] > 0) {
          echo <<<GFG
                  <button class="w3-bar-item w3-button" onclick="changeTab('Standard')">Standard</button>
                GFG;
        }
        
        //Premium role
        if ($_SESSION['roleValue'] > 1) {
          echo <<<GFG
                  <button class="w3-bar-item w3-button" onclick="changeTab('Premium')">Premium</button>
                GFG;
        }

        //VIP role
        if ($_SESSION['roleValue'] > 2) {
          echo <<<GFG
                  <button class="w3-bar-item w3-button" onclick="changeTab('VIP')">VIP</button>
                GFG;
        }
      ?>
    </div>
    <div id="Public" class="role">
      <?php
        // (B) GET IMAGES IN GALLERY FOLDER
        $publicDir = __DIR__ . DIRECTORY_SEPARATOR . "gallery" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR;
        $publicImages = glob("$publicDir*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
      
        // (C) OUTPUT IMAGES
        foreach ($publicImages as $i) {
          printf("<img height='640'src='gallery/public/%s'>", rawurlencode(basename($i)));
        }
      ?>
    </div>
    <?php
      // If proper role is set, add tabs
      //Standard role
      if ($_SESSION['roleValue'] > 0) {
        echo <<<Standard
          <div id="Standard" class="role">
        Standard;
        
        // (B) GET IMAGES IN GALLERY FOLDER
        $standardDir = __DIR__ . DIRECTORY_SEPARATOR . "gallery" . DIRECTORY_SEPARATOR . "standard" . DIRECTORY_SEPARATOR;
        $standardImages = glob("$standardDir*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
      
        // (C) OUTPUT IMAGES
        foreach ($standardImages as $i) {
          printf("<img height='640'src='gallery/standard/%s'>", rawurlencode(basename($i)));
        }

        echo <<<Standard
          </div>
        Standard;
      }
      
      //Premium role
      if ($_SESSION['roleValue'] > 1) {
        echo <<<Premium
          <div id="Premium" class="role">
        Premium;

        // (B) GET IMAGES IN GALLERY FOLDER
        $premiumDir = __DIR__ . DIRECTORY_SEPARATOR . "gallery" . DIRECTORY_SEPARATOR . "premium" . DIRECTORY_SEPARATOR;
        $premiumImages = glob("$premiumDir*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
      
        // (C) OUTPUT IMAGES
        foreach ($premiumImages as $i) {
          printf("<img height='640' src='gallery/premium/%s'>", rawurlencode(basename($i)));
        }

        echo <<<Premium
          </div>
        Premium;
      }

      //VIP role
      if ($_SESSION['roleValue'] > 2) {
        echo <<<Vip
          <div id="VIP" class="role">
        Vip;

        // (B) GET IMAGES IN GALLERY FOLDER
        $vipDir = __DIR__ . DIRECTORY_SEPARATOR . "gallery" . DIRECTORY_SEPARATOR . "vip" . DIRECTORY_SEPARATOR;
        $vipImages = glob("$vipDir*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
      
        // (C) OUTPUT IMAGES
        foreach ($vipImages as $i) {
          printf("<img height='640'src='gallery/vip/%s'>", rawurlencode(basename($i)));
        }

        echo <<<Vip
          </div>
        Vip;
      }
    ?>
  </div>

</body>
</html>