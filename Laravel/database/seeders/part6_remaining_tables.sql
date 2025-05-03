-- PART 6: Remaining Tables (Admin Commissions, Promo Codes, Applied Promos, Notifications, Bookmarks, Contacts, Carts)

-- Admin Commissions Table (for completed bookings)
INSERT INTO `admin_commissions` (`commission_id`, `booking_id`, `amount`, `created_at`) VALUES
-- Commissions for completed bookings
(1, 1, 4500.00, '2025-06-15 16:30:00'),
(2, 2, 9500.00, '2025-06-20 15:45:00'),
(3, 6, 1500.00, '2025-06-18 17:00:00'),
(4, 7, 2500.00, '2025-07-10 16:15:00'),
(5, 11, 3500.00, '2025-06-22 14:30:00'),
(6, 12, 7000.00, '2025-07-12 15:45:00'),
(7, 16, 1200.00, '2025-06-25 16:00:00'),
(8, 17, 3000.00, '2025-07-15 17:15:00'),
(9, 21, 2500.00, '2025-06-28 14:45:00'),
(10, 22, 4500.00, '2025-07-18 16:00:00'),
(11, 26, 1800.00, '2025-07-01 15:15:00'),
(12, 27, 3500.00, '2025-07-20 17:30:00'),
(13, 31, 3000.00, '2025-07-05 14:00:00'),
(14, 32, 8500.00, '2025-07-22 16:45:00'),
(15, 36, 2000.00, '2025-07-08 15:30:00'),
(16, 37, 4000.00, '2025-07-25 17:45:00'),
(17, 41, 1500.00, '2025-07-12 14:15:00'),
(18, 42, 3000.00, '2025-07-28 16:30:00'),
(19, 46, 2200.00, '2025-07-15 15:00:00'),
(20, 47, 5000.00, '2025-07-30 17:15:00');

-- Promo Codes Table
INSERT INTO `promo_codes` (`promo_id`, `code`, `discount_percentage`, `max_discount_amount`, `expiry_date`, `created_at`) VALUES
(1, 'WELCOME10', 10.00, 1000.00, '2025-12-31', '2025-03-01 09:00:00'),
(2, 'WEDDING20', 20.00, 5000.00, '2025-08-31', '2025-03-05 10:15:00'),
(3, 'BIRTHDAY15', 15.00, 2000.00, '2025-09-30', '2025-03-10 11:30:00'),
(4, 'SUMMER25', 25.00, 3000.00, '2025-07-31', '2025-03-15 12:45:00'),
(5, 'FESTIVE30', 30.00, 4000.00, '2025-10-31', '2025-03-20 14:00:00'),
(6, 'NEWYEAR25', 25.00, 5000.00, '2025-12-31', '2025-03-25 15:15:00'),
(7, 'CORPORATE15', 15.00, 6000.00, '2025-11-30', '2025-03-30 16:30:00'),
(8, 'FIRSTBOOK20', 20.00, 2500.00, '2025-12-31', '2025-04-05 09:45:00'),
(9, 'ANNIVERSARY10', 10.00, 3000.00, '2025-09-30', '2025-04-10 11:00:00'),
(10, 'FESTIVAL15', 15.00, 2000.00, '2025-10-31', '2025-04-15 12:15:00'),
(11, 'MONSOON25', 25.00, 3500.00, '2025-08-31', '2025-04-20 13:30:00'),
(12, 'PARTY10', 10.00, 1500.00, '2025-09-30', '2025-04-25 14:45:00'),
(13, 'GRAD20', 20.00, 2000.00, '2025-07-31', '2025-04-30 16:00:00'),
(14, 'DECOR15', 15.00, 3000.00, '2025-08-31', '2025-05-05 17:15:00'),
(15, 'REFER25', 25.00, 2500.00, '2025-12-31', '2025-05-10 09:30:00'),
(16, 'DIWALI30', 30.00, 5000.00, '2025-10-31', '2025-05-15 10:45:00'),
(17, 'CONFERENCE10', 10.00, 4000.00, '2025-11-30', '2025-05-20 12:00:00'),
(18, 'HOLI20', 20.00, 2000.00, '2025-12-31', '2025-05-25 13:15:00'),
(19, 'PREMIUM15', 15.00, 10000.00, '2025-12-31', '2025-05-30 14:30:00'),
(20, 'APP25', 25.00, 3000.00, '2025-10-31', '2025-06-05 15:45:00');

