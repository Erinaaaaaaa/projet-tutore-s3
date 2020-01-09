<form action="ValiderUpdate.php" method="POST" class="block">
    <fieldset>
        <legend>Inscription</legend>
        <fieldset>
            <table>
                <legend>Données personnelles</legend>
                <tr>
                    <th align = "left">id :</th>
                </tr>
                <tr>
                    <td><input type="text" name="id" value=""></td>
                    <td><input type=hidden name="oldId" value="" > </td>
                </tr>
                <tr>
                    <th align = "left">nom :</th>
                    <th align = "left">prenom :</th>
                    <th align = "left">mot de passe :</th>
                </tr>
                <tr>
                    <td><input type="text"     name="nom" value=""></td>
                    <td><input type="text"     name="prenom" value=""></td>
                    <td><input type="password" name="mdp" ></td>
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

                        <th align="left">
                        <input type="radio" name="role" value="A"  >Administrateur<br>
                        <input type="radio" name="role" value="AE">Administrateur/Enseignant<br>
                        <input type="radio" name="role" value="E" >Enseignant<br>
                        <input type="radio" name="role" value="T">Tuteur<br>

                        </th>
                        <th><input type="text" name="groupe" value=""></th>

                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Date</legend>
            <table>
                <tr>
                    <th align = "left">crée le</th>
                    <th align = "left">mis à jour le</th>
                </tr>
                <tr>
                    <td><input type="date" name="crea" value="" disabled></td>
                    <td><input type="date" name="maj" value="" disabled></td>
                </tr>
            </table>
        </fieldset>
        <table>
            <tr>
                <td><input type="submit" name="ok" value="Valider"></td>
                <td><input type="reset" name="renit" value="Effacer"></td>
                <td></td>
            </tr>
        </table>
    </fieldset>
</form>