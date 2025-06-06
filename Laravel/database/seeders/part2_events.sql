-- PART 2: Events

-- Events Table (Using the specified images)
INSERT INTO `events` (`event_id`, `title`, `description`, `image`, `category_id`, `decorator_id`, `is_live`, `price`, `rating`, `created_at`) VALUES
(1, 'Royal Wedding Decoration', 'Luxurious wedding decoration setup with royal theme and elegant floral arrangements', 'images/events/demo.png', 1, 1, 1, 45000.00, 4.7, '2025-03-10 10:00:00'),
(2, 'Birthday Bash', 'Colorful birthday decoration with balloons, streamers, and themed props', 'images/events/hl.jpg', 2, 2, 1, 15000.00, 4.5, '2025-03-11 11:15:00'),
(3, 'Corporate Annual Meet', 'Professional decoration for corporate events with branded elements', 'images/events/w10.jpg', 3, 3, 1, 35000.00, 4.3, '2025-03-12 09:30:00'),
(4, 'Warm Housewarming', 'Traditional and modern decoration for new home celebrations', 'images/events/img-png', 4, 4, 1, 12000.00, 4.2, '2025-03-15 14:45:00'),
(5, 'Silver Anniversary Celebration', 'Romantic silver-themed decoration for anniversary celebrations', 'images/events/demo.png', 5, 5, 1, 25000.00, 4.8, '2025-03-18 12:30:00'),
(6, 'Baby Shower Wonderland', 'Adorable decoration for baby showers with gender reveal themes', 'images/events/hl.jpg', 6, 6, 1, 18000.00, 4.4, '2025-03-20 15:15:00'),
(7, 'Engagement Glamour', 'Sophisticated decoration for engagement ceremonies with floral arches', 'images/events/w10.jpg', 7, 7, 1, 30000.00, 4.6, '2025-03-22 11:00:00'),
(8, 'Diwali Decoration', 'Traditional decoration for Diwali with diyas, rangoli, and lights', 'images/events/img-png', 8, 8, 1, 20000.00, 4.5, '2025-03-25 10:45:00'),
(9, 'Graduation Party', 'Academic-themed decoration for graduation celebrations', 'images/events/demo.png', 9, 9, 1, 15000.00, 4.3, '2025-03-28 13:30:00'),
(10, 'Holi Celebration', 'Vibrant decoration for Holi festival with color themes', 'images/events/hl.jpg', 10, 10, 1, 22000.00, 4.4, '2025-04-01 09:15:00'),
(11, 'Corporate Conference Setup', 'Formal decoration for business conferences with tech setup', 'images/events/w10.jpg', 11, 11, 1, 40000.00, 4.2, '2025-04-03 14:00:00'),
(12, 'Product Launch Event', 'Innovative decoration for product launches with brand focus', 'images/events/img-png', 12, 12, 1, 35000.00, 4.5, '2025-04-05 11:30:00'),
(13, 'Mehendi Celebration', 'Colorful traditional decoration for mehendi ceremonies', 'images/events/demo.png', 13, 13, 1, 25000.00, 4.7, '2025-04-08 15:45:00'),
(14, 'Cocktail Party Setup', 'Stylish decoration for cocktail parties with bar and lounge areas', 'images/events/hl.jpg', 14, 14, 1, 28000.00, 4.3, '2025-04-10 10:15:00'),
(15, 'Grand Reception Decoration', 'Luxurious setup for wedding receptions with themed décor', 'images/events/w10.jpg', 15, 15, 1, 50000.00, 4.9, '2025-04-12 13:00:00'),
(16, 'Sangeet Night Decoration', 'Vibrant decoration for sangeet ceremonies with dance floor', 'images/events/img-png', 16, 16, 1, 32000.00, 4.6, '2025-04-15 16:30:00'),
(17, 'Retirement Party', 'Elegant decoration for retirement celebrations with memorabilia', 'images/events/demo.png', 17, 17, 1, 20000.00, 4.4, '2025-04-18 11:45:00'),
(18, 'School Annual Day', 'Thematic decoration for school events and functions', 'images/events/hl.jpg', 18, 18, 1, 15000.00, 4.2, '2025-04-20 14:15:00'),
(19, 'Ganesh Puja Decoration', 'Traditional decoration for Ganesh Chaturthi celebrations', 'images/events/w10.jpg', 19, 19, 1, 18000.00, 4.8, '2025-04-22 09:30:00'),
(20, 'Christmas Party Setup', 'Festive decoration for Christmas celebrations with Santa theme', 'images/events/img-png', 20, 20, 1, 25000.00, 4.5, '2025-04-25 12:45:00'),
(21, 'Destination Wedding Decor', 'Beach-themed wedding decoration for destination weddings', 'images/events/demo.png', 1, 1, 1, 60000.00, 4.8, '2025-04-28 15:30:00'),
(22, 'Kids Birthday Party', 'Cartoon-themed decoration for children\'s birthday parties', 'images/events/hl.jpg', 2, 2, 1, 12000.00, 4.4, '2025-05-01 10:00:00'),
(23, 'Team Building Event', 'Activity-based decoration for corporate team building events', 'images/events/w10.jpg', 3, 3, 1, 30000.00, 4.2, '2025-05-04 13:45:00'),
(24, 'Modern Housewarming', 'Contemporary minimalist decoration for new apartments', 'images/events/img-png', 4, 4, 1, 15000.00, 4.5, '2025-05-07 11:15:00'),
(25, 'Golden Anniversary', 'Gold-themed elegant decoration for 50th anniversary celebrations', 'images/events/demo.png', 5, 5, 1, 40000.00, 4.9, '2025-05-10 14:30:00'),
(26, 'Gender Reveal Party', 'Creative decoration for baby gender reveal parties', 'images/events/hl.jpg', 6, 6, 1, 20000.00, 4.6, '2025-05-13 09:45:00'),
(27, 'Rooftop Engagement', 'Open-air decoration for rooftop engagement celebrations', 'images/events/w10.jpg', 7, 7, 1, 35000.00, 4.7, '2025-05-16 12:00:00'),
(28, 'Navratri Decoration', 'Traditional decoration for Navratri festival celebrations', 'images/events/img-png', 8, 8, 1, 22000.00, 4.5, '2025-05-19 15:15:00'),
(29, 'College Farewell Decoration', 'Nostalgic decoration for college farewell events', 'images/events/demo.png', 9, 9, 1, 18000.00, 4.4, '2025-05-22 10:30:00'),
(30, 'Janmashtami Celebration', 'Krishna-themed decoration for Janmashtami festival', 'images/events/hl.jpg', 10, 10, 1, 25000.00, 4.6, '2025-05-25 13:45:00');
