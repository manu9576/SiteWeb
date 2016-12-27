/**
 * @author Manu
 */

//Pässe l'interface  en monochrome si le cookie "Couleur" est a "Monochrome"
function DeterminationCouleur() {
	var couleur = readCookie("Couleur");

	if (couleur == "Monochrome") {

		document.getElementById("cadre_titre").className = "cadre_titre_BW";
		document.getElementById("titre").className = "titre_BW";
		
		document.getElementById("bouton").className = "bouton_BW";

	}

}


function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ')
		c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0)
			return c.substring(nameEQ.length, c.length);
	}
	return null;
}