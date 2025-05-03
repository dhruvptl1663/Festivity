-- PART 5: Feedback and Booking Cancellations

-- Feedback Table (for completed bookings)
INSERT INTO `feedback` (`feedback_id`, `user_id`, `event_id`, `package_id`, `decorator_id`, `booking_id`, `rating`, `comment`, `created_at`) VALUES
-- User 1 Feedback
(1, 1, 1, NULL, 1, 1, 4.7, 'Absolutely loved the decoration. It made our wedding day magical!', '2025-06-20 14:30:00'),
(2, 1, NULL, 1, 1, 2, 4.8, 'The complete wedding package was worth every penny. Beautiful arrangements!', '2025-06-25 10:15:00'),
-- User 2 Feedback
(3, 2, 2, NULL, 2, 6, 4.5, 'Amazing birthday decoration. My child was very happy!', '2025-06-23 16:45:00'),
(4, 2, NULL, 2, 2, 7, 4.6, 'Great birthday package. The theme was perfectly executed.', '2025-07-15 11:30:00'),
-- User 3 Feedback
(5, 3, 3, NULL, 3, 11, 4.3, 'The corporate event decoration was professional and elegant.', '2025-06-27 09:45:00'),
(6, 3, NULL, 3, 3, 12, 4.5, 'Excellent corporate package, everyone was impressed with the setup.', '2025-07-17 15:00:00'),
-- User 4 Feedback
(7, 4, 4, NULL, 4, 16, 4.2, 'The housewarming decoration was simple yet elegant.', '2025-06-30 12:15:00'),
(8, 4, NULL, 4, 4, 17, 4.4, 'Loved the mix of traditional and modern elements in the decoration.', '2025-07-20 14:30:00'),
-- User 5 Feedback
(9, 5, 5, NULL, 5, 21, 4.8, 'The silver anniversary decoration was absolutely stunning!', '2025-07-03 10:30:00'),
(10, 5, NULL, 5, 5, 22, 4.7, 'Beautiful anniversary package with perfect mood lighting.', '2025-07-23 13:45:00'),
-- User 6 Feedback
(11, 6, 6, NULL, 6, 26, 4.4, 'The baby shower decoration was adorable and perfect.', '2025-07-06 15:00:00'),
(12, 6, NULL, 6, 6, 27, 4.5, 'Lovely baby welcome package with all the cute elements.', '2025-07-25 11:15:00'),
-- User 7 Feedback
(13, 7, 7, NULL, 7, 31, 4.6, 'The engagement decoration was sophisticated and elegant.', '2025-07-10 09:30:00'),
(14, 7, NULL, 7, 7, 32, 4.9, 'The engagement to wedding package was comprehensive and beautiful.', '2025-07-27 16:45:00'),
-- User 8 Feedback
(15, 8, 8, NULL, 8, 36, 4.5, 'The Diwali decoration was traditional and vibrant!', '2025-07-13 12:00:00'),
(16, 8, NULL, 8, 8, 37, 4.6, 'Festival package had beautiful decorations for all occasions.', '2025-07-30 14:15:00'),
-- User 9 Feedback
(17, 9, 9, NULL, 9, 41, 4.3, 'The graduation party decoration was perfect for the occasion.', '2025-07-17 10:45:00'),
(18, 9, NULL, 9, 9, 42, 4.2, 'Academic celebration package had nice thoughtful elements.', '2025-08-02 13:00:00'),
-- User 10 Feedback
(19, 10, 10, NULL, 10, 46, 4.4, 'The Holi celebration decoration was colorful and vibrant!', '2025-07-20 15:30:00'),
(20, 10, NULL, 10, 10, 47, 4.6, 'Multi-day festival package was comprehensive and beautiful.', '2025-08-04 11:45:00'),
-- User 11 Feedback
(21, 11, 11, NULL, 11, 51, 4.2, 'The conference setup was professional and well-organized.', '2025-07-23 09:15:00'),
(22, 11, NULL, 11, 11, 52, 4.4, 'Business conference package had all the necessary elements.', '2025-08-07 14:30:00'),
-- User 12 Feedback
(23, 12, 12, NULL, 12, 56, 4.5, 'The product launch decoration was innovative and impressive.', '2025-07-25 12:45:00'),
(24, 12, NULL, 12, 12, 57, 4.5, 'Product launch bundle was comprehensive and brand-focused.', '2025-08-10 10:00:00'),
-- User 13 Feedback
(25, 13, 13, NULL, 13, 61, 4.7, 'Mehendi celebration decoration was colorful and traditional.', '2025-07-27 16:00:00'),
(26, 13, NULL, 13, 13, 62, 4.8, 'Wedding rituals package covered all ceremonies beautifully.', '2025-08-13 13:15:00'),
-- User 14 Feedback
(27, 14, 14, NULL, 14, 66, 4.3, 'Cocktail party setup was stylish and elegant.', '2025-07-30 11:30:00'),
(28, 14, NULL, 14, 14, 67, 4.4, 'Party night special had great ambiance and decorations.', '2025-08-15 15:45:00'),
-- User 15 Feedback
(29, 15, 15, NULL, 15, 71, 4.9, 'Grand reception decoration was luxurious and beautiful.', '2025-08-02 14:45:00'),
(30, 15, NULL, 15, 15, 72, 4.9, 'Grand celebration package had exceptional decorations.', '2025-08-17 10:00:00'),
-- User 16 Feedback
(31, 16, 16, NULL, 16, 76, 4.6, 'Sangeet night decoration had vibrant and festive elements.', '2025-08-06 09:30:00'),
(32, 16, NULL, 16, 16, 77, 4.5, 'Cultural events bundle had authentic traditional decor.', '2025-08-20 12:45:00'),
-- User 17 Feedback
(33, 17, 17, NULL, 17, 81, 4.4, 'Retirement party decoration was elegant and memorable.', '2025-08-10 15:15:00'),
(34, 17, NULL, 17, 17, 82, 4.5, 'Milestone celebration package captured the essence of the event.', '2025-08-23 13:30:00'),
-- User 18 Feedback
(35, 18, 18, NULL, 18, 86, 4.2, 'School annual day decoration was colorful and appropriate.', '2025-08-13 11:00:00'),
(36, 18, NULL, 18, 18, 87, 4.3, 'School events package had nice setup for all functions.', '2025-08-25 16:15:00'),
-- User 19 Feedback
(37, 19, 19, NULL, 19, 91, 4.7, 'Ganesh Puja decoration was traditional and beautiful.', '2025-08-15 14:30:00'),
(38, 19, NULL, 19, 19, 92, 4.8, 'Religious ceremony bundle had authentic sacred elements.', '2025-08-27 10:45:00'),
-- User 20 Feedback
(39, 20, 20, NULL, 20, 96, 4.5, 'Christmas party setup was festive and beautiful.', '2025-08-17 09:15:00'),
(40, 20, NULL, 20, 20, 97, 4.6, 'Holiday season special had perfect seasonal elements.', '2025-08-30 12:30:00');

