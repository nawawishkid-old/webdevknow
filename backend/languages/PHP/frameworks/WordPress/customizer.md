# Customizer

https://developer.wordpress.org/themes/customize-api/customizer-objects/  
https://codex.wordpress.org/Theme_Customization_API  

Customizer คือตัวปรับแต่งธีมใน live preview ที่เป็น sidebar อยู่ซ้ายมือ ให้เราเลือกปรับแต่งธีม แล้วเห็นตัวอย่างการเปลี่ยนแปลงได้ทันที theme support หลาย ๆ อย่างก็อยู่ใน customizer นี่แหละ เช่น เลือกโลโก้, เลือกพื้นหลัง เป็นตัน

## องค์ประกอบของ customizer มีอะไรบ้าง?
### 1. Section
Section ก็คือเมนูต่าง ๆ ที่เราเห็นอยู่ใน customizer sidebar เวลาเข้าไป edit ใน live preview section เดิม ๆ ของ WordPress มีอยู่หลายอัน ขึ้นอยู่กับธีมของเราว่า support อะไรบ้างด้วย ถ้า support ทุกอย่าง เราก็จะเห็น section ต่าง ๆ ดังนี้:

| ชื่ออังกฤษ | ชื่อไทย | ID | รหัสลำดับ |
| --- | --- | --- | --- |
| Site Title & Tagline | อัตลักษณ์เว็บไซต์ | title_tagline | 20 |
| Colors | สี | colors | 40 |
| Header Image | รูปภาพส่วนหัว | header_image | 60 |
| Background Image | รูปพื้นหลัง | background_image | 80 |
| Menus* | เมนู | nav_menus | 100 |
| Widgets* | วิดเจ็ต | widgets | 110 |
| Static Front Page | ตั้งค่าหน้าแรก | static_front_page | 120 |
| Additional CSS | CSS เพิ่มเติม | custom_css | 200 |

### 2. Control
Control คือ HTML input ต่าง ๆ ที่ใช้ในการปรับแต่งธีม เจ้า control นี้นี่แหละที่อยู่ใน section ในหนึ่ง section มีได้หลาย control

### 3. Setting
Setting ไม่ได้เป็น element ให้เราเห็นอยู่บนหน้าจอ แต่เป็น function เอาไว้จัดการข้อมูลที่ได้จาก control หมายความว่ามีไว้บันทึกการเปลี่ยนแปลงลงในฐานข้อมูล พอ control เปลี่ยนข้อมูลอะไรไป เจ้า setting ก็จะจัดการบันทึกลงฐานข้อมูล การเพิ่ม setting คือการผูก function ไว้กับ control นั่นเอง

### 4. Panel
จริง ๆ แล้ว panel ก็คือ section นั่นแหละ แต่เป็น section ที่มี section อื่น ๆ อยู่ภายใน จากตารางข้างบนในหัวข้อ section จะเห็นว่าผมมาร์กดอกจันท์ไว้ตรง Menus และ Widgets เพื่อจะบอกว่าสองตัวนี้นับว่าเป็น panel เพราะถ้าเราคลิกมัน เราจะเจอ section อื่น ๆ อยู่ข้างใน  
## การเพิ่ม custom customizer
เราเพิ่ม custom customizer ของเราเองได้โดยการใช้ PHP class ของ WordPress ชื่อว่า `WP_Customize_Manager` คลาสนี้มี method สำหรับการเพิ่ม customizer อยู่ 4 methods ได้แก่:  

* `add_panel`
* `add_section`
* `add_control`
* `add_setting`

Method แต่ละตัวมีไว้ทำอะไรดูได้จากชื่อเลยครับ ในแต่ละ  panel/section/control/setting ที่เราจะเพิ่มเข้าไป ล้วนต้องมี ID เพื่อใช้ในการอ้างอิง  

ปัญหาของการเพิ่ม customizer ที่ผมเจอคือ เพิ่ม section แล้วแต่ไม่เห็นมี section ที่เพิ่มเลย
ลองเพิ่ม panel ก็ไม่มีให้เห็น งมอยู่สักพักจึงรู้ว่า  
  
> **ต้องเขียน `add_control` หลังจาก `add_section` และ `add_setting` แล้วเท่านั้น**
  
เพราะ `add_control` ต้องอ้างอิง ID ของ setting และ section จริง ๆ `add_section` ก็ต้องอ้างอิง ID ของ panel (ถ้าเพิ่ม panel ด้วยอ่ะนะ) ด้วยเช่นกัน แต่เราจะเขียน `add_panel` หลัง `add_section` ก็ยังทำงานได้ปกติ ผมจึงคิดว่าเป็นที่การดีไซน์ลำดับการทำงานของ code ใน `WP_Customize_Manager` มากกว่า  

พอ control หา section ให้ตัวเองอยู่ไม่เจอ section ก็ว่าง พอ section ว่าง panel ก็ว่างไปด้วย ทำให้ไม่มีอะไรโผล่มาให้เห็นบนหน้าจอซักกะอัน  

**ตัวอย่าง**  

เขียนแบบนี้จะไม่มีอะไรเกิดขึ้น
```php
$customizer->add_section( 'section_id', [
	'panel' => 'panel_id'
]);
$customizer->add_control( 'control_id', [
	'section' => 'section_id',
	'settings' => 'setting_id'
]);
$customizer->add_setting( 'setting_id' );
$customizer->add_panel( 'panel_id' );
```
แค่สลับให้ `add_control` ไปอยู่ทีหลัง `add_setting` และ `add_section` ก็ works แล้ว  
```php
$customizer->add_section( 'section_id', [
	'panel' => 'panel_id'
]);
$customizer->add_setting( 'setting_id' );
$customizer->add_control( 'control_id', [
	'section' => 'section_id',
	'settings' => 'setting_id'
]);
$customizer->add_panel( 'panel_id' );
```