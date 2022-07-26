<template>
    <div class="row kanban-wrapper">
        <div class="col-12" id="tasks-layout-wrapper">
                            <!--main table view-->
            <div class="boards count-0" id="tasks-view-wrapper">
        <!--each board-->
            <!--board-->
        <div class="board">
        <div class="board-body border-default">
            <div class="board-heading clearfix">
                <div class="pull-left">{{ trans('lang.new') }}</div>
                <div class="pull-right x-action-icons">
                    <!--action add-->
                    <span class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form cursor-pointer" data-toggle="modal" data-target="#newtask"><i class="fa fa-plus"></i></span>
                </div>
            </div>
            <!--cards-->
            <div class="content kanban-content" id="kanban-board-wrapper-new" data-board-name="new">

                <!--dynamic content-->
                <div  v-for="task0 in tasks0" :key="task0.id">
                            <!--each card-->
    <div class="kanban-card show-modal-button reset-card-modal-form js-ajax-ux-request" @click="editTask(task0)" id="card_task_3">
        <div class="x-title wordwrap" id="kanban_task_title_3"> {{ task0.title }}
            <span class="x-action-button" id="card-action-button-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></span>
            <div class="dropdown-menu dropdown-menu-small dropdown-menu-right js-stop-propagation" aria-labelledby="card-action-button-3">
                            <!--delete-->
                            <!--stop my timer-->
                            <!--stop all timers-->
                            <!--no actions-->
                            <a class="dropdown-item js-stop-propagation" href="javascript:void(0);">{{ trans('lang.no_actions_availabe') }}</a>
                        </div>
        </div>
        <div class="x-meta">
            <!--priority-->
                    <label class="label label-outline-info p-t-3 p-b-3 p-l-8 p-r-8" data-toggle="tooltip" title="Priority">{{ task0.priority | formatPriority }}</label>
                    <!--date created-->
                    <span><strong>{{ trans('lang.created') }}:</strong> {{ task0.created_at | formatDate }}</span>
                    <!--start date-->
                    <!--due date-->
                    <span><strong>{{ trans('lang.due') }}:</strong>: {{ task0.due_date | formatDate }}</span>
                </div>
        <div class="x-footer row">
            <div class="col-6 x-icons">

                <!--client visibility-->
                                        
                <!--attachments-->
                            <!--comments-->
                
                <!--checklists-->
                
                <!--timer running-->
                <span class="x-icon text-danger hidden-forced" id="card-task-timer-3"><i class="mdi mdi-timer"></i></span>

            </div>
            <div class="col-6 x-assigned"> 
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Jesus" class="img-circle avatar-xsmall" data-original-title="Jesus">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Gabriel" class="img-circle avatar-xsmall" data-original-title="Gabriel">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Sadique" class="img-circle avatar-xsmall" data-original-title="Sadique">
                        </div>
        </div>
    </div>
                </div>
                
                
            </div>
        </div>
    </div>        <!--board-->
        <div class="board">
        <div class="board-body border-info">
            <div class="board-heading clearfix">
                <div class="pull-left">{{ trans('lang.in_progress') }}</div>
                <div class="pull-right x-action-icons">
                    <!--action add-->
                    <span class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form cursor-pointer" data-toggle="modal" data-target="#commonModal" data-url="http://projects.terapixel.com.mx/tasks/create?status=in_progress&amp;ref=list" data-loading-target="commonModalBody" data-modal-title="Add A New Task" data-action-url="http://projects.terapixel.com.mx/tasks?type=kanban&amp;ref=list" data-action-method="POST" data-action-ajax-loading-target="commonModalBody" data-save-button-class=""><i class="mdi mdi-plus-circle"></i></span>
                </div>
            </div>
            <!--cards-->
            <div class="content kanban-content" id="kanban-board-wrapper-in_progress" data-board-name="in_progress">

                <!--dynamic content-->
                <div  v-for="task1 in tasks1" :key="task1.id">
                            <!--each card-->
    <div class="kanban-card show-modal-button reset-card-modal-form js-ajax-ux-request" @click="editTask(task1)" id="card_task_3">
        <div class="x-title wordwrap" id="kanban_task_title_3"> {{ task1.title }}
            <span class="x-action-button" id="card-action-button-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></span>
            <div class="dropdown-menu dropdown-menu-small dropdown-menu-right js-stop-propagation" aria-labelledby="card-action-button-3">
                            <!--delete-->
                            <!--stop my timer-->
                            <!--stop all timers-->
                            <!--no actions-->
                            <a class="dropdown-item js-stop-propagation" href="javascript:void(0);">{{ trans('lang.no_actions_availabe') }}</a>
                        </div>
        </div>
        <div class="x-meta">
            <!--priority-->
                    <label class="label label-outline-info p-t-3 p-b-3 p-l-8 p-r-8" data-toggle="tooltip" title="Priority">{{ task1.priority | formatPriority }}</label>
                    <!--date created-->
                    <span><strong>{{ trans('lang.created') }}:</strong> {{ task1.created_at | formatDate }}</span>
                    <!--start date-->
                    <!--due date-->
                    <span><strong>{{ trans('lang.due') }}:</strong>: {{ task1.due_date | formatDate }}</span>
                </div>
        <div class="x-footer row">
            <div class="col-6 x-icons">

                <!--client visibility-->
                                        
                <!--attachments-->
                            <!--comments-->
                
                <!--checklists-->
                
                <!--timer running-->
                <span class="x-icon text-danger hidden-forced" id="card-task-timer-3"><i class="mdi mdi-timer"></i></span>

            </div>
            <div class="col-6 x-assigned">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Jesus" class="img-circle avatar-xsmall" data-original-title="Jesus">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Gabriel" class="img-circle avatar-xsmall" data-original-title="Gabriel">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Sadique" class="img-circle avatar-xsmall" data-original-title="Sadique">
                        </div>
        </div>
    </div>
                </div>
                
            </div>
        </div>
    </div>        <!--board-->
        <div class="board">
        <div class="board-body border-purple">
            <div class="board-heading clearfix">
                <div class="pull-left">{{ trans('lang.testing') }}</div>
                <div class="pull-right x-action-icons">
                    <!--action add-->
                    <span class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form cursor-pointer"><i class="mdi mdi-plus-circle"></i></span>
                </div>
            </div>
            <!--cards-->
            <div class="content kanban-content" id="kanban-board-wrapper-testing" data-board-name="testing">

                <!--dynamic content-->
                <div  v-for="task2 in tasks2" :key="task2.id">
                            <!--each card-->
                            <div class="kanban-card show-modal-button reset-card-modal-form js-ajax-ux-request" @click="editTask(task2)" id="card_task_3">
        <div class="x-title wordwrap" id="kanban_task_title_3"> {{ task2.title }}
            <span class="x-action-button" id="card-action-button-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></span>
            <div class="dropdown-menu dropdown-menu-small dropdown-menu-right js-stop-propagation" aria-labelledby="card-action-button-3">
                            <!--delete-->
                            <!--stop my timer-->
                            <!--stop all timers-->
                            <!--no actions-->
                            <a class="dropdown-item js-stop-propagation" href="javascript:void(0);">{{ trans('lang.no_actions_availabe') }}</a>
                        </div>
        </div>
        <div class="x-meta">
            <!--priority-->
                    <label class="label label-outline-info p-t-3 p-b-3 p-l-8 p-r-8" data-toggle="tooltip" title="Priority">{{ task2.priority | formatPriority }}</label>
                    <!--date created-->
                    <span><strong>{{ trans('lang.created') }}:</strong> {{ task2.created_at | formatDate }}</span>
                    <!--start date-->
                    <!--due date-->
                    <span><strong>{{ trans('lang.due') }}:</strong>: {{ task2.due_date | formatDate }}</span>
                </div>
        <div class="x-footer row">
            <div class="col-6 x-icons">

                <!--client visibility-->
                                        
                <!--attachments-->
                            <!--comments-->
                
                <!--checklists-->
                
                <!--timer running-->
                <span class="x-icon text-danger hidden-forced" id="card-task-timer-3"><i class="mdi mdi-timer"></i></span>

            </div>
            <div class="col-6 x-assigned">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Jesus" class="img-circle avatar-xsmall" data-original-title="Jesus">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Gabriel" class="img-circle avatar-xsmall" data-original-title="Gabriel">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Sadique" class="img-circle avatar-xsmall" data-original-title="Sadique">
                        </div>
        </div>
    </div>
    
                </div>
                
            </div>
        </div>
    </div>        <!--board-->
        <div class="board">
        <div class="board-body border-warning">
            <div class="board-heading clearfix">
                <div class="pull-left">{{ trans('lang.awaiting_feedback') }}</div>
                <div class="pull-right x-action-icons">
                    <!--action add-->
                    <span class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form cursor-pointer" ><i class="mdi mdi-plus-circle"></i></span>
                </div>
            </div>
            <!--cards-->
            <div class="content kanban-content" id="kanban-board-wrapper-awaiting_feedback" data-board-name="awaiting_feedback">

                <!--dynamic content-->
                <div  v-for="task3 in tasks3" :key="task3.id">
                            <!--each card-->
                            <div class="kanban-card show-modal-button reset-card-modal-form js-ajax-ux-request" @click="editTask(task3)" id="card_task_3">
        <div class="x-title wordwrap" id="kanban_task_title_3"> {{ task3.title }}
            <span class="x-action-button" id="card-action-button-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></span>
            <div class="dropdown-menu dropdown-menu-small dropdown-menu-right js-stop-propagation" aria-labelledby="card-action-button-3">
                            <!--delete-->
                            <!--stop my timer-->
                            <!--stop all timers-->
                            <!--no actions-->
                            <a class="dropdown-item js-stop-propagation" href="javascript:void(0);">{{ trans('lang.no_actions_availabe') }}</a>
                        </div>
        </div>
        <div class="x-meta">
            <!--priority-->
                    <label class="label label-outline-info p-t-3 p-b-3 p-l-8 p-r-8" data-toggle="tooltip" title="Priority">{{ task3.priority | formatPriority }}</label>
                    <!--date created-->
                    <span><strong>{{ trans('lang.created') }}:</strong> {{ task3.created_at | formatDate }}</span>
                    <!--start date-->
                    <!--due date-->
                    <span><strong>{{ trans('lang.due') }}:</strong>: {{ task3.due_date | formatDate }}</span>
                </div>
        <div class="x-footer row">
            <div class="col-6 x-icons">

                <!--client visibility-->
                                        
                <!--attachments-->
                            <!--comments-->
                
                <!--checklists-->
                
                <!--timer running-->
                <span class="x-icon text-danger hidden-forced" id="card-task-timer-3"><i class="mdi mdi-timer"></i></span>

            </div>
            <div class="col-6 x-assigned">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Jesus" class="img-circle avatar-xsmall" data-original-title="Jesus">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Gabriel" class="img-circle avatar-xsmall" data-original-title="Gabriel">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Sadique" class="img-circle avatar-xsmall" data-original-title="Sadique">
                        </div>
        </div>
    </div>
    
                </div>
                
            </div>
        </div>
    </div>        <!--board-->
        <div class="board">
        <div class="board-body border-success">
            <div class="board-heading clearfix">
                <div class="pull-left">{{ trans('lang.completed') }}</div>
                <div class="pull-right x-action-icons">
                    <!--action add-->
                    <span class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form cursor-pointer" data-toggle="modal" data-target="#commonModal"><i class="mdi mdi-plus-circle"></i></span>
                </div>
            </div>
            <!--cards-->
            <div class="content kanban-content" id="kanban-board-wrapper-completed" data-board-name="completed">
                    <div  v-for="task4 in tasks4" :key="task4.id">
                            <!--each card-->
                            <div class="kanban-card show-modal-button reset-card-modal-form js-ajax-ux-request" @click="editTask(task4)" id="card_task_3">
        <div class="x-title wordwrap" id="kanban_task_title_3"> {{ task4.title }}
            <span class="x-action-button" id="card-action-button-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></span>
            <div class="dropdown-menu dropdown-menu-small dropdown-menu-right js-stop-propagation" aria-labelledby="card-action-button-3">
                            <!--delete-->
                            <!--stop my timer-->
                            <!--stop all timers-->
                            <!--no actions-->
                            <a class="dropdown-item js-stop-propagation" href="javascript:void(0);">{{ trans('lang.no_actions_available') }}</a>
                        </div>
        </div>
        <div class="x-meta">
            <!--priority-->
                    <label class="label label-outline-info p-t-3 p-b-3 p-l-8 p-r-8" data-toggle="tooltip" title="Priority">{{ task4.priority | formatPriority }}</label>
                    <!--date created-->
                    <span><strong>{{ trans('lang.created') }}:</strong> {{ task4.created_at | formatDate }}</span>
                    <!--start date-->
                    <!--due date-->
                    <span><strong>{{ trans('lang.due') }}:</strong>: {{ task4.due_date | formatDate }}</span>
                </div>
        <div class="x-footer row">
            <div class="col-6 x-icons">

                <!--client visibility-->
                                        
                <!--attachments-->
                            <!--comments-->
                
                <!--checklists-->
                
                <!--timer running-->
                <span class="x-icon text-danger hidden-forced" id="card-task-timer-3"><i class="mdi mdi-timer"></i></span>

            </div>
            <div class="col-6 x-assigned">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Jesus" class="img-circle avatar-xsmall" data-original-title="Jesus">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Gabriel" class="img-circle avatar-xsmall" data-original-title="Gabriel">
                            <img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Sadique" class="img-circle avatar-xsmall" data-original-title="Sadique">
                        </div>
        </div>
    </div>
    
                </div>
                
            </div>
        </div>
    </div>    </div>


        <!-- model code -->
        <div class="modal card-modal" aria-labelledby="cardModal" id="cardModal" style="padding-right: 16px;overflow-y: auto;" aria-modal="true" role="dialog" v-bind="task">
            <div class="modal-dialog" id="cardModalContainer">
                <div class="modal-content" id="cardModalContent">
                    <div class="modal-body row min-h-200" id="cardModalBody">
                        <!--close button-->
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="ti-close"></i>
                        </button>

                        <!--left panel-->
                        <div class="col-lg-8 card-left-panel" id="card-left-panel">
                            <!--title-->
        <div class="card-title m-b-0" id="card-title-editable" style="">{{ task.title }}
        </div>
        <!--buttons: edit-->
        <div id="card-title-edit" class="card-title-edit hidden" style="display: none;">
            <input type="text" class="form-control form-control-sm card-title-input" id="task_title" name="task_title">
            <!--button: subit & cancel-->
            <div id="card-title-submit" class="p-t-10 text-right">
                <button type="button" class="btn waves-effect waves-light btn-xs btn-default" id="card-title-button-cancel">{{ trans('lang.cancel') }}</button>
                <button type="button" class="btn waves-effect waves-light btn-xs btn-danger" data-url="http://projects.terapixel.com.mx/tasks/2/update-title" data-progress-bar="hidden" data-type="form" data-form-id="card-title-edit" data-ajax-type="post" id="card-title-button-save">{{ trans('lang.save') }}</button>
            </div>
        </div>
        <div class="m-b-15"><small><strong>{{ trans('lang.milestone') }}: </strong></small><small id="card-task-milestone-title">{{ task.milestone | formatMilestone }}</small></div>



        <!--description-->
        <div class="card-description" id="card-description">
            <div class="x-heading"><i class="mdi mdi-file-document-box"></i>{{ trans('lang.description') }}</div>
            <div class="x-content rich-text-formatting" id="card-description-container">
                {{ task.description }}
            </div>
                <!--buttons: edit-->
            <div id="card-description-edit">
                <div class="x-action" id="card-description-button-edit"><a href="javaScript:void(0);">{{ trans('lang.edit_description') }}</a>
                </div>
                <input type="hidden" name="task_description" id="card-description-input" value="">
            </div>
            <!--button: subit & cancel-->
            <div id="card-description-submit" class="p-t-10 hidden text-right">
                <button type="button" class="btn waves-effect waves-light btn-xs btn-default" id="card-description-button-cancel">Cancel</button>
                <button type="button" class="btn waves-effect waves-light btn-xs btn-danger js-description-save" data-url="http://projects.terapixel.com.mx/tasks/2/update-description" data-progress-bar="hidden" data-type="form" data-form-id="card-description" data-ajax-type="post" id="card-description-button-save">Save</button>
            </div>
            </div>

        <checklists :taskid="task.id" ></checklists>


        <!--attachments-->
        <!--<div class="card-attachments" id="card-attachments" data-upload-url="http://projects.terapixel.com.mx/tasks/2/attach-files">
            <div class="x-heading"><i class="mdi mdi-cloud-download"></i>Attachments</div>
            <div class="x-content row" id="card-attachments-container"></div>
                <div class="x-action"><a class="card_fileupload" id="js-card-toggle-fileupload" href="javascript:void(0)">Add attachment</a></div>

            <div class="hidden" id="card-fileupload-container">
                <div class="dropzone dz-clickable" id="card_fileupload">
                    <div class="dz-default dz-message">
                        <i class="icon-Upload-toCloud"></i>
                        <span>Drop files here or click to upload</span>
                    </div>
                </div>
            </div>
            </div>-->
        <!--attachemnts js-->


        <!--comments-->
        <comments :taskid="task.id" :userid="this.userid"></comments>
        
        </div>

                        <!--right panel-->
                        <div class="col-lg-4 card-right-panel" id="card-right-panel"><!----------Assigned----------->
                <div class="x-section">
                <div class="x-title">
                    <h6>{{ trans('lang.assigned_users') }}</h6>
                </div>
                <span id="task-assigned-container" class="">
                    <!--user-->
        <span class="x-assigned-user  card-task-assigned" tabindex="0" data-popover-content="card-task-team" data-title="Assign Users"><img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Gabriel" class="img-circle avatar-xsmall" data-original-title="Gabriel"></span>
        <span class="x-assigned-user  card-task-assigned" tabindex="0" data-popover-content="card-task-team" data-title="Assign Users"><img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Jesus" class="img-circle avatar-xsmall" data-original-title="Jesus"></span>
        <span class="x-assigned-user  card-task-assigned" tabindex="0" data-popover-content="card-task-team" data-title="Assign Users"><img src="http://worketic.apnahive.com/public/images/user.jpg" data-toggle="tooltip" title="" data-placement="top" alt="Sadique" class="img-circle avatar-xsmall" data-original-title="Sadique"></span>
                </span>
                <!--user-->
                    </div>
            

            <!--show timer-->
            <!--<div id="task-timer-container">
                <div class="x-section x-timer m-t-10" id="task-users-task-timer">
            <div class="x-title  text-left">
                <h6 class=" m-b-0">My Timer</h6>
            </div>
            <span class="x-timer-time timers " id="task_timer_card_2">00<span class="timer-deliminator">:</span>05</span> -->
                <!--start a timer-->
            <!--<span class="x-timer-button js-timer-button js-ajax-request timer-start-button hidden visible-inline-block" id="timer_button_start_card_2" data-task-id="2" data-location="table" data-url="http://projects.terapixel.com.mx/tasks/timer/2/start?source=card" data-form-id="tasks-list-table" data-type="form" data-progress-bar="hidden" data-ajax-type="POST">
                <span><i class="mdi mdi-play-circle"></i></span>
            </span> -->
            <!--stop a timer-->
            <!--<span class="x-timer-button js-timer-button js-ajax-request timer-stop-button hidden " id="timer_button_stop_card_2" data-task-id="2" data-location="table" data-url="http://projects.terapixel.com.mx/tasks/timer/2/stop?source=card" data-form-id="tasks-list-table" data-type="form" data-progress-bar="hidden" data-ajax-type="POST">
                <span><i class="mdi mdi-stop-circle"></i></span>
            </span> -->
            <!--timer updating-->
            <!-- <input type="hidden" name="timers[2]" value=""> -->
            
            <!--polling trigger-->
            <!-- <span class="hidden" id="timerTaskPollingTrigger" data-type="form" data-progress-bar="hidden" data-notifications="disabled" data-skip-checkboxes-reset="TRUE" data-form-id="task-users-task-timer" data-ajax-type="post" data-url="http://projects.terapixel.com.mx/polling/timers?ref=task"></span>
        </div>
            </div>-->


            <!----------settings----------->
            <div class="x-section">
                <div class="x-title">
                    <h6>{{ trans('lang.settings') }}</h6>
                </div>
                <!--start date-->
                <div class="x-element" id="task-start-date" @click="editstartdate"><i class="mdi mdi-calendar-plus"></i>
                    <span>{{ trans('lang.start_date') }}: {{ task.start_date | formatDate }}</span>
                                <span class="x-highlight x-editable card-pickadate" id="task-start-date-container"></span>
                    
                            </div>
                <div id="task-start-date-edit" class="hidden" style="margin-bottom: 13px;">            
                    <input type="date" class="form-control form-control-sm pickadate" name="task_start_date_edit" autocomplete="off" placeholder="Start Date" v-on:change="startdatechange">
                </div>
                <!--due date-->
                <div class="x-element" id="task-due-date" @click="editduedate"><i class="mdi mdi-calendar-clock"></i>
                    <span>{{ trans('lang.due_date') }}: {{ task.due_date | formatDate }}</span>
                                <span class="x-highlight x-editable card-pickadate" id="task-due-date-container"></span>
                    
                            </div>
                <div id="task-due-date-edit" class="hidden" style="margin-bottom: 13px;">            
                    <input type="date" class="form-control form-control-sm pickadate" name="task_start_date_edit" autocomplete="off" placeholder="Due Date" v-on:change="duedatechange">
                </div>
                <!--status-->
                <!--<div class="x-element" id="card-task-status"><i class="mdi mdi-flag"></i> <span>Status: </span>
                                <span class="x-highlight x-editable js-card-settings-button-static" id="card-task-status-text" tabindex="0" data-popover-content="card-task-statuses" data-offset="0 25%" data-title="Status" data-original-title="" title="">{{ task.status | formatStatus }}</span>
                            </div> -->
                            
                <div class="x-element" id="card-task-status" @click="editstatus()"><i class="mdi mdi-flag"></i> <span>{{ trans('lang.status') }}: </span>
                                <span class="x-highlight x-editable js-card-settings-button-static" id="card-task-status-text" >{{ task.status | formatStatus }}</span>
                            </div>
                <div id="card-task-stat" class="hidden" style="margin-bottom: 13px;">
                        <label>{{ trans('lang.status') }}</label>
                        <select class="form-control form-control-sm" id="task-stat" name="task-stat" v-on:change="statuschange">
                            <option value="0">{{ trans('lang.new') }}</option>
                            <option value="1">{{ trans('lang.in_progress') }}</option>
                            <option value="2">{{ trans('lang.testing') }}</option>
                            <option value="3">{{ trans('lang.awaiting_feedback') }}</option>
                            <option v-show="isapprover == '1'" value="4">{{ trans('lang.completed') }}</option>
                        </select>                        
                    </div>

                <!--priority-->
                <div class="x-element" id="card-task-priority" @click="editpriority()"><i class="mdi mdi-verified"></i> <span>{{ trans('lang.priority') }}:
                    </span>
                                <span class="x-highlight x-editable js-card-settings-button-static" id="card-task-priority-text" tabindex="0" data-popover-content="card-task-priorities" data-title="Priority" data-original-title="" title="">{{ task.priority | formatPriority }}</span>
                            </div>

                <div id="card-task-prior" class="hidden" style="margin-bottom: 13px;">
                        <label>{{ trans('lang.priority') }}</label>
                        <select class="form-control form-control-sm" id="task-prior" name="task-prior" v-on:change="priorchange">
                            <option value="0">{{ trans('lang.normal') }}</option>
                            <option value="1">{{ trans('lang.high') }}</option>
                            <option value="2">{{ trans('lang.urgent') }}</option>
                            <option value="3">{{ trans('lang.low') }}</option>
                        </select>                        
                    </div>

                <!--client visibility-->
                        <div class="x-element" id="card-task-client-visibility" @click="editvisibility()"><i class="mdi mdi-eye"></i>
                    <span>{{ trans('lang.client') }}:</span>
                    <span class="x-highlight x-editable js-card-settings-button-static" id="card-task-client-visibility-text" tabindex="0" data-popover-content="card-task-visibility" data-title="Client Visibility" data-original-title="" title="">{{ task.client_visibility | formatClient }}</span>
                    
                </div>
                <div id="card-task-visi" class="hidden" style="margin-bottom: 13px;">
                        <label>{{ trans('lang.client') }}</label>
                        <select class="form-control form-control-sm" id="task-stat" name="task-stat" v-on:change="visibilitychange">
                            <option value="1">{{ trans('lang.visible') }}</option>
                            <option value="0">{{ trans('lang.not_visible') }}</option>
                            
                        </select>                        
                    </div>

                    </div>

            <!----------actions----------->
            <!--<div class="x-section">
                <div class="x-title">
                    <h6>Actions</h6>
                </div>

                track if we have any actions-->
                
                <!--change milestone-->
                <div class="x-element x-action js-card-settings-button-static" id="card-task-milestone" @click="editmilestone()"><i class="mdi mdi-redo-variant"></i>
                    <span class="x-highlight">{{ trans('lang.change_milestone') }}</span>
                </div> 
                <div id="card-task-mile" class="hidden" style="margin-bottom: 13px;">
                        <label>Milestone</label>
                        <select class="form-control form-control-sm" id="task-mile" name="task-mile" v-on:change="milechange">
                            <option value="0">{{ trans('lang.planning') }}</option>
                            <option value="1">{{ trans('lang.design') }}</option>
                            <option value="2">{{ trans('lang.development') }}</option>
                            <option value="3">{{ trans('lang.testing') }}</option>
                        </select>                        
                    </div>
                        
                <!--stop all timer-->
                
                <!--delete-->
                
                <!--no action available
                
            </div>-->


            <!----------meta infor----------->
            <div class="x-section">
                <div class="x-title">
                    <h6>{{ trans('lang.information') }}</h6>
                </div>
                <div class="x-element x-action">
                    <table class="table table-bordered table-sm">
                        <tbody>
                            <tr>
                                <td>{{ trans('lang.task_id') }}</td>
                                <td><strong>#{{ task.id }}</strong></td>
                            </tr>
                            <tr>
                                <td>{{ trans('lang.created_by') }}</td>
                                <td><strong>{{ task.username }}</strong></td>
                            </tr>
                            <tr>
                                <td>{{ trans('lang.date_created') }}</td>
                                <td><strong>{{ task.created_at | formatDate }}</strong></td>
                            </tr>
                            <!--<tr>
                                <td>Total Time</td>
                                <td><strong><span id="task_timer_all_card_2">00<span class="timer-deliminator">:</span>05</span></strong>
                                </td>
                            </tr>
                            <tr>
                                <td>Time Invoiced</td>
                                <td><strong><span id="task_timer_all_card_2">00<span class="timer-deliminator">:</span>00</span></strong>
                                </td>
                            </tr>-->
                            <tr>
                                <td>{{ trans('lang.project') }}t</td>
                                <td><strong><a href="#" target="_blank">#{{ task.job }}</a></strong>
                                </td>
                            </tr>
                                            </tbody>
                    </table>
                </div>
            </div>


            <!-----------------------------popover dropdown elements------------------------------------>

            <!--task statuses - popover -->
                <!--<div class="hidden" id="card-task-statuses">
                <ul class="list">
                                <li class="card-tasks-update-status-link" data-button-text="card-task-status-text" data-progress-bar="hidden" data-url="http://projects.terapixel.com.mx/tasks/2/update-status" data-type="form" data-value="new" data-form-id="--set-dynamically--" data-ajax-type="post">
                        New</li>
                                <li class="card-tasks-update-status-link" data-button-text="card-task-status-text" data-progress-bar="hidden" data-url="http://projects.terapixel.com.mx/tasks/2/update-status" data-type="form" data-value="in_progress" data-form-id="--set-dynamically--" data-ajax-type="post">
                        In Progress</li>
                                <li class="card-tasks-update-status-link" data-button-text="card-task-status-text" data-progress-bar="hidden" data-url="http://projects.terapixel.com.mx/tasks/2/update-status" data-type="form" data-value="testing" data-form-id="--set-dynamically--" data-ajax-type="post">
                        Testing</li>
                                <li class="card-tasks-update-status-link" data-button-text="card-task-status-text" data-progress-bar="hidden" data-url="http://projects.terapixel.com.mx/tasks/2/update-status" data-type="form" data-value="awaiting_feedback" data-form-id="--set-dynamically--" data-ajax-type="post">
                        Awaiting Feedback</li>
                                <li class="card-tasks-update-status-link" data-button-text="card-task-status-text" data-progress-bar="hidden" data-url="http://projects.terapixel.com.mx/tasks/2/update-status" data-type="form" data-value="completed" data-form-id="--set-dynamically--" data-ajax-type="post">
                        Completed</li>
                            </ul>
                <input type="hidden" name="task_status" id="task_status">
                <input type="hidden" name="current_task_status_text" id="current_task_status_text">
            </div>-->
            

            <!--task priority - popover-->
            <!--<div class="hidden" id="card-task-priorities">
                <ul class="list">
                                <li class="card-tasks-update-priority-link" data-button-text="card-task-priority-text" data-progress-bar="hidden" data-url="http://projects.terapixel.com.mx/tasks/2/update-priority" data-type="form" data-value="low" data-form-id="--set-dynamically--" data-ajax-type="post">
                        Low</li>
                                <li class="card-tasks-update-priority-link" data-button-text="card-task-priority-text" data-progress-bar="hidden" data-url="http://projects.terapixel.com.mx/tasks/2/update-priority" data-type="form" data-value="normal" data-form-id="--set-dynamically--" data-ajax-type="post">
                        Normal</li>
                                <li class="card-tasks-update-priority-link" data-button-text="card-task-priority-text" data-progress-bar="hidden" data-url="http://projects.terapixel.com.mx/tasks/2/update-priority" data-type="form" data-value="high" data-form-id="--set-dynamically--" data-ajax-type="post">
                        High</li>
                                <li class="card-tasks-update-priority-link" data-button-text="card-task-priority-text" data-progress-bar="hidden" data-url="http://projects.terapixel.com.mx/tasks/2/update-priority" data-type="form" data-value="urgent" data-form-id="--set-dynamically--" data-ajax-type="post">
                        Urgent</li>
                            </ul>
                <input type="hidden" name="task_priority" id="task_priority">
                <input type="hidden" name="current_task_priority_text" id="current_task_priority_text">
            </div> -->
            
            <!--client visibility - popover-->
            <!--  <div class="hidden" id="card-task-visibility">
                <ul class="list">
                    <li class="card-tasks-update-visibility-link" data-button-text="card-task-client-visibility-text" data-progress-bar="hidden" data-url="http://projects.terapixel.com.mx/tasks/2/update-visibility" data-type="form" data-value="no" data-text="Hidden" data-form-id="card-task-client-visibility" data-ajax-type="post">
                        Hidden
                    </li>
                    <li class="card-tasks-update-visibility-link" data-button-text="card-task-client-visibility-text" data-progress-bar="hidden" data-url="http://projects.terapixel.com.mx/tasks/2/update-visibility" data-type="form" data-value="yes" data-text="Visible" data-form-id="card-task-client-visibility" data-ajax-type="post">
                        Visible
                    </li>
                </ul>
                <input type="hidden" name="task_client_visibility" id="task_client_visibility">
                <input type="hidden" name="current_task_client_visibility_text" id="current_task_client_visibility_text">
            </div> -->
            
            <!--milestone - popover -->
             <!--   <div class="hidden" id="card-task-milestones">
                <div class="form-group m-t-10">
                    <select class="custom-select col-12 form-control form-control-sm" id="task_milestoneid" name="task_milestoneid">
                                                        <option value="1">
                            Planning</option>
                                        <option value="2">
                            Design</option>
                                        <option value="3">
                            Development</option>
                                        <option value="4">
                            Testing</option>
                                        <option value="5">
                            Uncategorised</option>
                                                    </select>
                </div>
                <div class="form-group text-right">
                    <button type="button" class="btn btn-danger btn-sm" id="card-tasks-update-milestone-button" data-progress-bar="hidden" data-url="http://projects.terapixel.com.mx/tasks/2/update-milestone" data-type="form" data-ajax-type="post" data-form-id="popover-body">
                        Update
                    </button>
                </div>
            </div> -->
            

            <!--assign user-->
            <!--<div class="hidden" id="card-task-team">
                <div class="alert alert-info">Only users assigned to the project are shown in this list</div>
                        <div class="form-check m-b-15">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="assigned[4]" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><img src="http://worketic.apnahive.com/public/images/user.jpg" class="img-circle avatar-xsmall"> Gabriel Luna</span>
                    </label>
                </div>
                        <div class="form-check m-b-15">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="assigned[3]" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><img src="http://worketic.apnahive.com/public/images/user.jpg" class="img-circle avatar-xsmall"> Jesus Chavez</span>
                    </label>
                </div>
                        <div class="form-check m-b-15">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="assigned[5]" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><img src="http://worketic.apnahive.com/public/images/user.jpg" class="img-circle avatar-xsmall"> Sadique Ali</span>
                    </label>
                </div>
                        <div class="form-group text-right">
                    <button type="button" class="btn btn-danger btn-sm" id="card-tasks-update-assigned" data-progress-bar="hidden" data-url="http://projects.terapixel.com.mx/tasks/2/update-assigned" data-type="form" data-ajax-type="post" data-form-id="popover-body">
                        Update
                    </button>
                </div>
            </div>-->
            
            </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- add new task Model -->
        <div class="modal" id="newtask" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document" style="margin-top: 40px;">
                <form @submit.prevent="CreateTask()">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('lang.add_new_task') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ trans('lang.title') }}</label>
                        <input v-model="form.title" type="text" name="title"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">                        
                    </div>
                    <div class="form-group">
                        <label>{{ trans('lang.description') }}</label>
                        <textarea v-model="form.description"  class="form-control" name="description" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('lang.target_date') }}</label>
                        <input v-model="form.task_date_due" type="date" class="form-control form-control-sm pickadate" name="task_date_due" autocomplete="off" placeholder="" :class="{ 'is-invalid': form.errors.has('task_date_due') }">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('lang.tags') }}</label>
                        <input v-model="form.tags" type="text" name="tags"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('tags') }">                        
                    </div>
                    <div class="form-group">
                        <label>{{ trans('lang.milestone') }}</label>
                        <select v-model="form.milestone" class="form-control form-control-sm" id="milestone" name="milestone" :class="{ 'is-invalid': form.errors.has('milestone') }">
                            <option value="0">{{ trans('lang.planning') }}</option>
                            <option value="1">{{ trans('lang.design') }}</option>
                            <option value="2">{{ trans('lang.development') }}</option>
                            <option value="3">{{ trans('lang.testing') }}</option>
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label>{{ trans('lang.priority') }}</label>
                        <select v-model="form.priority" class="form-control form-control-sm" id="priority" name="priority" :class="{ 'is-invalid': form.errors.has('priority') }">
                            <option value="0">{{ trans('lang.normal') }}</option>
                            <option value="1">{{ trans('lang.high') }}</option>
                            <option value="2">{{ trans('lang.urgent') }}</option>
                            <option value="3">{{ trans('lang.low') }}</option>
                        </select>                        
                    </div>
                    <div class="form-group form-group-half" style="display: flex;margin-top: 20px;">
                        <label>{{ trans('lang.visible_to_client') }}</label>
                        <input v-model="form.client_visibility" type="checkbox" name="client_visibility"
                            class="form-control checkboxes" :class="{ 'is-invalid': form.errors.has('client_visibility') }" style="box-shadow: none;width: 50%;">                        
                    </div>
                    <div class="form-group form-group-half" style="display: flex;margin-top: 20px;">
                        <label>{{ trans('lang.billable') }}</label>
                        <input v-model="form.billable" type="checkbox" name="billable"
                            class="form-control checkboxes" :class="{ 'is-invalid': form.errors.has('billable') }" style="box-shadow: none;width: 50%;">                        
                    </div>
                    <input type="hidden" name="job_id" v-model="form.job_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="wt-btn" style="background-color: gray;" data-dismiss="modal">{{ trans('lang.close') }}</button>
                    <button type="submit" class="wt-btn">{{ trans('lang.save_changes') }}</button>
                </div>
                </div>
                </form>
            </div>
        </div>


            
        </div>
    </div>

    
    
