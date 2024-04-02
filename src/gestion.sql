CREATE TABLE `roles` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50) NOT NULL
);

CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `active` bool NOT NULL,
  `email` varchar(100) UNIQUE NOT NULL,
  `password` varchar(255),
  `roleId` int(11)
);

CREATE TABLE `promotions` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `places` int(1)
);

CREATE TABLE `courses` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `period` varchar(20) NOT NULL,
  `promotionId` int(11)
);

CREATE TABLE `user_promotion` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `userId` int(11),
  `promotionId` int(11)
);

CREATE TABLE `user_course` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `userId` int(11),
  `courseId` int(11),
  `present` bool NOT NULL,
  `late` bool NOT NULL
);

ALTER TABLE `users` ADD FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`);

ALTER TABLE `user_course` ADD FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

ALTER TABLE `user_course` ADD FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`);

ALTER TABLE `courses` ADD FOREIGN KEY (`promotionId`) REFERENCES `promotions` (`id`);

ALTER TABLE `user_promotion` ADD FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

ALTER TABLE `user_promotion` ADD FOREIGN KEY (`promotionId`) REFERENCES `promotions` (`id`);

INSERT INTO roles (name) VALUES
('apprenants'),
('formateur'),
('délégué'),
('reponsable_pédagogique'),
('campus_manager');

INSERT INTO users (firstName, lastName, active, email, password, roleId) VALUES
('John', 'Doe', true, 'john.doe@example.com', 'password123', 2),
('Jane', 'Smith', true, 'jane.smith@example.com', 'securepassword', 3),
('Michael', 'Johnson', false, 'michael.johnson@example.com', NULL, 3),
('Emily', 'Brown', false, 'emily.brown@example.com', NULL, 3);


INSERT INTO promotions (name, startDate, endDate, places) VALUES
('CDA', '2024-01-15', '2024-12-20', 12),
('DWWM', '2024-02-10', '2024-10-20', 20);

INSERT INTO courses (date, period, promotionId) VALUES
('2024-03-15 09:00:00', 'Matin', 1),
('2024-03-15 13:30:00', 'Après-midi', 1),
('2024-09-10 09:00:00', 'Matin', 2),
('2024-09-10 13:30:00', 'Après-midi', 2);

INSERT INTO user_promotion (userId, promotionId) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2);

INSERT INTO user_course (userId, courseId, present, late) VALUES
(1, 1, true, false),
(2, 1, true, false),
(3, 3, true, true),
(3, 4, false, false);

