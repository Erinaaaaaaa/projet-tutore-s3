create or replace function ft_majUtilisateur() returns trigger AS
$$
Begin

    if (OLD.id_utilisateur = NEW.id_utilisateur
        and OLD.nom = NEW.nom
        and OLD.prenom = NEW.prenom
        and OLD.mdp = NEW.mdp
        and OLD.role = NEW.role
        and OLD.groupe = NEW.groupe
        and OLD.cree_le = NEW.cree_le
        and OLD.maj_le = NEW.maj_le)
    then
        raise exception 'execution du trigger % sur table % impossible car valeur identique', tg_name, tg_table_name;

    else

        -- update utilisateur set maj_le = now() where id_utilisateur = OLD.id_utlisateur;

        NEW.maj_le := now();

    end if;

    return NEW;
end;

$$ language plpgsql;

drop trigger if exists t_majUtilisateur on utilisateur;
create trigger t_majUtilisateur
    before update
    on utilisateur
    for each row
execute procedure ft_majUtilisateur();

