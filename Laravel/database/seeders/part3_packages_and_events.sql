-- PART 3: Packages and Package Events

-- Packages Table
INSERT INTO `packages` (`package_id`, `title`, `description`, `decorator_id`, `price`, `rating`, `status`, `created_at`) VALUES
(1, 'Complete Wedding Package', 'Full wedding decoration package including sangeet, mehendi, and reception decor', 1, 95000.00, 4.8, 'confirmed', '2025-03-15 09:30:00'),
(2, 'Birthday Special', 'Complete birthday decoration package with cake area, photo booth, and theme decor', 2, 25000.00, 4.5, 'confirmed', '2025-03-18 11:45:00'),
(3, 'Corporate Event Bundle', 'Professional package for corporate events including stage, seating and branding', 3, 70000.00, 4.6, 'confirmed', '2025-03-22 14:15:00'),
(4, 'New Home Celebration', 'Complete house warming package with traditional and modern elements', 4, 30000.00, 4.3, 'confirmed', '2025-03-25 10:30:00'),
(5, 'Anniversary Special', 'Romantic anniversary package with flower arrangements and mood lighting', 5, 45000.00, 4.7, 'confirmed', '2025-03-28 13:00:00'),
(6, 'Baby Welcome Package', 'Complete package for baby shower and welcome ceremonies', 6, 35000.00, 4.4, 'confirmed', '2025-04-01 15:30:00'),
(7, 'Engagement to Wedding', 'Complete package covering engagement and wedding ceremonies', 7, 85000.00, 4.9, 'confirmed', '2025-04-05 09:45:00'),
(8, 'Festival Celebration Bundle', 'Decoration package for religious festivals and ceremonies', 8, 40000.00, 4.5, 'confirmed', '2025-04-08 12:15:00'),
(9, 'Academic Celebration', 'Complete package for graduation and academic celebrations', 9, 30000.00, 4.2, 'confirmed', '2025-04-12 14:30:00'),
(10, 'Multi-Day Festival Package', 'Decoration package for multiple days of festival celebrations', 10, 50000.00, 4.6, 'confirmed', '2025-04-15 11:00:00'),
(11, 'Business Conference Package', 'Complete setup for business conferences and seminars', 11, 65000.00, 4.4, 'confirmed', '2025-04-18 13:45:00'),
(12, 'Product Launch Bundle', 'Comprehensive package for product launches and exhibitions', 12, 55000.00, 4.5, 'confirmed', '2025-04-22 16:15:00'),
(13, 'Wedding Rituals Package', 'Complete package for all wedding rituals and ceremonies', 13, 90000.00, 4.8, 'confirmed', '2025-04-25 10:30:00'),
(14, 'Party Night Special', 'Package for cocktail parties and night celebrations', 14, 45000.00, 4.3, 'confirmed', '2025-04-28 12:45:00'),
(15, 'Grand Celebration Package', 'Luxurious package for large-scale celebrations and events', 15, 100000.00, 4.9, 'confirmed', '2025-05-01 15:00:00'),
(16, 'Cultural Events Bundle', 'Package for traditional cultural events and celebrations', 16, 60000.00, 4.6, 'confirmed', '2025-05-04 09:15:00'),
(17, 'Milestone Celebration', 'Package for retirement and other milestone celebrations', 17, 40000.00, 4.5, 'confirmed', '2025-05-07 11:30:00'),
(18, 'School Events Package', 'Complete package for school events and annual functions', 18, 35000.00, 4.2, 'confirmed', '2025-05-10 14:00:00'),
(19, 'Religious Ceremony Bundle', 'Package for religious ceremonies and puja celebrations', 19, 38000.00, 4.7, 'confirmed', '2025-05-13 16:30:00'),
(20, 'Holiday Season Special', 'Package for decorating during holiday seasons', 20, 45000.00, 4.5, 'confirmed', '2025-05-16 10:45:00');

