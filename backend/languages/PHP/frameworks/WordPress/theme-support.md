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