-- Applied Promo Codes Table
INSERT INTO `applied_promo_codes` (`applied_id`, `user_id`, `promo_id`, `booking_id`, `discount_applied`, `applied_at`) VALUES
(1, 1, 2, 1, 5000.00, '2025-03-15 09:35:00'),
(2, 3, 7, 11, 5250.00, '2025-03-20 13:50:00'),
(3, 5, 5, 21, 4000.00, '2025-03-25 09:05:00'),
(4, 7, 2, 31, 5000.00, '2025-03-30 09:35:00'),
(5, 9, 13, 41, 1800.00, '2025-04-03 09:50:00'),
(6, 11, 7, 51, 6000.00, '2025-04-08 09:20:00'),
(7, 13, 2, 61, 2500.00, '2025-04-12 10:35:00'),
(8, 15, 5, 71, 4000.00, '2025-04-16 09:05:00'),
(9, 17, 8, 81, 2000.00, '2025-04-20 15:35:00'),
(10, 19, 10, 91, 1800.00, '2025-04-24 13:20:00'),
(11, 2, 3, 6, 1500.00, '2025-03-18 10:05:00'),
(12, 4, 4, 16, 1800.00, '2025-03-22 14:35:00'),
(13, 6, 6, 26, 2250.00, '2025-03-28 12:50:00'),
(14, 8, 8, 36, 2000.00, '2025-04-01 13:20:00'),
(15, 10, 11, 46, 2750.00, '2025-04-05 14:35:00'),
(16, 12, 12, 56, 1500.00, '2025-04-10 12:50:00'),
(17, 14, 14, 66, 2100.00, '2025-04-14 13:50:00'),
(18, 16, 16, 76, 3000.00, '2025-04-18 12:20:00'),
(19, 18, 18, 86, 1500.00, '2025-04-22 10:05:00'),
(20, 20, 20, 96, 3000.00, '2025-04-26 16:35:00');

