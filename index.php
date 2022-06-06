<?php
    include('bdd/cnxion.php');
    if(isset($_POST['first_name'],$_POST['last_name'],$_POST['sexe'],$_POST['phone'],$_POST['address'],$_POST['mail'],$_POST['password'])){
      $no=(string)htmlspecialchars($_POST['first_name']);
      $pr=(string)htmlspecialchars($_POST['last_name']);
      $sx=(string)htmlspecialchars($_POST['sexe']);
      $ph=(string)htmlspecialchars($_POST['phone']);
      $ad=(string)htmlspecialchars($_POST['address']);
      $ml=(string)htmlspecialchars($_POST['mail']);
      $pw=(string)htmlspecialchars($_POST['password']);

     
      if(!empty($no)and!empty($pr)and!empty($sx)and!empty($ph)and!empty($ad)and!empty($ml)and!empty($pw)){
          $mel = $cnx->prepare("SELECT * from etudiants where mail = ?");
                 $mel->execute(array($ml));
          $melExist = $mel->rowcount();
          if($melExist==0){
              $req = $cnx->prepare("INSERT into etudiants values (null,?,?,?,?,?,?,?)");
              $resisOk = $req->execute(array($no,$pr,$sx,$ph,$ad,$ml,$pw));
                  if($resisOk){
                      $msg ="l'etudiant a bien ete enregistré dans la base de donnée";
                  }else{
                      $msg =" insertion érronnée";
                  }
          }else{
              $msg="cette adresse mail existe deja dans la base de donnée";
          }
      }else{
          $msg = "veuillez remplir les champs vides!!!";
      }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <title>inscription</title>
  </head>
  <body>
    <?php
    require_once('menu.php')
    ?>
    <h5 class="text-center" style="color:purple"><?= $msg ?></h5>
    <br>
    <div class="col-md-12" >
      <h1 class="text-center">insertion d'étudiants</h1>
    </div>
    <hr>
    <form method="post" action="">
    <div align ="center">
    <div class="col-md-2 mb-1"> 
      <input type="text" class="form-control"  placeholder="first_name" name="first_name" >  
    </div>
    <div class="col-md-2 mb-1"> 
      <input type="text" class="form-control"  placeholder="last_name" name="last_name" >  
    </div>
    <div class="col-md-2 mb-1"> 
      <select name="sexe" type="text" class="form-control" placeholder="sexe">
        <option value="H">H</option>
        <option value="F">F</option>
      </select>  
    </div>
    <div class="col-md-2 mb-1"> 
      <input type="int" class="form-control"  placeholder="phone" name="phone" >  
    </div>
    <div class="col-md-2 mb-1"> 
      <input type="int" class="form-control"  placeholder="address" name="address" >  
    </div>
    <div class="col-md-2 mb-1"> 
      <input type="email" class="form-control"  placeholder="email" name="mail" >  
    </div>
    <div class="col-md-2 mb-3">
      <input type="password" class="form-control"  placeholder="password" name="password" >
    </div>
    <div class="form-group">
      <button class="btn btn-primary" type="submit">enregistrer</button>
      <a href="liste.php">
        <button class="btn btn-success" type="button">voir liste des etudiants</button>
      </a>
    </div>
  </form>
  <label for="input" class="col-sm-2 control-label">genre</label>
  <div class="col-sm-10">
    <label>
      <input type="radio" name="gender" id="optionsradios" value="H" checked>Homme
    </label>
    <label>
      <input type="radio" name="gender" id="optionsradios" value="H" checked>Femme
    </label>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>