-- Booking Cancellations Table (for cancelled bookings)
INSERT INTO `booking_cancellations` (`cancellation_id`, `booking_id`, `cancelled_by`, `reason`, `refund_amount`, `cancelled_at`) VALUES
-- User 1 Cancellation
(1, 5, 'user', 'Schedule conflict, need to postpone the event', 8750.00, '2025-04-15 11:30:00'),
-- User 2 Cancellation
(2, 10, 'user', 'Budget constraints, need to cancel the booking', 7000.00, '2025-04-20 14:45:00'),
-- User 3 Cancellation
(3, 15, 'decorator', 'Unable to accommodate the specific requirements', 7500.00, '2025-04-25 10:00:00'),
-- User 4 Cancellation
(4, 20, 'user', 'Change in event plans, no longer needed', 5500.00, '2025-04-30 16:15:00'),
-- User 5 Cancellation
(5, 25, 'user', 'Venue changed, decorator unavailable at new location', 6250.00, '2025-05-05 13:30:00'),
-- User 6 Cancellation
(6, 30, 'admin', 'Payment issues, booking cancelled', 12500.00, '2025-05-10 09:45:00'),
-- User 7 Cancellation
(7, 35, 'decorator', 'Decorator unavailable due to emergency', 5000.00, '2025-05-15 15:00:00'),
-- User 8 Cancellation
(8, 40, 'user', 'Event cancelled due to personal reasons', 6250.00, '2025-05-20 11:15:00'),
-- User 9 Cancellation
(9, 45, 'admin', 'Booking conflicts, need to reschedule', 4500.00, '2025-05-25 14:30:00'),
-- User 10 Cancellation
(10, 50, 'user', 'Change in event date, decorator unavailable', 5000.00, '2025-05-30 10:45:00'),
-- User 11 Cancellation
(11, 55, 'decorator', 'Decorator fully booked for the date', 10000.00, '2025-06-04 13:00:00'),
-- User 12 Cancellation
(12, 60, 'user', 'Event postponed indefinitely', 8750.00, '2025-06-09 16:15:00'),
-- User 13 Cancellation
(13, 65, 'admin', 'Payment not completed within deadline', 8000.00, '2025-06-14 11:30:00'),
-- User 14 Cancellation
(14, 70, 'user', 'Changed mind about the decoration theme', 6250.00, '2025-06-19 14:45:00'),
-- User 15 Cancellation
(15, 75, 'decorator', 'Unable to meet specific decoration requirements', 11250.00, '2025-06-24 10:00:00'),
-- User 16 Cancellation
(16, 80, 'user', 'Budget constraints, need to cancel', 5500.00, '2025-06-29 13:15:00'),
-- User 17 Cancellation
(17, 85, 'admin', 'Incomplete booking information', 3750.00, '2025-07-04 15:30:00'),
-- User 18 Cancellation
(18, 90, 'user', 'Event cancelled due to unforeseen circumstances', 4500.00, '2025-07-09 11:45:00'),
-- User 19 Cancellation
(19, 95, 'decorator', 'Decorator unavailable for specified requirements', 5500.00, '2025-07-14 14:00:00'),
-- User 20 Cancellation
(20, 100, 'user', 'Change in event venue, decorator unable to accommodate', 3000.00, '2025-07-19 09:15:00');
