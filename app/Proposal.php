<?php
/**
 * Class Proposal
 *
 
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
use Storage;
use DB;
use Auth;
use App\Job;
use App\EmailTemplate;
use App\Mail\ProviderEmailMailable;
use App\User;
use App\Proposal;
use App\ProposalFile;

/**
 * Class Proposal
 *
 */
class Proposal extends Model
{

    /**
     * Get the job that owns the proposal.
     *
     * @return relation
     */
    public function job()
    {
        return $this->belongsTo('App\Job');
    }

    /**
     * Get all of the proposal's report.
     *
     * @return relation
     */
    public function reports()
    {
        return $this->morphOne('App\Report', 'reportable');
    }

    /**
     * Get the provider that owns the proposal.
     *
     * @return relation
     */
    public function provider()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Store Propsals.
     *
     * @param string $request req->attributes
     * @param string $id      ID
     *
     * @return proposal
     */
    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public function updateProposal($request, $id, $login_id ='')
    {
        $json = array();
        if (!empty($request)) {
            $user_id = !empty($login_id) ? $login_id :Auth::user()->id;
            $proposal = self::where('provider_id', $user_id)->where('job_id', $id)->first();
            $proposal->amount = intval($request['amount']);
            $proposal['original'] = intval($request['amount']);
            
            $proposal->completion_time = filter_var($request['completion_time'], FILTER_SANITIZE_STRING);
            $proposal->content = filter_var($request['description'], FILTER_SANITIZE_STRING);
            //$proposal->provider_id = intval($user_id);
            //$job = Job::find($id);
            //$this->job()->associate($job);
            //$old_path = 'uploads\proposals\temp';
            /*$proposal_attachments = array();
            if (!empty($request['attachments'])) {

                $attachments = $request['attachments'];
                foreach ($attachments as $key => $attachment) {
                    if (Storage::disk('local')->exists($old_path . '/' . $attachment)) {
                        $new_path = 'uploads/proposals/' . $user_id;
                        if (!file_exists($new_path)) {
                            File::makeDirectory($new_path, 0755, true, true);
                        }
                        $filename = time() . '-' . $attachment;
                        Storage::move($old_path . '/' . $attachment, $new_path . '/' . $filename);
                        $proposal_attachments[] = $filename;
                    }
                }
                $this->attachments = serialize($proposal_attachments);
            }*/
            
            $proposal->save();
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        } 
    }
    public function storeProposal($request, $id, $login_id ='')
    {
        //dd('In the model');
        $json = array();
        if (!empty($request)) {
            $user_id = !empty($login_id) ? $login_id :Auth::user()->id;
            $this->amount = intval($request['amount']);
            $this['original'] = intval($request['amount']);
            
            $this->completion_time = filter_var($request['completion_time'], FILTER_SANITIZE_STRING);
            $this->content = filter_var($request['description'], FILTER_SANITIZE_STRING);
            $this->provider_id = intval($user_id);
            $job = Job::find($id);
            $this->job()->associate($job);
            $old_path = 'uploads\proposals\temp';
            $proposal_attachments = array();
            
            
            //dd('In the model', $this->original, $this->amount);
            //dd($this);
            $this->save();

            if (!empty($request['attachments'])) {

                $attachments = $request['attachments'];
                foreach ($attachments as $key => $attachment) {
                    if (Storage::disk('local')->exists($old_path . '/' . $attachment)) {
                        $new_path = 'job_files/';
                        if (!file_exists($new_path)) {
                            File::makeDirectory($new_path, 0755, true, true);
                        }
                        $filename = time() . '-' . $attachment;
                        Storage::move($old_path . '/' . $attachment, $new_path . '/' . $filename);
                        
                        $proposal_attachments[] = $filename;
                        $job_file = new ProposalFile;
                        $job_file->name = $attachment;
                        $job_file->size = "142.79 KB";
                        $job_file->description = $request->fdescription;
                        $job_file->proposal_id = $this->id;
                        $job_file->file = $filename; 
                        $job_file->save();
                    }
                    //$file = $attachment;
                    //$name = $file;
                    //$size = "142.79 KB";
                    //$size_unit = $this->formatSizeUnits($size);
                    //$origin = explode('.', $name);

                    //$proposal = Proposal::where('job_id', $job->id)->where('provider_id', $user_id)->first();

                    //$file = $request->file('file');
                    /*$job_file = new ProposalFile;
                    $job_file->name = $name;
                    $job_file->size = $size;
                    $job_file->description = $request->fdescription;
                    $job_file->proposal_id = $this->id;
                    $job_file->file = $file; 
                    $job_file->save();*/
                    
                    //$input['file'] = $job_file->file;

                    //$destinationPath = public_path('/job_files/'); 

                    //$file->move($destinationPath, $input['file']);
                }
                //$this->attachments = serialize($proposal_attachments);
            }
            /*$ids = $this->id;
            $proposal = Proposal::find($ids);
            $proposal->original = $proposal->amount;
            $proposal->save();*/
            //dd('saved');
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * AssignJob.
     *
     * @param string $id ID
     *
     * @return proposal
     */
    public function assignJob($id)
    {
        $proposal = $this::find($id);
        $proposal->hired = 1;
        $proposal->status = 'hired';
        $proposal->save();
        $job = Job::find($proposal->job->id);
        $job->status = 'hired';

        return $job->save();
    }

    /**
     * Send Message.
     *
     * @param mixed $request request->attr
     * @param int   $user_id
     *
     * @return response
     */
    public static function sendMessage($request, $user_id)
    {
        if (!empty($request['recipent_id'])) {
            $message_attachments = array();
            if (!empty($request['attachments'])) {
                $old_path = 'uploads\proposals\temp';
                $attachments = $request['attachments'];
                foreach ($attachments as $key => $attachment) {
                    if (Storage::disk('local')->exists($old_path . '/' . $attachment)) {
                        $new_path = 'uploads/proposals/' . $user_id;
                        if (!file_exists($new_path)) {
                            File::makeDirectory($new_path, 0755, true, true);
                        }
                        $filename = time() . '-' . $attachment;
                        Storage::move($old_path . '/' . $attachment, $new_path . '/' . $filename);
                        $message_attachments[] = $filename;
                    }
                }
            }
            $msg_attachments = !empty($message_attachments) ? serialize($message_attachments) : null;
            DB::table('private_messages')->insert(
                [
                    'author_id' => $user_id, 'proposal_id' => $request['proposal_id'], 'content' => $request['description'],
                    'attachments' => $msg_attachments,
                    'notify' => 0, "created_at" => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]
            );

            $lastInsertedID = DB::getPdo()->lastInsertId();
            DB::table('private_messages_to')->insert(
                [
                    'private_message_id' => $lastInsertedID, 'recipent_id' => $request['recipent_id'],
                    'message_read' => 0, 'read_date' => null, "created_at" => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]
            );
            $json['type'] = 'success';
            return $json;
        }
    }

    /**
     * Get message
     *
     * @param mixed $user_id       User ID
     * @param int   $provider_id provider ID
     * @param int   $proposal_id   Proposal
     *
     * @return response
     */
    public static function getMessages($user_id, $provider_id, $proposal_id, $project_type)
    {
        return DB::table('private_messages')
            ->join('private_messages_to', 'private_messages.id', '=', 'private_messages_to.private_message_id')
            ->join('profiles', 'profiles.user_id', '=', 'private_messages.author_id')
            ->select('private_messages.id', 'private_messages.*', 'profiles.avater')
            ->where('private_messages.proposal_id', $proposal_id)
            ->where('private_messages.project_type', $project_type)
            ->orWhere(function ($query) use ($user_id, $provider_id) {
                $query
                    ->where('private_messages_to.recipent_id', '=', $user_id)
                    ->Where('private_messages.author_id', '=', $provider_id);
            })
            ->orWhere(function ($query) use ($user_id, $provider_id) {
                $query->where('private_messages_to.recipent_id', '=', $provider_id)
                    ->Where('private_messages.author_id', '=', $user_id);
            })
            ->orderBy('private_messages.created_at')->get()->toArray();
    }
    
    /**
     * Get message
     *
     * @param mixed $user_id       User ID
     * @param int   $provider_id Provider ID
     * @param int   $proposal_id   Proposal
     *
     * @return response
     */
    public static function getProjectHistory($user_id, $provider_id, $proposal_id, $project_type)
    {
        return DB::table('private_messages')
            ->join('private_messages_to', 'private_messages.id', '=', 'private_messages_to.private_message_id')
            ->join('profiles', 'profiles.user_id', '=', 'private_messages.author_id')
            ->select('private_messages.id', 'private_messages.*', 'profiles.avater')
            ->where('private_messages.proposal_id', $proposal_id)
            ->where('private_messages.project_type', $project_type)
            ->orderBy('private_messages.created_at')->get()->toArray();
    }
    

    /**
     * Get proposals by status.
     *
     * @param mixed  $user_id     User ID
     * @param int    $status      Status
     * @param string $paid_status paid_status
     * @param int    $limit       limit
     *
     * @return \Illuminate\Http\Response
     */
    public static function getProposalsByStatus($user_id, $status, $paid_status = '', $limit = 3)
    {
        $projects = Proposal::select('id', 'amount', 'updated_at')->latest()
            ->where('provider_id', $user_id)
            ->where('status', $status);
        if (!empty($paid_status)) {
            $projects->where('paid', $paid_status);
        }
        return $projects->take($limit)->get();
    }

    /**
     * Get proposals by status.
     *
     * @param mixed $job_skills job skill
     *
     * @return \Illuminate\Http\Response
     */
    public function getJobSkillRequirement($job_skills)
    {
        $json = array();
        $skill = '';
        if (!empty($job_skills)) {
            $provider_skills = auth()->user()->skills->pluck('id')->toArray();
            foreach ($job_skills as $key => $skill) {
                if (!(in_array($skill, $provider_skills))) {
                    $json[$key] = $skill;
                }

            }
            return $json;
        }
    }

    /**
     * Get proposals by status.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProvidersTotalAmount()
    {
        $this::where('status', 'completed')->sum(amount);
    }

    /**
     * Delete proposal from storage
     *
     * @param string $id ID
     *
     * @return \Illuminate\Http\Response
     */
    public static function deleteRecord($id)
    {
        $proposal = self::find($id);
        $job = Job::find($proposal->job->id);
        if (!empty($job) && $job->status == 'hired') {
            $job->status = 'posted';
            $job->save();
        }
        return $proposal->delete();
    }
}
