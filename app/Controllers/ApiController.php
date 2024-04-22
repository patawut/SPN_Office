<?php
namespace App\Controllers; 
use CodeIgniter\RESTful\ResourceController;

class ApiController extends ResourceController
{ 
    protected $db; 
    protected $fSCB;
    function __construct(){
        $this->db= db_connect();   
    }
    public function getLogin(){
        $req= json_decode(file_get_contents('php://input'), true);
        $username = $req['username'];
        $password = $req['password'];
        $user = $this->db->table('employee')->where('username', $username)->where('status', 1)->get()->getFirstRow('array');
        if (!$user) {
            $response = [
                'code' => 0,
                'message' => 'Incorrect username or password',
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        } elseif (!password_verify($password, $user['password'])) {
            $response = [
                'code' => 0,
                'message' => 'Incorrect username or password',
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        } else {
            $response = [
                'code' => 1,
                'message' => 'Login successful', 
                'username' => $user['username']
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        }
    }
    public function getProfile(){
        $req= json_decode(file_get_contents('php://input'), true);
        $username = $req['username'];
        $user = $this->db->table('employee')->where('username', $username)->get()->getFirstRow('array');
        if (!$user) {
            $response = [
                'code' => 0,
                'message' => 'กรุณาเข้าระบบใหม่อีกครั้ง',
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        } else {
            $response = [
                'code' => 1,
                'message' => 'Login successful', 
                'username' => $user['username'],
                'fullname' => $user['employee_name'],
                'tel' => $user['employee_tel'],
                'address' => $user['employee_address'],
                'note'=>$user['note'],
                'status' => $user['status'],
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        }
    }
    public function profileupdate(){
        $req= json_decode(file_get_contents('php://input'), true);
        $username = $req['username'];
        $fullname = $req['fullname'];
        $tel = $req['tel'];
        $address = $req['address'];
        $note = $req['note'];
        $status = $req['status'];
        $user = $this->db->table('employee')->where('username', $username)->get()->getFirstRow('array');
        if (!$user) {
            $response = [
                'code' => 0,
                'message' => 'กรุณาเข้าระบบใหม่อีกครั้ง',
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        } else {
            $data = [
                'employee_name' => $fullname,
                'employee_tel' => $tel,
                'employee_address' => $address,
                'note' => $note,
                'status' => $status,
            ];
            $this->db->table('employee')->where('username', $username)->update($data);
            $response = [
                'code' => 1,
                'message' => 'Login successful', 
                'username' => $user['username'],
                'fullname' => $user['employee_name'],
                'tel' => $user['employee_tel'],
                'address' => $user['employee_address'],
                'note'=>$user['note'],
                'status' => $user['status'],
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        }
    }
    public function profileChangePassword(){
        $req= json_decode(file_get_contents('php://input'), true);
        $username = $req['username']; 
        $newpassword = $req['newpassword'];
        $user = $this->db->table('employee')->where('username', $username)->get()->getFirstRow('array');
        if (!$user) {
            $response = [
                'code' => 0,
                'message' => 'กรุณาเข้าระบบใหม่อีกครั้ง',
            ];
            return $this->response->setStatusCode(200)->setJSON($response); 
        } else {
            $data = [
                'password' => password_hash($newpassword, PASSWORD_DEFAULT),
            ];
            $this->db->table('employee')->where('username', $username)->update($data);
            $response = [
                'code' => 1,
                'message' => 'ChangePassword successful', 
                'username' => $user['username'],
                'fullname' => $user['employee_name'],
                'tel' => $user['employee_tel'],
                'address' => $user['employee_address'],
                'note'=>$user['note'],
                'status' => $user['status'],
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        }
    }
 
    public function getOrderlist(){
        $req= json_decode(file_get_contents('php://input'), true);
        $username = $req['username'];
        $user = $this->db->table('employee')->where('username', $username)->where('status', 1)->get()->getFirstRow('array');
        if (!$user) {
            $response = [
                'code' => 0,
                'message' => 'กรุณาเข้าระบบใหม่อีกครั้ง',
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        } else {
            $data = $this->db->table('order')->where('employee', $user['username'])->where('status', 1)->orderBy('start_date', 'desc')->orderBy('appointmenttime', 'desc')->get()->getResultArray();
            $response = [
                'code' => 1,
                'message' => 'success', 
                'data' => $data,
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        }
    }
    public function getOrderlistInday(){
        $req= json_decode(file_get_contents('php://input'), true);
        $username = $req['username'];
        $date = $req['date'];
        $user = $this->db->table('employee')->where('username', $username)->where('status', 1)->get()->getFirstRow('array');
        if (!$user) {
            $response = [
                'code' => 0,
                'message' => 'กรุณาเข้าระบบใหม่อีกครั้ง',
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        } else {
            $data = $this->db->table('order')->where('employee', $user['username'])->where('status<>', 99)->where('start_date', $date)->orderBy('appointmenttime', 'desc')->get()->getResultArray();
            $response = [
                'code' => 1,
                'message' => 'success', 
                'date'=> $date,
                'data' => $data,
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        }
    }
    public function getOrderHistorylist(){
        $req= json_decode(file_get_contents('php://input'), true);
        $username = $req['username'];
        $user = $this->db->table('employee')->where('username', $username)->where('status', 1)->get()->getFirstRow('array');
        if (!$user) {
            $response = [
                'code' => 0,
                'message' => 'กรุณาเข้าระบบใหม่อีกครั้ง',
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        } else {
            // query ข้อมูลจากตาราง order โดยเรียงจาก วันที่ start_date,status ล่าสุด และ  appointmenttime และ status <> 99
            $data = $this->db->table('order')->select('start_date')->select('status')->where('employee', $user['username'])->where('status<>', 99)->orderBy('start_date', 'desc')->orderBy('appointmenttime', 'desc')->get()->getResultArray();
            $response = [
                'code' => 1,
                'message' => 'success', 
                'data' => $data,
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        }
    }

    public function getOderDetail(){
        $req= json_decode(file_get_contents('php://input'), true);
        $order_id = $req['order_id'];
        $data = $this->db->table('order_detail')->where('order_id', $order_id)->orderby('create_date','desc')->get()->getResultArray();
        $response = [
            'code' => 1,
            'message' => 'Login successful', 
            'data' => $data,
        ];
        return $this->response->setStatusCode(200)->setJSON($response);
    }
    public function getOderUpdate(){
        $req= json_decode(file_get_contents('php://input'), true);
        $order_id = $req['order_id'];
        $status = $req['status'];
        $data = [
            'status' => $status,
        ];
        $this->db->table('order')->where('order_id', $order_id)->update($data);
        $response = [
            'code' => 1,
            'message' => 'Login successful', 
            'data' => $data,
        ];
        return $this->response->setStatusCode(200)->setJSON($response);
    }

    public function insertOderDetail(){
        $req= json_decode(file_get_contents('php://input'), true); 
        $log = [
            'datajson' => json_encode($req, JSON_UNESCAPED_UNICODE), 
        ]; 
        $this->db->table('temp')->insert($log);  
        $dateTime= date("Y-m-d H:i:s");
        $data = [
            'order_id' => $req['orderid'],
            'employee' => $req['username'],
            'note' => $req['textcomment']??'',
            'photo'=> $req['photo']??null,
            'create_date' => $dateTime,
            'status' => 1,
            'type' => $req['type']??1,
        ];
        if($req['type'] == 1){
            $dataOrder['customer_standby'] = $dateTime;
            $this->db->table('order')->where('order_id', $req['orderid'])->update($dataOrder);
        }else if($req['type'] == 4 || $req['type'] == 5){
            $OTmoney=$this->checkOTForTypeOrderEvent($req['orderid'],$dateTime)??0;
            $dataOrder['otmoney'] = $OTmoney;
            $dataOrder['status'] = 2;
            $dataOrder['customer_finish']= $dateTime;
            $this->db->table('order')->where('order_id', $req['orderid'])->update($dataOrder);
        }
        $this->db->table('order_detail')->insert($data);
        $this->sentToLine($req['orderid'],'');
        $response = [
            'code' => 1,
            'message' => 'ส่งข้อมูลเรียบร้อย',
        ]; 
        return $this->response->setStatusCode(200)->setJSON($response);
    }
    function checkOTForTypeOrderEvent($orderid,$finishDateTime){
        try { 
            $order = $this->db->table('order')->where('order_id', $orderid)->get()->getFirstRow('array');
            if(isset($order['ordertype'])==true && $order['ordertype']=="Event"){
                $orderDateTime= $order['start_date'].' '.$order['appointmenttime']; 
                $numhour= $order['numhour'];
                $otTime= $order['otrate'];
                $data=processOT($orderDateTime,$finishDateTime,$numhour,$otTime);
                return $data['OTmoney'];
            }else{
                return 0; 
            }
        } catch (\Throwable $th) {
            $arr = [
                'OrderID' => $orderid, 
                'error' => $th->getMessage(),
            ];
            $log = [
                'datajson' => json_encode($arr, JSON_UNESCAPED_UNICODE), 
            ]; 
            $this->db->table('temp')->insert($log);  
            return 0; 
        }
    }
    public function processOT($orderDateTime,$finishDateTime,$numhour,$otTime){
        $limitTime = $this->processTime($orderDateTime,$numhour);
        $miniTime = $this->diffTime($limitTime,$finishDateTime);
        $overTimeH =floor($miniTime/60);
        $overTimeM = $miniTime%60; 
        $totalOverTime = $overTimeM > 20? $overTimeH+1 : $overTimeH;
        $dataReturn = array(
            'limitTime' => $limitTime, 
            'overTimeH' => $overTimeH,
            'overTimeM' => $overTimeM,
            'otTime' => $otTime,
            'totalOverTime' => $totalOverTime,
            'OTmoney' => $totalOverTime*$otTime,
        );
        return $dataReturn;

    }
    function processTime($date, $numhour) { 
        $date = date('Y-m-d H:i:s', strtotime('+'.$numhour.' hour', strtotime($date)));
        return $date;
    } 
    function diffTime($date1, $date2) { 
        $date1 = strtotime($date1);
        $date2 = strtotime($date2);
        $diff = $date2 - $date1;
        $diff = $diff / 60;
        return $diff;
    }
    function sendImageToLineNotify($token, $msg = 'System', $imageUrl='') {
        $apiUrl = 'https://notify-api.line.me/api/notify';
        $headers = array(
            'Authorization: Bearer ' . $token,
        );
        $postData['message'] =$msg;
        if($imageUrl!=''){
            $imageData = file_get_contents($imageUrl); 
            if ($imageData !== false) {
                $imageFile = tmpfile();
                fwrite($imageFile, $imageData);
                $postData['imageFile']= new \CurlFile(stream_get_meta_data($imageFile)['uri'], 'image/jpeg', 'imageFile.jpg');
            }
        } 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        if ($imageData !== false) {
        fclose($imageFile);
        }
        curl_close($ch);
        return json_decode($result, true);
    }
    
        
    public function sentLine() { 
        $id=23;
        $photo='[]'; 
        $return =$this->sentToLine($id,$photo) ;
        // echo "<pre>";
        // print_r($photo); 
        // print_r($return);
        // echo "</pre>";
    }

    public function sentToLine($id,$photo=''){
        $upload ='';
        if($photo!=''){
            $photo = json_decode($photo, true);
            $upload = $photo[0]??'';
        }
        try { 
            $order=$this->getOrderFeed($id); 
            if( $orderp['token']=='' || $order['token']==null){
                return 'Nosent';
            }else{
                $return =$this->sendImageToLineNotify($order['token'],$order['msg'] ,$upload);  
                return $return;
            } 
        } catch (\Throwable $th) {
            return '';
        }
        
    }

    private function getOrderFeed($orderid){
        $retun=array();
        $order = $this->db->table('order')->where('order_id', $orderid)->get()->getFirstRow('array');
        $orderDetail = $this->db->table('order_detail')->where('order_id', $orderid)->orderBy('detail_id', 'desc')->get()->getFirstRow();
        // $agent = $this->db->table('agent')->select('agent_linetoken')->where('agent_id', $order['agent_id'])->get()->getFirstRow('array');
        if($order['roomid']!=99 && $order['roomid']!=null){ // 99 is not send to line (test
        $roomchat = $this->db->table('roomchat')->select('agent_linetoken')->where('roomid', $order['roomid'])->get()->getFirstRow('array');
        }else{
            $roomchat['agent_linetoken']='';
        }
        $driver = $this->db->table('employee')->select('employee_name,employee_tel')->where('username', $order['employee'])->get()->getFirstRow('array');
        $modelcar= $this->db->table('modelcar')->select('model_name')->where('model_id', $order['modelcar'])->get()->getFirstRow('array');
        $car_code= $this->db->table('carcode')->select('carcode')->where('carcode_id', $order['car_code'])->get()->getFirstRow('array');
        $forMsg['booking'] = $order['booking']; 
        $forMsg['time'] = date('H:i', strtotime($order['appointmenttime'])); 
        $forMsg['date'] = $order['start_date'];
        $forMsg['STB'] = $this->findTypeOrderDetail($orderid,1);
        $forMsg['Call'] =  $this->findTypeOrderDetail($orderid,2);
        $forMsg['POB'] =  $this->findTypeOrderDetail($orderid,3);
        $forMsg['Drop'] =  $this->findTypeOrderDetail($orderid,4);
        $forMsg['driver'] = $driver['employee_name'];
        $forMsg['phoen'] =  $driver['employee_tel']; 
        $forMsg['car'] =$modelcar['model_name'].' '.$car_code['carcode'];
        $retun['msg']=$this->formatText($forMsg);
        $retun['token']=$roomchat['agent_linetoken']??null;  // line token for roomchat
        return $retun;
    }
        private function findTypeOrderDetail($orderid,$type){ 
            $orderDetail = $this->db->table('order_detail')->select('create_date')->where('order_id', $orderid)->where('type', $type)->orderBy('detail_id', 'desc')->get()->getFirstRow('array');
            if($orderDetail){
                $tim= date('H:i', strtotime($orderDetail['create_date'])); 
                return $tim;
            }
            return '';
        }
        private function formatText($order){
            $return =" \n".'Booking : '.$order['booking'].'('.$order['time'].')'." \n";
            $return .= 'date : '.date('d/m/Y', strtotime($order['date']))."\n";
            $return .= 'STB : '.$order['STB']."\n";
            $return .= 'Call : '.$order['Call']."\n";
            $return .= 'POB : '.$order['POB']."\n";
            $return .= 'Drop off : '.$order['Drop']."\n"; 
            $return .= 'Driver : '.$order['driver']."\n"; 
            $return .= 'Driver Phone No.: '.$order['phoen']."\n"; 
            $return .= 'Car License : '.$order['car']."\n";
            return $return;
        }

        private function typeText($type){
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
        private function displaydate_short($x) {
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


    
        public function getPhotofromApp($filedata){ 
            $return = array();  
            // $images = explode(',', $filedata); 
            $images = json_decode($filedata);
            foreach ($images as $img) {
                $img = str_replace('data:image/jpeg;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $img = base64_decode($img);
                $tempFilename = tempnam(sys_get_temp_dir(), 'image_');
                file_put_contents($tempFilename, $img);
                $cfile = curl_file_create($tempFilename, 'image/jpeg', 'uploaded_image.jpg');
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fileservice.patawut44.com/upload/photo');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ['image' => $cfile]);
                $result = curl_exec($ch);
                curl_close($ch);
                unlink($tempFilename);
                $result = json_decode($result, true); 
                $return[] = $result['url'];
            }
            return $return;
        }

        public function password(){
            $pass="1234561";
            $encode= password_hash($pass, PASSWORD_DEFAULT);
            return $this->response->setStatusCode(200)->setJSON($encode);
        } 

        function resizeAndSaveImage($url, $outputPath, $maxWidth = 1000, $maxHeight = 1000) { 
                $imageData = file_get_contents($url);
                if ($imageData === false) {
                    return false;
                } 
                $image = imagecreatefromstring($imageData);
                if ($image === false) {
                    return false;
                }
                $originalWidth = imagesx($image);
                $originalHeight = imagesy($image);
                $newWidth = $originalWidth;
                $newHeight = $originalHeight;
                if ($originalWidth > $maxWidth) {
                    $newWidth = $maxWidth;
                    $newHeight = ($maxWidth / $originalWidth) * $originalHeight;
                }
                if ($newHeight > $maxHeight) {
                    $newHeight = $maxHeight;
                    $newWidth = ($maxHeight / $originalHeight) * $originalWidth;
                }
                $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
                imagejpeg($resizedImage, $outputPath);
                imagedestroy($image);
                imagedestroy($resizedImage);
            return true;
        }




        public function sentPhototoLine(){ 
            $orderDetail = $this->db->table('order_detail')->where('status', 1)->where('photo !=', '[]')->orderby('detail_id','asc')->get()->getFirstRow('array');
            
            if($orderDetail){
                $data = [ 'status' => 2, ];
                $this->db->table('order_detail')->where('detail_id', $orderDetail['detail_id'])->update($data);
                $order = $this->db->table('order')->where('order_id', $orderDetail['order_id'])->get()->getFirstRow('array');
                // $agent = $this->db->table('agent')->select('agent_linetoken')->where('agent_id', $order['agent_id'])->get()->getFirstRow('array');
                if($order['roomid']!=99 && $order['roomid']!=null){
                    $roomchat = $this->db->table('roomchat')->select('agent_linetoken')->where('roomid', $order['roomid'])->get()->getFirstRow('array');
                    $photos = json_decode($orderDetail['photo'], true); 
                    foreach ($photos as $key => $photo) {  
                        $txt=' ';
                        $return =$this->sendImageToLineNotify($roomchat['agent_linetoken'],$txt ,$photo);  
                            if($return['status']==200){
                                echo "done";
                            }
                        }
                    }else{
                        echo "update order_detail: ".$orderDetail['detail_id']. "RoomID:".$order['roomid']." ไม่ส่งไปยัง line"; 
                    } 
                } else{
                    echo "no datav";
                }
        }
        function extractStringFromUrl($url) {
            $urlParts = parse_url($url);
            if (isset($urlParts['path'])) {
                $pathParts = explode('/', $urlParts['path']);
                $lastPart = end($pathParts);
                $fileNameWithoutExtension = pathinfo($lastPart, PATHINFO_FILENAME);
                return $fileNameWithoutExtension;
            }
            return false;
        }

}