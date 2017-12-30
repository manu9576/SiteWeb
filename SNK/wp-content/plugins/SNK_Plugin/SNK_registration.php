<?php

Class SNK_registration
{

  private $_id,
  $_id_WP, // id de l'utilisateur de wordpress , permet de savoir quel utilisateur à creer l'enregistrement
  $_nom,
  $_prenom,
  $_adresse,
  $_codePostal,
  $_ville,
  $_telephone,
  $_email,
  $_nombreHeuresValidees;

  public function id()
  {
    return $this->_id;
  }

  public function id_WP()
  {
    return $this->_id_WP;
  }

  public function nom()
  {
    return $this->_nom;
  }

  public function prenom()
  {
    return $this->_prenom;
  }

  public function adresse()
  {
    return $this->_adresse;
  }

  public function codePostal()
  {
    return $this->_codePostal;
  }

  public function ville()
  {
    return $this->_ville;
  }

  public function telephone()
  {
    return $this->_telephone;
  }

  public function email()
  {
    return $this->_email;
  }

  public function nombreHeuresValidees()
  {
    return $this->_nombreHeuresValidees;
  }

  public function setId($id)
  {
    $id = (int) $id;

    if($id>0)
    {
      $this->_id = $id;
    }
  }

  public function setId_WP($id)
  {
    $id = (int) $id;

    if($id>0)
    {
      $this->_id_WP = $id;
    }
  }

  public function setNom($nom)
  {
    if(is_string($nom))
    {
      $this->_nom = $nom;
    }
  }

  public function setPrenom($prenom)
  {
    if(is_string($prenom))
    {
      $this->_prenom = $prenom;
    }
  }

  public function setAdresse($adresse)
  {
    if(is_string($adresse))
    {
      $this->_adresse = $adresse;
    }
  }

  public function setCodePostal($codePostal)
  {
    $codePostal = (int) $codePostal;

    if($codePostal>0)
    {
      $this->_codePostal = $codePostal;
    }
  }

  public function setVille($ville)
  {
    if(is_string($ville))
    {
      $this->_ville = $ville;
    }
  }

  public function setTelephone($phone)
  {

    if(is_string($phone))
    {
      $this->_telephone = $phone;
    }
  }


  public function setEmail($email)
  {

    if(is_string($email))
    {
      $this->_email = $email ;
    }
  }

  public function setNombreHeuresValidees($heures)
  {
    $heures = (int) $heures;

    if($heures>0)
    {
      $this->_nombreHeuresValidees = $heures;
    }
  }

  public function __construct(array $donnees)
  {
    // on fixe les valeurs par defaut
    $this->_nom = "";
    $this->_id_WP = -1;
    $this->_prenom = "";
    $this->_adresse = "";
    $this->_codePostal = 0;
    $this->_ville= "";
    $this->_telephone = "";
    $this->_email= "";
    $this->_nombreHeuresValidees = 0;

    $this->hydrate($donnees);
  }

  public function hydrate(array $donnees)
  {

    /*echo '<pre>';
    echo 'Hydrate';
    print_r ($donnees);
    echo '</pre>';*/

    foreach ($donnees as $key => $value)
    {

      // On récupère le nom du setter correspondant à l'attribut.
      $method = 'set'.ucfirst($key);
      //echo 'valid '.$method.'('.$value.')<br/>';

      // Si le setter correspondant existe.
      if (method_exists($this, $method))
      {
        //echo 'OK<br/>';
        // On appelle le setter.
        $this->$method($value);
      }
    }
  }
}
 ?>
