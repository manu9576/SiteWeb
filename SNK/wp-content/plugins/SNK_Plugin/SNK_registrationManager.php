<?php

class SNK_registrationManager
{

  public function add(SNK_registration $registration)
  {
    global $wpdb;

     $wpdb->query( $wpdb->prepare("INSERT INTO {$wpdb->prefix}SNK_registrations(nom) VALUES (%s)", $registration->nom()));

    $registration->hydrate([
      'id' => $wpdb->insert_id
    ]);

    $this->update($registration);
  }

  public function count()
  {
    global $wpdb;

    return $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}SNK_registrations" );
  }

  public function delete(SNK_registration $registration)
  {
    global $wpdb;

    $wpdb->query("DELETE FROM {$wpdb->prefix}SNK_registrations WHERE id = " . $registration->id());
  }


  public function exists($idOuNom)
  {
    global $wpdb;

    if(is_int($idOuNom))
    {
      return (bool) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}SNK_registrations WHERE id = ".$idOuNom);
    }

    return (bool) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}SNK_registrations WHERE nom = ".$idOuNom);

  }

  public function get($idOuNom)
  {
    if(is_int($idOuNom))
    {

      $q = $this->_db->query('SELECT * FROM {$wpdb->prefix}SNK_registrations WHERE id = '.$idOuNom);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);

      return new SNK_registration($donnees);
    }

    $q = $this->_db->prepare('SELECT * FROM {$wpdb->prefix}SNK_registrations WHERE nom = :nom');
    $q->execute([':nom'=>$idOuNom]);

    return new SNK_registration($q->fetch(PDO::FETCH_ASSOC));
  }

  public function getList()
  {
    global $wpdb;

    $enregistrements = [];

    $res = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}SNK_registrations ORDER BY nom");

    foreach ($res as $line)
    {
      echo $line->nom;

      //$enregistrements[] = new SNK_registration($values);
    }

    return $enregistrements;

  }

  public function update(SNK_registration $registration)
  {
    global $wpdb;

    $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->prefix}SNK_registrations
      SET nom = %s, prenom = %s, adresse = %s, codePostal = %d, ville = %s, telephone = %s, email = %s, nombreHeuresValidees = %d WHERE id = %d",
      array($registration->nom(), $registration->prenom(),$registration->adresse(),$registration->codePostal(), $registration->ville(), $registration->telephone(),
      $registration->email(), $registration->nombreHeuresValidees(), $registration->id() )));
  }
}
 ?>
