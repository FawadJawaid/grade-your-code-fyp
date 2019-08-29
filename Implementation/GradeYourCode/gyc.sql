-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2015 at 06:00 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gyc`
--
CREATE DATABASE IF NOT EXISTS `gyc` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gyc`;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`) VALUES
(1, 'DS'),
(2, 'ITC'),
(3, 'CP'),
(4, 'AI');

-- --------------------------------------------------------

--
-- Table structure for table `course_quiz`
--

CREATE TABLE IF NOT EXISTS `course_quiz` (
  `quiz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password`
--

CREATE TABLE IF NOT EXISTS `password` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(100) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `password`
--

INSERT INTO `password` (`id`, `password`) VALUES
(1, 'aaa'),
(2, '123456'),
(3, '123456');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) DEFAULT NULL,
  `description` varchar(10000) NOT NULL,
  `title` varchar(50) NOT NULL,
  `test_case` varchar(10000) DEFAULT NULL,
  `type` varchar(10) NOT NULL,
  `skeleton_code` varchar(2000) NOT NULL,
  `skeleton_lang` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=142 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `teacher_id`, `description`, `title`, `test_case`, `type`, `skeleton_code`, `skeleton_lang`) VALUES
(86, 3, 'Kundu is true tree lover. Tree is a connected graph having N vertices and N-1 edges. Today when he got a tree, he coloured each edge with one of either red(r) or black(b) colour. He is interested in knowing how many triplets(a,b,c) of vertices are there , such that, there is at least one edge having red colour on all the three paths i.e. from vertex a to b, vertex b to c and vertex c to a . Note that (a,b,c), (b,a,c) and all such permutations will be considered as the same triplet.\r\n\r\nIf the answer is greater than 109 + 7, print the answer modulo (%) 109 + 7. okieeeee', 'Kundu', 'The first line contains an integer N, i.e., the number of vertices in tree. \r\nThe next N-1 lines represent edges: 2 space separated integers denoting an edge followed by a colour of the edge. A colour of an edge is denoted by a small letter of English alphabet, and it can be either red(r) or black(b).\r\n\r\nPrint a single number i.e. the number of triplets.\r\n\r\n1 ? N ? 105\r\nA node is numbered between 1 to N.', '86', '', ''),
(88, 3, '\r\nThe previous challenges covered Insertion Sort, which is a simple and intuitive sorting algorithm. Insertion Sort has a running time of O(N<sup>2</sup>) which isn''t fast enough for most purposes. Instead, sorting in the real-world is done with faster algorithms like Quick sort, which will be covered in the challenges that follow.\r\n\r\nThe first step of Quick sort is to partition an array into two smaller arrays.\r\n\r\nChallenge: \r\nYou''re given an array ar and a number p. Partition the array, so that, all elements greater than p are to its right, and all elements smaller than p are to its left.\r\n\r\nIn the new sub-array, the relative positioning of elements should remain the same, i.e., if n1 was before n2 in the original array, it must remain before it in the sub-array. The only situation where this does not hold good is when p lies between n1 and n2\r\n\r\ni.e., n1 &gt; p &gt; n2.\r\n\r\nGuideline - In this challenge, you do not need to move around the numbers ''in-place''. This means you can create 2 lists and combine them at the end.', 'Quick Sort - Partition', '\r\nYou will be given an array of integers. The number p is the first element in ar.\r\n\r\nThere are 2 lines of input:\r\n\r\nn - the number of elements in the array ar\r\nthe n elements of ar (including p at the beginning)\r\n \r\nPrint out the numbers of the partitioned array on one line.\r\n\r\nConstraints: \r\n1 &le; n &le; 1000 \r\n-1000 &le; x &le; 1000 , x &#8712; ar \r\nAll elements will be distinct', 'DS', '', ''),
(90, 3, '\r\nPrincess Peach is trapped in one of the four corners of a square grid. You are in the centre of the grid and can move one step at a time in any of the four directions. Can you rescue the princess?', 'Bot saves princess', '\r\nThe first line contains an odd integer N (3 &le; N &lt; 100) denoting the size of the grid. This is followed by an NxN grid. Each cell is denoted by ''-'' (ascii value: 45). The bot position is denoted by ''m'' and the princess position is denoted by ''p''.\r\n\r\nGrid is indexed using Matrix Convention\r\n\r\n\r\nPrint out the moves you will take to rescue the princess in one go. The moves must be separated by ''\\n'', a newline. The valid moves are LEFT or RIGHT or UP or DOWN.', 'AI', '', ''),
(91, 3, 'Battleship is a popular 2-player game that takes place a 10 x 10 board. Ships of various sizes are placed on the 10 x 10 board either horizontally or vertically. The position of the ships are hidden to the user. Your task is to sink all the ships.\r\n\r\nShips of the following size are given to each player.\r\n\r\nSubmarine (1 x 1) - 2 nos\r\nDestroyer (2 x 1) - 2 nos\r\nCruiser (3 x 1) - 1 nos\r\nBattleship(4 x 1) - 1 nos\r\nCarrier (5 x 1) - 1 nos\r\nIn this version of the game, you will initially specify the positions of your ships in a specific format and then start attacking the positions of your opponent.', 'Battleship on fire', 'Input Format:\r\nThe very first move would be a 4 letter word "INIT* which indicates that you are to place your ships. The next set of moves follow the format as mentioned below.\r\n\r\nFirst line contains N indicating the size of the board. N lines follow each line contains 10 characters. If a cell is hit, it is denoted by character h (ascii value 104), if a cell is a miss it is denoted by character m (ascii value 109), if all the positions of a ship is destroyed, each of its position of the board is denoted by character d ( ascii value 100 ). If a cell is not attacked by the player, it is denoted by the character - (ascii value 45).\r\n\r\nThe board is indexed according to Matrix Convention\r\n\r\nConstraints:\r\nN = 10\r\n\r\n', '91', '', ''),
(93, 322, 's3322', '3333332', 's332', '23', '', ''),
(123, 1, 'Maze is a square, consisting of N×N segments. Each segment can be either empty or filled with stones. It is guaranteed that the upper-left and bottom right segments are empty. Surrounded by a maze of bottom, top, left and right walls, leave a space only the upper left and lower right corners. Director of the labyrinth has decided to paint the walls of the labyrinth, visible from inside.\r\n\r\nHelp him to calculate the amount of paint needed for this.', 'Printing Maze', 'Input:\r\nThe first line contains the number N, then N lines of N symbols: the dot denotes an empty segment, the lattice - a segment of the wall.\r\n3 ? N ? 33, the segment size of 3×3, the height of the walls of 3 meters.\r\n\r\nOutput:\r\nDerive a single number - the area of the visible part of the interior walls of the labyrinth in square meters.', 'DS', '', ''),
(124, 1, 'The oriented weighted graph is given. Find the shortest path from the vertex s to the vertex f.', 'Dijkstra Algorithm', 'Input:\r\nThe first line contains three numbers n, s and f (1 ? n ? 100, 1 ? s, f ? n), where n is the number of vertices in a graph. Each of the next n lines contains n numbers - the adjacency matrix of the graph, where the number in the i-th line and j-th column corresponds to the edge from i to j: -1 means the absence of the edge between the vertices, and any non-negative number - the presence of the edge of a given weight. The main diagonal of the matrix contains always zeroes.\r\n\r\nOutput:\r\nPrint the required distance or -1 if the path between the given vertices does not exist.', 'CP', '', ''),
(125, 1, 'The connected undirected graph without loops and multiple edges is given. You are allowed to remove the edges from it. Obtain a tree from the graph.', 'Tree from Graph', 'Input:\r\nThe first line contains the number of vertices n (1 ? n ? 100) and the number of edges m of the graph. The next m pairs of numbers define the edges. It is guaranteed that the graph is connected.\r\n\r\nOutput:\r\nPrint n - 1 pairs of numbers - the edges that will be included in a tree. The edges can be displayed in any order.', 'DS', '', ''),
(126, 1, 'The undirected unweighted graph with one selected vertex is given. Find the number of vertices in the connected component where the selected vertex belong (including the selected one).', 'Depth-First-Search', 'Input:\r\nThe first line contains two integers n and s (1 ? s ? n ? 100), where n - the number of vertices of the graph, and s - chosen vertex. The following n lines contains n numbers - the adjacency matrix of the graph in the MDM figure "0" means no edges between vertices, and the number "1" - its availability. It is guaranteed that the main diagonal of the matrix are always zero.\r\n\r\nOutput:\r\nPrint the desired number of vertices', 'AI', '', ''),
(127, 3, 'a) Your instructor in Design Patterns course asked you to write a Sorter who takes an input and sorts using two different algorithms i.e. Insertion Sort and bubble sort. Your sorter has may take input, sort using any of the two algorithms, print and plot output and show time complexity in Big-O notation for either of the two algorithms. Select the most appropriate design pattern to use to address the problem and show how it is applied. In particular, show an appropriate class diagram(s) and enough code fragments to illustrate your use of the pattern to solve the problem.\r\n\r\nb) Your teacher is thinking to add Quick Sort to this Sorter in future. Where you will be incorporating this change? Show in your class diagram as well as in your program.', 'Design Patterns Test', 'Nil', 'CP', '', ''),
(128, 1, 'Given a linked list find whether the list is looped or not. A linked list is looped when one of the nodes point to any one of its previous nodes or itself. Also find the length of the loop and the starting point of the loop.', 'Find loop in linked list', 'Nil', 'DS', '', ''),
(129, 1, 'Click o mania is a 1-player game consisting of a rectangular grid of square blocks, each colored in one of k colors. Adjacent blocks horizontally and vertically of the same color are considered to be a part of the same group. A move selects a group containing at least two blocks and removes those blocks, followed by two "falling" rules;\r\n\r\nAny blocks remaining above the holes created, fall down through the same column.\r\nAny empty columns are removed by sliding the succeeding columns left.\r\n\r\nIn this game, you have to code a bot such that it eliminates as many possible blocks from the grid. The top left of the grid is indexed (0,0) and the bottom right of the grid is indexed (rows-1,columns-1).', 'Click-o-Mania', 'Input Format \r\nThe first line of the input is 3 space separated integers, x y k where x and y are the row index and the column index of the grid respectively, and k is the number of colors the grid has.\r\n\r\nAn empty cell in the grid will be denoted by ''-''.\r\n\r\nOutput Format \r\nOutput 2 space separated integers that represent the co-ordinates of the block you choose to remove from the grid. You can output any one of the nodes of the group which you choose to remove.\r\n\r\nConstraints \r\n1 ? k ? 7 \r\nEach color can be any of ''V'',''I'',''B'',''G'',''Y'',''O'',''R'' (VIBGYOR)', 'AI', '', ''),
(130, 1, 'The Utopian tree goes through 2 cycles of growth every year. The first growth cycle occurs during the spring, when it doubles in height. The second growth cycle occurs during the summer, when its height increases by 1 meter. \r\nNow, a new Utopian tree sapling is planted at the onset of the spring. Its height is 1 meter. Can you find the height of the tree after N growth cycles?', 'Utopian Tree', 'Input Format \r\nThe first line contains an integer, T, the number of test cases. \r\nT lines follow. Each line contains an integer, N, that denotes the number of cycles for that test case.\r\n\r\nConstraints \r\n1 <= T <= 10 \r\n0 <= N <= 60\r\n\r\nOutput Format \r\nFor each test case, print the height of the Utopian tree after N cycles.', 'DS', '', ''),
(132, 3, 'asdas', 'shabaz', 'adasdasd', 'DS', '', ''),
(133, 3, '<p>123</p>\r\n', 'new question', '<p>5667</p>\r\n', 'DS', '', ''),
(135, 3, '<p>Baby ka hai birthday bash.</p>\r\n', 'Baby', '<p>_|_</p>\r\n', '135', 'int main', '0'),
(138, 3, '<p>asd</p>\r\n', 'sdasd', '<p>ads</p>\r\n', 'DS', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n	cout<<"Shoaib";\r\n	return 0;\r\n}', '0'),
(139, 3, '<p>kdaf</p>\r\n', 'asd', '<p>as</p>\r\n', 'DS', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n	cout<<"Hello";\r\n	return 0;\r\n}', 'C/C++'),
(140, 3, '<p>kajsd</p>\r\n', 'asdk', '<p>aslkd</p>\r\n', 'DS', 'print "Shoaib"', 'Python'),
(141, 3, '<p>Write a program which prints &quot;n&quot; stars in n lines where n is a positive integer entered by the user&nbsp;in such a way that the first line contains n stars, second line contains n-1 stars, third line contains n-2 stars and so on. The last line will contain only one star.</p>\r\n', 'Stars Code', '<p>The value of n provided by the user should be a non-negative integer.</p>\r\n', 'ITC', '#include <iostream>\r\nusing namespace std;\r\nint main() {\r\n	int n;\r\n        cout << "Enter the value of n" << endl;\r\n        cin >> n;\r\n\r\n\r\n	system("pause");\r\n        return 0;\r\n}', 'C/C++');

-- --------------------------------------------------------

--
-- Table structure for table `question_tc`
--

CREATE TABLE IF NOT EXISTS `question_tc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ques_id` int(11) NOT NULL,
  `input` varchar(100) NOT NULL,
  `output` varchar(100) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `question_tc`
--

INSERT INTO `question_tc` (`id`, `ques_id`, `input`, `output`, `points`) VALUES
(21, 67, 'qe', 'qwe', 9),
(22, 68, 'ASMD ASMD MASD MS DMS DMAS DMAS DMAS DMAS DMAS DMAS DMAS DMAS DMAS Ddsf', 'sdf', 4),
(23, 0, 'dfs', 'sdf', 4),
(24, 69, 'asd', 'asd', 2),
(25, 70, '4', '', 0),
(26, 70, '7 4 5 2 3 -4 -3 -5', '3', 2),
(27, 70, '1 -4', '1', 2),
(28, 70, '4 3 2 3 1', '1', 2),
(29, 70, '7 1 -2 -3 -4 2 0 -1', '7', 2),
(30, 71, '', '', 0),
(31, 72, '', '', 0),
(32, 73, '4  \r\n7 4 5 2 3 -4 -3 -5  \r\n1 -4  \r\n4 3 2 3 1  \r\n7 1 -2 -3 -4 2 0 -1  ', '3\r\n1\r\n1\r\n7', 5),
(33, 74, '4\r\n7 4 5 2 3 -4 -3 -5  \r\n1 -4  \r\n4 3 2 3 1\r\n7 1 -2 -3 -4 2 0 -1', '3\r\n1\r\n1\r\n7', 5),
(34, 75, '2\r\n3\r\n3\r\n3\r\n3\r\n3\r\n3\r\n', '\r\n2\r\n2\r\n2\r\n2\r\n2\r\n', 2),
(35, 76, '2\r\n3\r\n3\r\n3\r\n3\r\n3\r\n3\r\n', '\r\n2\r\n2\r\n2\r\n2\r\n2\r\n', 22),
(36, 77, '2\r\n3\r\n3\r\n3\r\n3\r\n3\r\n3\r\n', '\r\n2\r\n2\r\n2\r\n2\r\n2\r\n', 2222),
(37, 78, '2\r\n3\r\n3\r\n3\r\n3\r\n3\r\n3\r\n', '\r\n2\r\n2\r\n2\r\n2\r\n2\r\n', 222),
(38, 79, '2\r\n2\r\n2\r\n2\r\n2\r\n', '3\r\n3\r\n3\r\n3\r\n3\r\n', 2),
(39, 80, '1\r\n1\r\n2\r\n23\r\n4\r\n', '3\r\n4\r\n5\r\n6\r\n4\r\n', 2),
(40, 81, '2\r\n3\r\n3\r\n4\r\n5\r\n', '23\r\n2\r\n2\r\n2\r\n2\r\n', 2),
(41, 82, '2\r\n2\r\n2\r\n22\r\n\r\n2', '3\r\n3\r\n33\r\n3\r\n3\r\n\r\n3', 3),
(42, 83, '4\r\n7 4 5 2 3 -4 -3 -5  \r\n1 -4  \r\n4 3 2 3 1\r\n7 1 -2 -3 -4 2 0 -1', '3\r\n1\r\n1\r\n7', 5),
(43, 84, '4\r\n7 4 5 2 3 -4 -3 -5  \r\n1 -4  \r\n4 3 2 3 1\r\n7 1 -2 -3 -4 2 0 -1', '3\r\n1\r\n1\r\n7', 5),
(44, 85, '5\r\n1 2 b\r\n2 3 r\r\n3 4 r\r\n4 5 b', '4', 0),
(46, 87, '5\r\n4 5 3 7 2', '3 2 4 5 7', 5),
(48, 89, '3\r\n---\r\n-m-\r\np--', 'DOWN\r\nLEFT', 0),
(52, 93, 'asd', 's', 0),
(53, 94, 'am ,mas cmas cmas c', 'm cma cma', 4),
(54, 95, 'sa324324', 'faas', 3434),
(55, 95, 'bvcbcvbcv', 'vcbcvb', 44),
(61, 97, '', '', 0),
(62, 98, '', '', 0),
(63, 99, '', '', 0),
(64, 100, '', '', 0),
(65, 101, '', '', 0),
(66, 102, '', '', 0),
(67, 103, '', '', 0),
(68, 104, '', '', 0),
(69, 105, '', '', 0),
(70, 106, '', '', 0),
(71, 107, '', '', 0),
(72, 108, '', '', 0),
(73, 109, '', '', 0),
(74, 110, '', '', 0),
(75, 111, '', '', 0),
(76, 110, '', '', 0),
(77, 111, '', '', 0),
(78, 112, '', '', 0),
(79, 113, '', '', 0),
(80, 114, '', '', 0),
(81, 115, '', '', 0),
(82, 116, '', '', 0),
(83, 117, '33', '232', 2),
(85, 119, '12', '12', 12),
(86, 120, '1', '11', 1),
(87, 121, '2', '2', 2),
(88, 122, '2', '2', 2),
(89, 118, '1', '1', 1),
(90, 123, '5\r\n.....\r\n...##\r\n..#..\r\n..###\r\n.....', '198', 3),
(91, 124, '3 1 2\r\n0 -1 2\r\n3 0 -1\r\n-1 4 0', '6', 3),
(92, 125, '4 4\r\n1 2\r\n2 3\r\n3 4\r\n4 1', '1 2\r\n2 3\r\n3 4', 3),
(93, 126, '5 1\r\n0 1 1 0 0\r\n1 0 1 0 0\r\n1 1 0 0 0\r\n0 0 0 0 1\r\n0 0 0 1 0', '3', 3),
(95, 128, 'Nil', 'Nil', 2),
(96, 129, '20 10 2\r\nBBRBRBRBBB\r\nRBRBRBBRRR\r\nRRRBBRBRRR\r\nRBRBRRRBBB\r\nRBRBRRRRBB\r\nRBBRBRRRRR\r\nBBRBRRBRBR\r\nBRBRBBR', '0 1', 3),
(97, 130, '2\r\n0\r\n1', '1\r\n2', 3),
(98, 131, '2\r\n0\r\n1', '1\r\n2', 3),
(103, 136, 'add', 'asd', 232),
(104, 137, 's', 's', 3),
(105, 135, '', '', 0),
(106, 138, 'asd', 'fa', 12),
(107, 139, 'asd', 'lajdf', 0),
(108, 140, 'alsk', 'lask', 0),
(109, 141, '5', '*****\r\n ****\r\n  ***\r\n   **\r\n    *', 5),
(110, 141, '6', '******\r\n *****\r\n  ****\r\n   ***\r\n    **\r\n     *', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ques_image`
--

