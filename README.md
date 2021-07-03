# Blog Module 4.0

The Blog module allows authorized users to maintain a blog. Blogs are a series of posts that are time stamped and are typically viewed by date as you would view a journal. Blog entries can be made public or private to the site members, depending on which roles have access to view content.

## Installation

* `composer require imagina/iblog-module`
* `php artisan module:migrate Iblog`

## End Points

Route Base: `https://yourhost.com/api/iblog/v1/`

* #### Post

    * Attributes
    
        * title: string (Translatable)
        * description: string (Translatable)
        * slug: string (Translatable)
        * summary: string (Translatable)
        * meta_title: string (Translatable)
        * meta_description: string (Translatable)
        * meta_keywords: string (Translatable)
        * translatable_options: string (Translatable)
        * options: string
        * category_id: string
        * categories: array
        * tags: array
        * user_id: string
        * status: string
        * created_at: string
   
    * Create
    
        * Method: `POST`
        * URI: `/posts`
    
    * Read
    
         * Method: `GET`
         * URI: `/posts/:id`
         * URI: `/posts`
         
    * Update
    
         * Method: `PUT`
         * URI: `/post/:id`
         
    * Delete
    
         * Method: `DELETE`
         * URI: `/posts/:id`

* #### Categories

    * Attributes
    
        * parent_id: Integer
        * options: Text
        * title: String (Translatable)
        * slug: String (Translatable)
        * description: Text (Translatable)
        * meta_title: Text (Translatable)
        * meta_description: Text (Translatable)
        * translatable_options: Text (Translatable)
    
    * Create
    
        * Method: `POST`
        * URI: `/categories`
    
    * Read
    
         * Method: `GET`
         * URI: `/categories/:id`
         * URI: `/categories`
         
    * Update
    
         * Method: `PUT`
         * URI: `/categories/:id`
         
    * Delete
    
         * Method: `DELETE`
         * URI: `/categories/:id`

## Setting up relations

For establish relationships with other modules since we cannot edit our Iblog module directly, since this module is managed by the composer; we need to edit the `config.php` file in the folder `/config/asgard/iblog/` of our application.

Navigate to the section titled Dynamic Relationships, by default it looks like this:

```
'relations' => [
        'category'=>[
         'store' => function () {
                return $this->belongsTo(
                    \Modules\Marketplace\Entities\Store::class);
            },
        ],
        'post'=>[
            'store' => function () {
                return $this->belongsTo(
                    \Modules\Marketplace\Entities\Store::class);
            },
        ],
]
```


Now we can access the information of the iblog Post or Category using `$post->store->name` o `$category->store->name` respectively.

Add data in Post or Category table
You can add additional columns in the category or post table if really necessary. For example, if you want to add a relation column or an additional query field.
We need to edit the config.php file in the /config/asgard/iblog/ folder of our application. there's a fillable key which contains an array of fillable fields for the object.

```
  /*
    |--------------------------------------------------------------------------
    | Fillable user fields
    |--------------------------------------------------------------------------
    | Set the fillable post and category fields, those fields will be mass assigned
    */
    'fillable' => [
       'post'=>[
           'options',
           'category_id',
           'user_id',
           'status',
           'created_at'
       ],
        'category'=>[
            'parent_id',
            'options'
        ]
    ],
```
Add the fields you want in this array.
 
```
  /*
    |--------------------------------------------------------------------------
    | Fillable user fields
    |--------------------------------------------------------------------------
    | Set the fillable post and category fields, those fields will be mass assigned
    */
    'fillable' => [
       'post'=>[
           'options',
           'category_id',
           'user_id',
           'status',
           'created_at',
           'store_id'
       ],
        'category'=>[
            'parent_id',
            'options',
            'store_id'
        ]
    ],
```





