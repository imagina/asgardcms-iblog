<?php

namespace Modules\Iblog\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Ihelpers\Traits\UserStamps;
use Modules\Media\Entities\File;
use Kalnoy\Nestedset\NodeTrait;
use Modules\Media\Support\Traits\MediaRelation;
use Illuminate\Support\Str;

class Category extends Model
{
    use Translatable, MediaRelation, PresentableTrait, NamespacedEntity, NodeTrait, UserStamps, SoftDeletes;

    protected $table = 'iblog__categories';

    protected $softdeleting = true;

    protected $fillable = [
      'parent_id',
      'show_menu',
      'featured',
      'status',
      'sort_order',
      'options'
    ];

    public $translatedAttributes = ['title', 'description', 'slug', 'meta_title', 'meta_description', 'meta_keywords', 'translatable_options'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array'
    ];


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function parent()
    {
        return $this->belongsTo('Modules\Iblog\Entities\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Modules\Iblog\Entities\Category', 'parent_id');
    }

    public function posts()
    {
        return $this->belongsToMany('Modules\Iblog\Entities\Post', 'iblog__post__category')->as('posts')->with('category');
    }

    public function getOptionsAttribute($value)
    {
        try {
            return json_decode(json_decode($value));
        } catch (\Exception $e) {
            return json_decode($value);
        }
    }

    public function getSecondaryImageAttribute()
    {
        $thumbnail = $this->files()->where('zone', 'secondaryimage')->first();
        if (!$thumbnail) {
            $image = [
                'mimeType' => 'image/jpeg',
                'path' => url('modules/iblog/img/post/default.jpg')
            ];
        } else {
            $image = [
                'mimeType' => $thumbnail->mimetype,
                'path' => $thumbnail->path_string
            ];
        }
        return json_decode(json_encode($image));
    }

    public function getMainImageAttribute()
    {
        $thumbnail = $this->files()->where('zone', 'mainimage')->first();
        if (!$thumbnail) {
            if (isset($this->options->mainimage)) {
                $image = [
                    'mimeType' => 'image/jpeg',
                    'path' => url($this->options->mainimage)
                ];
            } else {
                $image = [
                    'mimeType' => 'image/jpeg',
                    'path' => url('modules/iblog/img/post/default.jpg')
                ];
            }
        } else {
            $image = [
                'mimeType' => $thumbnail->mimetype,
                'path' => $thumbnail->path_string
            ];
        }
        return json_decode(json_encode($image));

    }


  public function getUrlAttribute()
  {
    $url = "";
    $useOldRoutes = config('asgard.iblog.config.useOldRoutes') ?? false;
    $currentLocale = \LaravelLocalization::getCurrentLocale();
//dd($useOldRoutes);
    if(empty($this->slug)){

      $category = $this->getTranslation(\LaravelLocalization::getDefaultLocale());
      $this->slug = $category->slug;
    }


    if (!(request()->wantsJson() || Str::startsWith(request()->path(), 'api'))) {
      if ($useOldRoutes) {
        $url = \URL::route($currentLocale . '.iblog.category.' . $this->slug);
      } else {

        $url = \URL::route($currentLocale . '.iblog.blog.index.category', $this->slug);

      }
    }
    return $url;
  }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeFirstLevelItems($query)
    {
        return $query->where('depth', '1')
            ->orWhere('depth', null)
            ->orderBy('lft', 'ASC');
    }

    public function __call($method, $parameters)
    {
        #i: Convert array to dot notation
        $config = implode('.', ['asgard.iblog.config.relations.category', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);
            $bound = $function->bindTo($this);

            return $bound();
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }

  public function getLftName()
  {
    return 'lft';
  }

  public function getRgtName()
  {
    return 'rgt';
  }

  public function getDepthName()
  {
    return 'depth';
  }

  public function getParentIdName()
  {
    return 'parent_id';
  }

}
