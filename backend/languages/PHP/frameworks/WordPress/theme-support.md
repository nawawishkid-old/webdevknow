# Theme Support

https://developer.wordpress.org/reference/functions/add_theme_support/  

คือการเขียน theme ให้ user ปรับแต่ง theme ได้ตามแต่ละสิ่งที่เรา support เช่น เลือกสีพื้นหลังได้, เลือกรูปโลโก้ได้, เลือกรูปส่วนหัวของเพจได้, หรือเลือกรูปส่วนหัวของโพสต์ก็ได้ เป็นต้น  
และเรายังสามารถกำหนดค่าเริ่มต้นให้กับการปรับแต่งนั้น ๆ ได้อีกด้วย

เรา support การปรับแต่งได้ด้วย function `add_theme_support`
Function นี้คือการบอกระบบของ WordPress ว่าเราอยากให้ user ที่ใช้ theme ของเรานั้นปรับแต่งอะไรได้บ้าง แล้ว WordPress ก็จะเพิ่ม UI สำหรับการปรับแต่งเข้าไปให้เราเอง  
ตัวอย่าง เช่น:
```php
$defaults = [
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
];

add_theme_support( 'custom-logo', $defaults );
```
จากตัวอย่างข้างบน เราอนุญาตให้ user เลือกรูปโลโก้ของเว็บไซต์ได้  
แต่จะไม่มีใครเห็นโลโก้ ถ้าเรายังไม่ได้เพิ่มมันเข้าไปใน template หรือ frontend ของ theme ฉะนั้น เราจึงต้องเพิ่ม `<img>` สำหรับการแสดงรูป custom logo เสียก่อน  

function ที่เกี่ยวข้องกับการแสดงผล custom logo โดยตรงมีอยู่ 2 functions  
1. `the_custom_logo` จะ `echo` HTML markup ออกมาให้เราเสร็จสรรพ
```php
<div class="logo-wrapper">
    <?php the_custom_logo(); ?>
</div>
```
2. `get_custom_logo` จะ return HTML markup ออกมา เป็น function ที่ถูกเอาไป `echo` ใน `the_custom_logo` ข้างบนนี่เอง
```php
<div class="logo-wrapper">
    <?php echo the_custom_logo(); ?>
</div>
```
ถ้าเราอยากได้เฉพาะ URL ของ custom logo ล่ะ?
```php
<?php
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
?>
<img src="<?php echo $image[0]; ?>>
```
ตามนี้เลย