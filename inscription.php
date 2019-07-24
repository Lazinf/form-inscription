<?php

$bdd = new PDO('mysql:host=localhost;dbname=espace_membres', 'root' , '');

if(isset($_POST['forminscription']))
{
	if (!empty($_POST['pseudo']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['mail']))
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mdp = sha1($_POST['mdp']);
		$mdp2 = sha1($_POST['mdp2']);
		$mail = htmlspecialchars($_POST['mail']);
		

		$pseudolenght = strlen($pseudo);
			if ($pseudolenght <= 255) 
				{
				}
			else
				{
					$message = "Votre pseudo est trop long";
				}	
			if (filter_var($mail, FILTER_VALIDATE_EMAIL)) 
				{
				
				}	
			else
				{
					$message = "votre mail n'est pas valide";
				}

			if($mdp == $mdp2)
				{
			
					$insertmbr = $bdd->prepare("INSERT INTO espace_membres(pseudo , mdp , mail) VALUES (?,?,?)");
					$insertmbr->execute(array($pseudo,$mdp,$mail));
					$message = "votre compte a bien été créé";	
				}
			
			else
				{
					$message = "Vos mots de passes ne correspondent pas";
		}		
		
}
			else
				{
					$message = "Tous les champs doivent être complétés !";
				}


}	



?>
<!DOCTYPE html>

<html>
	<head>
		<title>Formulaire PHP</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<div align="center">
			<h2>Inscription</h2>
			</br></br></br>
			<form method="POST"	action="">
				<table>
					<tr>
						<td align="right">
							<label for="pseudo">Pseudo : </label>
						</td>
						<td align="right">	
							<input type="text"
							placeholder="Votre pseudo" id="pseudo"
							name="pseudo">
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mail">Adresse mail : </label>
						</td>
						<td align="right">	
							<input type="text"
							placeholder="Votre mail" id="mail"
							name="mail">
						</td>
					</tr>		
					
						<tr>
						<td align="right">
							<label for="mdp">Mot de passe : </label>
						</td>
						<td align="right">	
							<input type="password"
							placeholder="Votre mot de passe" id="mdp"
							name="mdp">
						</td>
					</tr>		
						<tr>
						<td>
							<label for="mdp2">Confirmez votre mot de passe : </label>
						</td>
						<td>	
							<input type="password"
							placeholder="Confirmez le mdp" id="mdp2"
							name="mdp2">
						</td>
					</tr>
					</table></br>	
							<input type="submit" name ="forminscription" value="M'inscrire"/>

							</br></br>

</form>
</div>
<?php

if(isset($message))
{
	echo $message;
}

?>		
</body>
</html>