-- Notifications Table
INSERT INTO `notifications` (`notification_id`, `user_id`, `title`, `message`, `is_read`, `created_at`) VALUES
-- User 1 Notifications
(1, 1, 'Booking Confirmed', 'Your booking for Royal Wedding Decoration has been confirmed', 1, '2025-03-15 09:35:00'),
(2, 1, 'Payment Successful', 'Your advance payment of ₹22,500 has been received', 1, '2025-03-15 09:40:00'),
(3, 1, 'Booking Completed', 'Your booking for Royal Wedding Decoration has been marked as completed', 0, '2025-06-15 16:30:00'),
(4, 1, 'Feedback Request', 'Please share your feedback for your recent booking', 0, '2025-06-16 10:00:00'),
-- User 2 Notifications
(5, 2, 'Booking Confirmed', 'Your booking for Birthday Bash has been confirmed', 1, '2025-03-18 10:05:00'),
(6, 2, 'Payment Successful', 'Your advance payment of ₹7,500 has been received', 1, '2025-03-18 10:10:00'),
(7, 2, 'Booking Status Update', 'Your booking for Kids Birthday Party has been rejected', 0, '2025-04-10 15:30:00'),
(8, 2, 'Booking Cancelled', 'Your booking for Cocktail Party Setup has been cancelled', 0, '2025-04-20 14:45:00'),
-- User 3 Notifications
(9, 3, 'Booking Confirmed', 'Your booking for Corporate Annual Meet has been confirmed', 1, '2025-03-20 13:50:00'),
(10, 3, 'Payment Successful', 'Your advance payment of ₹17,500 has been received', 1, '2025-03-20 13:55:00'),
(11, 3, 'Booking Accepted', 'Your booking for Corporate Conference Setup has been accepted', 0, '2025-04-05 11:30:00'),
(12, 3, 'New Promotion', 'Use code CORPORATE15 for 15% off on your next corporate event booking', 0, '2025-04-15 09:00:00'),
-- User 4 Notifications
(13, 4, 'Booking Confirmed', 'Your booking for Warm Housewarming has been confirmed', 1, '2025-03-22 14:35:00'),
(14, 4, 'Payment Successful', 'Your advance payment of ₹6,000 has been received', 1, '2025-03-22 14:40:00'),
(15, 4, 'Booking Accepted', 'Your booking for Modern Housewarming has been accepted', 0, '2025-04-10 16:15:00'),
(16, 4, 'Booking Cancelled', 'Your booking for Holi Celebration has been cancelled', 0, '2025-04-30 16:15:00'),
-- User 5 Notifications
(17, 5, 'Booking Confirmed', 'Your booking for Silver Anniversary Celebration has been confirmed', 1, '2025-03-25 09:05:00'),
(18, 5, 'Payment Successful', 'Your advance payment of ₹12,500 has been received', 1, '2025-03-25 09:10:00'),
(19, 5, 'Booking Accepted', 'Your booking for Golden Anniversary has been accepted', 0, '2025-04-10 14:30:00'),
(20, 5, 'Feedback Reminder', 'Don\'t forget to share your feedback for your completed booking', 0, '2025-07-05 10:00:00');

-- Bookmarks Table
INSERT INTO `bookmarks` (`bookmark_id`, `user_id`, `event_id`, `package_id`, `decorator_id`, `created_at`) VALUES
-- User bookmarks for events
(1, 1, 15, NULL, NULL, '2025-03-12 10:30:00'),
(2, 2, 2, NULL, NULL, '2025-03-15 11:45:00'),
(3, 3, 3, NULL, NULL, '2025-03-18 14:00:00'),
(4, 4, 24, NULL, NULL, '2025-03-20 15:15:00'),
(5, 5, 5, NULL, NULL, '2025-03-22 09:30:00'),
(6, 6, 6, NULL, NULL, '2025-03-25 10:45:00'),
(7, 7, 27, NULL, NULL, '2025-03-28 12:00:00'),
(8, 8, 8, NULL, NULL, '2025-03-30 13:15:00'),
(9, 9, 9, NULL, NULL, '2025-04-02 14:30:00'),
(10, 10, 10, NULL, NULL, '2025-04-05 15:45:00'),
-- User bookmarks for packages
(11, 11, NULL, 11, NULL, '2025-04-07 09:00:00'),
(12, 12, NULL, 12, NULL, '2025-04-09 10:15:00'),
(13, 13, NULL, 13, NULL, '2025-04-11 11:30:00'),
(14, 14, NULL, 14, NULL, '2025-04-13 12:45:00'),
(15, 15, NULL, 15, NULL, '2025-04-15 14:00:00'),
(16, 16, NULL, 16, NULL, '2025-04-17 15:15:00'),
(17, 17, NULL, 17, NULL, '2025-04-19 16:30:00'),
(18, 18, NULL, 18, NULL, '2025-04-21 09:45:00'),
(19, 19, NULL, 19, NULL, '2025-04-23 11:00:00'),
(20, 20, NULL, 20, NULL, '2025-04-25 12:15:00'),
-- User bookmarks for decorators
(21, 1, NULL, NULL, 1, '2025-04-27 13:30:00'),
(22, 2, NULL, NULL, 2, '2025-04-29 14:45:00'),
(23, 3, NULL, NULL, 3, '2025-05-01 16:00:00'),
(24, 4, NULL, NULL, 4, '2025-05-03 09:15:00'),
(25, 5, NULL, NULL, 5, '2025-05-05 10:30:00'),
(26, 6, NULL, NULL, 6, '2025-05-07 11:45:00'),
(27, 7, NULL, NULL, 7, '2025-05-09 13:00:00'),
(28, 8, NULL, NULL, 8, '2025-05-11 14:15:00'),
(29, 9, NULL, NULL, 9, '2025-05-13 15:30:00'),
(30, 10, NULL, NULL, 10, '2025-05-15 16:45:00');

