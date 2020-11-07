CREATE DATABASE IIS2020;
USE IIS2020;

CREATE TABLE Festival(
	festival_ID			INT 			NOT NULL AUTO_INCREMENT,
    nazov               VARCHAR(100)    NOT NULL,
    kapacita			INT				NOT NULL,
    datum_Od			DATETIME		NOT NULL,
    datum_Do            DATETIME        NOT NULL,
    adresa				VARCHAR(100)	NOT NULL,
    popis				VARCHAR(1000)	DEFAULT NULL,
    obrazok				VARCHAR(200)	DEFAULT NULL,
    PRIMARY KEY(festival_ID)
);

CREATE TABLE Podium(
	podium_ID			INT				NOT NULL AUTO_INCREMENT,
    festival_ID			INT 			NOT NULL,
    nazov				VARCHAR(50) 	NOT NULL,
    popis				VARCHAR(1000) 	DEFAULT NULL,
    PRIMARY KEY(podium_ID),
    CONSTRAINT Podium_FK
        FOREIGN KEY (festival_ID)
        REFERENCES Festival (festival_ID)
        ON DELETE CASCADE
);

CREATE TABLE Interpret(
	interpret_ID 		INT				NOT NULL AUTO_INCREMENT,
    nazov				VARCHAR(50)  	NOT NULL,
    hodnotenie			DECIMAL(2,1)	DEFAULT NULL,
    logo				VARCHAR(200)    DEFAULT NULL,
    PRIMARY KEY(interpret_ID)
);

CREATE TABLE Interpret_vystupuje_na_Podium(
	interpret_ID		INT 			NOT NULL,
    podium_ID			INT				NOT NULL,
    cas_vystupenia		DATETIME		NOT NULL,
    CONSTRAINT Interpret_vystupuje_na_Podium_PK
		PRIMARY KEY(interpret_ID, podium_ID),
	CONSTRAINT Interpret_na_Podiu_interpret_ID_FK
        FOREIGN KEY (interpret_ID)
        REFERENCES Interpret (interpret_ID)
        ON DELETE CASCADE,
	CONSTRAINT Interpret_na_Podiu_podium_ID_FK
        FOREIGN KEY (podium_ID)
        REFERENCES Podium (podium_ID)
        ON DELETE CASCADE
);

CREATE TABLE Clovek(
    clovek_ID           INT             NOT NULL AUTO_INCREMENT,
    meno                VARCHAR(50)     NOT NULL,
    PRIMARY KEY (clovek_ID)
);

CREATE TABLE Registrovany(
    registrovany_ID   	INT             NOT NULL,
    email				VARCHAR(50)		NOT NULL,
    login				VARCHAR(50)		NOT NULL,
    heslo				VARCHAR(60)		NOT NULL,
    level_opravnenia	ENUM('admin', 'poradatel', 'pokladni', 'divak')		NOT NULL,
    foto				VARCHAR(200)    DEFAULT NULL,
    PRIMARY KEY (registrovany_ID),
    CONSTRAINT Registrovany_FK
        FOREIGN KEY (registrovany_ID)
        REFERENCES Clovek (clovek_ID)
        ON DELETE CASCADE
);

CREATE TABLE Neregistrovany(
    neregistrovany_ID  	INT             NOT NULL,
    email               VARCHAR(50)     NOT NULL,
    PRIMARY KEY (neregistrovany_ID),
    CONSTRAINT Neregistrovany_FK
        FOREIGN KEY (neregistrovany_ID)
        REFERENCES Clovek (clovek_ID)
        ON DELETE CASCADE
);

CREATE TABLE Clen(
    clen_ID			  	INT             NOT NULL,
    foto				VARCHAR(200)    DEFAULT NULL,
    PRIMARY KEY (clen_ID),
    CONSTRAINT Clen_ID_FK
        FOREIGN KEY (clen_ID)
        REFERENCES Clovek (clovek_ID)
        ON DELETE CASCADE
);

CREATE TABLE Zaner(
	zaner_ID			INT 			NOT NULL AUTO_INCREMENT,
    zaner_nazov			VARCHAR(50)		NOT NULL,
    PRIMARY KEY(zaner_ID)
);

CREATE TABLE Vstupenka(
	vstupenka_ID		INT 			NOT NULL AUTO_INCREMENT,
    cena				DECIMAL			NOT NULL,
    festival_ID			int				NOT NULL,
    registrovany_ID		int				DEFAULT NULL,
    neregistrovany_ID	int				DEFAULT NULL,
    PRIMARY KEY(vstupenka_ID),
    CONSTRAINT Vstupenka_Festival_ID_FK
        FOREIGN KEY (festival_ID)
        REFERENCES Festival (festival_ID)
        ON DELETE CASCADE,
	CONSTRAINT Vstupenka_Registrovany_ID_FK
        FOREIGN KEY (registrovany_ID)
        REFERENCES Registrovany (registrovany_ID)
        ON DELETE CASCADE,
	CONSTRAINT Vstupenka_Neregistrovany_ID_FK
        FOREIGN KEY (neregistrovany_ID)
        REFERENCES Neregistrovany (neregistrovany_ID)
        ON DELETE CASCADE
);

CREATE TABLE Interpret_patri_do_Zaner(
	zaner_ID			INT 			NOT NULL,
    interpret_ID		INT 			NOT NULL,
    CONSTRAINT Interpret_patri_do_Zaner_PK
		PRIMARY KEY(zaner_ID, interpret_ID),
    CONSTRAINT Zaner_Zaner_ID_FK
        FOREIGN KEY (zaner_ID)
        REFERENCES Zaner (zaner_ID)
        ON DELETE CASCADE,
    CONSTRAINT Zaner_Interpret_ID_FK
        FOREIGN KEY (interpret_ID)
        REFERENCES Interpret (interpret_ID)
        ON DELETE CASCADE
);

CREATE TABLE Festival_patri_do_Zaner(
	zaner_ID			INT 			NOT NULL,
    festival_ID			INT 			NOT NULL,
    CONSTRAINT Festival_patri_do_Zaner_PK
		PRIMARY KEY(zaner_ID, festival_ID),
    CONSTRAINT Zaner_Festival_Zaner_ID_FK
        FOREIGN KEY (zaner_ID)
        REFERENCES Zaner (zaner_ID)
        ON DELETE CASCADE,
    CONSTRAINT Zaner_Festival_ID_FK
        FOREIGN KEY (festival_ID)
        REFERENCES Festival (festival_ID)
        ON DELETE CASCADE
);

CREATE TABLE Clen_je_v_Interpret(
	clen_ID				INT 			NOT NULL,
    interpret_ID		INT 			NOT NULL,
    CONSTRAINT Clen_je_v_Interpret_PK
		PRIMARY KEY(clen_ID, interpret_ID),
	CONSTRAINT Clen_Interpret_ClenID_FK
        FOREIGN KEY (clen_ID)
        REFERENCES Clen (clen_ID)
        ON DELETE CASCADE,
	CONSTRAINT Clen_Interpret_ID_FK
        FOREIGN KEY (interpret_ID)
        REFERENCES Interpret (interpret_ID)
        ON DELETE CASCADE
);