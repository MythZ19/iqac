<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creating the school_department_details table
        Schema::create('school_department_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');// Auto-incrementing primary key
            $table->string('school_name');  // Name of the school
            $table->year('year_of_establishment');  // Year the school was established
            $table->year('year_of_first_intake');  // Year of the first intake of students
            $table->string('head_of_department');  // Name of the head of department
            $table->string('department_phone');  // Department phone number
            $table->string('residence_phone');  // Residence phone number
            $table->string('email');  // Department email address
            $table->string('department_fax');  // Department fax number
            $table->text('brief_introduction');  // Brief introduction (maximum 150 words)
            $table->integer('number_of_visiting_fellows')->nullable();  // Number of visiting fellows
            $table->integer('student_intake_capacity')->nullable();  // Student intake capacity
            $table->integer('number_of_patents_received')->nullable(); // No of patents
        });

        // Creating the position_of_teaching_faculty table
        Schema::create('position_of_teaching_faculty', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('name');  // Name of the teaching faculty
            $table->string('designation');  // Designation of the teaching faculty
            $table->string('degree');  // Degree awarded to the faculty
            $table->string('university_institute');  // University or Institute from which the degree was awarded
            $table->string('subject_specialization');  // Subject specialization of the faculty
        });

        // Creating the guest_lecturer_details table
        Schema::create('guest_lecturer_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('name');  // Name of the guest lecturer
            $table->string('research_degrees');  // Research degrees of the guest lecturer
            $table->string('subject_specialization');  // Subject specialization of the guest lecturer
        });

        // Creating the departmentstaff table
        Schema::create('departmentstaff', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('designation');  // Designation of the staff
            $table->integer('sc_reg_m')->default(0);  // SC Male registration count
            $table->integer('sc_reg_f')->default(0);  // SC Female registration count
            $table->integer('sc_cont_m')->default(0);  // SC Male continuation count
            $table->integer('sc_cont_f')->default(0);  // SC Female continuation count
            $table->integer('st_reg_m')->default(0);  // ST Male registration count
            $table->integer('st_reg_f')->default(0);  // ST Female registration count
            $table->integer('st_cont_m')->default(0);  // ST Male continuation count
            $table->integer('st_cont_f')->default(0);  // ST Female continuation count
            $table->integer('obc_reg_m')->default(0);  // OBC Male registration count
            $table->integer('obc_reg_f')->default(0);  // OBC Female registration count
            $table->integer('obc_cont_m')->default(0);  // OBC Male continuation count
            $table->integer('obc_cont_f')->default(0);  // OBC Female continuation count
            $table->integer('gen_reg_m')->default(0);  // General Male registration count
            $table->integer('gen_reg_f')->default(0);  // General Female registration count
            $table->integer('gen_cont_m')->default(0);  // General Male continuation count
            $table->integer('gen_cont_f')->default(0);  // General Female continuation count
            // The total fields are calculated columns that sum the respective counts
            $table->integer('total_reg_m')->generatedAs('sc_reg_m + st_reg_m + obc_reg_m + gen_reg_m')->stored();  // Total Male Registration
            $table->integer('total_reg_f')->generatedAs('sc_reg_f + st_reg_f + obc_reg_f + gen_reg_f')->stored();  // Total Female Registration
            $table->integer('total_cont_m')->generatedAs('sc_cont_m + st_cont_m + obc_cont_m + gen_cont_m')->stored();  // Total Male Continuation
            $table->integer('total_cont_f')->generatedAs('sc_cont_f + st_cont_f + obc_cont_f + gen_cont_f')->stored();  // Total Female Continuation
        });

        // Creating the details_of_course table
        Schema::create('details_of_course', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('semester');  // Semester in which the course is taught
            $table->string('course_code');  // Code of the course
            $table->string('course_title');  // Title of the course
            $table->integer('credit');  // Credit hours of the course
            $table->string('course_in_charge');  // Name of the course in-charge
            $table->integer('total_credit');  // Total credit hours (sum of credits for all courses in a semester, if needed)
        });

        // Creating the courses_conducted_by_department_for_phd_mphil table
        Schema::create('courses_conducted_by_department_for_phd_mphil', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('course');  // Name of the course for PhD/M.Phil program
            $table->enum('course_type', ['Compulsory', 'Optional', 'Practical']);  // Type of the course: Compulsory/Optional/Practical
            $table->integer('number_of_credit');  // Number of credits for the course
            $table->string('course_in_charge');  // Name of the course in-charge
        });

        // Creating the student_particulars table
        Schema::create('student_particulars', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->enum('course_type', ['U.G.', 'P.G.', 'M.Phil.', 'Ph.D.']);  // Type of course (Undergraduate, Postgraduate, M.Phil, Ph.D)
            $table->string('semester')->nullable();  // Semester for the course
            $table->enum('category', ['SC', 'ST', 'GENERAL', 'OBC', 'TOTAL']);  // Category of the student (SC, ST, General, OBC, or Total)
            $table->integer('male')->default(0);  // Number of male students in the category
            $table->integer('female')->default(0);  // Number of female students in the category
        });

        // Creating the student_support_and_progress table
        Schema::create('student_support_and_progress', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->integer('outside_state_male')->default(0);  // Number of male students outside the state
            $table->integer('outside_state_female')->default(0);  // Number of female students outside the state
            $table->integer('international_students')->default(0);  // Number of international students
            $table->integer('international_male')->default(0);  // Number of male international students
            $table->integer('international_female')->default(0);  // Number of female international students
            $table->decimal('average_attendance_percentage', 5, 2)->nullable();  // Annual average attendance percentage
            $table->string('study_tour_or_csst_conducted')->nullable();  // Study tour/CSST conducted under the year of the report
            $table->text('achievements_of_students')->nullable();  // Achievements of students in the year of the report
        });

        // Creating the physically_challenged_students table
        Schema::create('physically_challenged_students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->enum('category', ['SC', 'ST', 'General', 'OBC', 'Total']);  // Category of the student
            $table->integer('male')->default(0);  // Number of male students
            $table->integer('female')->default(0);  // Number of female students
        });

        // Creating the pass_percentage table
        Schema::create('pass_percentage', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('programme_title');  // Title of the program
            $table->integer('students_appeared');  // Total number of students who appeared for the exam
            $table->float('distinction_percentage');  // Percentage of students in distinction category
            $table->float('first_division_percentage');  // Percentage of students in first division
            $table->float('second_division_percentage');  // Percentage of students in second division
            $table->float('pass_percentage');  // Overall pass percentage of students
        });
        Schema::create('scholars_enrollment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('supervisor_name');  // Name of the supervisor
            $table->string('supervisor_designation');  // Designation of the supervisor
            $table->enum('program_type', ['M.Phil.', 'Ph.D.']);  // Program type (M.Phil. or Ph.D.)

            // Scholars details
            $table->integer('sc_male')->default(0);  // SC Male
            $table->integer('sc_female')->default(0);  // SC Female
            $table->integer('st_male')->default(0);  // ST Male
            $table->integer('st_female')->default(0);  // ST Female
            $table->integer('obc_male')->default(0);  // OBC Male
            $table->integer('obc_female')->default(0);  // OBC Female
            $table->integer('gen_male')->default(0);  // General Male
            $table->integer('gen_female')->default(0);  // General Female
            $table->integer('total_male')->generatedAs('sc_male + st_male + obc_male + gen_male')->stored();  // Total Male
            $table->integer('total_female')->generatedAs('sc_female + st_female + obc_female + gen_female')->stored();  // Total Female
            $table->integer('total_scholars')->generatedAs('total_male + total_female')->stored();  // Total Scholars
        });
        Schema::create('qualified_candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('name');  // Name of the candidate
            $table->string('registration_no')->unique();  // Registration number (unique)
            $table->string('dissertation_title');  // Title of Dissertation/Thesis
            $table->string('supervisor');  // Name of the Supervisor

            // You can add other columns if needed (e.g., year of qualification, etc.)
            $table->timestamps();  // Adds created_at and updated_at timestamps
        });
          // Creating the faculty_qualified table
          Schema::create('faculty_qualified', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('name');  // Name of the faculty member
            $table->string('registration_no')->unique();  // Registration number (unique)
            $table->string('dissertation_title');  // Title of Dissertation/Thesis
            $table->string('supervisor');  // Name of the Supervisor

            // You can add other columns if needed (e.g., year of qualification, etc.)
            $table->timestamps();  // Adds created_at and updated_at timestamps
        });
        Schema::create('studentfellowshipdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key (equivalent to 'id int(11) NOT NULL AUTO_INCREMENT')
            $table->string('programme');  // Programme name (varchar(255) NOT NULL)
            
            // Number of male and female students in each category
            $table->integer('sc_male')->default(0);
            $table->integer('sc_female')->default(0);
            $table->integer('st_male')->default(0);
            $table->integer('st_female')->default(0);
            $table->integer('obc_male')->default(0);
            $table->integer('obc_female')->default(0);
            $table->integer('general_male')->default(0);
            $table->integer('general_female')->default(0);
            
            // Generated fields for totals (using raw SQL expressions)
            $table->integer('total_male')->virtualAs('sc_male + st_male + obc_male + general_male');
            $table->integer('total_female')->virtualAs('sc_female + st_female + obc_female + general_female');
            $table->integer('grand_total')->virtualAs('total_male + total_female');

            $table->timestamps();  // Adds created_at and updated_at columns
        });
        Schema::create('faculty_development_initiatives', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('development_programme');  // Name of the development programme (e.g., Refresher Courses)
            $table->integer('number_of_faculty_benefited')->default(0);  // Number of faculty who benefited from the programme
            $table->timestamps();  // Adds created_at and updated_at columns
        });
        Schema::create('faculty_paper_and_lecture_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('faculty_name');  // Name of the faculty
            $table->integer('international')->default(0);  // Number of international papers presented or sessions chaired
            $table->integer('national')->default(0);  // Number of national papers presented or sessions chaired
            $table->integer('regional')->default(0);  // Number of regional papers presented or sessions chaired
            $table->integer('state')->default(0);  // Number of state-level papers presented or sessions chaired
            $table->integer('total')->generatedAs('international + national + regional + state')->stored();  // Total papers presented or sessions chaired
            $table->timestamps();  // Adds created_at and updated_at columns
        });
        Schema::create('department_events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('level');  // Column to store the level of the event (e.g., International, National, etc.)
            $table->integer('international')->default(0);  // Number of international events
            $table->integer('national')->default(0);  // Number of national events
            $table->integer('state')->default(0);  // Number of state-level events
            $table->integer('university')->default(0);  // Number of university-level events
            $table->integer('college')->default(0);  // Number of college-level events
            $table->timestamps();  // Adds created_at and updated_at columns
        });
        Schema::create('ongoing_research_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('project_name');  // Name of the Scheme/Project/Endowments/Chairs
            $table->string('principal_investigator');  // Name of the Principal Investigator
            $table->string('co_investigator')->nullable();  // Name of the Co-Investigator (nullable)
            $table->string('funding_agency');  // Name of the Funding Agency
            $table->enum('type', ['Government', 'Non-Government']);  // Type of funding agency
            $table->string('department');  // Department name
            $table->year('year_of_award');  // Year of the award
            $table->decimal('funds_provided', 8, 2);  // Funds provided in INR (in lakhs)
            $table->string('duration');  // Duration of the project (e.g., "2 years", "6 months")
            $table->timestamps();  // Adds created_at and updated_at columns
        });
        Schema::create('net_slet_candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->enum('category', ['SC', 'ST', 'OBC', 'General', 'Total']);  // Candidate category
            $table->integer('net_slet_lectureship_male')->default(0);  // Male candidates for Lectureship
            $table->integer('net_slet_lectureship_female')->default(0);  // Female candidates for Lectureship
            $table->integer('net_slet_jrf_male')->default(0);  // Male candidates for Junior Research Fellowship
            $table->integer('net_slet_jrf_female')->default(0);  // Female candidates for Junior Research Fellowship
            $table->integer('total_male')->generatedAs('net_slet_lectureship_male + net_slet_jrf_male')->stored();  // Total male candidates
            $table->integer('total_female')->generatedAs('net_slet_lectureship_female + net_slet_jrf_female')->stored();  // Total female candidates
            $table->timestamps();  // Adds created_at and updated_at columns
        });
        Schema::create('faculty_publications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('publication_type');  // Type of publication (e.g., Paper in Peer-Reviewed Journals)
            $table->integer('international')->default(0);  // International publications count
            $table->integer('national')->default(0);  // National publications count
            $table->integer('others')->default(0);  // Other publications count
            $table->integer('total')->generatedAs('international + national + others')->stored();  // Total publications count
            $table->timestamps();  // Adds created_at and updated_at columns
        });
        Schema::create('awardsgiven', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->enum('recipient_type', ['Teacher', 'Student', 'Invited Lecturer', 'Special Lecturer', 'Other']);  // Type of recipient
            $table->string('award_name');  // Name of the award
            $table->year('year_awarded');  // Year the award was given
            $table->timestamps();  // Adds created_at and updated_at columns
        });
        Schema::create('successful_candidates_public_service_exams_yearly', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->enum('exam_type', ['IAS', 'IPS', 'State Civil Service', 'State Police Service', 'Others']);
            $table->integer('upsc_male')->default(0);
            $table->integer('upsc_female')->default(0);
            $table->integer('upsc_total')->virtualAs('upsc_male + upsc_female'); // Virtual generated column
            $table->integer('state_psc_male')->default(0);
            $table->integer('state_psc_female')->default(0);
            $table->integer('state_psc_total')->virtualAs('state_psc_male + state_psc_female'); // Virtual generated column
            $table->year('year_of_report');
            $table->timestamps(); // Automatically creates created_at and updated_at columns
        });
        Schema::create('annex_1', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('program_name');  // Name of the program
            $table->string('venue');  // Venue of the event
            $table->date('date');  // Date of the event
            $table->string('session_type');  // Type of session (Paper Presented / Chaired Session / Keynote / Invited Lecture, etc.)
            $table->timestamps();  // Automatically adds created_at and updated_at columns
        });
        Schema::create('annex_2', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');  // Auto-incrementing primary key
            $table->string('title_of_paper');  // Title of the paper published
            $table->string('author_names');  // Name of the authors
            $table->string('department');  // Department of the teacher
            $table->string('journal_name');  // Name of the journal
            $table->year('year_of_publication');  // Year of publication
            $table->string('issn_number');  // ISSN Number
            $table->string('ugc_recognition_link');  // Link to the recognition in UGC enlistment of the journal
            $table->timestamps();  // Automatically adds created_at and updated_at columns
        });
        Schema::create('annex_3', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name_of_patenter');
            $table->string('patent_number');
            $table->string('title_of_patent');
            $table->year('year'); // Year column
            $table->enum('status', ['Award', 'Published', 'Filed']); // Status column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the tables in reverse order of creation
        Schema::dropIfExists('pass_percentage');
        Schema::dropIfExists('physically_challenged_students');
        Schema::dropIfExists('student_support_and_progress');
        Schema::dropIfExists('student_particulars');
        Schema::dropIfExists('courses_conducted_by_department_for_phd_mphil');
        Schema::dropIfExists('details_of_course');
        Schema::dropIfExists('departmentstaff');
        Schema::dropIfExists('guest_lecturer_details');
        Schema::dropIfExists('position_of_teaching_faculty');
        Schema::dropIfExists('school_department_details');
        Schema::dropIfExists('scholars_enrollment');
        Schema::dropIfExists('qualified_candidates');
        Schema::dropIfExists('faculty_qualified');
        Schema::dropIfExists('studentfellowshipdetails');
        Schema::dropIfExists('faculty_development_initiatives');
        Schema::dropIfExists('faculty_paper_and_lecture_details');
        Schema::dropIfExists('ongoing_research_projects');
        Schema::dropIfExists('net_slet_candidates');
        Schema::dropIfExists('faculty_publications');
        Schema::dropIfExists('awardsgiven');
        Schema::dropIfExists('successful_candidates_public_service_exams_yearly');
        Schema::dropIfExists('annex_1');
        Schema::dropIfExists('annex_2');
        Schema::dropIfExists('annex_3');

    }
};