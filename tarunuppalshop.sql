-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2021 at 06:35 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tarunuppalshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart_Id` int(11) NOT NULL,
  `Product_Id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Customer_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `User_Id` int(11) NOT NULL,
  `User_Email` varchar(255) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `User_First_Name` varchar(50) NOT NULL,
  `User_Last_Name` varchar(50) NOT NULL,
  `User_City` varchar(90) NOT NULL,
  `User_State` varchar(20) NOT NULL,
  `User_Zip` varchar(12) NOT NULL,
  `User_Address` varchar(255) NOT NULL,
  `Registration_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `User_Phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`User_Id`, `User_Email`, `User_Password`, `User_First_Name`, `User_Last_Name`, `User_City`, `User_State`, `User_Zip`, `User_Address`, `Registration_Date`, `User_Phone`) VALUES
(1, 'admin@admin.com', 'admin', 'Tarun', 'Uppal', 'Montreal', 'Quebec', 'H1E 7E6', 'Montreal, Quebec', '2021-07-27 21:48:14', '3216549870');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Feedback_Id` int(11) NOT NULL,
  `Customer_Name` varchar(50) NOT NULL,
  `Customer_Email` varchar(100) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_Id` int(11) NOT NULL,
  `Order_Date` datetime NOT NULL,
  `Order_Status` varchar(1) NOT NULL DEFAULT 'N',
  `Shipping_Amount` int(11) NOT NULL,
  `Order_Amount` int(11) NOT NULL,
  `Payment_Satus` varchar(1) NOT NULL DEFAULT 'N',
  `Shipping_Status` varchar(1) NOT NULL DEFAULT 'N',
  `Customer_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `Id` int(11) NOT NULL,
  `Customer_Id` int(11) NOT NULL,
  `Product_Id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Status` varchar(1) NOT NULL DEFAULT 'N',
  `Order_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`Id`, `Customer_Id`, `Product_Id`, `Quantity`, `Status`, `Order_Id`) VALUES
(1, 1, 1, 1, 'Y', 1),
(2, 1, 1, 1, 'Y', 2),
(3, 1, 2, 1, 'Y', 3),
(4, 0, 4, 4, 'N', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_Id` int(11) NOT NULL,
  `Product_Name` varchar(50) NOT NULL,
  `Product_short_desc` varchar(200) NOT NULL,
  `Product_full_desc` varchar(500) NOT NULL,
  `Product_price` decimal(10,2) NOT NULL,
  `Category_Id` int(11) NOT NULL,
  `Image` varchar(200) NOT NULL,
  `Product_Publish` varchar(10) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_Id`, `Product_Name`, `Product_short_desc`, `Product_full_desc`, `Product_price`, `Category_Id`, `Image`, `Product_Publish`) VALUES
