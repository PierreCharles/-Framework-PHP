DROP TABLE IF EXISTS USER;
DROP TABLE IF EXISTS STATUSES;

--
-- Structure de la table `Statuses`
--
CREATE TABLE USER(
  user_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  user_name VARCHAR(100) NOT NULL,
  user_password VARCHAR(100) NOT NULL
);

--
-- Structure de la table `Statuses`
--
CREATE TABLE STATUSES(
  status_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  status_message VARCHAR(140) NOT NULL,
  status_user_name VARCHAR(100),
  status_date DATETIME NOT NULL
);
