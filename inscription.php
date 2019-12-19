<html>
<head>
</head>
<body>
<form action="Creation.php" method="POST">
    <fieldset>
        <legend>Inscription</legend>
        <fieldset>
            <table>
                <legend>Données personnelles</legend>
                <tr>
                    <th align = "left">id</th>
                </tr>
                <tr>
                    <td><input type="text" name="id"></td>
                </tr>
                <tr>
                    <th align = "left">nom</th>
                    <th align = "left">prenom</th>
                    <th align = "left">mot de passe</th>
                </tr>
                <tr>
                    <td><input type="text"     name="nom"></td>
                    <td><input type="text"     name="prenom"></td>
                    <td><input type="password" name="mdp"></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Attribution</legend>
            <table>

                <tr>
                    <th align = "left">roles</th>
                    <th align = "left">groupe</th>
                </tr>
                <tr>
                    <td><select name="roles">
                            <option value="A">Administrateur</option>
                            <option value="AE">Administrateur/Enseignant</option>
                            <option selected="E">Enseignant</option>
                            <option value="T">Tuteur</option>
                        </select>
                    </td>
                    <td><input type="text" name="groupe"></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <table>
                <tr>
                    <th align = "left">crée le</th>
                    <th align = "left">mis à jour le</th>
                </tr>
                <tr>
                    <td><input type="date" name="crea" value="2019-12-16"></td>
                    <td><input type="date" name="maj" value="2019-12-16"></td>
                </tr>
            </table>
        </fieldset>
        <table align="center">
            <tr>
                <td><input type="submit" name="ok"     value="Valider"></td>
                <td><input type="reset"  name="renit"  value="Effacer"></td>
</form>
                <td><a href='accueil.php' class="retour">Retour</a></td>
                <td><button onclick="window.history.back()">Retour2</button></td>
            </tr>
        </table>
</body>
</html>