-- Contacts Table (with is_read column)
INSERT INTO `contacts` (`id`, `name`, `email`, `mobile`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'Rahul Sharma', 'rahul.sharma@gmail.com', '9876543210', 'I would like to inquire about wedding decoration packages for December 2025', 1, '2025-03-10 09:15:00', '2025-03-10 09:15:00'),
(2, 'Priya Patel', 'priya.patel@gmail.com', '9876543211', 'Can you provide custom birthday decoration for my son\'s 5th birthday?', 1, '2025-03-12 10:30:00', '2025-03-12 10:30:00'),
(3, 'Amit Kumar', 'amit.kumar@gmail.com', '9876543212', 'Looking for corporate event decorations for our annual meeting', 1, '2025-03-14 11:45:00', '2025-03-14 11:45:00'),
(4, 'Neha Singh', 'neha.singh@gmail.com', '9876543213', 'Need information about housewarming decoration services', 1, '2025-03-16 13:00:00', '2025-03-16 13:00:00'),
(5, 'Vikas Gupta', 'vikas.gupta@gmail.com', '9876543214', 'Would like to know your anniversary decoration packages', 0, '2025-03-18 14:15:00', '2025-03-18 14:15:00'),
(6, 'Anjali Verma', 'anjali.verma@gmail.com', '9876543215', 'Can you do themed baby shower decorations?', 0, '2025-03-20 15:30:00', '2025-03-20 15:30:00'),
(7, 'Rajesh Khanna', 'rajesh.khanna@gmail.com', '9876543216', 'Looking for engagement ceremony decoration', 0, '2025-03-22 16:45:00', '2025-03-22 16:45:00'),
(8, 'Meena Kumari', 'meena.kumari@gmail.com', '9876543217', 'Do you provide Diwali decoration services for homes?', 0, '2025-03-24 09:00:00', '2025-03-24 09:00:00'),
(9, 'Deepak Joshi', 'deepak.joshi@gmail.com', '9876543218', 'Need graduation party decoration for 50 people', 0, '2025-03-26 10:15:00', '2025-03-26 10:15:00'),
(10, 'Pooja Sharma', 'pooja.sharma@gmail.com', '9876543219', 'Do you offer Holi event decorations?', 0, '2025-03-28 11:30:00', '2025-03-28 11:30:00'),
(11, 'Suresh Yadav', 'suresh.yadav@gmail.com', '9876543220', 'Looking for conference hall decoration services', 0, '2025-03-30 12:45:00', '2025-03-30 12:45:00'),
(12, 'Rekha Mishra', 'rekha.mishra@gmail.com', '9876543221', 'Need product launch event decoration', 0, '2025-04-01 14:00:00', '2025-04-01 14:00:00'),
(13, 'Ajay Malhotra', 'ajay.malhotra@gmail.com', '9876543222', 'Can you provide Mehendi ceremony decoration?', 0, '2025-04-03 15:15:00', '2025-04-03 15:15:00'),
(14, 'Sunita Agarwal', 'sunita.agarwal@gmail.com', '9876543223', 'Looking for cocktail party decoration services', 0, '2025-04-05 16:30:00', '2025-04-05 16:30:00'),
(15, 'Vivek Reddy', 'vivek.reddy@gmail.com', '9876543224', 'Need reception decoration for 500 guests', 0, '2025-04-07 09:45:00', '2025-04-07 09:45:00'),
(16, 'Kavita Nair', 'kavita.nair@gmail.com', '9876543225', 'Would like information on Sangeet ceremony decoration', 0, '2025-04-09 11:00:00', '2025-04-09 11:00:00'),
(17, 'Manoj Tiwari', 'manoj.tiwari@gmail.com', '9876543226', 'Need retirement party decoration services', 0, '2025-04-11 12:15:00', '2025-04-11 12:15:00'),
(18, 'Shweta Kapoor', 'shweta.kapoor@gmail.com', '9876543227', 'Looking for school annual function decoration', 0, '2025-04-13 13:30:00', '2025-04-13 13:30:00'),
(19, 'Dinesh Choudhary', 'dinesh.choudhary@gmail.com', '9876543228', 'Do you provide Ganesh Puja decoration services?', 0, '2025-04-15 14:45:00', '2025-04-15 14:45:00'),
(20, 'Anita Desai', 'anita.desai@gmail.com', '9876543229', 'Need Christmas party decoration for office', 0, '2025-04-17 16:00:00', '2025-04-17 16:00:00');

