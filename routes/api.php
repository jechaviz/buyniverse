<?php

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('v1/listing/get-freelancers', 'RestAPIController@getFreelancer');
Route::get('v1/listing/get-employers', 'RestAPIController@getEmployer');
Route::get('v1/listing/get-jobs', 'RestAPIController@getJobs');
Route::post('v1/user/update-profile', 'RestAPIController@updateProfile');
Route::post('v1/user/do-login', 'RestAPIController@userLogin');
Route::post('v1/user/do-logout', 'RestAPIController@userLogout');
Route::post('v1/media/upload-media', 'RestAPIController@uploadMedia');
Route::post('v1/user/update-favourite', 'RestAPIController@updateWishlist');
Route::post('v1/user/submit-proposal', 'RestAPIController@submitProposal');
Route::get('v1/taxonomies/get-list', 'RestAPIController@listings');
Route::get('v1/list/get-categories', 'RestAPIController@getCategories');
Route::post('v1/user/reporting', 'RestAPIController@storeReport');
Route::post('v1/user/send-offer', 'RestAPIController@sendProjectOffers');
Route::get('v1/taxonomies/get-taxonomy', 'RestAPIController@taxonomies');
Route::get('v1/profile/setting', 'RestAPIController@getUserInfo');
Route::post('v1/password/reset', 'RestAPIController@sendResetLinkEmail');
Route::get('v1/employer-jobs', 'RestAPIController@getEmployerJobs');
Route::post('v1/listing/add-jobs', 'RestAPIController@postJob');
Route::get('v1/listing/services', 'RestAPIController@getServices');
Route::get('v1/service/detail', 'RestAPIController@getService');
Route::post('v1/create-user', 'RestAPIController@createUser');
Route::post('v1/listing/add-service', 'RestAPIController@postService');
Route::get('v1/listing/get-settings', 'RestAPIController@getSettings');
Route::get('v1/listing/get-chat-users', 'RestAPIController@getChatUsers');
Route::get('v1/listing/get-user-messages', 'RestAPIController@getUserMessages');
Route::post('v1/listing/store-messages', 'RestAPIController@storeMessages');

//Task Api

