<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('school_department_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('school_name');
            $table->year('year_of_establishment')->nullable();
            $table->year('year_of_first_intake')->nullable();
            $table->string('head_of_department')->nullable();
            $table->string('department_phone')->nullable();
            $table->string('residence_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('department_fax')->nullable();
            $table->text('brief_introduction')->nullable();
            $table->integer('number_of_visiting_fellows')->nullable();
            $table->integer('student_intake_capacity')->nullable();
            $table->integer('number_of_patents_received')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        

        Schema::create('position_of_teaching_faculties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('degree')->nullable();
            $table->string('university_institute')->nullable();
            $table->string('subject_specialization')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('guest_lecturer_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('research_degrees')->nullable();
            $table->string('subject_specialization')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('departmentstaff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('designation')->nullable();
            $table->integer('sc_reg_m')->default(0);
            $table->integer('sc_reg_f')->default(0);
            $table->integer('sc_cont_m')->default(0);
            $table->integer('sc_cont_f')->default(0);
            $table->integer('st_reg_m')->default(0);
            $table->integer('st_reg_f')->default(0);
            $table->integer('st_cont_m')->default(0);
            $table->integer('st_cont_f')->default(0);
            $table->integer('obc_reg_m')->default(0);
            $table->integer('obc_reg_f')->default(0);
            $table->integer('obc_cont_m')->default(0);
            $table->integer('obc_cont_f')->default(0);
            $table->integer('gen_reg_m')->default(0);
            $table->integer('gen_reg_f')->default(0);
            $table->integer('gen_cont_m')->default(0);
            $table->integer('gen_cont_f')->default(0);
        
            $table->integer('total_reg_m')->storedAs('sc_reg_m + st_reg_m + obc_reg_m + gen_reg_m');
            $table->integer('total_reg_f')->storedAs('sc_reg_f + st_reg_f + obc_reg_f + gen_reg_f');
            $table->integer('total_cont_m')->storedAs('sc_cont_m + st_cont_m + obc_cont_m + gen_cont_m');
            $table->integer('total_cont_f')->storedAs('sc_cont_f + st_cont_f + obc_cont_f + gen_cont_f');
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        

        Schema::create('details_of_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('semester')->nullable();
            $table->string('course_code')->nullable();
            $table->string('course_title')->nullable();
            $table->integer('credit')->nullable();
            $table->string('course_in_charge')->nullable();
            $table->integer('total_credit')->nullable();
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        

        Schema::create('courses_conducted_by_department_for_phd_mphil', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('course');
            $table->enum('course_type', ['Compulsory', 'Optional', 'Practical'])->nullable();
            $table->integer('number_of_credit')->nullable();
            $table->string('course_in_charge')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        

        Schema::create('student_particulars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('course_type', ['U.G.', 'P.G.', 'M.Phil.', 'Ph.D.'])->nullable();
            $table->string('semester')->nullable();
            $table->enum('category', ['SC', 'ST', 'GENERAL', 'OBC', 'TOTAL'])->nullable();
            $table->integer('male')->default(0);
            $table->integer('female')->default(0);
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        

        Schema::create('student_support_and_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('outside_state_male')->default(0);
            $table->integer('outside_state_female')->default(0);
            $table->integer('international_students')->default(0);
            $table->integer('international_male')->default(0);
            $table->integer('international_female')->default(0);
            $table->decimal('average_attendance_percentage', 5, 2)->nullable();
            $table->string('study_tour_or_csst_conducted')->nullable();
            $table->text('achievements_of_students')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        

        Schema::create('physically_challenged_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('category', ['SC', 'ST', 'General', 'OBC', 'Total'])->nullable();
            $table->integer('male')->default(0);
            $table->integer('female')->default(0);
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        

        Schema::create('pass_percentage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('programme_title')->nullable();
            $table->integer('students_appeared')->nullable();
            $table->float('distinction_percentage')->nullable();
            $table->float('first_division_percentage')->nullable();
            $table->float('second_division_percentage')->nullable();
            $table->float('pass_percentage')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        

        Schema::create('scholars_enrollment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('supervisor_name')->nullable();
            $table->string('supervisor_designation')->nullable();
            $table->enum('program_type', ['M.Phil.', 'Ph.D.'])->nullable();
            $table->integer('sc_male')->default(0);
            $table->integer('sc_female')->default(0);
            $table->integer('st_male')->default(0);
            $table->integer('st_female')->default(0);
            $table->integer('obc_male')->default(0);
            $table->integer('obc_female')->default(0);
            $table->integer('gen_male')->default(0);
            $table->integer('gen_female')->default(0);
            $table->integer('total_male')->storedAs('sc_male + st_male + obc_male + gen_male');
            $table->integer('total_female')->storedAs('sc_female + st_female + obc_female + gen_female');
            $table->integer('total_scholars')->storedAs('total_male + total_female');
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        

        Schema::create('qualified_candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('registration_no')->unique();
            $table->string('dissertation_title')->nullable();
            $table->string('supervisor')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('faculty_qualified', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('registration_no')->unique()->nullable();
            $table->string('dissertation_title')->nullable();
            $table->string('supervisor')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        

        Schema::create('studentfellowshipdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('programme')->nullable();
        
            $table->integer('sc_male')->default(0);
            $table->integer('sc_female')->default(0);
            $table->integer('st_male')->default(0);
            $table->integer('st_female')->default(0);
            $table->integer('obc_male')->default(0);
            $table->integer('obc_female')->default(0);
            $table->integer('general_male')->default(0);
            $table->integer('general_female')->default(0);
        
            $table->integer('total_male')->virtualAs('sc_male + st_male + obc_male + general_male');
            $table->integer('total_female')->virtualAs('sc_female + st_female + obc_female + general_female');
            $table->integer('grand_total')->virtualAs('total_male + total_female');
        
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('faculty_development_initiatives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('development_programme')->nullable();
            $table->integer('number_of_faculty_benefited')->default(0);
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('faculty_paper_and_lecture_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('faculty_name')->nullable();
            $table->integer('international')->default(0);
            $table->integer('national')->default(0);
            $table->integer('regional')->default(0);
            $table->integer('state')->default(0);
            $table->integer('total')->storedAs('international + national + regional + state');
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('department_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('level')->nullable();
            $table->integer('international')->default(0);
            $table->integer('national')->default(0);
            $table->integer('state')->default(0);
            $table->integer('university')->default(0);
            $table->integer('college')->default(0);
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('ongoing_research_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('project_name');
            $table->string('principal_investigator')->nullable();
            $table->string('co_investigator')->nullable();
            $table->string('funding_agency')->nullable();
            $table->enum('type', ['Government', 'Non-Government'])->nullable();
            $table->string('department')->nullable();
            $table->year('year_of_award')->nullable();
            $table->decimal('funds_provided', 8, 2)->nullable();
            $table->string('duration')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('net_slet_candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('category', ['SC', 'ST', 'OBC', 'General', 'Total'])->nullable();
            $table->integer('net_slet_lectureship_male')->default(0);
            $table->integer('net_slet_lectureship_female')->default(0);
            $table->integer('net_slet_jrf_male')->default(0);
            $table->integer('net_slet_jrf_female')->default(0);
            $table->integer('total_male')->storedAs('net_slet_lectureship_male + net_slet_jrf_male');
            $table->integer('total_female')->storedAs('net_slet_lectureship_female + net_slet_jrf_female');
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('faculty_publications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('publication_type')->nullable();
            $table->integer('international')->default(0);
            $table->integer('national')->default(0);
            $table->integer('others')->default(0);
            $table->integer('total')->storedAs('international + national + others');
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('awardsgiven', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('recipient_type', ['Teacher', 'Student', 'Invited Lecturer', 'Special Lecturer', 'Other'])->nullable();
            $table->string('award_name')->nullable();
            $table->year('year_awarded')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('successful_candidates_public_service_exams_yearly', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
        
            $table->enum('exam_type', ['IAS', 'IPS', 'State Civil Service', 'State Police Service', 'Others'])->nullable();
        
            $table->integer('upsc_male')->default(0);
            $table->integer('upsc_female')->default(0);
            $table->integer('upsc_total')->virtualAs('upsc_male + upsc_female');
        
            $table->integer('state_psc_male')->default(0);
            $table->integer('state_psc_female')->default(0);
            $table->integer('state_psc_total')->virtualAs('state_psc_male + state_psc_female');
        
            $table->year('year_of_report')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('annex_1', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
        
            $table->string('program_name')->nullable();
            $table->string('venue')->nullable();
            $table->date('date')->nullable();
            $table->string('session_type')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('annex_2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
        
            $table->string('title_of_paper');
            $table->string('author_names');
            $table->string('department')->nullable();
            $table->string('journal_name')->nullable();
            $table->year('year_of_publication')->nullable();
            $table->string('issn_number')->nullable();
            $table->string('ugc_recognition_link')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('annex_3', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
        
            $table->string('name_of_patenter');
            $table->string('patent_number')->nullable();
            $table->string('title_of_patent')->nullable();
            $table->year('year')->nullable();
            $table->enum('status', ['Award', 'Published', 'Filed'])->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
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