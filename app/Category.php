<?php
/**
 * Class Category
 *
 
 */

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use File;
use Storage;
use Auth;

/**
 * Class Category
 *
 */
class Category extends Model
{
    /**
     * Fillables for the database
     *
     * @access protected
     *
     * @var array $fillable
     */
    protected $fillable = array(
        'title', 'slug', 'abstract', 'user_id', 'admin', 'parent_id'
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
     * Get all of the users that are assigned this category.
     *
     * @return relation
     */
    public function providers()
    {
        return $this->morphedByMany('App\User', 'catable');
    }


    /**
     * Get all of the jobs that are assigned this category.
     *
     * @return relation
     */
    public function jobs()
    {
        return $this->morphedByMany('App\Job', 'catable');
    }

    /**
     * Get all of the services that are assigned this category.
     *
     * @return relation
     */
    public function services()
    {
        return $this->morphedByMany('App\Service', 'catable');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Skill', 'cat_skills', 'cat_id');        
    }


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
            if (!Category::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!Category::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * Saving categories
     *
     * @param string $request get req attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCategories($request)
    {
        if (!empty($request)) {
            $this->title = filter_var($request['category_title'], FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request['category_title'], FILTER_SANITIZE_STRING);
            // $this->abstract = filter_var($request['category_abstract'], FILTER_SANITIZE_STRING);
            $this->abstract = $request['category_abstract'];
            //dd($request['parent_id']);
            $this->parent_id = $request['parent_id'];
            $user_id = Auth::user()->id;
            $this->user_id = $user_id;
            if (Auth::user()->getRoleNames()[0] == 'admin') 
            {
                $this->admin = 1;
                $this->status = 'appear_globally';
            }
            else
            {
                $this->admin = 0;
                $this->status = 'appear_user';
            }
            $old_path = Helper::assetPath() . '/uploads/categories/temp';
            if (!empty($request['uploaded_image'])) {
                $filename = $request['uploaded_image'];
                if (file_exists($old_path . '/' . $request['uploaded_image'])) {
                    $new_path = Helper::assetPath().'/uploads/categories/';
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['uploaded_image'];
                    rename($old_path . '/' . $request['uploaded_image'], $new_path . '/' . $filename);
                    rename($old_path . '/small-' . $request['uploaded_image'], $new_path . '/small-' . $filename);
                    rename($old_path . '/medium-' . $request['uploaded_image'], $new_path . '/medium-' . $filename);
                }
                $this->image = filter_var($filename, FILTER_SANITIZE_STRING);
            } else {
                $this->image = null;
            }
            $this->save();
            $json['type'] = 'success';
            $json['message'] = trans('lang.cat_created');
            return $json;
        }
    }

    /**
     * Updating Categories
     *
     * @param string $request get request attributes
     * @param int    $id      get department id for updation
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCategories($request, $id)
    {
        if (!empty($request)) {
            $cats = self::find($id);
            if ($cats->title != $request['category_title']) {
                $cats->slug  =  filter_var($request['category_title'], FILTER_SANITIZE_STRING);
            }
            $cats->title = filter_var($request['category_title'], FILTER_SANITIZE_STRING);
            // $cats->abstract = filter_var($request['category_abstract'], FILTER_SANITIZE_STRING);
            $cats->abstract = $request['category_abstract'];
            $cats->parent_id = $request['parent_id'];
            $old_path = Helper::assetPath() . '/uploads/categories/temp';
            if (!empty($request['uploaded_image'])) {
                $filename = $request['uploaded_image'];
                if (file_exists($old_path . '/' . $request['uploaded_image'])) {
                    $new_path = Helper::assetPath().'/uploads/categories/';
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['uploaded_image'];
                    rename($old_path . '/' . $request['uploaded_image'], $new_path . '/' . $filename);
                    rename($old_path . '/small-' . $request['uploaded_image'], $new_path . '/small-' . $filename);
                    rename($old_path . '/medium-' . $request['uploaded_image'], $new_path . '/medium-' . $filename);
                }
                $cats->image = filter_var($filename, FILTER_SANITIZE_STRING);
            } else {
                $cats->image = null;
            }
            return $cats->save();
        }
    }
}
