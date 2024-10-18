<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSeedInitialData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert categories
        DB::statement("
            INSERT INTO `categories` (`id`, `name`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
            (1, 'SIA Security', 1, '2024-07-25 22:09:54', '2024-07-25 22:09:54', NULL),
            (2, 'First Aid', 1, '2024-07-25 22:10:01', '2024-07-25 22:10:01', NULL),
            (3, 'Construction', 1, '2024-07-25 22:10:07', '2024-07-25 22:10:07', NULL),
            (4, 'Fire Safety', 1, '2024-07-25 22:10:13', '2024-07-25 22:10:13', NULL),
            (5, 'Traffic Marshal', 1, '2024-07-25 22:10:20', '2024-07-25 22:10:20', NULL);
        ");

        // Insert awarding bodies
        DB::statement("
            INSERT INTO `awarding_bodies` (`id`, `name`, `description`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
            (1, 'Highfield Qualifications', 'We’re a global leader in compliance and work-based learning and apprenticeship qualifications and one of the UK’s most recognisable awarding organisations.', 1, '2024-07-25 22:11:56', '2024-07-25 22:11:56', NULL),
            (2, 'CITB', 'CITB is the industry training board for the construction sector in England, Scotland, and Wales. It’s our job to help the construction industry attract talent and to support skills development, to build a better Britain.', 1, '2024-07-25 22:13:41', '2024-07-25 22:13:41', NULL);
        ");

        // Insert exams
        DB::statement("
           INSERT INTO `exams` (`id`, `name`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
            (1, '﻿Principles of working in the Private Security Industry', 1, '2024-07-25 22:15:38', '2024-07-25 22:15:38', NULL),
            (2, 'Principles of working as a Door Supervisor in the Private Security Industry', 1, '2024-07-25 22:15:43', '2024-07-25 22:15:43', NULL),
            (3, 'Application of conflict management in the Private Security Industry', 1, '2024-07-25 22:15:49', '2024-07-25 22:15:49', NULL),
            (4, 'Application of physical intervention skills in the Private Security Industry', 1, '2024-07-25 22:15:54', '2024-07-25 22:15:54', NULL),
            (5, 'Principles of Terror Threat Awareness in the Private Security Industry', 1, '2024-07-25 22:16:00', '2024-07-25 22:16:00', NULL),
            (6, 'Principles of Using Equipment as a Door Supervisor in the Private Security Industry', 1, '2024-07-25 22:16:06', '2024-07-25 22:16:06', NULL),
            (7, 'Principles and Practices of Working as a CCTV Operator in the Private Security Industry', 1, '2024-07-25 22:16:11', '2024-07-25 22:16:11', NULL),
            (8, 'Principles of Minimising Personal Risk for Security Officers in the Private Security Industry', 1, '2024-07-25 22:16:16', '2024-07-25 22:16:16', NULL),
            (9, '﻿Emergency First Aid in the Workplace', 1, '2024-07-25 22:16:20', '2024-07-25 22:16:20', NULL),
            (10, 'Managing paediatric illness, injuries and emergencies', 1, '2024-07-25 22:16:26', '2024-07-25 22:16:26', NULL),
            (11, 'Emergency Paediatric First Aid', 1, '2024-07-25 22:16:30', '2024-07-25 22:16:30', NULL),
            (12, 'Recognition and Management of Illness and Injury in the Workplace', 1, '2024-07-25 22:16:36', '2024-07-25 22:16:36', NULL),
            (13, 'Health and safety in a construction environment', 1, '2024-07-25 22:16:40', '2024-07-25 22:16:40', NULL),
            (14, 'Legal and Social Responsibilities of a Personal License Holder', 1, '2024-07-25 22:16:45', '2024-07-25 22:16:45', NULL),
            (15, 'Principles of Fire Safety', 1, '2024-07-25 22:16:51', '2024-07-25 22:16:51', NULL),
            (16, 'Principles of Fire Safety Awareness', 1, '2024-07-25 22:16:56', '2024-07-25 22:16:56', NULL),
            (17, 'Traffic Marshal', 1, '2024-07-25 23:21:39', '2024-07-25 23:21:39', NULL),
            (18, 'First Aid', 1, '2024-07-26 02:05:34', '2024-07-26 02:05:34', NULL),
            (19, 'Fire Safety level 2', 1, '2024-07-26 02:16:43', '2024-07-26 02:16:43', NULL),
            (20, 'Legal and management', 1, '2024-07-26 19:41:20', '2024-07-26 19:41:20', NULL),
            (21, 'Health and welfare', 1, '2024-07-26 19:41:33', '2024-07-26 19:41:33', NULL),
            (22, 'General safety', 1, '2024-07-26 19:41:47', '2024-07-26 19:41:47', NULL),
            (23, 'High risk activities', 1, '2024-07-26 19:42:08', '2024-07-26 19:42:08', NULL),
            (24, 'Environment', 1, '2024-07-26 19:42:20', '2024-07-26 19:42:20', NULL);
        ");

        // Insert venues
        DB::statement("
            INSERT INTO `venues` (`id`, `code`, `venue_name`, `address`, `post_code`, `region`, `city`, `primary_contact_number`, `telephone_number`, `email`, `parking`, `access_instructions`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
            (1, 'B19 3NY', 'Head Office', '89-91 Hatchett Street, Birmingham, West Midlands', 'B19 3NY', 'West Midlands', 'Birmingham', '01216302115', '08082808098', 'info@training4employment.co.uk', 'Free Parking Available', NULL, 1, '2024-07-25 21:32:24', '2024-07-25 21:32:24', NULL);
        ");

        // Insert qualifications
        DB::statement("
           INSERT INTO `qualifications` (`id`, `name`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
            (1, 'Highfield Level 2 Award for Door Supervisors in the Private Security Industry', 1, '2024-07-25 22:14:09', '2024-07-25 22:14:09', NULL),
            (2, 'Highfield Level 2 Award for CCTV Operators (Public Space Surveillance) in the Private Security Industry', 1, '2024-07-25 22:14:17', '2024-07-25 22:14:17', NULL),
            (3, 'Highfield Level 2 Award for Door Supervisors in the Private Security Industry (Top Up)', 1, '2024-07-25 22:14:23', '2024-07-25 22:14:23', NULL),
            (4, 'Highfield Level 2 Award for Security Officers in the Private Security Industry (Top Up)', 1, '2024-07-25 22:14:30', '2024-07-25 22:14:30', NULL),
            (5, 'Highfield Level 3 Award in First Aid at Work', 1, '2024-07-25 22:14:36', '2024-07-25 22:14:36', NULL),
            (6, 'Highfield Level 3 Award in Emergency First Aid at Work', 1, '2024-07-25 22:14:43', '2024-07-25 22:14:43', NULL),
            (7, 'Highfield Level 3 Award in Paediatric First Aid', 1, '2024-07-25 22:14:48', '2024-07-25 22:14:48', NULL),
            (8, '﻿Highfield Level 3 Award in Emergency Paediatric First Aid', 1, '2024-07-25 22:14:54', '2024-07-25 22:14:54', NULL),
            (9, 'Highfield Level 1 Award in Health and Safety within a Construction Environment', 1, '2024-07-25 22:14:59', '2024-07-25 22:14:59', NULL),
            (10, 'Highfield Level 2 Award for Personal License Holders', 1, '2024-07-25 22:15:07', '2024-07-25 22:15:07', NULL),
            (11, 'Highfield Level 2 Award in the Principles of Fire Safety', 1, '2024-07-25 22:15:13', '2024-07-25 22:15:13', NULL),
            (12, '﻿Highfield Level 1 Award in the Principles of Fire Safety Awareness', 1, '2024-07-25 22:15:20', '2024-07-25 22:15:20', NULL),
            (13, 'Vehicle Banksman', 1, '2024-07-25 23:19:27', '2024-07-25 23:19:27', NULL),
            (14, 'First Aid', 1, '2024-07-26 02:05:22', '2024-07-26 02:05:22', NULL),
            (15, 'Health and Safety Awareness (HSA)', 1, '2024-07-26 19:40:00', '2024-07-26 19:40:00', NULL);
        ");


        // Insert courses
        DB::statement("
           insert  into `courses`(`id`,`name`,`category_id`,`qualification`,`description`,`price`,`duration`,`certification`,`awarding_bodies`,`exam`,`delivery_mode`,`course_type`,`user_id`,`created_at`,`updated_at`,`deleted_at`) values (1,'Door Supervisor',1,'1','<p>The Level 2 Door Supervisor course is based on the relevant SIA specification for learning and qualifications and is supported by Skills for Security, the standards setting body for the security industry and the SIA, who regulate the private security industry.</p>',259.00,'1','External','1','Principles of working as a Door Supervisor in the Private Security Industry','ClassroomBased','OpenCourse',1,'2024-09-16 18:19:57','2024-09-16 18:40:04',NULL),(2,'Door Supervisor Top-Up',1,'3','<p>Door Supervisor Top-Up</p>',300.00,'1','External','1','Principles of working as a Door Supervisor in the Private Security Industry','ClassroomBased','OpenCourse',1,'2024-09-18 01:58:28','2024-09-18 01:58:28',NULL),(3,'Security Guard Top-Up',1,'1','<p>Security Guard Top-Up</p>',250.00,'1','External','1','Principles of working as a Door Supervisor in the Private Security Industry','ClassroomBased','OpenCourse',1,'2024-09-18 01:59:06','2024-09-18 01:59:06',NULL),(4,'CCTV Operator, Public Surveillance',1,'2','<p>CCTV Operator, Public Surveillance</p>',200.00,'1','External','1','Principles of working as a Door Supervisor in the Private Security Industry','ClassroomBased','OpenCourse',1,'2024-09-18 01:59:41','2024-09-18 01:59:41',NULL),(5,'Emergency First Aid at Work',1,'1','<p>Emergency First Aid at Work</p>',250.00,'1','External','1','Principles of working as a Door Supervisor in the Private Security Industry','ClassroomBased','OpenCourse',1,'2024-09-18 02:00:07','2024-09-18 02:00:07',NULL);
        ");


        DB::statement("insert  into `cohorts`(`id`,`max_learner`,`course_id`,`venue_id`,`trainer_id`,`delivery_mode`,`corporate_client_id`,`start_date_time`,`end_date_time`,`booking_reference`,`user_id`,`created_at`,`updated_at`,`deleted_at`) values (1,10,1,1,2,'ClassroomBased',NULL,'2024-11-01 09:00:00','2024-11-01 14:00:00',NULL,1,'2024-09-16 18:42:14','2024-09-16 18:42:14',NULL),(2,15,2,1,2,'ClassroomBased',NULL,'2024-09-26 04:11:00','2024-09-26 15:05:00',NULL,1,'2024-09-18 02:05:25','2024-09-18 02:05:25',NULL),(3,20,3,1,2,'ClassroomBased',NULL,'2024-09-30 04:10:00','2024-09-30 14:10:00',NULL,1,'2024-09-18 02:06:29','2024-09-18 02:06:29',NULL),(4,22,4,1,2,'ClassroomBased',NULL,'2024-10-17 00:09:00','2024-10-17 15:07:00',NULL,1,'2024-09-18 02:07:15','2024-09-18 02:07:15',NULL),(5,15,5,1,2,'ClassroomBased',NULL,'2024-11-12 00:09:00','2024-11-20 12:11:00',NULL,1,'2024-09-18 02:07:40','2024-09-18 02:07:40',NULL);
");



        DB::statement(
            "insert  into `course_task`(`id`,`course_id`,`task_id`,`created_at`,`updated_at`) values (1,1,1,NULL,NULL),(2,1,2,NULL,NULL),(3,1,3,NULL,NULL),(4,1,7,NULL,NULL),(5,1,8,NULL,NULL),(6,1,9,NULL,NULL),(7,1,10,NULL,NULL),(8,1,11,NULL,NULL),(9,1,12,NULL,NULL),(10,2,1,NULL,NULL),(11,2,2,NULL,NULL),(12,2,3,NULL,NULL),(13,2,7,NULL,NULL),(14,2,8,NULL,NULL),(15,2,9,NULL,NULL),(16,2,10,NULL,NULL),(17,2,11,NULL,NULL),(18,2,12,NULL,NULL),(19,3,1,NULL,NULL),(20,3,6,NULL,NULL),(21,3,8,NULL,NULL),(22,3,9,NULL,NULL),(23,3,10,NULL,NULL),(24,3,11,NULL,NULL),(25,3,12,NULL,NULL),(26,4,4,NULL,NULL),(27,4,8,NULL,NULL),(28,4,9,NULL,NULL),(29,4,10,NULL,NULL),(30,4,11,NULL,NULL),(31,4,12,NULL,NULL);"
        );

        DB::statement(
            "insert  into `course_license`(`id`,`course_id`,`license_id`,`created_at`,`updated_at`) values (1,1,1,NULL,NULL),(2,1,2,NULL,NULL);"
        );

    //    DB::statement("insert  into `cohort_user`(`id`,`cohort_id`,`user_id`,`status`,`comments`,`created_at`,`updated_at`) values (1,1,2,'Not Submitted',NULL,NULL,NULL),(2,2,2,'Not Submitted',NULL,'2024-09-18 02:11:09','2024-09-18 02:11:09'),(3,3,2,'Not Submitted',NULL,'2024-09-18 02:11:09','2024-09-18 02:11:09'),(4,4,2,'Not Submitted',NULL,'2024-09-18 02:11:09','2024-09-18 02:11:09'),(5,5,2,'Not Submitted',NULL,'2024-09-18 02:11:09','2024-09-18 02:11:09');");



//        DB::statement("
//          INSERT INTO `cohorts` (`id`, `max_learner`, `course_id`, `venue_id`, `trainer_id`, `delivery_mode`, `corporate_client_id`, `start_date_time`, `end_date_time`, `booking_reference`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
//            (1, 12, 1, 1, 4, 'BlendedLearning', NULL, '2024-08-05 09:00:00', '2024-08-07 17:00:00', NULL, 1, '2024-07-26 04:10:52', '2024-07-26 04:10:52', NULL),
//            (2, 12, 7, 1, 5, 'BlendedLearning', NULL, '2024-08-06 09:00:00', '2024-08-06 13:00:00', NULL, 1, '2024-07-26 04:11:44', '2024-07-26 19:32:41', NULL),
//            (3, 20, 10, 1, 6, 'ClassroomBased', NULL, '2024-08-31 09:00:00', '2024-08-31 17:00:00', NULL, 1, '2024-07-26 19:44:56', '2024-07-26 19:46:01', NULL),
//            (4, 12, 7, 1, 5, 'BlendedLearning', NULL, '2024-08-02 09:00:00', '2024-08-02 13:00:00', NULL, 1, '2024-07-26 23:17:42', '2024-07-26 23:17:42', NULL),
//            (5, 12, 7, 1, 5, 'BlendedLearning', NULL, '2024-08-02 13:00:00', '2024-08-02 17:00:00', NULL, 1, '2024-07-26 23:19:56', '2024-07-26 23:19:56', NULL),
//            (6, 12, 4, 1, 4, 'BlendedLearning', NULL, '2024-08-02 14:00:00', '2024-08-02 16:00:00', NULL, 1, '2024-07-26 23:23:26', '2024-07-26 23:23:26', NULL),
//            (7, 12, 5, 1, 4, 'ClassroomBased', NULL, '2024-08-02 14:00:00', '2024-08-02 16:00:00', NULL, 1, '2024-07-26 23:26:35', '2024-07-26 23:26:35', NULL),
//            (8, 12, 3, 1, 4, 'BlendedLearning', NULL, '2024-08-03 09:00:00', '2024-08-04 16:30:00', NULL, 1, '2024-07-26 23:28:26', '2024-07-26 23:28:26', NULL),
//            (9, 12, 12, 1, 4, 'ClassroomBased', NULL, '2024-08-08 11:00:00', '2024-08-08 13:00:00', NULL, 1, '2024-08-06 01:25:12', '2024-08-06 01:25:12', NULL);
//        ");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
