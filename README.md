# Laravel Seo Tools #
Laravel is becoming more and more popular and lots of web application are developing. In most of the web application there need some SEO work for thir marketing purpose. There are some tools but those are not suitable for non programmer. Everything can be control via dashboard  like  [Wordpress Yoast](https://yoast.com/)

### Installation ###
```javascript
  "require": { 
     "digitaldream/laravel-seo-tools": "1.*"
}
```
#### Settings ###

01. Add this line to config/app.php providers array . Not needed if you are using laravel 5.5 or greater
```php
    SEO\SeoServiceProvider::class
``` 
  
02. Then Run
```php
    php artisan vendor:publish --provider="SEO\SeoServiceProvider"
```
  Please have a look to App\Policies\Seo folder. Adjust permission for seo settings routes.
  
03. Run migration
```php 
  php artisan migrate
```
04. Run Seed
```php 
   php artisan db:seed --class="SEO\Database\Seeders\SeoTablesSeeder"
```
05. Show form into your post/content page by adding this custom blade tag
```javascript
     @seoForm($model)
```
 This will be usually inside your form. 
 
06. Save tags into your controller
 ```php
     
      if ($model->save()) {
            \SEO\Seo::save($model, route('blog::posts.show', $model->slug), [
                'title' => $model->title,
                'images' => [
                    $model->getImageUrl()
                ]
            ]);
           }
```
Do not make your controller dirty. Do not worry [follow this instruction](https://github.com/digitaldreams/laravel-seo-tools/wiki/Setup-Meta-Tag-save-in-background)

07. Finally display tags into your layouts header by this custom blade tag
```php
   @seoTags()
```

Now visit **/seo/dashboard** from your browser to see seo dashboard and settings

### Easy to use ###
Target user of this tool is non programmer. So they can able to add/modify on page SEO tags and do some necessary action that can give full control how this page will be appear by Search Engine. 

### Social media sharing ###
Everybody loves to share their page or content in Socail media. By using tools you can able to manage how your page looks like in Facebook, Twitter and others and what image will be shown, which title and description are shown and many more. 
<img src="https://image.ibb.co/e2yAzT/social_media.png" alt="social_media" border="0">

### Page management ###
Your application have many pages but not all of them for search engine. You can control this from your dashboard. 
Also it can be set via programatically for example when a post is published it will automatically added to xml sitemap and will add necessary seo tags so search engine can understand its purpose and content. 
<img src="https://image.ibb.co/j8Jom8/page_management.png" alt="page_management" border="0">

### Submit company or personal information to Google ###
 For business or ecommerce we often see support email, telephone and some other extra information like ther facebook, Twiteer account in google search. This can be done schema.org tags. To make this super simple there have few input field that you can easily fill and save. 
Behind the scene everyting will be done for you. 
<img src="https://image.ibb.co/frTceT/company_personal_info.png" alt="company_personal_info" border="0">

### Webmaster tools ###
Sometimes web master need ftp or file access because they need to add some verification code into your site. Using this tools they can simply add this from dashboard. Like Google Verification code
<img src="https://image.ibb.co/mUkZR8/webmaster_tools.png" alt="webmaster_tools" border="0">
### Sitemap generator ###
Sitemap are the key to search engine. Search engline will crawl your website according to this. It will be created automatically for you. Also you can set pririty and change frequency of your page. 
<img src="https://image.ibb.co/jQGKto/site_map.png" alt="site_map" border="0">


### Robot.txt and .htaccess file customization ###
Web master sometings need to have access to robot.txt and .htaccess. Now it can be done via dashboard. Although its require expertise knowledge to modify this files. 
<img src="https://image.ibb.co/hM3ceT/robot_htaccess.png" alt="robot_htaccess" border="0">

### Meta tag management ###
Only way to inform search engine about your site or page is via Meta tags. There are many tags. Most common are already there. But you can able to create, edit or delete any of them. To add a meta tag you do not have to call programmer. You can do it from dashbarod. 

<img src="https://image.ibb.co/meMkYo/meta_tags.png" alt="meta_tags" border="0">
This is simple. Isn't it?

