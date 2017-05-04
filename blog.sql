-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2017 at 08:02 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_category`
--

INSERT INTO `blog_category` (`cat_id`, `cat_name`, `status`) VALUES
(1, 'html', 1),
(2, 'css', 1),
(3, 'design', 1),
(4, 'php', 1),
(5, 'java', 1),
(6, 'others', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_comment`
--

INSERT INTO `blog_comment` (`comment_id`, `post_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 11, 2, 'Hello', '2017-03-04 04:35:35', '0000-00-00 00:00:00'),
(2, 11, 1, 'hi\r\n', '2017-03-03 01:42:09', '0000-00-00 00:00:00'),
(3, 10, 0, 'Good', '2017-03-06 12:47:31', '0000-00-00 00:00:00'),
(4, 12, 1, 'jjkh', '2017-03-20 11:43:34', '0000-00-00 00:00:00'),
(5, 13, 1, 'nmmnm', '2017-03-20 11:54:48', '0000-00-00 00:00:00'),
(6, 11, 0, 'jj', '2017-03-25 12:51:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `post_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `hit` int(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`post_id`, `cat_id`, `user_id`, `post_title`, `post`, `created_at`, `updated_at`, `status`, `hit`) VALUES
(1, 1, 1, 'How to select multiple value from a listbox', 'I have a below code where if I select one value, it works fine, but now I need such that when I select multiple values from the listbox, i have to get the value of selected values. How do i go about it? Here is the code.', '2017-03-27 16:59:33', '0000-00-00 00:00:00', 1, 20),
(2, 2, 1, 'Select item from listbox by value number', 'However, the problem I am having is that I want to be able to search the user_list (start from 1) for the next avaliable number. However, the problem I am having is that I want to be able to search the user_list (start from 1) for the next avaliable number. However, the problem I am having is that I want to be able to search the user_list (start from 1) for the next avaliable number.', '2017-03-15 17:15:16', '0000-00-00 00:00:00', 1, 4),
(3, 3, 1, 'Node clustering with Cytoscape', 'Does anyone know if it is possible to do clustering in the way that vis.js supports it with cytoscape.js? Here are some examples. Does anyone know if it is possible to do clustering in the way that vis.js supports it with cytoscape.js? Here are some examples. Does anyone know if it is possible to do clustering in the way that vis.js supports it with cytoscape.js? Here are some examples.', '2017-03-03 05:50:39', '0000-00-00 00:00:00', 1, 0),
(4, 3, 2, 'Node clustering with Cytoscape', 'Does anyone know if it is possible to do clustering in the way that vis.js supports it with cytoscape.js? Here are some examples. Does anyone know if it is possible to do clustering in the way that vis.js supports it with cytoscape.js? Here are some examples. Does anyone know if it is possible to do clustering in the way that vis.js supports it with cytoscape.js? Here are some examples.', '2017-03-27 17:05:51', '0000-00-00 00:00:00', 1, 33),
(5, 3, 2, 'Node clustering with Cytoscape', 'Does anyone know if it is possible to do clustering in the way that vis.js supports it with cytoscape.js? Here are some examples. Does anyone know if it is possible to do clustering in the way that vis.js supports it with cytoscape.js? Here are some examples. Does anyone know if it is possible to do clustering in the way that vis.js supports it with cytoscape.js? Here are some examples.', '2017-03-16 17:04:59', '0000-00-00 00:00:00', 1, 6),
(6, 3, 2, 'Test', 'Blog Test.', '2017-03-22 17:32:42', '0000-00-00 00:00:00', 1, 12),
(10, 4, 2, 'Hello Blog', 'Hello Blog Hello Blog Hello Blog Hello Blog Hello Blog Hello Blog Hello Blog Hello Blog Hello Blog Hello Blog Hello Blog Hello Blog Hello Blog Hello Blog Hello Blog ', '2017-03-18 12:54:26', '0000-00-00 00:00:00', 1, 25),
(11, 1, 1, 'Hello Welcome', 'Hello Welcome Hello Welcome Hello Welcome Hello Welcome Hello Welcome Hello Welcome ', '2017-05-04 18:00:16', '0000-00-00 00:00:00', 1, 94),
(12, 5, 1, 'Hello', 'jhmbn ', '2017-03-28 03:27:18', '0000-00-00 00:00:00', 1, 15),
(13, 6, 1, 'Test post', 'guj mhokkj kjol', '2017-03-25 03:56:20', '0000-00-00 00:00:00', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `blog_user`
--

CREATE TABLE `blog_user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_user`
--

INSERT INTO `blog_user` (`user_id`, `name`, `user_name`, `address`, `image`, `email`, `password`, `status`) VALUES
(1, 'Palash Roy', 'palash', 'Mirpur', 'Untitled-2.jpg', 'palash.cmt@gmail.com', '123456', 1),
(2, 'Sagor roy', 'sagor1', 'Mohammadpur', '', 'sagor@gmail.com', '123456', 1),
(7, 'sultan', 'sultan', 'mirpur', 'sultan-31489511956.jpg', 'sultan@gmail.com', '1234567', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
(1, 'Palash', 'palash.cmt@gmail.com', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `blog_user`
--
ALTER TABLE `blog_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `blog_user`
--
ALTER TABLE `blog_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
