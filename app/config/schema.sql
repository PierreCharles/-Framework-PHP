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

--
-- Content statuses table
--
INSERT INTO `statuses` (`status_id`, `status_message`, `status_user_name`, `status_date`) VALUES
(1, 'Mon premier tweet !', 'UserTest', '2016-02-11 00:19:39'),
(2, 'My first tweet in engish !', 'UserTest', '2016-02-11 00:19:54'),
(3, 'I am not register and I can post my first tweet ! This social network is very funy !', 'Unregister User', '2016-02-11 00:20:35'),
(4, 'It''s very easy to use !', 'Unregister User', '2016-02-11 00:21:07');

--
-- Content user table
--
INSERT INTO `user` (`user_id`, `user_name`, `user_password`) VALUES
(1, 'UserTest', '$2y$10$zfa/pbpZ/pYSloWACETd5eSy1Wwx/mqZ8.1a.6wS9zd1ReJDICZMm');