-- Carts Table
INSERT INTO `carts` (`id`, `user_id`, `event_id`, `package_id`, `event_datetime`, `created_at`, `updated_at`) VALUES
(1, 1, 21, NULL, '2025-08-15 10:00:00', '2025-05-01 09:15:00', '2025-05-01 09:15:00'),
(2, 2, NULL, 2, '2025-08-18 11:30:00', '2025-05-02 10:30:00', '2025-05-02 10:30:00'),
(3, 3, 3, NULL, '2025-08-20 14:00:00', '2025-05-03 11:45:00', '2025-05-03 11:45:00'),
(4, 4, NULL, 4, '2025-08-22 15:30:00', '2025-05-04 13:00:00', '2025-05-04 13:00:00'),
(5, 5, 5, NULL, '2025-08-25 09:00:00', '2025-05-05 14:15:00', '2025-05-05 14:15:00'),
(6, 6, NULL, 6, '2025-08-28 10:30:00', '2025-05-06 15:30:00', '2025-05-06 15:30:00'),
(7, 7, 7, NULL, '2025-08-30 12:00:00', '2025-05-07 16:45:00', '2025-05-07 16:45:00'),
(8, 8, NULL, 8, '2025-09-02 13:30:00', '2025-05-08 09:00:00', '2025-05-08 09:00:00'),
(9, 9, 9, NULL, '2025-09-05 15:00:00', '2025-05-09 10:15:00', '2025-05-09 10:15:00'),
(10, 10, NULL, 10, '2025-09-08 16:30:00', '2025-05-10 11:30:00', '2025-05-10 11:30:00'),
(11, 11, 11, NULL, '2025-09-10 10:00:00', '2025-05-11 12:45:00', '2025-05-11 12:45:00'),
(12, 12, NULL, 12, '2025-09-12 11:30:00', '2025-05-12 14:00:00', '2025-05-12 14:00:00'),
(13, 13, 13, NULL, '2025-09-15 13:00:00', '2025-05-13 15:15:00', '2025-05-13 15:15:00'),
(14, 14, NULL, 14, '2025-09-18 14:30:00', '2025-05-14 16:30:00', '2025-05-14 16:30:00'),
(15, 15, 15, NULL, '2025-09-20 16:00:00', '2025-05-15 09:45:00', '2025-05-15 09:45:00'),
(16, 16, NULL, 16, '2025-09-22 09:30:00', '2025-05-16 11:00:00', '2025-05-16 11:00:00'),
(17, 17, 17, NULL, '2025-09-25 11:00:00', '2025-05-17 12:15:00', '2025-05-17 12:15:00'),
(18, 18, NULL, 18, '2025-09-28 12:30:00', '2025-05-18 13:30:00', '2025-05-18 13:30:00'),
(19, 19, 19, NULL, '2025-09-30 14:00:00', '2025-05-19 14:45:00', '2025-05-19 14:45:00'),
(20, 20, NULL, 20, '2025-10-03 15:30:00', '2025-05-20 16:00:00', '2025-05-20 16:00:00');
