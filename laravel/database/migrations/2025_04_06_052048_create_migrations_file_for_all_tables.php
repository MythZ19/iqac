<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name_of_department');
         
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
        Schema::create('school_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name_of_department');
            $table->string('name_of_school');
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

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
        

        Schema::create('teaching_faculties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('degree')->nullable();
            $table->string('degree_university_institution')->nullable();
            $table->string('subject_specialization')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('guest_lecturers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->string('name');
            $table->string('research_degrees')->nullable();
            $table->string('subject_specialization')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
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
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->string('semester')->nullable();
            $table->string('course_code')->nullable();
            $table->string('course_title')->nullable();
            $table->integer('credit')->nullable();
            $table->string('course_in_charge')->nullable();
            $table->integer('total_credit')->nullable();
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        

        Schema::create('phd_mphil_department_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->string('course');
            $table->enum('course_type', ['Compulsory', 'Optional', 'Practical'])->nullable();
            $table->integer('number_of_credit')->nullable();
            $table->string('course_in_charge')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        

        Schema::create('student_demographics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->enum('course_type', ['U.G.', 'P.G.', 'M.Phil.', 'Ph.D.'])->nullable();
            $table->string('semester')->nullable();
            $table->enum('category', ['SC', 'ST', 'GENERAL', 'OBC', 'TOTAL'])->nullable();
            $table->integer('male')->default(0);
            $table->integer('female')->default(0);
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        

        Schema::create('student_support_and_achievements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
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
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        

        Schema::create('students_with_disabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->enum('category', ['SC', 'ST', 'General', 'OBC', 'Total'])->nullable();
            $table->integer('male')->default(0);
            $table->integer('female')->default(0);
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        

        Schema::create('student_pass_percentages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->string('programme_title')->nullable();
            $table->integer('students_appeared')->nullable();
            $table->float('distinction_percentage')->nullable();
            $table->float('first_division_percentage')->nullable();
            $table->float('second_division_percentage')->nullable();
            $table->float('pass_percentage')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        

        Schema::create('scholar_enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
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
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        

        Schema::create('qualified_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->string('name')->nullable();
            $table->string('registration_no')->unique();
            $table->string('dissertation_title')->nullable();
            $table->string('supervisor')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('qualified_faculty_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->string('name')->nullable();
            $table->string('registration_no')->unique()->nullable();
            $table->string('dissertation_title')->nullable();
            $table->string('supervisor')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        

        Schema::create('student_fellowships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
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
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('faculty_development_programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->string('development_programme')->nullable();
            $table->integer('number_of_faculty_benefited')->default(0);
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('faculty_papers_and_lectures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->string('faculty_name')->nullable();
            $table->integer('international')->default(0);
            $table->integer('national')->default(0);
            $table->integer('regional')->default(0);
            $table->integer('state')->default(0);
            $table->integer('total')->storedAs('international + national + regional + state');
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('department_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->string('level')->nullable();
            $table->integer('international')->default(0);
            $table->integer('national')->default(0);
            $table->integer('state')->default(0);
            $table->integer('university')->default(0);
            $table->integer('college')->default(0);
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('research_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
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
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('net_slet_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->enum('category', ['SC', 'ST', 'OBC', 'General', 'Total'])->nullable();
            $table->integer('net_slet_lectureship_male')->default(0);
            $table->integer('net_slet_lectureship_female')->default(0);
            $table->integer('net_slet_jrf_male')->default(0);
            $table->integer('net_slet_jrf_female')->default(0);
            $table->integer('total_male')->storedAs('net_slet_lectureship_male + net_slet_jrf_male');
            $table->integer('total_female')->storedAs('net_slet_lectureship_female + net_slet_jrf_female');
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('faculty_publications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->string('publication_type')->nullable();
            $table->integer('international')->default(0);
            $table->integer('national')->default(0);
            $table->integer('others')->default(0);
            $table->integer('total')->storedAs('international + national + others');
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->enum('recipient_type', ['Teacher', 'Student', 'Invited Lecturer', 'Special Lecturer', 'Other'])->nullable();
            $table->string('award_name')->nullable();
            $table->year('year_awarded')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('public_service_exam_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
        
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
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('academic_programs_and_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
        
            $table->string('program_name')->nullable();
            $table->string('venue')->nullable();
            $table->date('date')->nullable();
            $table->string('session_type')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('research_publications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
        
            $table->string('title_of_paper');
            $table->string('author_names');
            $table->string('department')->nullable();
            $table->string('journal_name')->nullable();
            $table->year('year_of_publication')->nullable();
            $table->string('issn_number')->nullable();
            $table->string('ugc_recognition_link')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
        
        Schema::create('patents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
        
            $table->string('name_of_patenter');
            $table->string('patent_number')->nullable();
            $table->string('title_of_patent')->nullable();
            $table->year('year')->nullable();
            $table->enum('status', ['Award', 'Published', 'Filed'])->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_pass_percentages');
        Schema::dropIfExists('students_with_disabilities');
        Schema::dropIfExists('student_support_and_achievements');
        Schema::dropIfExists('student_demographics');
        Schema::dropIfExists('phd_mphil_department_courses');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('department_staff');
        Schema::dropIfExists('guest_lecturers');
        Schema::dropIfExists('teaching_faculties');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('scholar_enrollments');
        Schema::dropIfExists('qualified_students');
        Schema::dropIfExists('qualified_faculty_members');
        Schema::dropIfExists('student_fellowships');
        Schema::dropIfExists('faculty_development_programs');
        Schema::dropIfExists('faculty_papers_and_lectures');
        Schema::dropIfExists('research_projects');
        Schema::dropIfExists('net_slet_results');
        Schema::dropIfExists('faculty_publications');
        Schema::dropIfExists('awards');
        Schema::dropIfExists('public_service_exam_results');
        Schema::dropIfExists('academic_programs_and_sessions');
        Schema::dropIfExists('research_publications');
        Schema::dropIfExists('patents');
    }
};