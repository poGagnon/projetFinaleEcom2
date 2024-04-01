-- verifier et supprime si ma base de donnee existe
drop database if Exists TeccartWear;

-- creation de ma base donnee
create database TeccartWear;

use TeccartWear;

CREATE TABLE Utilisateur (
    id INT PRIMARY KEY auto_increment,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    email VARCHAR(255),
    mot_de_passe VARCHAR(255),
    addresse VARCHAR(255),
    postal_code VARCHAR(15),
    date_naissance DATE,
    roleU varchar(10)
);

INSERT INTO
    Utilisateur(
        nom,
        prenom,
        email,
        mot_de_passe,
        roleU
    )
values
    (
        "Admin",
        "Admin",
        "admin@test.ca",
        "$2y$10$.aMsPWuIC8dpNFJ3122/YOacYHPF/K.5ZGXjwhxS9J2jCLDYgzara",
        "Admin"
    ),
    (
        "Cruise",
        "Tom",
        "tcruise@test.ca",
        "$2y$10$5PjswM.EbTI9esPVXim7UOHCb6ESFyyYqd/eyERhEOVn5OVEDtkda",
        "client"
    );

create table Produit(
    id int primary key auto_increment not null,
    nom varchar(50) not null,
    item_description varchar(255),
    prix float not null,
    taille varchar(10),
    couleur varchar(10),
    quantite int
);

insert into
    Produit(
        nom,
        item_description,
        prix,
        taille,
        couleur,
        quantite
    )
values
    (
        "Adidas Black Panther Shirt",
        "Bold, Sleek, Iconic, Athletic, Dynamic, Streetwear.",
        19.99,
        "S, M, L, XL",
        "Black",
        10
    ),
    (
        "Nike Golf Polo Shirt",
        "Vibrant citrus hue embraces sporty Nike style.",
        16.99,
        "S, M, L, XL",
        "Orange",
        10
    );

create table Images(
    id int primary key auto_increment,
    chemin varchar(255),
    id_produit int,
    foreign key(id_produit) REFERENCES Produit(id)
);

insert into
    Images(chemin, id_produit)
values
    ("images/Shirt 8.png", 1),
    ("images/Shirt 3.png", 2);

create table Commands(
    id_commande int primary key auto_increment,
    total float,
    date_commande varchar(25),
    id_utilisateur int
);

alter table
    Commands
add
    constraint fk_comm_utilisateur foreign key(id_utilisateur) REFERENCES Utilisateur(id);

create table listcommands(
    id_list int primary key auto_increment,
    id_commande int,
    id_produit int,
    quantity int
);

alter table
    Images
add
    constraint fk_image_produit foreign key(id_produit) REFERENCES Produit(id) on update cascade on delete cascade;

alter table
    listcommands
add
    constraint fk_listcommands_command foreign key(id_commande) REFERENCES Commands(id_commande) on update cascade on delete cascade,
add
    constraint fk_listcommands_produit foreign key(id_produit) REFERENCES Produit(id) on update cascade on delete cascade;