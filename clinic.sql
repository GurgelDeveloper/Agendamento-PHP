-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Jul-2024 às 14:58
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clinic`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_date` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `appointment_date`, `notes`) VALUES
(11, 1, 1, '2024-07-05 09:00:00', ''),
(12, 7, 1, '2024-07-05 10:00:00', ''),
(13, 8, 2, '2024-07-06 14:00:00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `specialization`, `email`, `password`) VALUES
(1, 'Dr. João Silva', 'Cardiologia', 'joao@clinic.com', 'password1'),
(2, 'Dra. Maria Souza', 'Dermatologia', 'maria@clinic.com', 'password2'),
(3, 'Dr. Carlos Pereira', 'Pediatria', 'carlos@clinic.com', 'password3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `doctor_availabilities`
--

CREATE TABLE `doctor_availabilities` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `available_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `doctor_availabilities`
--

INSERT INTO `doctor_availabilities` (`id`, `doctor_id`, `available_date`) VALUES
(1, 1, '2024-07-05 09:00:00'),
(2, 1, '2024-07-05 10:00:00'),
(3, 2, '2024-07-06 14:00:00'),
(4, 3, '2024-07-07 16:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `patients`
--

INSERT INTO `patients` (`id`, `name`, `email`, `password`) VALUES
(1, 'Gabriel Nathan', 'gabrielnathan.r.gurgel@gmail.com', '$2y$10$z.8/WFPtkiP9A3RNOBM/0etquSlCMgnPEyJ7FeWAoMwpH4DCgOHku'),
(6, 'Atila', 'rogerintestadorqa@gmail.com', '$2y$10$H/K4R4vcCJuZOtqWQ.nS5OpiRsBL4daG6x5x4bkN/WiZxXWAuI4QG'),
(7, 'Vitor', 'vitin33@gmail.com', '$2y$10$7/Zg37KE6vUxK.dyyMuZbOgMZcp2x7f/XjH49uzT38fhN1HbXHaK6'),
(8, 'rayanne ', 'rayannecosta818@gmail.com', '$2y$10$5CKssRCNtE/uNPMoM/I9G.L1JbCybNZSjc/Y5hD2T/YWljwQxaeFi');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Índices para tabela `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `doctor_availabilities`
--
ALTER TABLE `doctor_availabilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Índices para tabela `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `doctor_availabilities`
--
ALTER TABLE `doctor_availabilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Limitadores para a tabela `doctor_availabilities`
--
ALTER TABLE `doctor_availabilities`
  ADD CONSTRAINT `doctor_availabilities_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
