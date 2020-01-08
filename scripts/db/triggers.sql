CREATE OR REPLACE FUNCTION trig_user_Update() RETURNS TRIGGER AS
$$
BEGIN
    IF (Old.Id = New.Id
        AND Old.Nom = New.Nom
        AND Old.Prenom = New.Prenom
        AND Old.Mdp = New.Mdp
        AND Old.Roles = New.Roles
        AND Old.Groupes = New.Groupes
        AND Old.Date_Creation = New.Date_Creation
        AND Old.Date_Modification = New.Date_Modification)
    THEN
        RAISE NOTICE 'execution du trigger % sur table % impossible car valeur identique', Tg_Name, Tg_Table_Name;

    ELSE

        -- update utilisateur set maj_le = now() where id_utilisateur = OLD.id_utlisateur;

        New.Date_Modification := now();

    END IF;

    RETURN New;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER Trig_User_Update
    BEFORE UPDATE
    ON Utilisateur
    FOR EACH STATEMENT
EXECUTE PROCEDURE trig_user_Update();