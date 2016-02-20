<div class="col-sm-4 col-sm-offset-2" style = "margin-top:10vh;">
  <h4>Paramètres</h4><br></br>
<form id="settings-form" method="post" action = "./settingscript.php" style="display: block;" enctype="multipart/form-data">
  <div class="form-group">
    <div class="input-group" style="width:100%;">
              <input type="text" style="width:50%;" class="form-control" placeholder = "Photo de profil" disabled="disabled">
              <span style="width:50%;" class="btn btn-default btn-file form-control">
                <span class="glyphicon glyphicon-folder-open" style="margin-right:10%;"></span>  Parcourir <input type="file">
              </span>
    </div>
  </div>
  <div class="form-group">
    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Mot de passe" required>
  </div>
  <div class="form-group">
    <input type="password" name="newpassword" id="newpassword" tabindex="2" class="form-control" placeholder="Nouveau mot de passe">
  </div>
  <div class="form-group">
    <input type="password" name="confirm" id="confirm" tabindex="2" class="form-control" placeholder="Confirmation">
    <span class="help-block" id = "info" style = "position:inherit;display:block;font-family:Sniglet;font-size:12px;"></span>
  </div>
  <div class="form-group">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <button class="form-control btn btn-submit">Modifier</button>
      </div>
    </div>
  </div>
</form>
</div>
