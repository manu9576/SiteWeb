<?php


class SNK_Adm_ListeRegistrations
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
    $this->_manager = new SNK_registrationManager();
  }

  public function affichagePage()
  {
    if(isset($_POST['detail']))
    {
      $this->detail_HTML($_POST['id']);
    }
    elseif(isset($_POST['delete']))
    {
      $this->registration = $this->_manager->get((int)$_POST['id']);
      $this->_manager->delete($registration);

      $this->contenu_enregistrement_html();
    }
    elseif(isset($_POST['valider']))
    {
      $this->registration = $this->_manager->get((int)$_POST['id']);
      $this->registration->setValider(1);
      $this->_manager->addOrUpdate($this->registration);

      $this->contenu_enregistrement_html();
    }
    elseif(isset($_POST['devalider']))
    {
      $this->registration = $this->_manager->get((int)$_POST['id']);
      $this->registration->setValider(0);
      $this->_manager->addOrUpdate($this->registration);

      $this->contenu_enregistrement_html();
    }
    elseif(isset($_POST['modify']))
    {
      $this->registration = $this->_manager->get((int)$_POST['id']);
      $this->lectureChamps($_POST);
      $this->_manager->addOrUpdate($this->registration);

      $this->contenu_enregistrement_html();
    }
    else
    {
      $this->contenu_enregistrement_html();
    }
  }

  public function contenu_enregistrement_html()
  {
    $manager = new SNK_registrationManager();
    $enregistrements = $manager->getList();

    echo '<h1>'.get_admin_page_title().'</h1> </br>';

    ?>
      <style>
        #tableau
        {
          width: 80%;
        }

        #tableau th, #tableau td
        {
          padding: 3px;
          border: 1px solid #555;
          text-align: center;
        }

        #tableau th
        {
          background: #444;
          color: white;
          font-weight: bold;
        }
      </style>

      <table id="tableau">
        <thead>
          <tr>
            <th>Nom du compte</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Validation</th>
            <th></th>
          </tr>
        </thead>

        <?php
          foreach($enregistrements as $enr)
          {
            ?>
            <form action="" method="post">
              <tr>
                <td><?= $enr->getWpUserName(); ?> </td>
                <td><?= $enr->nom(); ?> </td>
                <td><?= $enr->prenom(); ?></td>
                <td><?= $enr->email(); ?></td>
                <td><?= $enr->valider() == 0 ? "En attente": "Validé"; ?></td>
                <td> <input class="button-primary" name="detail" value= "Détail" type="submit"/></td>
              </tr>

              <input name="id" value=<?= $enr->id() ?> hidden=true/>
            </form>
            <?php
          }
        ?>
      </table>
    <?php
  }


  public function detail_HTML($id)
  {

    $id = intval($id);

    if(is_int($id))
    {
      $manager = new SNK_registrationManager();
      $registration = $manager->get($id);

    ?>

    <style>
      label
      {
        width:200px;
        display: inline-block;
      }

      input
      {
        width: 200px;
      }
    </style>

    <fieldset class="">
      <h1>Detail de l'enregistrement</h1>

      <form action="" method="post">
        <p >
          <label for="nom">Nom : </label>
          <input type="text"  name="nom" id="nom" placeholder="<?= self::NOM ?>"value= "<?= htmlspecialchars($registration->nom())?>"/>
          <br>
          <label for="prenom">Prénom : </label>
          <input type="text"  name="prenom" id="prenom" placeholder="<?= self::PRENOM ?>" value= "<?= htmlspecialchars($registration->prenom())?>" />
          <br>
          <label for="adresse">Adresse : </label>
          <input type="text" name="adresse" id="adresse" placeholder="<?= self::ADRESSE ?>" value= "<?= htmlspecialchars($registration->adresse())?>" />
          <br>
          <label for="codePostal">Code postal : </label>
          <input type="number" name="codePostal" id="codePostal" value= <?= $registration->codePostal()?> />
          <br>
          <label  for="ville">Ville : </label>
          <input type="text"  name="ville" id="ville" placeholder="<?= self::VILLE ?>" value= "<?= htmlspecialchars($registration->ville())?>" />
          <br>
          <label for="telephone">Téléphone : </label>
          <input type="tel" name="telephone" id="telephone" placeholder="<?= self::TELEPHONE ?>" value= "<?= htmlspecialchars($registration->telephone())?>" />
          <br>
          <label for="form-message">Email:</label>
          <input type="email" name="email" id="email" placeholder="<?= self::EMAIL ?>" value= "<?= htmlspecialchars($registration->email())?>" />
          <br>
          <label for="nombre_heure">Nombre d'heure validées : </label>
          <input type="number" name="nombre_heure" id="nombre_heure"  value= "<?= $registration->nombreHeuresValidees()?>"/>
          <br>
          <input name="id" value=<?= $registration->id() ?> hidden=true/>
          <br>

          <?php
          if($registration->valider()== 0)
             echo '<input class="button-primary"  name="valider" value= "Valider enregistrement" type="submit"/>';
          else
            echo '<input class="button-primary"  name="devalider" value= "Retirer la validation" type="submit"/>';
          ?>

          <input class="button-primary"  name="delete" value= "Supprimer enregistrement" type="submit"/>
          <br>
          <br>
          <input class="button-primary"  name="retour" value= "Retourner à la liste" type="submit"/>
          <input class="button-primary"  name="modify" value= "Modifier enregistrement" type="submit"/>

        </p>
      </form>
    <?php
    }
    return;
  }


    public function lectureChamps($array)
    {

      if(isset($array['nom']))
          $this->registration->setNom(htmlspecialchars($array['nom']));

      if(isset($array['prenom']))
          $this->registration->setPrenom(htmlspecialchars($array['prenom']));

      if(isset($array['adresse']))
          $this->registration->setAdresse(htmlspecialchars($array['adresse']));

      if(isset($array['codePostal']))
          $this->registration->setCodePostal($array['codePostal']);

      if(isset($array['ville']))
          $this->registration->setVille(htmlspecialchars($array['ville']));

      if(isset($array['telephone']))
          $this->registration->setTelephone(htmlspecialchars($array['telephone']));

      if(isset($array['email']))
          $this->registration->setEmail(htmlspecialchars($array['email']));

      if(isset($array['nombre_heure']))
          $this->registration->setNombreHeuresValidees($array['nombre_heure']);


    }
}
?>
