
drop table Utilisateur cascade;
drop table Modules     cascade;
drop table Affectation cascade;
drop table Groupe      cascade;
drop table Seance      cascade;
drop table Evenement   cascade;


/* Table Utilisateur */

create table Utilisateur
(
	id_utilisateur varchar(25) primary key,
	nom     varchar(25),
	prenom  varchar(25),
	mdp     varchar(60),
	role    varchar(5),
	groupe  varchar(25),
	cree_le date,
	maj_le  date
);

/* Table Modules */

create table Modules
(
	id_module varchar(7) primary key,
	libelle   varchar(25),
	couleur   varchar(6),
	droit     varchar(3),
	date_creation  varchar(10),
	date_modif     varchar(10)
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

/* Table Seance */

create table Seance
(
	id_seance      serial primary key ,
	module         varchar(25),
	date_creation  varchar(10),
	date_modif     varchar(10),
	type           varchar(17),
	groupe         varchar(7),
	id_utilisateur varchar(25) REFERENCES Utilisateur(id_utilisateur)
);

/* Table Evenement */

create table Evenement
(
	id_evenement serial primary key,
	categorie    varchar(10),
	description  varchar(100),
	temps        varchar(5),
	pour_le      varchar(10),
	id_seance    integer REFERENCES Seance(id_seance)
);
