-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2017 at 05:22 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antibioplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`id`, `nom`, `mail`, `login`, `mdp`) VALUES
(1, 'boss', 'boss@epsi.fr', 'boss', 'boss1234'),
(2, 'sous-chef', 'souschef@epsi.fr', 'souschef', 'souschef1234');

-- --------------------------------------------------------

--
-- Table structure for table `antibiotique`
--

CREATE TABLE `antibiotique` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `antibiotique`
--

INSERT INTO `antibiotique` (`id`, `nom`) VALUES
(1, 'Amoxicilline'),
(2, 'Lorazepam'),
(3, 'Xanax'),
(4, 'revlon'),
(5, 'Yenarixum');

-- --------------------------------------------------------

--
-- Table structure for table `bacterie`
--

CREATE TABLE `bacterie` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bacterie`
--

INSERT INTO `bacterie` (`id`, `nom`) VALUES
(1, 'Pseudomonas aeruginosa'),
(2, 'Escherichia coli'),
(3, 'Staphylococcus aureus'),
(4, 'Klebsiella pneumonia'),
(5, 'Acinetobacter baumanii'),
(6, 'Citrobacter freundi '),
(7, 'Enterococcus faecium'),
(8, 'Staphylococcus epidermidis'),
(9, 'Legionella pneumophila'),
(10, 'Bacilus cereus');

-- --------------------------------------------------------

--
-- Table structure for table `equipe`
--

CREATE TABLE `equipe` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipe`
--

INSERT INTO `equipe` (`id`, `nom`, `mail`, `pin`) VALUES
(1, 'Les branlos', 'lesbranlos@epsi.fr', '1234'),
(2, 'superchercheurs', 'powerrangers@epsi.fr', '0070'),
(3, 'groupe 3', 'groupe3@epsi.fr', '4765');

-- --------------------------------------------------------

--
-- Table structure for table `etude`
--

CREATE TABLE `etude` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `en_cours` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etude`
--

INSERT INTO `etude` (`id`, `nom`, `date_debut`, `date_fin`, `en_cours`) VALUES
(1, 'etudeVegan', '2017-04-04', '2017-04-18', 0),
(2, 'megarecherche', '2017-04-19', '2017-04-22', 1),
(3, 'cleversearch', '2017-04-21', '2017-05-12', 0),
(4, 'rayona', '2017-07-05', '2017-11-02', 1),
(5, 'lebonjour', '2017-03-23', '2017-06-26', 0),
(6, 'estudiare', '2017-05-01', '2017-10-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `etude_bacterie`
--

CREATE TABLE `etude_bacterie` (
  `id_etude` int(11) DEFAULT NULL,
  `id_bacterie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `etude_equipe`
--

