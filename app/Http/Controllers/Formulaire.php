<?php

class Formulaire {

    public function input($label, $type, $valeur, $name){  ?>
   
        <div class="form-group">
            <b><?= $label ?></b>
            <input class="form-control" required type="<?= $type ?>" value="<?= $valeur ?>" name="<?= $name ?>">
        </div>
  <?php  }

}

