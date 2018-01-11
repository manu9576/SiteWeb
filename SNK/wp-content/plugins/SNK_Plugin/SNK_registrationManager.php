<?php

class SNK_registrationManager
{
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

      if(is_null($res) || count($res)>0)
        return new SNK_registration($res[0]);

    }

    return null;
  }

  // MAJ ou ajout d'un enregistrement dans la base
  public function addOrUpdate(SNK_registration $registration)
  {
    if($this->exists($registration->id()))
      $this->update($registration);
    else
      $this->add($registration);

  }

  public function count()
  {
    global $wpdb;

    return $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}SNK_registrations" );
  }

  public function delete(SNK_registration $registration)
  {
    if(is_null($registration) || !$this->exists($registration->id()))
      return;

      global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->prefix}SNK_registrations WHERE id = " . $registration->id());
  }


  public function exists($id)
  {
    global $wpdb;

    if(is_int($id))
      return (bool) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}SNK_registrations WHERE id = ".$id);

    return false;

  }

  public function get($id)
   {
     global $wpdb;

     if(is_int($id))
     {
       $res = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}SNK_registrations WHERE id=" .$id ,ARRAY_A);

       if(is_null($res) || count($res)>0)
        return new SNK_registration($res[0]);
     }

     return null;
   }

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

  private function update(SNK_registration $registration)
  {
    global $wpdb;

    if(!is_null($registration))
    {
      $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->prefix}SNK_registrations
        SET id_WP= %d, nom = %s, prenom = %s, adresse = %s, codePostal = %d, ville = %s, telephone = %s, email = %s, nombreHeuresValidees = %d, valider=%d WHERE id = %d",
        array($registration->id_WP(), $registration->nom(), $registration->prenom(),$registration->adresse(),$registration->codePostal(), $registration->ville(), $registration->telephone(),
        $registration->email(), $registration->nombreHeuresValidees(), $registration->valider(), $registration->id() )));
    }
  }

  // fonction qui renvoi l'enregistrement :
  // 1 - si un enregistrement est présent dans la variable session, on utilise celui-ci
  // 2 - si l'utilisateur est logge:
  //        a - on récupère le l'enregistrement de la base de données
  //        b - si null on cree un nouvel enregistrement
  public function getUserRegistration()
  {

    $userWP_id = get_current_user_id();
    $registration = $this->getByIdWP($userWP_id);

    if(is_null($registration))
    {
      $current_user = wp_get_current_user();
      $registration = new SNK_registration(['nom'=> $current_user->user_firstname,
      'prenom' => $current_user->user_lastname, 'email'=> $current_user->user_email, 'id_WP' => $userWP_id]);

      $this->add($registration);
    }

    return $registration;
  }
}
?>
