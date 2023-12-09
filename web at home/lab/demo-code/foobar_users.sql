CREATE TABLE IF NOT EXISTS `foobar_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL
);

INSERT INTO `foobar_users` (`id`, `username`, `password`, `first_name`, `surname`, `email_address`) VALUES
(1, 'foo', 'pwd123456789', 'John', 'Smith', 'john.smith@example.com'),
(2, 'bar', 'pwd987654321', 'Jane', 'Smith', 'jane.smith@example.com'),
(3, 'admin', 'TheyCallMeGod', 'Joe', 'Bloggs', 'joe.bloggs@example.com'),
(4, 'paul', 'MyBigLongSuperSecurePassword', 'Paul', 'Albinson', 'paul@example.com');

ALTER TABLE `foobar_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `foobar_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;