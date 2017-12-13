<?php


class SNK_register_form
{

  function __construct()
  {
    add_shortcode('SNK_register_form', array($this, 'formulaire_EtatCivil'));
    add_action('wp_loaded', array($this, 'next_page'));
  }

  public function formulaire_EtatCivil($atts, $content)
  {
    ?>
    <h2> Etat Civil <h2/>

      <form action="" method="post">
        <p>

          <label for="nom">Nom : </label>
          <input type="text" name="nom" id="nom"/>

          <label for="prenom">Prénom : </label>
          <input type="text" name="prenom" id="prenom"/>

          <label for="adresse">Adresse : </label>
          <input type="text" name="adresse" id="adresse"/>

          <label for="codePostal">Code postal : </label>
          <input type="text" name="codePostal" id="codePostal"/>

          <label for="ville">Ville : </label>
          <input type="text" name="ville" id="ville"/>

          <label for="telephone">Téléphone : </label>
          <input type="tel" name="telephone" id="telephone"/>

          <label for="form-message">Email:</label>
          <input type="email" name="form-message" id="form-message"/>

        </p>
        <input value="Formation continue" type="submit"/>
      </form>
      <?php
    }



    public function formulaire_FormationContinue()
    {

      ?>


      <h2> Formation continue <h2/>

        <form action="" method="post">
          <p>

            <label for="nombre_heure">Nombre d'heure validées : </label>
            <input type="text" name="nombre_heure" id="nombre_heure"/>


          </p>
          <input value="Formation continue" type="submit"/>
        </form>
        <?php


      }



      public function next_page()
      {

        echo "<h2> Etat Civil <h2/>";
        if (isset($_POST['Formation-continue']))
        {
          formulaire_FormationContinue();
        }
    }

}