/*Route::apiResources(['tasks' => 'API\TaskController']);
Route::apiResources(['quiz' => 'API\QuizController']);
Route::get('quiz/results/{id}', 'API\QuizController@results');
Route::apiResources(['question' => 'API\QuestionController']);
Route::apiResources(['answer' => 'API\AnswerController']);
Route::apiResources(['comments' => 'API\CommentController']);
Route::apiResources(['checklist' => 'API\ChecklistController']);
Route::get('checklist/status/{id}', 'API\ChecklistController@status');
Route::get('tasks/status/{id}', 'API\TaskController@status');
Route::get('tasks/priority/{id}', 'API\TaskController@priority');
Route::get('tasks/visibility/{id}', 'API\TaskController@visibility');
Route::get('tasks/milestone/{id}', 'API\TaskController@milestone');
Route::get('tasks/startdate/{id}', 'API\TaskController@startdate');
Route::get('tasks/duedate/{id}', 'API\TaskController@duedate');
Route::apiResources(['v1/user' => 'API\UserController']); 
Route::get('user/role/{id}', 'API\UserController@getrole');
Route::apiResources(['contest' => 'API\ContestController']);
Route::get('contest/bid/{id}', 'API\ContestController@bid');
Route::get('contest/over/{id}', 'API\ContestController@over');
Route::apiResources(['job_note' => 'API\NoteController']);
Route::get('job_note/star/{id}', 'API\NoteController@star');
Route::apiResources(['job_ticket' => 'API\TicketController']);
Route::get('ticket/status/{id}', 'API\TicketController@status');
Route::apiResources(['reply_ticket' => 'API\ReplyticketController']);
Route::apiResources(['job_file' => 'API\FilesController']);
Route::get('job_file/download/{id}', 'API\FilesController@download');
Route::get('job_ticket/download/{id}', 'API\TicketController@download');
Route::get('job_ticket/teams/{id}', 'API\TicketController@team');
Route::apiResources(['contest_proposal' => 'API\Contest_proposalController']);

Route::get('job_project_level', 'API\JobController@getProjectLevel');
Route::get('job_project_duration', 'API\JobController@getProjectduration');
Route::get('job_project_english', 'API\JobController@getProjectenglishlevel');
Route::get('job_project_freelancer', 'API\JobController@getProjectfreelancerlevel');
Route::get('job_overview/project_level/{id}', 'API\JobController@postProjectLevel');
Route::get('job_overview/project_duration/{id}', 'API\JobController@postProjectDuration');
Route::get('job_overview/project_price/{id}', 'API\JobController@postProjectprice');
Route::get('job_overview/project_freelancer/{id}', 'API\JobController@postProjectfreelavcer');
Route::get('job_overview/project_english/{id}', 'API\JobController@postProjectenglish');
Route::get('job_overview/project_expirydate/{id}', 'API\JobController@postProjectexpirydate');
Route::get('job_overview/project_jobmonth/{id}', 'API\JobController@postProjectmonth');
Route::get('job_overview/project_jobweek/{id}', 'API\JobController@postProjectweek');
Route::get('job_overview/project_jobday/{id}', 'API\JobController@postProjectday');
Route::get('job_overview/project_jobhour/{id}', 'API\JobController@postProjecthour');
Route::get('job_overview/quiz/{id}', 'API\JobController@postquiz');
Route::get('job_overview/getquiz/{id}', 'API\JobController@getQuiz');
Route::get('job_overview/updatequiz/{id}', 'API\JobController@updatequiz');
Route::get('job_overview/deletequiz/{id}', 'API\JobController@deletequiz');
Route::post('job_overview/description/{id}', 'API\JobController@postdescription');

Route::get('job_overview/getlang/{id}', 'API\JobController@getLanguages');
Route::get('job_overview/language/{id}', 'API\JobController@Language');
Route::get('job_overview/updatelang/{id}', 'API\JobController@updatelang');
Route::get('job_overview/deletelang/{id}', 'API\JobController@deletelang');

Route::get('job_overview/skill/{id}', 'API\JobController@Skill');
Route::get('job_overview/getskill/{id}', 'API\JobController@getSkills');
Route::get('job_overview/updateskill/{id}', 'API\JobController@updateskill');
Route::get('job_overview/deleteskill/{id}', 'API\JobController@deleteskill');

Route::get('job_overview/getteam/{id}', 'API\JobController@getTeam');
Route::post('job_overview/team/{id}', 'API\JobController@postteam');
Route::get('job_overview/deleteteam/{id}', 'API\JobController@deleteteam');

Route::get('job_overview/getapprover/{id}', 'API\JobController@getApprover');
Route::post('job_overview/approver/{id}', 'API\JobController@postApprover');
Route::get('job_overview/deleteapprover/{id}', 'API\JobController@deleteApprover');
Route::get('job_overview/approvejob/{id}', 'API\JobController@approvejob');


Route::get('job_overview/getenglish/{id}', 'API\JobController@getEnglish');
Route::get('job_overview/deleteenglish/{id}', 'API\JobController@deleteenglish');

Route::get('job_overview/getfreelancer/{id}', 'API\JobController@getFreelancer');
Route::get('job_overview/deletefreelancer/{id}', 'API\JobController@deletefreelancer');

Route::get('contest_proposal/hascontest/{id}', 'API\Contest_proposalController@hascontest');


Route::get('sub_skills/{id}', 'API\JobController@getsubskill');
Route::get('sub_skill/{id}', 'API\JobController@getsubkills');
Route::get('delete_sub_skill/{id}', 'API\JobController@deletesubskill');
Route::get('post_sub_skill/{id}', 'API\JobController@postsubskill');
Route::get('sub_skill_status/{id}', 'API\JobController@getskillstatus');
Route::get('sub_cat_status/{id}', 'API\JobController@getcatstatus');
Route::get('sub_category/{id}', 'API\JobController@getsubcategory');*/