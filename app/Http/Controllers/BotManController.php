<?php

namespace App\Http\Controllers;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\URL;
use App\Live_contest;
use App\Job;
use App\User;
use App\Proposal;
use App\Contest_bid;
use Auth;

class BotManController extends Controller
{   
    /*protected $BotManController;
    public function __construct(BotManController $BotManController)
    {
        $this->BotManController = $BotManController;
    }*/

    public function find_proposal($job)
    {
        $best = null;
        $temp = 0;
        $proposals = Proposal::where('job_id', $job)->get();
        foreach($proposals as $value)
        {
            if($temp == 0)
            {
                $best = $value;
                $temp = $value->amount;
                
            }                
            else
            {
                if($value->amount < $temp )
                {
                    $best = $value;
                    $temp = $value->amount;
                }
            }
        }        
        return $best;
    } 
    public function handle()
    {
        $botman = app('botman');

        
        
        $botman->hears('{message}', function($botman, $message) {
  
            /*if ($message == 'hi') {
                //$this->askName($botman);
                $this->say('Please say "Status" to check the current status of the contest. For Updating bid say "update bid"');
            } */                       
            if ($message == 'status')
            {
                $user = Auth::user();
                
                $payload = $botman->getmessage()->getPayload();
                
                $contest = Live_contest::find($payload['userId']);
                $job = Job::find($contest->job_id);
                $best_proposal = $this->find_proposal($job->id);
                //$botman->reply('best bid is '.$best_proposal);
                if($best_proposal->provider_id == $user->id)
                {
                    $botman->reply("Your proposal is the best in all the bids. <br><br> best bid is ".$best_proposal->amount);
                    //$botman->reply('best bid is '.$best_proposal->amount);
                }
                else
                {
                    $name = User::find($best_proposal->provider_id);
                    $botman->reply('Best Bid is from '.$name->first_name.' '.$name->last_name .'<br><br> Best bid is '.$best_proposal->amount);
                }
                $this->askNewBid($botman);             
            }
            elseif ($message == 'update bid')
            {
                $payload = $botman->getmessage()->getPayload();
                //dd($payload);
                $contest = Live_contest::find($payload['userId']);
                $job = Job::find($contest->job_id);
                $best_proposal = $this->find_proposal($job->id);

                $this->askNewBidAmount($botman, $best_proposal->amount);
                //$botman->reply('your bid is updated');
            }
            else{
                $botman->reply("write 'status' for contest information  ");
            }
  
        });
  
        $botman->listen();
    }
  
    /**
     * Place your BotMan logic here.
     */
    
    public function askNewBidAmount($botman, $number)
    {
        $botman->ask('Enter new bid amount', function(Answer $answer) use ($number, $botman) {            
            //dd( is_numeric($answer->getText()) );
            if( is_numeric($answer->getText()) )
            {
                $amount = (int)$answer->getText();
                if($amount < $number)
                {
                    $user = Auth::user();
                
                    $payload = $botman->getmessage()->getPayload();
                    
                    $contest = Live_contest::find($payload['userId']);
                    $job = Job::find($contest->job_id);
                    $proposal = Proposal::where('job_id', $contest->job_id)->where('provider_id', $user->id)->first();
                    $proposal->amount = $amount;
                    $contest_bid = new Contest_bid;
                    $contest_bid->bid = $amount;
                    $contest_bid->contest_id = $contest->id;
                    $contest_bid->user_id = $user->id;
                    $contest_bid->status = 0;
                    $contest_bid->save();
                    $proposal->save();
                    $this->say('New bid is '.$answer->getText());
                }
                else
                    $this->say('Amount is above the best bid. please put low amount');                
            }                
            else
                $this->say('entered is not an amount');
            
        });
    }

    public function askNewBid($botman)
    {
        $botman->ask('Do you wish to improve the bid?', function(Answer $answer, $botman) {
            if($answer->getText() == 'yes' || $answer->getText() == 'Yes')
                $this->say('say "update bid" to improve bid.');
            else
                $this->say('OK');
        });
    }
    

    /*public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function(Answer $answer) {
  
            $name = $answer->getText();
  
            $this->say('Nice to meet you '.$name);
        });
    }*/
}
