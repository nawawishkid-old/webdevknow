<?php

ini_set('display_errors', 'on');

// สร้าง Class
class Book {
	// กำหนด Property
	private $name;
	private $author;

	// สร้าง Method ไว้ให้ Object instance ใช้บันทึกข้อมูลไว้ในตัว Object เอง
	// Method สำหรับใส่ชื่อหนังสือ
	public function setName($name) {
		// $this คือ keyword ที่ใช้อ้างอิงถึง Object instance ไม่ใช่ตัว class
		// สังเกตว่า property ไม่มีเครื่องหมายดอลล่าร์นำหน้า
		$this->name = $name;
	}

	// Method สำหรับใสชื่อผู้แต่ง
	public function setAuthor($author) {
		$this->author = $author;
	}

	// Method สำหรับเรียกดูข้อมูลของ Object instance เอง
	// เรียกดูชื่อหนังสือ
	public function getName() {
		return $this->name;
	}

	// เรียกดูชื่อผู้แต่ง
	public function getAuthor() {
		return $this->author;
	}

	public function getAll() {
		return get_object_vars($this);
	}
}

$book1 = new Book();
$book2 = new Book();

$book1->setName('Game of thrones');
$book1->setAuthor('George R. R. Martin');

$book2->setName('The lord of the rings');
$book2->setAuthor('J. R. R. Tolkien');

$book1->getName(); // Game of thrones
$book1->getAuthor(); // George R. R. Martin

$book2->getName(); // The lord of the rings
$book2->getAuthor(); // J. R. R. Tolkien

print_r($book1->getAll());
print_r($book2->getAll());


?>