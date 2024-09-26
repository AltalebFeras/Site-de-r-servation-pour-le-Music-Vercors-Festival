
CREATE TABLE mvf_nuitee
(
  nuiteeID   INTEGER     NOT NULL AUTO_INCREMENT,
  nomNuitee  VARCHAR(60) NOT NULL,
  prixNuitee INTEGER     NOT NULL,
  PRIMARY KEY (nuiteeID)
);

ALTER TABLE mvf_nuitee
  ADD CONSTRAINT UQ_nuiteeID UNIQUE (nuiteeID);

CREATE TABLE mvf_options
(
  optionID    INTEGER     NOT NULL AUTO_INCREMENT,
  nomOption   VARCHAR(60) NOT NULL,
  stockOption INTEGER     NOT NULL,
  prixOption  INTEGER     NOT NULL,
  PRIMARY KEY (optionID)
);

ALTER TABLE mvf_options
  ADD CONSTRAINT UQ_optionID UNIQUE (optionID);

CREATE TABLE mvf_pass
(
  passID   INTEGER     NOT NULL AUTO_INCREMENT,
  prixPass INTEGER     NOT NULL,
  nomPass  VARCHAR(60) NOT NULL,
  PRIMARY KEY (passID)
);

ALTER TABLE mvf_pass
  ADD CONSTRAINT UQ_passID UNIQUE (passID);

CREATE TABLE mvf_reservation
(
  reservationID      INTEGER NOT NULL AUTO_INCREMENT,
  nombreReservations INTEGER NOT NULL,
  prixTotal          INTEGER NULL    ,
  utilisateurID      INTEGER NOT NULL,
  PRIMARY KEY (reservationID)
);

ALTER TABLE mvf_reservation
  ADD CONSTRAINT UQ_reservationID UNIQUE (reservationID);

CREATE TABLE mvf_reservation_nuitee
(
  jour          VARCHAR(60) NOT NULL,
  reservationID INTEGER     NOT NULL,
  nuiteeID      INTEGER     NOT NULL
);

CREATE TABLE mvf_reservation_option
(
  reservationID INTEGER NOT NULL,
  optionID      INTEGER NOT NULL
);

CREATE TABLE mvf_reservation_pass
(
  jour          VARCHAR(60) NOT NULL,
  passID        INTEGER     NOT NULL,
  reservationID INTEGER     NOT NULL
);

CREATE TABLE mvf_utilisateur
(
  utilisateurID INTEGER      NOT NULL AUTO_INCREMENT,
  nom           VARCHAR(50)  NOT NULL,
  prenom        VARCHAR(50)  NOT NULL,
  email         VARCHAR(50)  NOT NULL,
  motDePasse    VARCHAR(501) NOT NULL,
  telephone     VARCHAR(50)  NOT NULL,
  adresse       VARCHAR(150) NOT NULL,
  RGPD          DATE         NOT NULL,
  role          VARCHAR(60)  NULL    ,
  PRIMARY KEY (utilisateurID)
);

ALTER TABLE mvf_utilisateur
  ADD CONSTRAINT UQ_utilisateurID UNIQUE (utilisateurID);

ALTER TABLE mvf_utilisateur
  ADD CONSTRAINT UQ_email UNIQUE (email);

ALTER TABLE mvf_reservation
  ADD CONSTRAINT FK_mvf_utilisateur_TO_mvf_reservation
    FOREIGN KEY (utilisateurID)
    REFERENCES mvf_utilisateur (utilisateurID);

ALTER TABLE mvf_reservation_pass
  ADD CONSTRAINT FK_mvf_pass_TO_mvf_reservation_pass
    FOREIGN KEY (passID)
    REFERENCES mvf_pass (passID);

ALTER TABLE mvf_reservation_pass
  ADD CONSTRAINT FK_mvf_reservation_TO_mvf_reservation_pass
    FOREIGN KEY (reservationID)
    REFERENCES mvf_reservation (reservationID);

ALTER TABLE mvf_reservation_nuitee
  ADD CONSTRAINT FK_mvf_reservation_TO_mvf_reservation_nuitee
    FOREIGN KEY (reservationID)
    REFERENCES mvf_reservation (reservationID);

ALTER TABLE mvf_reservation_nuitee
  ADD CONSTRAINT FK_mvf_nuitee_TO_mvf_reservation_nuitee
    FOREIGN KEY (nuiteeID)
    REFERENCES mvf_nuitee (nuiteeID);

ALTER TABLE mvf_reservation_option
  ADD CONSTRAINT FK_mvf_reservation_TO_mvf_reservation_option
    FOREIGN KEY (reservationID)
    REFERENCES mvf_reservation (reservationID);

ALTER TABLE mvf_reservation_option
  ADD CONSTRAINT FK_mvf_options_TO_mvf_reservation_option
    FOREIGN KEY (optionID)
    REFERENCES mvf_options (optionID);