CREATE TABLE `etude_equipe` (
  `id_etude` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etude_equipe`
--

INSERT INTO `etude_equipe` (`id_etude`, `id_equipe`) VALUES
(2, 2),
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `etude_molecule`
--

CREATE TABLE `etude_molecule` (
  `id_molecule` int(11) DEFAULT NULL,
  `id_etude` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molecule_antibioplus`
--

CREATE TABLE `molecule_antibioplus` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `molecule_antibioplus`
--

INSERT INTO `molecule_antibioplus` (`id`, `nom`) VALUES
(1, 'Chlorasulfin'),
(2, 'Cepalazine'),
(3, 'Zamalupanolone'),
(4, 'Methantrispene-1'),
(5, 'Methantrispene-2'),
(6, 'Methantrispene-3'),
(7, 'Amavilox'),
(8, 'Zoperamine A'),
(9, 'Zoperamine B'),
(10, 'Uniclovel');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_etude` int(11) NOT NULL,
  `id_antibiotique` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `nom`, `id_etude`, `id_antibiotique`, `id_equipe`) VALUES
(1, 'session2', 1, 2, 2),
(2, 'session1', 2, 1, 1),
(3, 'session3', 3, 2, 1),
(4, 'session4', 3, 4, 2),
(5, 'session5', 2, 1, 3),
(6, 'session6', 1, 5, 1),
(7, 'session7', 4, 4, 2),
(8, 'session8', 4, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `diametre` decimal(10,0) DEFAULT NULL,
  `id_molecule` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_bacterie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `diametre`, `id_molecule`, `id_session`, `id_bacterie`) VALUES
(1, '23', 4, 1, 2),
(2, '7', 8, 2, 5),
(3, '19', 3, 3, 1),
(4, '10', 1, 4, 3),
(5, '7', 10, 4, 2),
(6, '8', 2, 5, 5),
(7, '11', 6, 5, 4),
(8, '15', 9, 6, 6),
(9, '24', 5, 6, 4),
(10, '20', 1, 7, 7),
(11, '1', 6, 7, 8),
(12, '3', 2, 7, 9),
(13, '6', 7, 8, 4),
(14, '13', 3, 3, 10),
(15, '14', 8, 5, 1),
(16, '17', 4, 8, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `antibiotique`
--
ALTER TABLE `antibiotique`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bacterie`
--
ALTER TABLE `bacterie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etude`
--
ALTER TABLE `etude`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etude_bacterie`
--
ALTER TABLE `etude_bacterie`
  ADD KEY `id_etude` (`id_etude`),
  ADD KEY `id_bacterie` (`id_bacterie`);

--
-- Indexes for table `etude_equipe`
--
ALTER TABLE `etude_equipe`
  ADD KEY `id_etude` (`id_etude`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Indexes for table `etude_molecule`
--
ALTER TABLE `etude_molecule`
  ADD KEY `id_molecule` (`id_molecule`),
  ADD KEY `id_bacterie` (`id_etude`);

--
-- Indexes for table `molecule_antibioplus`
--
ALTER TABLE `molecule_antibioplus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_etude` (`id_etude`),
  ADD KEY `id_antibiotique` (`id_antibiotique`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_molecule` (`id_molecule`),
  ADD KEY `id_session` (`id_session`),
  ADD KEY `id_bacterie` (`id_bacterie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `antibiotique`
--
ALTER TABLE `antibiotique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bacterie`
--
ALTER TABLE `bacterie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `etude`
--
ALTER TABLE `etude`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `molecule_antibioplus`
--
ALTER TABLE `molecule_antibioplus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `etude_bacterie`
--
ALTER TABLE `etude_bacterie`
  ADD CONSTRAINT `etude_bacterie_ibfk_2` FOREIGN KEY (`id_bacterie`) REFERENCES `bacterie` (`id`),
  ADD CONSTRAINT `etude_bacterie_ibfk_1` FOREIGN KEY (`id_etude`) REFERENCES `etude` (`id`);

--
-- Constraints for table `etude_equipe`
--
ALTER TABLE `etude_equipe`
  ADD CONSTRAINT `etude_equipe_ibfk_1` FOREIGN KEY (`id_equipe`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `etude_equipe_ibfk_2` FOREIGN KEY (`id_etude`) REFERENCES `etude` (`id`);

--
-- Constraints for table `etude_molecule`
--
ALTER TABLE `etude_molecule`
  ADD CONSTRAINT `etude_molecule_ibfk_2` FOREIGN KEY (`id_etude`) REFERENCES `etude` (`id`),
  ADD CONSTRAINT `etude_molecule_ibfk_1` FOREIGN KEY (`id_molecule`) REFERENCES `molecule_antibioplus` (`id`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`id_antibiotique`) REFERENCES `antibiotique` (`id`),
  ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`id_etude`) REFERENCES `etude` (`id`),
  ADD CONSTRAINT `session_ibfk_3` FOREIGN KEY (`id_equipe`) REFERENCES `equipe` (`id`);

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_3` FOREIGN KEY (`id_bacterie`) REFERENCES `bacterie` (`id`),
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`id_session`) REFERENCES `session` (`id`),
  ADD CONSTRAINT `test_ibfk_2` FOREIGN KEY (`id_molecule`) REFERENCES `molecule_antibioplus` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
