-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2026 at 03:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `network_plans_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'manoj', 'manoj@gmail.com', 'Customization Request', 'fsdfgdfhg', '2025-12-30 10:20:01'),
(2, 'manoj', 'admin@netplans.com', 'Customization Request', 'fvgfcv', '2025-12-31 14:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `customized_details` text DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `plan_id`, `customized_details`, `total_price`, `status`, `created_at`) VALUES
(1, 1, 3, NULL, 450000.00, 'confirmed', '2025-12-30 10:20:44'),
(2, 1, 7, NULL, 580000.00, 'confirmed', '2025-12-31 05:29:18'),
(3, 5, 12, NULL, 400000.00, 'confirmed', '2026-04-21 14:28:36'),
(4, 5, 1, NULL, 500000.00, 'confirmed', '2026-04-21 15:00:36'),
(5, 5, 1, NULL, 500000.00, 'confirmed', '2026-05-25 15:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `speed` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `features` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `title`, `category`, `description`, `speed`, `price`, `features`, `image`, `is_active`, `created_at`) VALUES
(1, 'Hospital Network Plan', NULL, 'Complete hospital network with VLANs, Firewall and redundancy', NULL, 500000.00, NULL, 'https://www.researchgate.net/publication/261430553/figure/fig2/AS:306930015850497@1450189226304/Hospital-Network-Architecture.png', 1, '2025-12-30 10:18:36'),
(2, 'School Network Plan', NULL, 'Full school computer lab and admin network setup', NULL, 300000.00, NULL, 'https://www.researchgate.net/publication/283258166/figure/fig1/AS:289116509618176@1445942155602/The-School-Network-Topology.png', 1, '2025-12-30 10:18:36'),
(3, 'Hotel Network System', NULL, 'WiFi, CCTV and server integration for hotels', NULL, 450000.00, NULL, 'https://www.conceptdraw.com/How-To-Guide/picture/Hotel-Network-Topology.png', 1, '2025-12-30 10:18:36'),
(4, 'Enterprise Office V2', NULL, 'High availability office network with Cisco devices', NULL, 850000.00, NULL, 'https://images.wondershare.com/edrawmax/templates/small-company-network-diagram.png', 1, '2025-12-30 10:18:36'),
(5, 'Home Lab Setup', NULL, 'Advanced home networking lab with Packet Tracer', NULL, 150000.00, NULL, 'https://i.redd.it/uz8cpzrexx751.png', 1, '2025-12-30 10:18:36'),
(6, 'Hospital VLAN Network', 'Hospital', 'Advanced hospital network with VLAN segmentation', NULL, 550000.00, NULL, 'https://svg.template.creately.com/BZRvBMXdztu', 1, '2025-12-30 10:38:14'),
(7, 'Hospital LAN Fault Tolerance', 'Hospital', 'Redundant hospital network design', NULL, 580000.00, NULL, 'https://www.conceptdraw.com/How-To-Guide/picture/Network-diagram-LAN-fault-tolerance-system.png', 1, '2025-12-30 10:38:14'),
(8, 'Medical Facility Topology', 'Hospital', 'Complete medical center network layout', NULL, 520000.00, NULL, 'https://images.edrawsoft.com/articles/network-topology-examples/network-topology-examples-cover.png', 1, '2025-12-30 10:38:14'),
(9, 'Hospital Logical Network', 'Hospital', 'Step-by-step hospital topology', NULL, 600000.00, NULL, 'https://images.edrawsoft.com/articles/network-topology-examples/step2-1.png', 1, '2025-12-30 10:38:14'),
(10, 'Hospital Boardmix Design', 'Hospital', 'Modern hospital logical topology', NULL, 590000.00, NULL, 'https://cms.boardmix.com/images/articles/design-logical-network-topology-in-boardmix-step-4.png', 1, '2025-12-30 10:38:14'),
(11, 'School Campus Area Network', 'School', 'Full campus network with multiple buildings', NULL, 350000.00, NULL, 'https://www.conceptdraw.com/How-To-Guide/picture/campus-area-networks.png', 1, '2025-12-30 10:38:15'),
(12, 'Cisco School LAN Design', 'School', 'Cisco recommended campus LAN/WLAN', NULL, 400000.00, NULL, 'https://www.cisco.com/c/dam/en/us/td/docs/solutions/CVD/Campus/cisco-campus-lan-wlan-design-guide.docx/_jcr_content/renditions/cisco-campus-lan-wlan-design-guide_7.png', 1, '2025-12-30 10:38:15'),
(13, 'School CAN Overview', 'School', 'Campus Area Network basic topology', NULL, 300000.00, NULL, 'https://media.geeksforgeeks.org/wp-content/uploads/20200705182005/can-2.png', 1, '2025-12-30 10:38:15'),
(14, 'Hierarchical School Network', 'School', 'Three-layer school network design', NULL, 380000.00, NULL, 'https://cdn.networklessons.com/wp-content/uploads/2015/03/hierarchical-switch-network-design.png', 1, '2025-12-30 10:38:15'),
(15, 'School Network Example', 'School', 'Complete school computer lab setup', NULL, 320000.00, NULL, 'https://images.edrawsoft.com/articles/network-diagram-example/example13.png', 1, '2025-12-30 10:38:15'),
(16, 'Hotel Full Network Topology', 'Hotel', 'Complete hotel network with guest and admin', NULL, 480000.00, NULL, 'https://www.conceptdraw.com/How-To-Guide/picture/Hotel-Network-Topology.png', 1, '2025-12-30 10:38:15'),
(17, 'Hotel Edraw Design', 'Hotel', 'Professional hotel network layout', NULL, 450000.00, NULL, 'https://www.edrawsoft.com/images/examples/HotelNetworkTopology.png', 1, '2025-12-30 10:38:15'),
(18, 'Hotel Management System', 'Hotel', 'Hotel network with management servers', NULL, 500000.00, NULL, 'https://svg.template.creately.com/iz76y1to', 1, '2025-12-30 10:38:15'),
(19, 'Hotel Service Process', 'Hotel', 'Hotel backend network flow', NULL, 460000.00, NULL, 'https://www.conceptdraw.com/How-To-Guide/picture/hotel-service-process.png', 1, '2025-12-30 10:38:15'),
(20, 'Hotel Fault Tolerant LAN', 'Hotel', 'Redundant hotel network', NULL, 520000.00, NULL, 'https://www.conceptdraw.com/How-To-Guide/picture/Network-diagram-LAN-fault-tolerance-system.png', 1, '2025-12-30 10:38:15'),
(21, 'Enterprise Communication Network', 'Enterprise', 'Large office communication architecture', NULL, 850000.00, NULL, 'https://www.conceptdraw.com/How-To-Guide/picture/Network-diagram-Communication-network-architecture.png', 1, '2025-12-30 10:38:15'),
(22, 'Enterprise ProcessOn Design', 'Enterprise', 'Modern enterprise topology guide', NULL, 800000.00, NULL, 'https://cdn.processon.io/admin/knowledge/article_content_img/66e3db3e9a7db063b59a9130.png', 1, '2025-12-30 10:38:15'),
(23, 'Office Network Example', 'Enterprise', 'Real office network layout', NULL, 780000.00, NULL, 'https://www.gliffy.com/sites/default/files/inline-images/office-network-example.png', 1, '2025-12-30 10:38:15'),
(24, 'Enterprise Office Diagram', 'Enterprise', 'Visual Paradigm office network', NULL, 820000.00, NULL, 'https://online.visual-paradigm.com/repository/images/5339616f-b705-46e2-809f-46a9fcce912d.png', 1, '2025-12-30 10:38:15'),
(25, 'Enterprise EdrawMax', 'Enterprise', 'Professional enterprise network', NULL, 870000.00, NULL, 'https://images.wondershare.com/edrawmax/article2023/network-diagram-example/network-example1.jpg', 1, '2025-12-30 10:38:15'),
(26, 'Advanced Home Lab Overview', 'Home Lab', 'Complete homelab hardware and topology', NULL, 180000.00, NULL, 'https://miro.medium.com/1*CPBxVLzCM0KWcJfd_WJoQA.jpeg', 1, '2025-12-30 10:38:15'),
(27, 'Smart Home + Homelab', 'Home Lab', '4 years evolved smart home network', NULL, 200000.00, NULL, 'https://i.redd.it/8stun1nvkw5a1.png', 1, '2025-12-30 10:38:15'),
(28, 'Detailed Home Lab Diagram', 'Home Lab', 'Full homelab network map', NULL, 220000.00, NULL, 'https://i.redd.it/qabah1o620a91.png', 1, '2025-12-30 10:38:15'),
(29, 'Home Lab Logical Map', 'Home Lab', 'First home lab topology', NULL, 150000.00, NULL, 'https://preview.redd.it/x7w63yb5qyv41.jpg?width=1588&format=pjpg&auto=webp&s=71510b81436827b766e0e20b5844c34b77d9a944', 1, '2025-12-30 10:38:15'),
(30, 'Planned Home Lab Network', 'Home Lab', 'Advanced planned homelab topology', NULL, 190000.00, NULL, 'https://i.redd.it/bkscspa8rbr11.png', 1, '2025-12-30 10:38:15'),
(31, 'home network', 'Home Lab', '100mbps speed', NULL, 500000.00, NULL, '../uploads/1767159733_1-basic-home-network-diagram.png', 1, '2025-12-31 05:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('client','admin') DEFAULT 'client',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `role`, `created_at`) VALUES
(1, 'manoj Chathuranga', 'manoj@gmail.com', '$2y$10$foJW/pymmhc20taPvs8HPOB62eSGKrbp7vQDIJMuBTapSrLjhe/y2', NULL, 'client', '2025-12-30 10:15:53'),
(3, 'Admin User', 'admin@netplans.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'admin', '2025-12-30 14:07:29'),
(4, 'admin2', 'admin@yk.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1234', 'admin', '2025-12-30 14:19:40'),
(5, 'akila kanchana', 'akila1@gmail.com', '$2y$10$R1sb.5Jb6Nbik9ueS9LsNuVlKkbtFFmFMu9UJP91wd/mzcF6Yg9QW', NULL, 'client', '2026-04-21 14:26:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
