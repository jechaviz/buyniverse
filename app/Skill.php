<?php

/**
 * Class Skill
 *
 
 */

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\CatSkill;
use App\Category;

/**
 * Class Skill
 *
 */
class Skill extends Model
{
    /**
     * Fillables for the database
     *
     * @access protected
     * @var    array $fillable
     */
    protected $fillable = array(
        'title', 'slug', 'description',
    );

    /**
     * Protected Date
     *
     * @access protected
     * @var    array $dates
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The provider that belong to the skill.
     *
     * @return relation
     */
    public function providers()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * The job that belong to the skill.
     *
     * @return relation
     */
    public function jobs()
    {
        return $this->belongsToMany('App\Job');
    }

    /* For the future*/
    public function category()
    {
        return $this->belongsToMany('App\Category', 'cat_skills', 'skill_id', 'cat_id');   
    }

    /*public static function getcategory($id)
    {
        $cat = Category::where('code', $id)->first();
        return $currency->symbol;
    }*/

    /**
     * Set slug before saving in DB
     *
     * @param string $value value
     *
     * @access public
     *
     * @return string
     */
    public function setSlugAttribute($value)
    {
        if (!empty($value)) {
            $temp = str_slug($value, '-');
            if (!Skill::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!Skill::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * For saving skills in Database
     *
     * @param mixed $request get req attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function saveSkills($request)
    {
        if (!empty($request)) {
            $this->title = filter_var($request['skill_title'], FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request['skill_title'], FILTER_SANITIZE_STRING);
            $this->description = filter_var($request['skill_desc'], FILTER_SANITIZE_STRING);
            $user_id = Auth::user()->id;
            $this->user_id = $user_id;
            if (Auth::user()->getRoleNames()[0] == 'admin') 
            {
                $this->admin = 1;
            }
            else
            {
                $this->admin = 0;
            }
            $this->save();

            CatSkill::create([
                'cat_id' => $request->cat_id,
                'skill_id' => $this->id
            ]);

            //dd($this->id);
            return true;
        }
    }

    /**
     * For updating skills
     *
     * @param mixed $request get req attributes
     * @param int   $id      get skill id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateSkills($request, $id)
    {
        if (!empty($request)) {
            $skills = self::find($id);
            if ($skills->title != filter_var($request['skill_title'], FILTER_SANITIZE_STRING)) {
                $skills->slug = filter_var($request['skill_title'], FILTER_SANITIZE_STRING);
            }
            $skills->title = filter_var($request['skill_title'], FILTER_SANITIZE_STRING);
            $skills->description = filter_var($request['skill_desc'], FILTER_SANITIZE_STRING);
            $skills->save();

            $cat = CatSkill::where('skill_id', $id)->first();
            if($cat)
            {
                $cat->cat_id = $request->cat_id;
                $cat->save();
            }
            else
            {
                CatSkill::create([
                    'cat_id' => $request->cat_id,
                    'skill_id' => $id
                ]);
            }
            
        }
    }

    /**
     * For updating skills
     *
     * @param int $user_id get user ID
     *
     * @return \Illuminate\Http\Response
     */
    public static function getProviderSkill($user_id)
    {
        return DB::table('skill_user')->select('skill_id')
            ->where('user_id', $user_id)
            ->get()->pluck('skill_id')->toArray();
    }

    /**
     * For updating skills
     *
     * @param int $job_id JobId
     *
     * @return \Illuminate\Http\Response
     */
    public static function getJobSkill($job_id)
    {
        return DB::table('job_skill')->select('skill_id')
            ->where('job_id', $job_id)
            ->get()->pluck('skill_id')->toArray();
    }
}
