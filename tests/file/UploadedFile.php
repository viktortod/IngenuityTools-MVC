<?php
	namespace UnitTests\File;
	
	use File\UploadedFile;

	require_once "../../lib/File/UploadedFile.php";
	require_once "../../lib/File/FileNameStrategy.php";
	require_once "../../lib/File/Strategy/TimestampNameStrategy.php";
	
	class FileTestCase extends \PHPUnit_Framework_TestCase {
		public function setUp(){
			$_FILES['unitTest'] = array(
				'name' => "unitTest",
				'type' => 'image/gif',
				'size' => 10485760,
				'tmp_name' => 'tmp/y5nFoi35hn',
				'error' => 0		
			);			
			
			$_FILES['unitUpload2'] = $_FILES['unitTest'];
			$_FILES['unitUpload2']['name'] = "unitTest.txt";
			$_FILES['unitUpload2']['tmp_name'] = "../../uploaded/1.txt";
		}
		
		public function testCheckFile(){
			$unit = new UploadedFile('unitTest');
			
			$this->assertFalse($unit->checkFile("file"));
			$this->assertFalse($unit->checkFile("string"));
			$this->assertTrue($unit->checkFile("image"));
		}
		
		public function testExceptions(){
			$Unit = new UploadedFile("unitTest");
			
			try{ 
				$invalidFile = new UploadedFile("unknownFile");
				$this->fail("Exception not thrown");
			} catch(\Exception $e){
				$this->assertTrue(true);
			}
			
			try{
				$fileDestination =  $Unit->upload("string", "./");
				$this->fail("Exception not thrown");
			} catch(\Exception $e){
				$this->assertTrue(true);
			}
			
			try{
				$fileDestination =  $Unit->upload("image", "./");
				$this->fail("Exception not thrown");
			} catch(\Exception $e){
				$this->assertTrue(true);
			}
		}
		
		public function testUpload(){
			$file = __FILE__;
				
			try {
				$unit = new UploadedFile('unitUpload2');
				$destination = $unit->upload("image","../../uploaded/");
				$this->assertNotEmpty($destination);
			} catch (\Exception $e) {
				$this->fail("Upload failed. " . $e->getMessage());
			}
		}
		
		public function testNamingStrategy() {
			$unit = new UploadedFile('unitUpload2');
			$unit->setNamingStrategy(new UnitTestNameStrategy());
			$destination = $unit->upload("image","../../uploaded/");
			$this->assertNotEmpty($destination);
			$this->assertEquals("1123", $destination);
		}
	}
	
	class UnitTestNameStrategy implements \File\FileNameStrategy {
		public function nameFile(array $fileInfo){
			return "1123";
		}
	}