CREATE TABLE IF NOT EXISTS `ques_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ques_id` int(11) NOT NULL,
  `image` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ques_image`
--

INSERT INTO `ques_image` (`id`, `ques_id`, `image`) VALUES
(1, 117, 'Amir_-_Copy1.png'),
(3, 121, 'background_spriteb.png'),
(4, 122, 'background_sprite.png'),
(5, 118, 'raju1.png'),
(6, 123, 'un1.png'),
(7, 124, 'images.png'),
(8, 125, 'images1.png'),
(9, 126, 'images2.png'),
(11, 128, 'images4.png'),
(12, 129, 'Clickomania.png'),
(13, 130, 'images5.png'),
(14, 131, 'images6.png');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `course_id` varchar(15) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `name`, `description`, `course_id`, `teacher_id`) VALUES
(1, '1st quiz', 'HELLO', 'DS', 3),
(2, 'Daddy quiz', 'nnmnmnmn', 'AI', 3),
(3, 'FINAL', 'ASDASDASDASD', 'ITC', 3),
(4, 'Programming Test', 'Initial Programming Test', 'CP', 1),
(5, 'Data Structures Programming', 'To check the concepts of data structures.', 'DS', 1),
(10, 'asdkj', 'kadfj', 'DS', 3),
(11, 'Quiz No 1', 'Instructions\r\n1. This quiz contains only 1 question.\r\n2. You have 15 minutes for this quiz.\r\n3. The question contains two test cases. Your code should satisfy both of them.', 'ITC', 3);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_post`
--

