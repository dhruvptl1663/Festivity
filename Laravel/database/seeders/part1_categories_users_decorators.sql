-- PART 1: Categories, Users, Decorators, Admins

-- Categories Table
INSERT INTO `categories` (`category_id`, `category_name`, `description`, `created_at`) VALUES
(1, 'Wedding', 'Beautiful wedding decoration services for your special day', NOW()),
(2, 'Birthday', 'Creative birthday decoration services for all ages', NOW()),
(3, 'Corporate Event', 'Professional decoration for corporate meetings and events', NOW()),
(4, 'Housewarming', 'Elegant decoration for new home celebrations', NOW()),
(5, 'Anniversary', 'Romantic decoration for anniversary celebrations', NOW()),
(6, 'Baby Shower', 'Cute and adorable decoration for baby showers', NOW()),
(7, 'Engagement', 'Sophisticated decoration for engagement ceremonies', NOW()),
(8, 'Religious Ceremony', 'Traditional decoration for religious events', NOW()),
(9, 'Graduation', 'Celebratory decoration for graduation parties', NOW()),
(10, 'Festival', 'Vibrant decoration for various festival celebrations', NOW()),
(11, 'Conference', 'Formal decoration for conferences and seminars', NOW()),
(12, 'Product Launch', 'Impressive decoration for product launches', NOW()),
(13, 'Mehendi', 'Colorful decoration for mehendi ceremonies', NOW()),
(14, 'Cocktail Party', 'Stylish decoration for cocktail parties and gatherings', NOW()),
(15, 'Reception', 'Grand decoration for reception ceremonies', NOW()),
(16, 'Sangeet', 'Vibrant decoration for sangeet ceremonies', NOW()),
(17, 'Retirement Party', 'Elegant decoration for retirement celebrations', NOW()),
(18, 'School Event', 'Fun decoration for school events and functions', NOW()),
(19, 'Puja', 'Traditional decoration for puja ceremonies', NOW()),
(20, 'Holiday Party', 'Festive decoration for holiday season celebrations', NOW());

-- Users Table
INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Rahul Sharma', 'rahul.sharma@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-03-10 10:15:22'),
(2, 'Priya Patel', 'priya.patel@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-03-11 14:20:45'),
(3, 'Amit Kumar', 'amit.kumar@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-03-12 09:30:15'),
(4, 'Neha Singh', 'neha.singh@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-03-15 16:45:30'),
(5, 'Vikas Gupta', 'vikas.gupta@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-03-18 11:10:25'),
(6, 'Anjali Verma', 'anjali.verma@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-03-20 13:25:45'),
(7, 'Rajesh Khanna', 'rajesh.khanna@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-03-22 10:05:30'),
(8, 'Meena Kumari', 'meena.kumari@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-03-25 15:40:20'),
(9, 'Deepak Joshi', 'deepak.joshi@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-03-28 09:15:50'),
(10, 'Pooja Sharma', 'pooja.sharma@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-04-01 14:30:10'),
(11, 'Suresh Yadav', 'suresh.yadav@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-04-03 11:20:35'),
(12, 'Rekha Mishra', 'rekha.mishra@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-04-05 16:55:45'),
(13, 'Ajay Malhotra', 'ajay.malhotra@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-04-08 10:40:15'),
(14, 'Sunita Agarwal', 'sunita.agarwal@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-04-10 13:15:30'),
(15, 'Vivek Reddy', 'vivek.reddy@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-04-12 15:25:40'),
(16, 'Kavita Nair', 'kavita.nair@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-04-15 09:50:20'),
(17, 'Manoj Tiwari', 'manoj.tiwari@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-04-18 14:05:35'),
(18, 'Shweta Kapoor', 'shweta.kapoor@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-04-20 11:30:25'),
(19, 'Dinesh Choudhary', 'dinesh.choudhary@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-04-22 16:15:40'),
(20, 'Anita Desai', 'anita.desai@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-04-25 10:45:30');

-- Decorators Table
INSERT INTO `decorators` (`decorator_id`, `decorator_name`, `decorator_icon`, `email`, `password`, `rating`, `availability`, `created_at`) VALUES
(1, 'Elegant Events', 'images/decorators/dlogo.png', 'elegant@events.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.5, 1, '2025-03-05 09:00:00'),
(2, 'Dream Decorators', 'images/decorators/dndlogo.png', 'dream@decorators.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.2, 1, '2025-03-07 10:30:00'),
(3, 'Magical Moments', 'images/decorators/dlogo-png', 'magical@moments.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.7, 1, '2025-03-10 11:15:00'),
(4, 'Royal Decors', 'images/decorators/dndlogo.png', 'royal@decors.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.0, 1, '2025-03-12 12:45:00'),
(5, 'Festive Flames', 'images/decorators/dlogo.png', 'festive@flames.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.8, 1, '2025-03-15 09:30:00'),
(6, 'Vibrant Venues', 'images/decorators/dlogo-png', 'vibrant@venues.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.3, 0, '2025-03-18 14:20:00'),
(7, 'Graceful Garnish', 'images/decorators/dndlogo.png', 'graceful@garnish.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.6, 1, '2025-03-20 10:45:00'),
(8, 'Celebration Creators', 'images/decorators/dlogo.png', 'celebration@creators.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.1, 1, '2025-03-23 09:15:00'),
(9, 'Divine Decors', 'images/decorators/dlogo-png', 'divine@decors.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.9, 1, '2025-03-25 11:30:00'),
(10, 'Artistic Arrangements', 'images/decorators/dndlogo.png', 'artistic@arrangements.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.4, 1, '2025-03-28 13:45:00'),
(11, 'Perfect Parties', 'images/decorators/dlogo.png', 'perfect@parties.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.2, 1, '2025-04-01 10:00:00'),
(12, 'Splendid Settings', 'images/decorators/dlogo-png', 'splendid@settings.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.5, 0, '2025-04-03 14:30:00'),
(13, 'Majestic Makeovers', 'images/decorators/dndlogo.png', 'majestic@makeovers.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.7, 1, '2025-04-05 09:45:00'),
(14, 'Blissful Beginnings', 'images/decorators/dlogo.png', 'blissful@beginnings.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.3, 1, '2025-04-08 11:15:00'),
(15, 'Grand Garnishers', 'images/decorators/dlogo-png', 'grand@garnishers.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.8, 1, '2025-04-10 13:30:00'),
(16, 'Vivid Vision Decorators', 'images/decorators/dndlogo.png', 'vivid@vision.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.0, 1, '2025-04-12 15:45:00'),
(17, 'Elite Event Decorators', 'images/decorators/dlogo.png', 'elite@eventdecorators.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.6, 0, '2025-04-15 10:00:00'),
(18, 'Radiant Revelries', 'images/decorators/dlogo-png', 'radiant@revelries.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.2, 1, '2025-04-18 12:15:00'),
(19, 'Spectacular Settings', 'images/decorators/dndlogo.png', 'spectacular@settings.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.9, 1, '2025-04-20 14:30:00'),
(20, 'Glorious Gatherings', 'images/decorators/dlogo.png', 'glorious@gatherings.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4.5, 1, '2025-04-22 09:45:00');

-- Admins Table
INSERT INTO `admins` (`admin_id`, `name`, `email`, `password_hash`, `created_at`) VALUES
(1, 'Admin User', 'admin@festivity.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-03-01 00:00:00');
