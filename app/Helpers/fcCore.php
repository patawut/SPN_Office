<?php
namespace App\Helpers;
use CodeIgniter\Database\ConnectionInterface;
class fcCore { 
    public $provinces = array(1 => "กรุงเทพมหานคร","กระบี่", "กาญจนบุรี", "กาฬสินธุ์", "กำแพงเพชร", "ขอนแก่น", "จันทบุรี", "ฉะเชิงเทรา", "ชลบุรี", "ชัยนาท", "ชัยภูมิ", "ชุมพร", "เชียงราย", "เชียงใหม่", "ตรัง", "ตราด", "ตาก", "นครนายก", "นครปฐม", "นครพนม", "นครราชสีมา", "นครศรีธรรมราช", "นครสวรรค์", "นนทบุรี", "นราธิวาส", "น่าน", "บุรีรัมย์","บึงกาฬ", "ปทุมธานี", "ประจวบคีรีขันธ์", "ปราจีนบุรี", "ปัตตานี", "พระนครศรีอยุธยา", "พะเยา", "พังงา", "พัทลุง", "พิจิตร", "พิษณุโลก", "เพชรบุรี", "เพชรบูรณ์", "แพร่", "ภูเก็ต", "มหาสารคาม", "มุกดาหาร", "แม่ฮ่องสอน", "ยโสธร", "ยะลา", "ร้อยเอ็ด", "ระนอง", "ระยอง", "ราชบุรี", "ลพบุรี", "ลำปาง", "ลำพูน", "เลย", "ศรีษะเกษ", "สกลนคร", "สงขลา", "สตูล", "สมุทรปราการ", "สมุทรสงคราม", "สมุทรสาคร", "สระแก้ว", "สระบุรี", "สิงห์บุรี", "สุโขทัย", "สุพรรณบุรี", "สุราษฏร์ธานี", "สุรินทร์", "หนองคาย", "หนองบัวลำพู", "อ่างทอง", "อำนาจเจริญ", "อุดรธานี", "อุตรดิตถ์", "อุทัยธานี", "อุบลราชธานี");
    public $character_e = array(1 => "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    public $thai_mo=array(1 =>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    public $thai_mo_short=array(1 =>"ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    public  function displaydate($x) {
        $thai_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $date_array=explode("-",$x);
        $y=$date_array[0];
        $m=$date_array[1]-1;
        $d=$date_array[2]*1;
    
        $m=$thai_m[$m];
        $y=$y+543;
    
        $displaydate="$d $m $y";
        return $displaydate;
    }
    public  function displaymonth($x) {
        $thai_mo=array(1 =>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
      
        $m=$thai_mo[$x];
        $displaymonth="$m";
        return $displaymonth;
    }
    
    public function displaydate_short($x) {
        $thai_m=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $date_array=explode("-",$x);
        $y=$date_array[0];
        $m=$date_array[1]-1;
        $d=$date_array[2]*1;
    
        $m=$thai_m[$m];
        $y=$y+543;
    
        $displaydate="$d $m $y";
        return $displaydate;
    }
    
    //echo max_days_month(4,2019); 
    public  function max_days_month($month, $year) {
        // Using first day of the month, it doesn't really matter
        $date = $year."-".$month."-1";
        return date("t", strtotime($date));
    } 
    public  function typeText($type){
        $return = '';
        switch($type){ 
            case '1':
                $return = 'STB';
                break;
            case '2':
                $return = 'Call';
                break;
            case '3':
                $return = 'POB';
                break;
            case '4':
                $return = 'DRop off';
                break;
            case '5':
                $return = 'NO SHOW';
                break;
            default:
                $return = 'ไม่ระบุ';
                break;
        }
        return $return;
    }
    public function thisPage(){
        $ser=$_SERVER['HTTP_REFERER'];
        $arr = explode("/", $ser);
        $num=count($arr);
        return $arr[$num-1];
    }
}