CREATE TABLE IF NOT EXISTS `quiz_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` datetime NOT NULL,
  `end_ap` varchar(2) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `quiz_post`
--

INSERT INTO `quiz_post` (`id`, `quiz_id`, `start_time`, `end_time`, `end_ap`, `teacher_id`) VALUES
(1, 1, '2014-12-05 17:48:16', '2014-12-05 11:50:00', 'pm', 3),
(2, 2, '2014-12-04 23:12:11', '2014-12-06 06:18:00', 'pm', 3),
(3, 1, '2014-12-05 17:50:51', '2014-06-02 03:01:00', 'pm', 3),
(4, 3, '2014-12-05 18:12:15', '2015-12-29 12:18:00', 'pm', 3),
(5, 4, '2014-12-07 20:12:11', '2014-12-19 11:55:00', 'pm', 1),
(11, 10, '2015-03-28 17:03:47', '2015-11-19 11:19:00', 'pm', 3),
(12, 11, '2015-03-29 19:00:32', '2015-11-19 11:19:00', 'pm', 3);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_question`
--

CREATE TABLE IF NOT EXISTS `quiz_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `quiz_question`
--

INSERT INTO `quiz_question` (`id`, `quiz_id`, `question_id`) VALUES
(1, 1, 86),
(7, 2, 86),
(20, 4, 123),
(21, 4, 124),
(22, 4, 125),
(23, 4, 126),
(24, 5, 124),
(25, 5, 125),
(26, 5, 126),
(27, 3, 129),
(32, 8, 138),
(33, 9, 138),
(34, 9, 139),
(35, 10, 140),
(36, 11, 141);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_student`
--

CREATE TABLE IF NOT EXISTS `quiz_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `quiz_student`
--

