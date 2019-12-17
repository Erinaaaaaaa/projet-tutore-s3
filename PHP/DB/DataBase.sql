
drop table Utilisateur cascade;
drop table Modules     cascade;
drop table Affectation cascade;
drop table Groupe      cascade;


/* Table Utilisateur */

create table Utilisateur
(
	id_utilisateur varchar(25) primary key,
	nom     varchar(25),
	prenom  varchar(25),
	mdp     varchar(40),
	role    char,
	groupe  varchar(25),
	cree_le date,
	maj_le  date
);

/* Table Modules */

create table Modules
(
	id_module varchar(7) primary key,
	valeur    varchar(10),
	libellé   varchar(25),
	couleur   varchar(6),
	droit     varchar(3)
);

/* Table module/utilisateurs */

create table Affectation
(
	id_utilisateur varchar(25) REFERENCES Utilisateur(id_utilisateur),
	id_module      varchar(7)  REFERENCES Modules(id_module)
);

/* Tableau de groupe */

create table Groupe
(
	groupe 		varchar(7) primary key,
	groupePere  varchar(7)	
);




