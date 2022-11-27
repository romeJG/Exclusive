<?php
function lang($phr){
    static $lang =array(
        'HOME_ADMIN' => 'Admin',
        'CATEGORIES' => 'categories',
        'ITEMS' =>'items',
        'LOGOUT' =>'logout',
        'MEMBERS'=>'members',
        'EDIT PROFILE'=>'edit profile',
        'USERNAME' => 'username',
        'PASSWORD' => 'password',
        'EMAIL'=>'email',
        'FULLNAME'=>'fullname',
        'total MEMBERS'=>'Total members',
        'pending MEMBERS'=>'pending members',
        'total item'=> 'total Item',
        'total comments'=>'total comments',
        'latest registerd users'=>'latest registerd users',
        'latest Item'=>'latest Item',
        'name'=>'Name',
        'description'=>'Description',
        'ordering'=>'Ordering',
        'visibilty'=>'visibilty',
        'allow-comment'=>'Comment',
       'allow-ads'=>'Ads',
       'price'=>'price',
       'add_date'=>'add_date',
       'country_made'=>'country made',
       'status' =>'status',
       'rating'=>'rating',
       'EXCLUSIVE'=>'EXCLUSIVE',
       'comment'=>'comment'
    );
    return $lang[$phr];
}

?>