</template>

<script>
//import vueDropzone from "vue2-dropzone";
export default {   
 data () {
    return {
        editmode : false,
        task : {
            id : '',
            title : '',
            description : '',
            start_date : '',
            due_date : '',
            milestone : '',
            client_visibility : '',
            status : '',
            created_at : '',
            username : '',
            created_by : '',
            job : this.jobtitle        
        },
        tasks0 : {},
        tasks1 : {},
        tasks2 : {},
        tasks3 : {},
        tasks4 : {},
        form : new Form({
            id: '',
            title : '',
            description : '',
            task_date_due : '',
            tags : '',
            priority : '',
            milestone : '',
            client_visibility : '',
            billable : '',
            job_id : this.jobid,
            user_id : this.userid,
            status: ''
        }),
        role : '' 
        
    }
  },
  props: {
      jobid: String,
      userid: String,
      jobtitle : String,
      isapprover : String
  },
  methods: {
      loadTasks() {
            let self = this;
            axios.get(APP_URL + '/api/tasks/' + this.jobid).then(function (response) {
                //console.log(response.data);
                self.tasks0 = response.data[0];
                self.tasks1 = response.data[1];
                self.tasks2 = response.data[2];
                self.tasks3 = response.data[3];
                self.tasks4 = response.data[4];
            });
        },
        priorchange(e) {
            let statp =  this.task.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/tasks/priority/' + statp).then(function (response) {
                Fire.$emit('TaskUpdated');
                $('#card-task-priority').removeClass('hidden');
                $('#card-task-prior').addClass('hidden');
                $('#cardModal').modal('hide');
            });
        },
        milechange(e) {
            let stat =  this.task.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/tasks/milestone/' + stat).then(function (response) {
                Fire.$emit('TaskUpdated');
                $('#card-task-milestone').removeClass('hidden');
                $('#card-task-mile').addClass('hidden');
                $('#cardModal').modal('hide');
            });
        },
        statuschange(e) {            
            let stat =  this.task.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/tasks/status/' + stat).then(function (response) {
                Fire.$emit('TaskUpdated');
                $('#card-task-status').removeClass('hidden');
                $('#card-task-stat').addClass('hidden');
                $('#cardModal').modal('hide');
            });
        },
        visibilitychange(e) {            
            let stat =  this.task.id + '-' + e.target.value;
            axios.get(APP_URL + '/api/tasks/visibility/' + stat).then(function (response) {
                Fire.$emit('TaskUpdated');
                $('#card-task-client-visibility').removeClass('hidden');
                $('#card-task-visi').addClass('hidden');
                $('#cardModal').modal('hide');
            });
        },
        startdatechange(e)
        {
            
            let stat =  this.task.id + '_' + e.target.value;
            axios.get(APP_URL + '/api/tasks/startdate/' + stat).then(function (response) {
                Fire.$emit('TaskUpdated');
                $('#task-start-date').removeClass('hidden');
                $('#task-start-date-edit').addClass('hidden');
                $('#cardModal').modal('hide');
            });
        },
        duedatechange(e)
        {
            
            let stat =  this.task.id + '_' + e.target.value;
            axios.get(APP_URL + '/api/tasks/duedate/' + stat).then(function (response) {
                Fire.$emit('TaskUpdated');
                $('#task-start-date').removeClass('hidden');
                $('#task-start-date-edit').addClass('hidden');
                $('#cardModal').modal('hide');
            });
        },
        editstartdate() {
            $('#task-start-date').addClass('hidden');
            $('#task-start-date-edit').removeClass('hidden');
        },
        editduedate() {
            $('#task-due-date').addClass('hidden');
            $('#task-due-date-edit').removeClass('hidden');
        },
        editpriority() {
            $('#card-task-priority').addClass('hidden');
            $('#card-task-prior').removeClass('hidden');
        },
        editvisibility() {
            $('#card-task-client-visibility').addClass('hidden');
            $('#card-task-visi').removeClass('hidden');
        },
        editmilestone() {
            $('#card-task-milestone').addClass('hidden');
            $('#card-task-mile').removeClass('hidden');
        },
        editstatus() {
            $('#card-task-status').addClass('hidden');
            $('#card-task-stat').removeClass('hidden');
            
        },
        loadRole() {
            let self = this;            
            axios.get(APP_URL + '/api/user/role/' + this.userid).then(function (response) {
                self.role = response.data;
            });
        },
        editTask(taskx) {
            //console.log(taskx);
            let self = this;
            self.task.id = taskx.id;
            self.task.title = taskx.title;
            self.task.created_at = taskx.created_at;
            self.task.description = taskx.description;
            self.task.milestone = taskx.milestone;
            self.task.priority = taskx.priority;
            self.task.due_date = taskx.due_date;
            self.task.start_date = taskx.start_date;
            self.task.status = taskx.status;
            self.task.client_visibility = taskx.client_visibility;
            self.task.created_by = taskx.created_by;
            axios.get(APP_URL + '/api/v1/user/' + taskx.created_by).then(function (response) {
                //console.log(taskx);
                self.task.username = response.data;
            });
            $('#cardModal').modal('show');  
            
        },
        CreateTask() {
            this.form.post('/api/tasks/')
            .then(() => {
                toast.fire({
                icon: 'success',
                title: 'Task Created successfully'
                });
                this.form.reset();
                Fire.$emit('AfterCreate');
                $('#newtask').hide();  
                $('#newtask').removeClass('show');   
                $('#newtask').removeClass('in');               
                $('.modal-backdrop').remove();
                
            })
            .catch(() => {

            })
            
        }
               

  },
    mounted: function() {
        this.loadRole();
      this.loadTasks();
      Fire.$on('AfterCreate', () => {
                this.loadTasks();
            });
      Fire.$on('TaskUpdated', () => {
                this.loadTasks();
                
                this.editTask(this.task);
            });
  }
};
</script>