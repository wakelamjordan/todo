DROP DATABASE todo;

CREATE DATABASE IF NOT EXISTS `todo`;

USE todo;

CREATE TABLE IF NOT EXISTS `todo`.`status` (
  `id` INT(12) NULL AUTO_INCREMENT,
  `no` INT(12) NOT NULL,
  `name` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `todo`.`tasks` (
  `id` INT(12) NULL AUTO_INCREMENT,
  `title` VARCHAR(50) NOT NULL,
  `description` VARCHAR(255),
  `status` INT(1) NOT NULL DEFAULT 0,
  `order` INT(12),
  PRIMARY KEY (`id`)
);

CREATE VIEW V_tasks AS
SELECT
  t.id, t.title, t.description,t.order, s.name as status, s.no
FROM
  tasks t,
  status s
WHERE
  t.status = s.no
ORDER BY
  t.id DESC;

INSERT INTO
  `todo`.`status` (no,name)
VALUES
  ('0','à faire'),
  ('1','en cours'),
  ('2','terminée')
  ;

INSERT INTO
  `todo`.`tasks` (title,description,status,`order`)
VALUES
  ('titre 1', 'description de la tâche numéros une', 0,1),
  ('titre 2', 'description de la tâche numéros deux', 1,2),
  ('titre 3', 'description de la tâche numéros trois', 2,3)
  ;

