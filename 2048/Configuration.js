function SaveConfiguration() {

	createCookie("Couleur", document.getElementById("comboCouleur").value);
	createCookie("Nombre", document.getElementById("comboNombre").value);

	DeterminationCouleur();

}

function createCookie(name, value) {
	var expire = new Date();
	expire.setTime(expire.getTime() + (365 * 24 * 60 * 60 * 1000));
	//alert(name + '=' + escape(value) + ';expires=' + expire.toGMTString()+"; path=/");
	document.cookie = name + '=' + escape(value) + ';expires=' + expire.toGMTString() + "; path=/";
	return true;
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

function LoadConfiguration() {

	var col = readCookie("Couleur");
	var nomb = readCookie("Nombre");

	//alert(nomb);

	if (nomb == "" || nomb == null) {
		document.getElementById("comboNombre").value = "Arabes";
	} else {
		document.getElementById("comboNombre").value = nomb;
	}
	
	if (col == "" || col == null) {
		document.getElementById("comboCouleur").value = "Couleur";
	} else {
		document.getElementById("comboCouleur").value = col;
	}
	
}

function DeterminationCouleur() {
	var couleur = readCookie("Couleur");

	if (couleur == "Monochrome") {
		document.getElementById("cadre_titre").className = "cadre_titre_BW";
		document.getElementById("titre").className = "titre_BW";
		document.getElementById("bouton").className = "bouton_BW";
	}

}