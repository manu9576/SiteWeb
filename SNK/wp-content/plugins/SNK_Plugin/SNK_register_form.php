<?php

include_once WP_PLUGIN_DIR . '/wp-session-manager/wp-session-manager.php';
include_once plugin_dir_path( __FILE__ ).'SNK_registrationManager.php';

if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}


class SNK_register_form
{
  private $_registration;
  private $_manager;

  const NOM ="Entrez votre nom";
  const PRENOM = "Entrez votre prenom";
  const ADRESSE = "Entrez votre adresse";
  const VILLE = "Entrez votre ville";
  const TELEPHONE = "Entrez votre numéro de Téléphone";
  const EMAIL = "Entrez votre Email";

  function __construct()
  {
    add_shortcode('SNK_register_form', array($this, 'affichagePage'));
    $this->_manager = new SNK_registrationManager();
  }

  public function affichagePage()
  {
    ob_start();

    $current_user_id = get_current_user_id();

    if($current_user_id == 0)
    {
      // impossible de s'enregistrer si l'utilisateur n'est pas identifié
      $this->messageUserNonEnregistree_HTLM();
    }
    else
    {
     // recupération des information de l'enregistrement
     $this->_registration = $this->_manager->getUserRegistration();

     // lecture de tous les champs possibles lors d'un post
     $this->lectureChamps($_POST);

     if (isset($_POST['nom']))
     {
       // on vient de la page etat civil => on affiche la page formation continue
       $this->formulaireFormationContinue_HTML();
     }
     elseif(isset($_POST['soumettre']))
     {
       // on vient de la page formation continu et on a valide le formulaire
      $this->_manager->addOrUpdate($this->_registration);
      $this->confimationEnregistrement_HTML();
     }
     else
     {
       // par defaut on va sur la page Etat Civi
       // on vient de la page formation continu et on veut retourner sur la page etat civil
       $this->formulaireEtatCivil_HTML();
     }

    }

    $output_string=ob_get_contents();;
    ob_end_clean();

    return $output_string;
  }

  public function lectureChamps($array)
  {

    if(isset($array['nom']))
      $this->_registration->setNom( htmlspecialchars($array['nom']));

    if(isset($array['prenom']))
      $this->_registration->setPrenom( htmlspecialchars($array['prenom']));

    if(isset($array['adresse']))
      $this->_registration->setAdresse( htmlspecialchars($array['adresse']));

    if(isset($array['codePostal']))
      $this->_registration->setCodePostal($array['codePostal']);

    if(isset($array['ville']))
      $this->_registration->setVille( htmlspecialchars($array['ville']));

    if(isset($array['telephone']))
      $this->_registration->setTelephone( htmlspecialchars($array['telephone']));

    if(isset($array['email']))
      $this->_registration->setEmail( htmlspecialchars($array['email']));

    if(isset($array['nombre_heure']))
      $this->_registration->setNombreHeuresValidees($array['nombre_heure']);

    if(isset($_FILES['file']))
    {
      $upload_dir=wp_upload_dir()['basedir'].'/'.$this->sanatizeName($this->_registration->nom()).'/';

      if(!file_exists($upload_dir))
        mkdir($upload_dir);

      $tmp_file=$_FILES['file']['tmp_name'];
      $target_file=basename($_FILES['file']['name']);

      if(!move_uploaded_file($tmp_file, $upload_dir.($this->sanatizeName($target_file)))) //$this->_registration->nom()."/"
        echo "Erreur au chargement du fichier !!<br/>";
    }

    if(is_a($this->_registration, 'SNK_registration'))
      $this->_manager->addOrUpdate($this->_registration);

  }

  /*
    retire les caratéres ~,;[]()
    remplace les espaces par '_'
  */
  private function sanatizeName($file)
  {
    if(is_string($file))
    {
      preg_replace('/[^a-zA-Z0-9\-\._]/','', $file);
    }

    return str_replace(' ', '_', $file);

  }

