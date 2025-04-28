-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2025 a las 16:12:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_trasversal_project`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

CREATE TABLE `book` (
  `ID` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(45) NOT NULL,
  `editorial` varchar(45) NOT NULL,
  `genre` varchar(45) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `toLend` tinyint(1) NOT NULL DEFAULT 0
) ;

--
-- Volcado de datos para la tabla `book`
--

INSERT INTO `book` (`ID`, `title`, `description`, `author`, `editorial`, `genre`, `image`, `create_time`, `update_time`, `id_user`, `toLend`) VALUES
(3, 'Don Quixote', 'Don Quixote is a middle-aged gentleman from the region of La Mancha in central Spain. Obsessed with the chivalrous ideals touted in books he has read, he decides to take up his lance and sword to defend the helpless and destroy the wicked.', 'Miguel de Cervantes', 'Aliance', 'Novel', 'assets/bookImages/DonQuijote.jpg', '2025-04-12 12:33:01', NULL, 17, 1),
(5, 'Pride and Prejudice', 'This classic novel centers on Elizabeth Bennet, a witty and independent young woman, and her evolving relationship with the proud and wealthy Mr. Darcy. Set in 19th-century England, the story explores themes of love, class, and misunderstandings. Through a series of social mishaps and revelations, Elizabeth and Darcy learn to look beyond first impressions and find true love.', 'Jane Austen', 'T. Egerton, Whitehall', 'Romance', 'assets/bookImages/PrideAndPrejudice.jpg', '2025-04-12 12:33:04', NULL, 17, 0),
(7, 'The Hobbit', 'The Hobbit follows Bilbo Baggins, a peaceful hobbit who is reluctantly pulled into an adventure by the wizard Gandalf and a group of dwarves. Their goal is to reclaim the dwarves\' homeland and treasure from the dragon Smaug. Along the way, Bilbo encounters trolls, goblins, and Gollum, from whom he wins a powerful ring. The journey transforms Bilbo from a timid homebody into a clever and brave hero.', 'J. R. R. Tolkien', 'George Allen & Unwin', 'Fantasy', 'assets/bookImages/TheHobbit.jpg', '2025-04-16 12:33:05', NULL, 17, 1),
(10, '1984', '1984 is a dystopian novel set in a totalitarian society controlled by a powerful government led by Big Brother. The story follows Winston Smith, who secretly despises the regime and dreams of rebellion. As he tries to resist, he faces psychological manipulation, surveillance, and oppression. The novel is a powerful warning about the dangers of absolute power and the loss of personal freedom.', 'George Orwell', 'Wolfsong', 'Novel', 'assets/bookImages/1984.jpg', NULL, NULL, 17, 0),
(22, 'The Little Prince', 'The Little Prince is a poetic tale about a young prince who travels from planet to planet, meeting various grown-ups, each representing different adult flaws—like vanity, greed, and narrow-mindedness. When he arrives on Earth, he meets a stranded pilot (the narrator) in the desert. Through their conversations, the prince shares lessons about love, friendship, and the importance of seeing with the heart rather than just the eyes. His love for a rose on his home planet becomes a symbol of true connection and responsibility.\r\n\r\nThe story is both whimsical and deeply philosophical, offering reflections on human nature and what really matters in life', 'Antoine de Saint-Exupéry', 'Wolfsong', 'Fantasy', 'assets/bookImages/TheLittlePrince.png', '2025-04-19 15:14:37', NULL, 17, 0),
(25, 'Don Quixote  ', 'Don Quixote is a middle-aged gentleman from the region of La Mancha in central Spain. Obsessed with the chivalrous ideals touted in books he has read, he decides to take up his lance and sword to defend the helpless and destroy the wicked.', 'Miguel de Cervantes  ', 'Aliance  ', 'Novel  ', 'assets/bookImages/DonQuijote.jpg', NULL, NULL, 18, 1),
(39, 'Harry Potter', 'The Harry Potter series tells the story of a young wizard, Harry, who discovers his magical heritage on his 11th birthday. He attends Hogwarts School of Witchcraft and Wizardry and learns about his connection to the dark wizard Voldemort. With the help of his friends Ron and Hermione, Harry faces various challenges and ultimately fights to defeat Voldemort, who threatens the magical and non-magical worlds.', 'J. K. Rowling', 'Bloomsbury', 'Fantasy', 'assets/bookImages/HarryPotter1.jpg', NULL, NULL, 18, 0),
(43, 'The Hobbit', 'The Hobbit follows Bilbo Baggins, a peaceful hobbit who is reluctantly pulled into an adventure by the wizard Gandalf and a group of dwarves. Their goal is to reclaim the dwarves\' homeland and treasure from the dragon Smaug. Along the way, Bilbo encounters trolls, goblins, and Gollum, from whom he wins a powerful ring. The journey transforms Bilbo from a timid homebody into a clever and brave hero.', 'J. R. R. Tolkien', 'George Allen & Unwin', 'Fantasy', 'assets/bookImages/TheHobbit.jpg', NULL, NULL, 18, 0),
(45, 'The Little Prince ', 'The Little Prince is a poetic tale about a young prince who travels from planet to planet, meeting various grown-ups, each representing different adult flaws—like vanity, greed, and narrow-mindedness. When he arrives on Earth, he meets a stranded pilot (the narrator) in the desert. Through their conversations, the prince shares lessons about love, friendship, and the importance of seeing with the heart rather than just the eyes. His love for a rose on his home planet becomes a symbol of true connection and responsibility.\r\n\r\nThe story is both whimsical and deeply philosophical, offering reflections on human nature and what really matters in life', 'Antoine de Saint-Exupéry ', 'Wolfsong ', 'Fantasy ', 'assets/bookImages/TheLittlePrince.png', NULL, NULL, 18, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `ID` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_publication` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`ID`, `description`, `image`, `create_time`, `update_time`, `id_user`, `id_publication`) VALUES
(1, '&#34;Don Quixote&#34; is such a fascinating blend of comedy, tragedy, and deep human insight. What I love most is how Cervantes explores the tension between reality and imagination. Don Quixote’s quest might seem foolish on the surface, but there’s someth', 'assets/bookImages/g-i-dle-pink-3840x2160-16390.jpg', '2025-04-09 19:41:44', NULL, 18, 1),
(25, 'Hoola ', 'assets/commentImage/i sway.jpg', NULL, NULL, 17, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lend`
--

CREATE TABLE `lend` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `lend_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `borrow_user_id` int(11) NOT NULL,
  `userConfirmation` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lend`
--

INSERT INTO `lend` (`user_id`, `book_id`, `lend_date`, `return_date`, `borrow_user_id`, `userConfirmation`) VALUES
(17, 5, '2025-04-19', '2025-04-30', 18, 0),
(18, 45, '2025-04-21', NULL, 17, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication`
--

CREATE TABLE `publication` (
  `ID` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `publication_image` varchar(45) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publication`
--

INSERT INTO `publication` (`ID`, `description`, `publication_image`, `create_time`, `update_time`, `id_user`) VALUES
(1, '&#34;Don Quixote&#34; is such a fascinating blend of comedy, tragedy, and deep human insight. What I love most is how Cervantes explores the tension between reality and imagination. Don Quixote’s quest might seem foolish on the surface, but there’s something incredibly noble about his commitment to ideals in a world that mocks them. The relationship between him and Sancho Panza is also so rich—funny and touching at the same time. It’s amazing how a book written over 400 years ago still feels so relevant today. Whether we see him as a madman or a misunderstood dreamer, Don Quixote reminds us that sometimes, believing in something bigger than ourselves—even against all odds—is what makes life meaningful.\r\n', 'assets/communityImages/DonQuijote.jpg', '2025-04-12 17:32:06', NULL, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `surname` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(45) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rol` varchar(5) NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `province` varchar(45) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`, `image`, `rol`, `address`, `city`, `province`, `create_time`, `update_time`) VALUES
(17, 'Joanita', 'Gomez', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'assets/userImages/GX1qj87WEAEevoS.jpeg', 'admin', 'Avenida Logroño', '          Logroño', '          La Rioja', NULL, NULL),
(18, 'Pepe', 'pepe', 'pepe@gmail.com', '7edede46f596b580cd10469463987280', 'assets/userImages/b92ea06eb9c308be145ab74bb9246aec.jpg', 'user', 'Calle 1', 'Logroño', 'La Rioja', NULL, NULL),
(21, 'testing', 'user', 'test@gmail.com', '4e7f25a06c7dde7efa0f5d7f8d1f11a9', 'assets/userImages/defaultProfile.jpg', 'admin', 'Calle Av.Logroño', ' ', ' ', NULL, NULL),
(23, 'Joanita', 'Gomez', 'admin2@gmail.com', '0192023a7bbd73250516f069df18b500', 'assets/userImages/defaultProfile.jpg', 'user', '', NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDX_BOOK_USER` (`id_user`);

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDX_COMMENT_USER` (`id_user`),
  ADD KEY `IDX_COMMENT_PUBLICATION` (`id_publication`);

--
-- Indices de la tabla `lend`
--
ALTER TABLE `lend`
  ADD PRIMARY KEY (`user_id`,`book_id`,`lend_date`),
  ADD KEY `IDX_LEND_BOOK` (`book_id`),
  ADD KEY `IDX_LEND_USER` (`user_id`),
  ADD KEY `FK_LEND_TOLEND` (`borrow_user_id`);

--
-- Indices de la tabla `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDX_PUBLICACION_USER` (`id_user`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EMAIL_UNIQUE` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `book`
--
ALTER TABLE `book`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `publication`
--
ALTER TABLE `publication`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `FK_BOOK_USER` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_COMMENT_PUBLICATION` FOREIGN KEY (`id_publication`) REFERENCES `publication` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_COMMENT_USER` FOREIGN KEY (`id_user`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `lend`
--
ALTER TABLE `lend`
  ADD CONSTRAINT `FK_LEND_BOOK` FOREIGN KEY (`book_id`) REFERENCES `book` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_LEND_TOLEND` FOREIGN KEY (`borrow_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_LEND_USER` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `FK_PUBLICACION_USER` FOREIGN KEY (`id_user`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