(1, 'Basmati Rice', 'Ajanta Indian Basmati Rice 40lbs', '&lt;p&gt;Ajanta Indian Basmati Rice brings you its Daily Choice Mini Mogra Basmati Rice. It is a medium-grain variety Basmati Rice that can be used for daily preparations. It is sourced from fields of North India and is packed in clean and hygienic conditions to ensure that the purity, taste and aroma of the grain are intact.&lt;/p&gt;\r\n&lt;p&gt;Bring home Ajanta Indian Basmati Rice and add the taste and goodness of Basmati Rice to your everyday meal.&lt;/p&gt;', '40.00', 1, 'fgdf.jpg', 'Y'),
(2, 'Weikfield Pasta Penne', 'Weikfield Pasta Penne, 1lbs Pouch', '&lt;p&gt;WeikField Pasta Hi-Protein Durum Wheat: Recipe: Spaghetti in Quick Marinara Sauce-Serves 2, Preparation Time 12 mins, Cooking Time 10-15 mins, Recipe Ingredients 100g of Weikfield Pasta Spaghetti uncooked, 2 tbsp Olive oil/cooking oil, 1 cup of chopped onion, 2-21/2 tbsp finely chopped garlic, 2 cups of chopped tomatoes, 1-2 tsp dried basil or 1/4-1/2 cup of chopped fresh basil 1/2 tsp dried parsley, 3 tsp Tomato Ketchup, Salt to taste, For garnish, Oregano, Fresh Parsley, Cut black Oli', '2.00', 7, 'ezgif.com-gif-maker.jpg', 'N'),
(4, 'Diet Coke', 'Coca-Cola Diet Coke Soft Drink 300ml', '&lt;p&gt;All over the world, Coca-Cola is synonymous with happiness and celebration. Coke is the first thing that comes to the mind of millions across the globe when they reach out for a cold drink.&lt;/p&gt;', '1.00', 6, '220px-Diet-Coke-Can.jpg', 'Y'),
(5, 'Coconut Water', 'Raw Pressery Coconut Water, 200 ml', '&lt;p&gt;Every athlete&amp;rsquo;s go to natural energy drink; Coconut Water is a complete win-win for your everyday rehydration needs. #iaminlovewiththecoco!&lt;/p&gt;', '5.00', 6, '51dU-CsJMfL._SX569_.jpg', 'Y'),
(6, 'Spices Combo Pack', 'GreenFinity Whole Spices Combo Pack - (50g * 3) 150g (Black Pepper, Green Cardamom, Cloves) - All Premium.', '&lt;p&gt;Store in cool &amp;amp; dry place. Avoid direct sunlight &amp;amp; moisture. Keep the material in air tight container once opened. Company will not be responsible for the packet once opened.&lt;/p&gt;', '10.00', 2, '71MlZfRQbxS._SX466_.jpg', 'Y'),
(7, 'Cookie Man Almond Fingers', 'Cookie Man Almond Fingers 250gms Gourmet Hand Made Snack Biscuit with Real Almonds', '&lt;p&gt;&lt;span class=&quot;a-list-item&quot;&gt;Cookie Man Almond Fingers are short bread cookies with real almond flakes&lt;/span&gt;&lt;/p&gt;', '15.00', 3, '610VjXX44bS._SX522_.jpg', 'Y'),
(8, 'Graham Baking Crumbs', 'Great Value Graham Baking Crumbs 400g', '&lt;p&gt;Great Value Graham Baking Crumbs are a convenient baking item your household will love. Crushing graham wafers to the perfect grind can be difficult skip that tedious task and head straight to the fun of baking. Use Great Value Graham Baking Crumbs to create pie crusts and other fun desserts that your entire family will enjoy.&lt;/p&gt;', '2.00', 4, '605388879301.jpg', 'Y'),
(9, 'Hearty Seasoning', 'Tasty, Hearty Seasoning, 33g', '&lt;div class=&quot;css-1ev1b0e eqaamsw1&quot;&gt;\r\n&lt;div class=&quot;css-190aten e1mpbtcv0&quot;&gt;\r\n&lt;div class=&quot;css-1nf1bpj e1mpbtcv2&quot; data-automation=&quot;long-description&quot;&gt;Tasty by Club House, Quality Natural Herbs &amp;amp; Spices, Seasoning Blend, Hearty, 33g. &lt;br /&gt;&lt;br /&gt;Obsessed with flavour since 1883. After more than 135 years Canadians know the pure flavour tastes better. From our family in London, Ontario, to yours we have committed to delivering ', '3.00', 5, '6000201988459.jpg', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `Category_Id` int(11) NOT NULL,
  `Category_Name` varchar(50) NOT NULL,
  `Category_desc` varchar(200) NOT NULL,
  `Category_Publish` varchar(10) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`Category_Id`, `Category_Name`, `Category_desc`, `Category_Publish`) VALUES
(1, 'Rice', 'Rice', 'Y'),
(2, 'Spices', 'Spices', 'Y'),
(3, 'Bakery', 'Bakery', 'Y'),
(4, 'Flour', 'Flour', 'Y'),
(5, 'Mixed Spices', 'Mixed Spices', 'Y'),
(6, 'Beverages', 'Beverages', 'Y'),
(7, 'Snacks', 'Snacks', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_Id` int(11) NOT NULL,
  `Fullname` varchar(50) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_Id`, `Fullname`, `Username`, `Password`) VALUES
(1, 'Administrator', 'Admin', 'Password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart_Id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`User_Id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Feedback_Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_Id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_Id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`Category_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `Feedback_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `Category_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