  public function messageUserNonEnregistree_HTLM()
  {
    ?>
      <div class="post hentry ivycat-post" >
        <h1 class="entry-title">Enregistrement impossible.</h1>
        <p>
          Il faut être connecté sur le site pour pouvoir s'enregistrer.</br>
          Lien vers la connection du site : <a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login">Login</a>
        </p>
      </div>
    <?php
  }

  public function formulaireEtatCivil_HTML()
  {

    $readonly = ($this->_registration->valider() == 0) ?  "": "readonly";

    if($readonly == "readonly")
      echo "<h3> La modification est impossible : le formulaire a été validé par l'administrateur </h3></br>";

    ?>
    <fieldset>
      <legend>Etat Civil </legend>
      <form action="" method="post">
        <p>
          <label for="nom">Nom : </label>
          <input type="text" <?=$readonly?> name="nom" id="nom" placeholder="<?= self::NOM ?>"value= "<?= htmlspecialchars($this->_registration->nom())?>" />

          <label for="prenom">Prénom : </label>
          <input type="text" <?=$readonly?> name="prenom" id="prenom" placeholder="<?= self::PRENOM ?>" value= "<?= htmlspecialchars($this->_registration->prenom())?>" />

          <label for="adresse">Adresse : </label>
          <input type="text" <?=$readonly?> name="adresse" id="adresse" placeholder="<?= self::ADRESSE ?>" value= "<?= htmlspecialchars($this->_registration->adresse())?>" />

          <label for="codePostal">Code postal : </label>
          <input type="number" <?=$readonly?> name="codePostal" id="codePostal" value= <?= $this->_registration->codePostal()?> />

          <label for="ville">Ville : </label>
          <input type="text" <?=$readonly?> name="ville" id="ville" placeholder="<?= self::VILLE ?>" value= "<?= htmlspecialchars($this->_registration->ville())?>" />

          <label for="telephone">Téléphone : </label>
          <input type="tel" <?=$readonly?> name="telephone" id="telephone" placeholder="<?= self::TELEPHONE ?>" value= "<?= htmlspecialchars($this->_registration->telephone())?>" />

          <label for="form-message">Email:</label>
          <input type="email" <?=$readonly?> name="email" id="email" placeholder="<?= self::EMAIL ?>" value= "<?= htmlspecialchars($this->_registration->email())?>" />
        </p>
        <p>
          <input value="Formation continue" type="submit"/>
        </p>
      </form>
    </fieldset>
    <?php
    return;
  }

  public function formulaireFormationContinue_HTML()
  {

    $readonly = ($this->_registration->valider() == 0) ?  "": "readonly";
    if($readonly == "readonly")
    {
      echo "<h3> La modification est impossible : le formulaire a été validé par l'administrateur </h3></br>";
    }
    ?>

    <fieldset>
      <legend>Formation continue </legend>

      <form action="" method="post" enctype="multipart/form-data">
        <p>
          <label for="nombre_heure">Nombre d'heure validées : </label>
          <input type="number" <?=$readonly?> name="nombre_heure" id="nombre_heure"  value= "<?= $this->_registration->nombreHeuresValidees()?>"/>
          <?php
          if($readonly == "")
          {
            ?>
            <p>
		            <input type='file' name='file' id='file'>
            </p>
            <?php
          }
          ?>
        </p>
        <p>
          <input value="Etat civil" type="submit" name="etatCivil"/>
          <?php

            if($readonly == "")
              echo "<input value=\"Soummettre\" type=\"submit\" name=\"soumettre\"/>";
          ?>

        </p>
      </form>
    </fieldset>

    <?php
  }

  public function confimationEnregistrement_HTML()
  {
    ?>
    <fieldset>
      <legend>Enregistrement </legend>
      <p>
        L'enregistrement s'est bien déroulé. Vous receverez une confirmation de votre enregistrement par mail.
      </p>
    </fieldset>
    <?php
  }

  }
