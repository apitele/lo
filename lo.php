<?php 

ob_start();

$API_KEY = '428289476:AAE8qpUQXBtVKhppLbHztRS7BlH-PyQNmrQ';
define('API_KEY',$API_KEY);

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$from = $message->from->id;


if($text == "/start"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"شلونك 🌝😹"
]);
} 
$lock = file_get_contents("lock.txt");
if($text=="/lock" && $from == 330839883){
file_put_contents("lock.txt", "lo");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"تم القفل "
]);
}
if($message && $from != 330839883 && $lock == "lo"){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id
]);
}
if($text=="/unlock" && $from == 330839883 ){
unlink("lock.txt");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"تم الفتح"
]);
}
$re = $message->reply_to_message; 
$re_id = $re->from->id; 
if($re && $text == "كتم" && $from == 330839883){
mkdir("ctm");
file_put_contents("ctm/$re_id.txt", "$re_id");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"تم الكتم"
]);
}
if($text && file_exists("ctm/$from.txt")){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message->message_id
]);
}
if($re && $text=="الغاء كتم" && $from == 330839883 ){
unlink("ctm/$re_id.txt");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"تم الغا الكتم"
]);
}

$rep = $message->reply_to_message; 
$id = $rep->message_id;  
$rep_id = $rep->from->id; 
if($rep && $text=="اتفل" $rep_id != 330839883 ){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"خخــــ💦💦💦ــــــخخــــ🌊🌊ــــتتتتففففووووووو.💦💦💦",
'reply_to_message_id'=>$id
]);
} 
if($rep && $text=="اتفل" $rep_id == 330839883 ){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"تفو عليك ياخرا يا حيوان اكبر مطي انت ايفل تاج راسك",
'reply_to_message_id'=>$msg
]);
} 
if($rep && $text=="مسح"){

bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$id
]);


bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message->message_id
]);

}
$usern = $message->from->username; 

if(isset($message->audio)){
$audio = $message->audio;
$file = $audio->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents('con/evil.ogg',file_get_contents('https://api.telegram.org/file/bot'.$API_KEY.'/'.$patch));
    bot('sendvoice',[
    'chat_id'=>$chat_id ,
    'voice'=> new CURLFile('con/evil.ogg'),
    'caption'=>"@$usern 🌝😹",
    'reply_to_message_id'=>$msg
    ]);
    }
    if(isset($message->voice)){
    $voice = $message->voice;
    $file = $voice->file_id;
    $get = bot('getfile',['file_id'=>$file]);
    $patch = $get->result->file_path;
    file_put_contents('con/evil.mp3',file_get_contents('https://api.telegram.org/file/bot'.$API_KEY.'/'.$patch));
    bot('sendaudio',[
    'chat_id'=>$chat_id ,
    'audio'=> new CURLFile('con/evil.mp3'),
    'caption'=>"@$usern 🌝😹",
'title'=>"By @$usern",
'performer'=>"🌝😹",
'duration'=>"@$usern",
    'reply_to_message_id'=>$msg
    ]);
    }
   if(isset($message->sticker)){
    $sticker = $message->sticker; 
    $file = $sticker->file_id;
    $get = bot('getfile',['file_id'=>$file]);
    $patch = $get->result->file_path;
    file_put_contents('con/evil.jpg',file_get_contents('https://api.telegram.org/file/bot'.$API_KEY.'/'.$patch));
    bot('sendphoto',[
    'chat_id'=>$chat_id ,
    'photo'=> new CURLFile('con/evil.jpg'),
     'caption'=>"@$username 🌝💝",
     'reply_to_message_id'=>$msg
     ]);
}