-- Package Events Table (multiple events in one package as requested)
INSERT INTO `package_events` (`package_event_id`, `package_id`, `event_id`) VALUES
-- Package 1: Complete Wedding Package (4 events)
(1, 1, 1),   -- Royal Wedding Decoration
(2, 1, 7),   -- Engagement Glamour
(3, 1, 13),  -- Mehendi Celebration
(4, 1, 15),  -- Grand Reception

-- Package 2: Birthday Special (2 events)
(5, 2, 2),   -- Birthday Bash
(6, 2, 22),  -- Kids Birthday Party

-- Package 3: Corporate Event Bundle (3 events)
(7, 3, 3),   -- Corporate Annual Meet
(8, 3, 11),  -- Corporate Conference Setup
(9, 3, 23),  -- Team Building Event

-- Package 4: New Home Celebration (2 events)
(10, 4, 4),  -- Warm Housewarming
(11, 4, 24), -- Modern Housewarming

-- Package 5: Anniversary Special (2 events)
(12, 5, 5),  -- Silver Anniversary Celebration
(13, 5, 25), -- Golden Anniversary

-- Package 6: Baby Welcome Package (2 events)
(14, 6, 6),  -- Baby Shower Wonderland
(15, 6, 26), -- Gender Reveal Party

-- Package 7: Engagement to Wedding (3 events)
(16, 7, 7),  -- Engagement Glamour
(17, 7, 1),  -- Royal Wedding Decoration
(18, 7, 15), -- Grand Reception

-- Package 8: Festival Celebration Bundle (3 events)
(19, 8, 8),  -- Diwali Decoration
(20, 8, 10), -- Holi Celebration
(21, 8, 28), -- Navratri Decoration

-- Package 9: Academic Celebration (2 events)
(22, 9, 9),  -- Graduation Party
(23, 9, 29), -- College Farewell Decoration

-- Package 10: Multi-Day Festival Package (3 events)
(24, 10, 10), -- Holi Celebration
(25, 10, 19), -- Ganesh Puja Decoration
(26, 10, 30), -- Janmashtami Celebration

-- Package 11: Business Conference Package (2 events)
(27, 11, 11), -- Corporate Conference Setup
(28, 11, 3),  -- Corporate Annual Meet

-- Package 12: Product Launch Bundle (2 events)
(29, 12, 12), -- Product Launch Event
(30, 12, 3),  -- Corporate Annual Meet

-- Package 13: Wedding Rituals Package (4 events)
(31, 13, 13), -- Mehendi Celebration
(32, 13, 16), -- Sangeet Night Decoration
(33, 13, 1),  -- Royal Wedding Decoration
(34, 13, 15), -- Grand Reception Decoration

-- Package 14: Party Night Special (2 events)
(35, 14, 14), -- Cocktail Party Setup
(36, 14, 20), -- Christmas Party Setup

-- Package 15: Grand Celebration Package (3 events)
(37, 15, 15), -- Grand Reception Decoration
(38, 15, 1),  -- Royal Wedding Decoration
(39, 15, 21), -- Destination Wedding Decor

-- Package 16: Cultural Events Bundle (3 events)
(40, 16, 16), -- Sangeet Night Decoration
(41, 16, 19), -- Ganesh Puja Decoration
(42, 16, 28), -- Navratri Decoration

-- Package 17: Milestone Celebration (2 events)
(43, 17, 17), -- Retirement Party
(44, 17, 9),  -- Graduation Party

-- Package 18: School Events Package (2 events)
(45, 18, 18), -- School Annual Day
(46, 18, 9),  -- Graduation Party

-- Package 19: Religious Ceremony Bundle (3 events)
(47, 19, 19), -- Ganesh Puja Decoration
(48, 19, 28), -- Navratri Decoration
(49, 19, 30), -- Janmashtami Celebration

-- Package 20: Holiday Season Special (2 events)
(50, 20, 20), -- Christmas Party Setup
(51, 20, 10); -- Holi Celebration
