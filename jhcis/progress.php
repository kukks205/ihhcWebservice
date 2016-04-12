<?PHP
$filename="log/log.txt";
// การอ่านข้อมูลจาก Text File อีกรูปแบบนึง
@$data=file($filename); // ข้อมูลที่ได้จากการใช้ Function file() จะได้ออกมาเป็น Array แต่ละบัีนทัดข้อมูลที่เก็บใน File คือ 1 ค่า index ของ Array
if(count($data)<=15){
    $num_line=0;
}else
{
    $num_line=count($data)-15;   
}
//$num_line=count($data);//นับจำนวนแถวใน Array


for($i=$num_line;$i<count($data);$i++){  // วนรอบเพื่อแสดงผลขอ้มูลโดยให้แสดงเพียง 25 แถว

echo $data[$i].'['.$i.']<br>';//แสดงข้อมูลโดยให้ขึ้นบรรทัดใหม่ในแต่ละสมาชิกใน Array
}
?>