INSERT INTO `quiz_student` (`id`, `quiz_id`, `student_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4),
(4, 1, 5),
(5, 2, 2),
(6, 3, 2),
(7, 3, 3),
(8, 3, 4),
(9, 3, 5),
(10, 4, 2),
(11, 4, 3),
(12, 4, 4),
(13, 4, 5),
(14, 5, 2),
(15, 5, 3),
(16, 5, 4),
(17, 5, 5),
(34, 10, 2),
(35, 10, 3),
(36, 10, 4),
(37, 10, 5),
(38, 11, 2),
(39, 11, 3),
(40, 11, 4),
(41, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `shared_question`
--

CREATE TABLE IF NOT EXISTS `shared_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ques_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `orig_teacher` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `shared_question`
--

INSERT INTO `shared_question` (`id`, `ques_id`, `teacher_id`, `orig_teacher`) VALUES
(1, 123, 3, 1),
(2, 124, 3, 1),
(3, 125, 3, 1),
(4, 126, 3, 1),
(5, 127, 1, 3),
(6, 128, 3, 1),
(7, 129, 3, 1),
(8, 130, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `section` varchar(2) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `fname`, `lname`, `email`, `section`, `password`) VALUES
(2, 'Zohaib', 'Masood', 'k112114', 'B', '123456'),
(3, 'Shoaib', 'Ahmed', 'k112016', 'B', '123456'),
(4, 'Fawad', 'Jawaid', 'k112116', 'B', '123456'),
(5, 'Mohammad', 'Zohair', 'k112181', 'B', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `student_code`
--

CREATE TABLE IF NOT EXISTS `student_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `code` mediumtext,
  `temp_code` mediumtext,
  `quiz_id` int(11) NOT NULL,
  `language` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `student_code`
--

INSERT INTO `student_code` (`id`, `student_id`, `question_id`, `code`, `temp_code`, `quiz_id`, `language`) VALUES
(34, 2, 90, 'zxczcxczxccxzcm zcznx czxn cnzxc zxnc zxnczxcn zxcznc zxnc zxnc nzx', '22222222222222222222', 3, '10'),
(35, 5, 90, 'masndasndsnadm.nam.dnasm.dnasm.ndasd.asn.dnasdasn.dasndmnas.dnasmdnasm.dnasm.dnasmdnasm.dnasm.dnas', NULL, 3, '10'),
(36, 5, 91, 'nncv,mzxncmzxn,mcnzx,mcnzxcnmzxn c,mzxn c,mzxn czxn czx,mcn zx,mcn ', NULL, 3, '10'),
(39, 2, 91, 'asdasdnmasdnas,mxnas,mdnasmndmasdnasdmasnd,masn,dmas,dn', '33333333333333333333', 3, '10'),
(40, 2, 129, 'zmzmzmzm', '55555555555555555555', 3, '0'),
(41, 2, 132, NULL, '99999999999999999999', 3, '7'),
(42, 3, 141, '#include <iostream>\r\nusing namespace std;\r\nint main() {\r\n	int n,i=0,j=0;\r\n        cout << "Enter the value of n" << endl;\r\n        cin >> n;\r\n\r\nfor(i=0;i<j;i++)\r\n{\r\n  cout << " ";\r\n\r\n  for(j=n;j<i;j--)\r\n  {\r\n    cout << "*";\r\n  }\r\n  cout << endl;\r\n}\r\n\r\n\r\n\r\n\r\n	system("pause");\r\n        return 0;\r\n}', NULL, 11, '7');

-- --------------------------------------------------------

--
-- Table structure for table `stu_pass`
--

CREATE TABLE IF NOT EXISTS `stu_pass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_email` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stu_pic`
--

CREATE TABLE IF NOT EXISTS `stu_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `pic` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `stu_pic`
--

INSERT INTO `stu_pic` (`id`, `student_id`, `pic`) VALUES
(16, 2, '1383358_609920375765877_1083695108_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_course`
--

CREATE TABLE IF NOT EXISTS `teacher_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `teacher_course`
--

INSERT INTO `teacher_course` (`id`, `teacher_id`, `course_id`) VALUES
(1, 1, 1),
(3, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(10) NOT NULL,
  `lname` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`) VALUES
(1, 'Zohaib', 'Masood', 'k112114@nu'),
(2, 'Z', 'M', 'zm099@yahoo.com'),
(3, 'Carol', 'Elizbeth', 'carol.elizbeth@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
