# รูปพาดหัวของโพสต์
## 1. เอารูป
### 1.1 `the_post_thumbnail( string|array $size, array $attr )`
https://developer.wordpress.org/reference/functions/the_post_thumbnail/  
**Arguments**  
* `$size` ของ WordPress ได้แก่ 'thumbnail', 'medium', 'medium_large', 'full'  
* `$attr` คือ HTML attributes ที่จะใส่ไปใน `<img>`  
**Return**  
* return เป็น HTML Image tag: `<img>`  
**การใช้งาน**  
* ใช้ใน WordPress Loop เท่านั้น
```php
<div>
    <?php the_post_thumbnail( 'medium_large' ); ?>
</div>
```
จะได้ออกมาแบบนี้:
```html
<img width="768" height="431" 
    src="https://example.tld/wp-content/uploads/2018/03/Screenshot-from-2018-03-20-13-07-39-768x431.png" 
    class="attachment-medium_large size-medium_large wp-post-image" 
    alt="" 
    srcset="https://example.tld/wp-content/uploads/2018/03/Screenshot-from-2018-03-20-13-07-39-768x431.png 768w, https://example.tld/wp-content/uploads/2018/03/Screenshot-from-2018-03-20-13-07-39-300x168.png 300w, https://example.tld/wp-content/uploads/2018/03/Screenshot-from-2018-03-20-13-07-39-1024x575.png 1024w, https://example.tld/wp-content/uploads/2018/03/Screenshot-from-2018-03-20-13-07-39-600x337.png 600w, https://example.tld/wp-content/uploads/2018/03/Screenshot-from-2018-03-20-13-07-39.png 1327w" 
    sizes="(max-width: 768px) 100vw, 768px">
```
### 1.2 `the_post_thumbnail_url( string|array $size )`
https://developer.wordpress.org/reference/functions/the_post_thumbnail_url/  
**Arguments**  
* `$size` เหมือน function ข้างบน  
**Return**  
* return URL ของรูป ไม่ใช่ HTML Image tag  
**การใช้งาน**  
* ใช้สำหรับดึง URL ของรูป
```php
<img src="<?php the_post_thumbnail_url(); ?>" />
```
จะได้:
```html
<img src="https://example.tld/wp-content/uploads/2018/03/Screenshot-from-2018-03-20-13-07-39-768x431.png" />
```