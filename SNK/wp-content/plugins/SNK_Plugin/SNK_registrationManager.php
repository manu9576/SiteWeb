<?php

class SNK_registrationManager
{
  const NOM_SESSION = 'formulaire';



  // Fonction qui donne le nombre d'enregistrement dans la base de donnée
  public function count()
  {
    global $wpdb;

    return $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}SNK_registrations" );
  }

  // Fonction qui supprime un enregistremenrt de la base de donnés
  public function delete(SNK_registration $registration)
  {
    global $wpdb;

    $wpdb->query("DELETE FROM {$wpdb->prefix}SNK_registrations WHERE id = " . $registration->id());
  }

  // fonction qui precise si un enregistrement est dans la base de données
  // Arguement : id si INT et nom si string
  public function exists($idOuNom)
  {
    global $wpdb;

    if(is_int($idOuNom))
    {
      return (bool) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}SNK_registrations WHERE id = ".$idOuNom);
    }

    return (bool) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}SNK_registrations WHERE nom = ".$idOuNom);

  }

  //revoie l'enregistrement dont le nom correspond
  public function get($idOuNom)
  {
    global $wpdb;

    if(is_int($idOuNom))
    {
      $res = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}SNK_registrations WHERE id=" .$idOuNom ,ARRAY_A);
      return new SNK_registration($res[0]);
    }

    $res = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}SNK_registrations WHERE nom=" .$idOuNom ,ARRAY_A);
    return new SNK_registration($res[0]);
  }


  // fonction qui renvoi l'enregistrement :
  // 1 - si un enregistrement est présent dans la variable session, on utilise celui-ci
  // 2 - si l'utilisateur est logge:
  //        a - on récupère le l'enregistrement de la base de données
  //        b - si null on cree un nouvel enregistrement
  public function getUserRegistration()
  {
    $wp_session = WP_Session::get_instance();

    if (!empty( $wp_session[self::NOM_SESSION] ) ) // Si la session perso existe, on restaure l'objet.
    {
      //  echo 'recupération  par la session';
      $this->_registration =  $wp_session[self::NOM_SESSION];
    }
    else
    {
      $userWP_id = get_current_user_id();
      $manager = new SNK_registrationManager();

      $this->_registration = $manager->getByIdWP($userWP_id);

      if(is_null($this->_registration ) || !is_a($this->_registration ,'SNK_registration') )
      {
        // echo 'Nouvel enregistrement : is null <br/>' . is_null($this->_registration );
        // echo 'Nouvel enregistrement : is_a <br/>' . !is_a($this->_registration ,'SNK_registration');

        $current_user = wp_get_current_user();

        $this->_registration = new SNK_registration(['nom'=> $current_user->user_firstname,
        'prenom' => $current_user->user_lastname, 'email'=> $current_user->user_email, 'id_WP' => $userWP_id]);
      }

      // echo 'info registration : ' .$this->_registration->id_WP() . ' <br/>';

      $wp_session[self::NOM_SESSION] = $this->_registration;

    }
    return $this->_registration;
  }

  // renvoi la liste des enregistrement
  public function getList()
  {
    global $wpdb;

    $enregistrements = [];

    $res = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}SNK_registrations ORDER BY nom",ARRAY_A);

    foreach ($res as $line)
    {
      $enregistrements[] = new SNK_registration($line);
    }

    return $enregistrements;

  }

  // MAJ ou ajout d'un enregistrement dans la base
  public function addOrUpdate(SNK_registration $registration)
  {
    if($this->exists($registration->id()))
    {
      $this->update($registration);
    }
    else
    {
      $this->add($registration);
    }

    $wp_session = WP_Session::get_instance();
    $wp_session[self::NOM_SESSION] = $this->_registration;

  }

  private function update(SNK_registration $registration)
  {
    global $wpdb;

    $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->prefix}SNK_registrations
      SET id_WP = %d, nom = %s, prenom = %s, adresse = %s, codePostal = %d, ville = %s, telephone = %s, email = %s, nombreHeuresValidees = %d WHERE id = %d",
      array($registration->id_WP(), $registration->nom(), $registration->prenom(),$registration->adresse(),$registration->codePostal(), $registration->ville(), $registration->telephone(),
      $registration->email(), $registration->nombreHeuresValidees(), $registration->id() )));
  }

  // Fonction qui ajoute un enregistrement dans la base de données
  private function add(SNK_registration $registration)
  {
    global $wpdb;

    $wpdb->query( $wpdb->prepare("INSERT INTO {$wpdb->prefix}SNK_registrations(nom) VALUES (%s)", $registration->nom()));

    $registration->setId($wpdb->insert_id);

    $this->update($registration);
  }

    // renvoi l'enregistrement correspondant à l'ID de l'utilisateur WP
    private function getByIdWP($id)
    {
      global $wpdb;

      if(is_int($id))
      {
        $res = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}SNK_registrations WHERE id_WP=" .$id ,ARRAY_A);
        return new SNK_registration($res[0]);
      }

    }
}
 ?>
