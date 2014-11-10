INSERT INTO `user` (`user_id`, `username`, `email`, `display_name`, `password`, `state`, `city`, `birthday`) VALUES
(0, 'freeuser', 'free@gmail.com', 'None', '$2y$14$MuYEf2FroHBQOs9wsIwDzONfZz81Kc5Lze7lqfhV.Pw9hqh5UW9ze', NULL, NULL, NULL);
INSERT INTO `user_role_linker` (`user_id`, `role_id`) VALUES
(0, 2);