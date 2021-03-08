<?php
//~~~~~~~~~~~~~~~~~~~~~~~//
/*
》● Nashenas Robot ●《
》● TeleGram Channel : @Compunic ●《
》● Bot ProGrammer : @Compunic ●《
》● Youtube Channel : https://youtube.com/DanialYousefi●《
*/
//~~~~~~~~~~~~~~~~~~~~~~~//
flush ();
ob_start ();
error_reporting(0);
//~~~~~~~~~~~~~~~~~~~~~~~//
$admin = 1223456; // ایدی عددی خود را قرار دهید 
$channel = "compunic"; //ایدی چنل را قرار دهید
$idbot = "chatbot"; //ایدی ربات را قرار دهید
//~~~~~~~~~~~~~~~~~~~~~~~//
define('API_KEY','TOKEN');//توکن خود را اینجا وارد کنید
//~~~~~~~~~~~~~~~~~~~~~~~//
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}


function httpPost($method, $data=[])
{

    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}



//~~~~~~~~~~~~~~~~~~~~~~~//
function basee ($text){
$ok = base64_encode($text);
return $ok;
}
//~~~~~~~~~~~~~~~~~~~~~~~//
function based ($text){
$ok = base64_decode($text);
return $ok;
}
//~~~~~~~~~~~~~~~~~~~~~~~//
function sendmessage($chat_id, $text, $mode){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode
	]);
}

function Forward($chat_id,$from_id,$massege_id){
    bot('ForwardMessage',[
    'chat_id'=>$chat_id,
    'from_chat_id'=>$from_id,
    'message_id'=>$massege_id
    ]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
$update = json_decode(file_get_contents('php://input'));
$chat_id = $update->message->chat->id;
$message_id = $update->message->message_id;
$from_id = $update->message->from->id;
$name = $update->message->from->first_name;
$username = $update->message->from->username;
$text = $update->message->text;
$forward = $update->message->forward_from;
$message = $update->message;
$tc = $update->message->chat->type;

$photo="";
$caption="";
$video="";
$voice="";

$photo= $update->message->photo[0]->file_id;
$caption= $update->message->caption;
$video=$update->message->video->file_id;
$voice=$update->message->voice->file_id;



//$photo= $update->message->photo[0]->file_id;

//~~~~~~~~~~~~~~~~~~~~~~~//
$Dani = file_get_contents("data/$from_id/Dani.txt");
$ban = file_get_contents("data/ban.txt");
$mess = file_get_contents("data/$from_id/mess.txt");
$nname = file_get_contents("data/$from_id/name.txt");
$mem = file_get_contents("data/$from_id/mem.txt");
$racode = file_get_contents("data/$from_id/racode.txt");

$rand = rand(1111,9999);
//~~~~~~~~~~~~~~~~~~~~~~~//
$rank = bot('GetChatMember',[
'chat_id'=>"@$channel",
'user_id'=>$from_id])->result->status;
//~~~~~~~~~~~~~~~~~~~~~~~//
if (strpos($ban,"$from_id") !== false){
sendmessage($chat_id,"• متاسفانه شما از سرور ما بن شدید •");
return;
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/start"){
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"چه کاری برات انجام بدم؟",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
if (!file_exists("data/$from_id")){
mkdir("data/$from_id");
file_put_contents("data/$from_id/Dani.txt","no");
file_put_contents("data/$from_id/name.txt","$name");
file_put_contents("data/$from_id/mem.txt","0");
file_put_contents("data/$from_id/racode.txt","$rand");
file_put_contents("data/$from_id/ok.txt","✅");
file_put_contents("data/$from_id/username.txt","$username");

$myfile2 = fopen("data/users.txt", "a") or die("Unable to open file!"); 
     fwrite($myfile2, "$from_id\n");
     fclose($myfile2);
}
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "راهنما 🔵"){
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"«پیام ناشناس» یه برنامه محبوب و هیجان‌انگیز در تلگرامه که باهاش می‌تونید به دوستان و اشناهاتون اجازه بدید هر انتقادی به شما دارند یا حرفی تو دلشون مونده به صورت ناشناس بهتون بگن.


• راهنما دستورات :
/start  شروع 
/help  راهنما ربات
/link  لینک اختصاصی شما
/setting  کنترل حساب
/mypm  صندوقچه پیام شما
/off  قطع سرویس ربات
/on  روشن کردن سرویس ربات
/insta  لینک اینستاگرام شما 
/story  عکس برای استوری شما
/myacc  اطلاعات حساب شما
/back  بازگشت
/callme  ارتباط با ما
/ch2or  فهمیدن چه کسی به شما پیام داده
/question1  دریافت لینک 
/changename  تغییر نام شما",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/help"){
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"«پیام ناشناس» یه برنامه محبوب و هیجان‌انگیز در تلگرامه که باهاش می‌تونید به دوستان و اشناهاتون اجازه بدید هر انتقادی به شما دارند یا حرفی تو دلشون مونده به صورت ناشناس بهتون بگن.

راهنما دستورات :
/start  شروع 
/help  راهنما ربات
/link  لینک اختصاصی شما
/setting  کنترل حساب
/mypm  صندوقچه پیام شما
/off  قطع سرویس ربات
/on  روشن کردن سرویس ربات
/insta  لینک اینستاگرام شما 
/story  عکس برای استوری شما
/myacc  اطلاعات حساب شما
/back  بازگشت
/callme  ارتباط با ما
/ch2or  فهمیدن چه کسی به شما پیام داده
/changename  تغییر نام شما",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "💌 لینک من برای دریافت پیام ناشناس"){
file_put_contents("data/$from_id/Dani.txt","no");
$id = basee($from_id);
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"سلام $nname هستم 😅

روی لینک زیر بزن و هر انتقادی که نسبت به من داری یا اعتراف و حرفی که تو دلت هست رو با خیال راحت بنویس و بفرست. بدون اینکه از اسمت باخبر بشم متنت به من می‌رسه. خودتم می‌تونی امتحان کنی و از همه بخوای راحت و ناشناس بهت پیام بفرستن، حرفای خیلی جالبی می‌شنوی.

👇👇👇👇👇
https://t.me/$idbot?start=$id",
'parse_mode'=>"HTML",
]);
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"👆👆👆👆
 👆👆 متن بالا رو به دوستانتون و گروه‌هایی که می‌شناسید فوروارد کنید تا بتونن براتون پیام ناشناس بفرستن. پیام‌ها از طریق همین برنامه به شما می‌رسه.

اینستاگرام داری؟ دریافت لینک مخصوص اینستاگرام: /insta",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/link"){
file_put_contents("data/$from_id/Dani.txt","no");
$id = basee($from_id);
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"سلام $nname هستم 😅

روی لینک زیر بزن و هر انتقادی که نسبت به من داری یا اعتراف و حرفی که تو دلت هست رو با خیال راحت بنویس و بفرست. بدون اینکه از اسمت باخبر بشم متنت به من می‌رسه. خودتم می‌تونی امتحان کنی و از همه بخوای راحت و ناشناس بهت پیام بفرستن، حرفای خیلی جالبی می‌شنوی.

👇👇👇👇👇
https://t.me/$idbot?start=$id",
'parse_mode'=>"HTML",
]);
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"👆👆👆👆
 👆👆 متن بالا رو به دوستانتون و گروه‌هایی که می‌شناسید فوروارد کنید تا بتونن براتون پیام ناشناس بفرستن. پیام‌ها از طریق همین برنامه به شما می‌رسه.

اینستاگرام داری؟ دریافت لینک مخصوص اینستاگرام: /insta",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/insta"){
file_put_contents("data/$from_id/Dani.txt","no");
$id = basee($from_id);
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"‌‌‎ برای اینکه دنبال‌کننده‌های اینستاگرامت بتونن برات پیام ناشناس بفرستن عکسی که ضمیمه شده رو دانلود کن، روی اینستاگرامتون پست کن و این لینک رو در قسمت website ویرایش پروفایل اینستاگرامت بذار:

👇👇👇👇👇
http://t.me/$idbot?start=$id



[📌](http://s9.picofile.com/file/8335872892/insta.png)

راستی میتونی استوری هم بزاری!
دستور /story لمس کن.",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif($text == "📭 پیامهای دریافتی"){
if(!file_exists("data/$from_id/mess.txt")){
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"در حال حاضر پیامی نداری. چطوره با زدن دستور /link لینک خودت رو بگیری و به دوستات و گروه‌ها بفرستی تا بتونند بهت پیام ناشناس بفرستند؟",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}else{
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"$mess",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
                [['text'=>"ریست صندوقچه پیام !!"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif($text == "/mypm"){
if(!file_exists("data/$from_id/mess.txt")){
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"در حال حاضر پیامی نداری. چطوره با زدن دستور /link لینک خودت رو بگیری و به دوستات و گروه‌ها بفرستی تا بتونند بهت پیام ناشناس بفرستند؟",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}else{
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"$mess",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
                [['text'=>"ریست صندوقچه پیام !!"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "ریست صندوقچه پیام !!"){
file_put_contents("data/$from_id/Dani.txt","no");
unlink("data/$from_id/mess.txt");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"صندوقچه با موفقیت ریست شد :",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/reset2536"){
file_put_contents("data/$from_id/Dani.txt","no");
unlink("data/$from_id/mess.txt");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"صندوقچه با موفقیت ریست شد :",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "⚙ تنظیمات"){
if($rank == "left"){
sendmessage($chat_id," • لطفا برای استفاده از ربات اول وارد @$channel بشوید و ربات را دوباره استارت کنید •"); 
exit();
}
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"کنترل حساب:",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"📵 قطع دریافت پیام"],['text'=>"🛆 تغییر نام"]],
                [['text'=>" 🎈 اطلاعات حساب کاربری"]],
                [['text'=>"منوی اصلی 🔙"],['text'=>"تماس با ما 📞"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/setting"){
if($rank == "left"){
sendmessage($chat_id," • لطفا برای استفاده از ربات اول وارد @$channel بشوید و ربات را دوباره استارت کنید •"); 
exit();
}
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"کنترل حساب:",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"📵 قطع دریافت پیام"],['text'=>"🛆 تغییر نام"]],
                [['text'=>" 🎈 اطلاعات حساب کاربری"]],
                [['text'=>"منوی اصلی 🔙"],['text'=>"تماس با ما 📞"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "منوی اصلی 🔙"){
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"چه کاری برات انجام بدم ؟",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
                [['text'=>"چطور بفهمم کی پیام ناشناس داده ؟"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/back"){
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"چه کاری برات انجام بدم؟",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
                [['text'=>"چطور بفهمم کی پیام ناشناس داده ؟"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "تماس با ما 📞"){
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• پل های ارتباطی با ما :
• ID : @jafardotcom
• Bot : @Bichatttbot
• کانال ما :
• Channel : @$channel
• جهت خرید سورس و مشاوره :
• ID : @jafardotcom
• Bot : @Bichatttbot
• Shomare : +98912-----",
'parse_mode'=>"HTML",
]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/callme"){
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• پل های ارتباطی با ما :
• ID : @jafardotcom
• Bot : @Bichatttbot
• کانال ما :
• Channel : @$channel
• جهت خرید سورس و مشاوره :
• ID : @jafardotcom
• Bot : @Bichatttbot
• Shomare : +9812----",
'parse_mode'=>"HTML",
]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "چطور بفهمم کی پیام ناشناس داده ؟"){
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"چطوری بفهمم کی داره بهم پیام ناشناس میده ؟ 🤔

• خیالتون رو راحت کنم ، نمیشه دقیقا فهمید کی بوده بهتون پیام داده ، اما میشه فهمید کسی که بهتون پیام داده ، باهاتون تو یک گروه هست یا اینکه باهاش چت خصوصی دارین یا نه ؟

• برای فهمیدن روی  /question1 بزنید و بعد پیام رو به گروها و کسایی که خصوصی باهاشون چت کردین ارسال کنید تا همه بهتون پیام بدن ، اگر شماره بالای پیام یکی از این افراد با پیامی که قبلا گرفتین یکی بود یعنی باهاش توی یک گروه هستید یا خصوصی چت دارید

کلیک کنید 👈 /question1

• با ربات ناشناس میتونید علاوه بر ارسال پیام ناشناس با لینک ، از طریق آی دی یا فوروارد یک پیام از فرد مورد نظر توی ربات ، بهش پیام ناشناس بدید ( حتی اگ لینکش رو ندارید ) و یا به همین شکل پیام ناشناس دریافت کنید !",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/ch2or"){
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"چطوری بفهمم کی داره بهم پیام ناشناس میده ؟ 🤔

• خیالتون رو راحت کنم ، نمیشه دقیقا فهمید کی بوده بهتون پیام داده ، اما میشه فهمید کسی که بهتون پیام داده ، باهاتون تو یک گروه هست یا اینکه باهاش چت خصوصی دارین یا نه ؟

• برای فهمیدن روی  /question1 بزنید و بعد پیام رو به گروها و کسایی که خصوصی باهاشون چت کردین ارسال کنید تا همه بهتون پیام بدن ، اگر شماره بالای پیام یکی از این افراد با پیامی که قبلا گرفتین یکی بود یعنی باهاش توی یک گروه هستید یا خصوصی چت دارید

کلیک کنید 👈 /question1

• با ربات ناشناس میتونید علاوه بر ارسال پیام ناشناس با لینک ، از طریق آی دی یا فوروارد یک پیام از فرد مورد نظر توی ربات ، بهش پیام ناشناس بدید ( حتی اگ لینکش رو ندارید ) و یا به همین شکل پیام ناشناس دریافت کنید !",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/question1"){
file_put_contents("data/$from_id/Dani.txt","no");
$id = basee($from_id);
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"سلام $name هستم 😅

روی لینک زیر بزن و هر انتقادی که نسبت به من داری یا اعتراف و حرفی که تو دلت هست رو با خیال راحت بنویس و بفرست. بدون اینکه از اسمت باخبر بشم متنت به من می‌رسه. خودتم می‌تونی امتحان کنی و از همه بخوای راحت و ناشناس بهت پیام بفرستن، حرفای خیلی جالبی می‌شنوی.

👇👇👇👇👇
https://t.me/$idbot?start=$id",
'parse_mode'=>"HTML",
]);
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"👆👆👆👆
 👆👆 متن بالا رو به دوستانتون و گروه‌هایی که می‌شناسید فوروارد کنید تا بتونن به سوالتون ناشناس جواب بدن ، پیام‌ ها از طریق همین برنامه به شما می‌رسه",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "📵 قطع دریافت پیام"){
file_put_contents("data/$from_id/ok.txt","❌");
unlink("data/$from_id/Dani.txt");
unlink("data/$from_id/mess.txt");
unlink("data/$from_id/name.txt");
unlink("data/$from_id/mem.txt");
unlink("data/$from_id/racode.txt");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"خیلی ناراحت شدیم که از پیش ما رفتی 😔 اما اگه دلت میخواد به جمع ما بپیوندی میتونی روی دکمه زیر کلیک کنی 😊 یا ربات مجدد /start کنید🙃",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"🎗 فعالسازی 🎗"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/off"){
file_put_contents("data/$from_id/ok.txt","❌");
unlink("data/$from_id/Dani.txt");
unlink("data/$from_id/mess.txt");
unlink("data/$from_id/name.txt");
unlink("data/$from_id/mem.txt");
unlink("data/$from_id/racode.txt");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"خیلی ناراحت شدیم که از پیش ما رفتی 😔 اما اگه دلت میخواد به جمع ما بپیوندی میتونی روی دکمه زیر کلیک کنی 😊 یا ربات مجدد /start کنید🙃",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"🎗 فعالسازی 🎗"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "🎗 فعالسازی 🎗"){
$ok = file_get_contents("data/$from_id/ok.txt");
if ($ok == "❌"){
file_put_contents("data/$from_id/Dani.txt","no");
file_put_contents("data/$from_id/name.txt","$name");
file_put_contents("data/$from_id/racode.txt","$rand");
file_put_contents("data/$from_id/mem.txt","0");
file_put_contents("data/$from_id/ok.txt","✅");
file_put_contents("data/$from_id/username.txt","$username");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"✡ مرسی که به جمع ما پیوستی :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}else{
sendmessage($chat_id," • حساب شما فعال است و نیازی به فعالسازی مجدد ندارید •");
}
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/on"){
$ok = file_get_contents("data/$from_id/ok.txt");
if ($ok == "❌"){
file_put_contents("data/$from_id/Dani.txt","no");
file_put_contents("data/$from_id/name.txt","$name");
file_put_contents("data/$from_id/racode.txt","$rand");
file_put_contents("data/$from_id/mem.txt","0");
file_put_contents("data/$from_id/ok.txt","✅");
file_put_contents("data/$from_id/username.txt","$username");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"✡ مرسی که به جمع ما پیوستی :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}else{
sendmessage($chat_id," • حساب شما فعال است و نیازی به فعالسازی مجدد ندارید •");
}
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "🛆 تغییر نام"){
file_put_contents("data/$from_id/Dani.txt","changename");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"نام نمایشی شما <code>$nname</code> هست اگر میخواهید اسم شما تغییر کند لطفا اسم جدید خود را بفرستید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"منوی اصلی 🔙"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/changename"){
file_put_contents("data/$from_id/Dani.txt","changename");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"نام نمایشی شما <code>$nname</code> هست اگر میخواهید اسم شما تغییر کند لطفا اسم جدید خود را بفرستید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"منوی اصلی 🔙"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($Dani == "changename" && $text != "/start" && $text != "منوی اصلی 🔙"){
file_put_contents("data/$from_id/Dani.txt","no");
file_put_contents("data/$from_id/name.txt","$text");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"نام شما به <code>$text</code> تغییر کرد :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"💌 لینک من برای دریافت پیام ناشناس"]],
                [['text'=>"راهنما 🔵"],['text'=>"📭 پیامهای دریافتی"]],
                [['text'=>"⚙ تنظیمات"],['text'=>"پشتیبانی ✏"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "🎈 اطلاعات حساب کاربری"){
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• نام شما : 
<code>$nname</code>
• تعداد نفراتی که به شما پیام ناشناس دادند :
<code>$mem</code>

• کد اختصاصی شما در ربات :
<code>$racode</code>
~~~~~~~~~~~~~~~~~
• برای ورود به تنظیمات : /setting
• برای دریافت لینک اختصاصی : /link
• برای دیدن پیام ها : /mypm",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"📵 قطع دریافت پیام"],['text'=>"🛆 تغییر نام"]],
                [['text'=>" 🎈 اطلاعات حساب کاربری"]],
                [['text'=>"منوی اصلی 🔙"],['text'=>"تماس با ما 📞"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/myacc"){
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• نام شما : 
<code>$nname</code>
• تعداد نفراتی که به شما پیام ناشناس دادند :
<code>$mem</code>
• کد اختصاصی شما در ربات :
<code>$racode</code>
~~~~~~~~~~~~~~~~~
• برای ورود به تنظیمات : /setting
• برای دریافت لینک اختصاصی : /link
• برای دیدن پیام ها : /mypm",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"📵 قطع دریافت پیام"],['text'=>"🛆 تغییر نام"]],
                [['text'=>" 🎈 اطلاعات حساب کاربری"]],
                [['text'=>"منوی اصلی 🔙"],['text'=>"تماس با ما 📞"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/story"){
file_put_contents("data/$from_id/Dani.txt","no");
$id = basee($from_id);
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"با لمس /link و لینک اختصاصی که به تو میده ، لینک  رو کپی کن، برو تو صفحه ویرایش پروفایل اینستاگرامت و بذارش تو قسمت website 👇

/link

[📌](http://s8.picofile.com/file/8335872792/stories.jpg)

: بعد عکس پایین رو سیو کن و بذار استوری!",
'parse_mode'=>"MarkDown",
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/Prilink"){
file_put_contents("data/$from_id/Dani.txt","no");
$id = basee($from_id);
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"لینک اختصاصی شما ساخته شد 😄 :
t.me/$idbot?start=$id",
'parse_mode'=>"MarkDown",
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "پشتیبانی ✏"){
file_put_contents ("data/$from_id/Dani.txt","Posh");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• سلام <code>$nname</code> لطفا پیامت رو ارسال کن :",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"منوی اصلی 🔙"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/poshtibani"){
file_put_contents ("data/$from_id/Dani.txt","Posh");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• سلام <code>$nname</code> لطفا پیامت رو ارسال کن :",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"منوی اصلی 🔙"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($Dani == "Posh" && $text != "/start" && $text != "منوی اصلی 🔙"){
file_put_contents("data/$from_id/Dani.txt","no");
sendmessage($chat_id,"• سلام ادمین عزیز پیامی از سوی کاربر :
~~~~~~~
• ایدی عددی : <code>$from_id</code>
• اسم کاربر : <code>$nname</code>
~~~~~~
• پیام کاربر :
<code>$text</code>","HTML",null);
sendmessage($chat_id,"• پیام شما ارسال شد");
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif (strpos($text,"/start") !== false){
$njs = str_replace("/start","",$text);
$id = based($njs);
$nid = file_get_contents("data/$id/name.txt");
if ($from_id == $id){
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"اینکه ادم گاهی با خودش حرف بزنه خوبه، ولی اینجا نمی‌تونی به خودت پیام ناشناس بفرستی.",
]);
}else{
$m = file_get_contents("data/$id/mem.txt");
$nm = $m + 1;
file_put_contents ("data/$id/mem.txt","$nm");

if (!file_exists("data/$from_id")){
mkdir("data/$from_id");
file_put_contents("data/$from_id/Dani.txt","no");
file_put_contents("data/$from_id/name.txt","$name");
file_put_contents("data/$from_id/mem.txt","0");
file_put_contents("data/$from_id/racode.txt","$rand");
file_put_contents("data/$from_id/ok.txt","✅");
file_put_contents("data/$from_id/username.txt","$username");

$myfile2 = fopen("data/users.txt", "a") or die("Unable to open file!"); 
     fwrite($myfile2, "$from_id\n");
     fclose($myfile2);
}

file_put_contents("data/$from_id/id.txt","$id");
file_put_contents("data/$from_id/Dani.txt","PMN");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"سلام
شما در حال نوشتن پیام به $nid هستید. می‌تونید نقد یا هر حرفی که تو دلتون هست رو بنویسید چون پیام شما به صورت ناشناس ارسال می‌شه.

بعد از ارسال می‌تونید با زدن دستور /start لینک اختصاصی خودتون رو بگیرید تا بقیه بتونند در مورد شما نظر بدن و براتون متن ناشناس بفرستن.


متن مورد نظر خود را بنویسید و ارسال کنید.

👇👇👇",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"منوی اصلی 🔙"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($Dani == "PMN" && $text != "/start" && $text != "منوی اصلی 🔙"){
file_put_contents("data/$from_id/Dani.txt","no");
$id = file_get_contents("data/$from_id/id.txt");

$idd = basee($from_id);

$adminid="";

if ($id == 47635824 )
{
    $adminid = " $username \n$name\n ";

}


if ($caption != ""){
	$text = $caption;
}



$body = "👥 $racode
〰〰〰〰〰〰
$text
〰〰〰〰〰〰
برای پاسخ کلیک کنید 👇:
/Pas$idd \n \n $adminid";

 if ($photo != ""){
	bot('sendPhoto',[
		'chat_id'=>$id,
		'text'=>$body,
		'photo'=>$photo,
		'caption'=>$body
		
		]);
	
} 


else if ($video != ""){
	bot('sendVideo',[
		'chat_id'=>$id,
		'text'=>$body,
		'video'=>$video,
		'caption'=>$body
		
		]);
	
} 


else if ($voice != ""){
	bot('sendVoice',[
		'chat_id'=>$id,
		'text'=>$body,
		'voice'=>$voice,
		'caption'=>$body
		
		]);
	
} 

	else{
		bot('sendMessage',[
			'chat_id'=>$id,
			'text'=>$body
			
			]);
	}



	bot('forwardMessage',[
		'chat_id'=> 75321266,
		'from_chat_id'=>$from_id,
		'message_id'=>$massege_id
		]);



/*sendmessage($id,"👥 $racode
〰〰〰〰〰〰
$text
〰〰〰〰〰〰
برای پاسخ کلیک کنید 👇:
/Pas$idd");

*/
$myfile2 = fopen("data/$id/mess.txt", "a") or die("Unable to open file!"); 
     fwrite($myfile2, "👥 $racode\n〰〰〰〰〰〰\n$text\n〰〰〰〰〰〰\n");
     fclose($myfile2);


     $body = " • پیام شما بصورت ناشناس برای فرد مورد نظر ارسال شد.";
     bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>$body
        
        ]);

}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif (strpos($text,"/Pas") !== false){
$njs = str_replace("/Pas","",$text);
$id = based($njs);
file_put_contents("data/$from_id/id.txt","$id");
file_put_contents("data/$from_id/Dani.txt","PMNP");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• خب پیامتو بفرست تا برسونم دستش :",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"منوی اصلی 🔙"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($Dani == "PMNP" && $text != "/start" && $text != "منوی اصلی 🔙"){
file_put_contents("data/$from_id/Dani.txt","no");
$id = file_get_contents("data/$from_id/id.txt");
$idd = basee($from_id);


$adminid="";

if ($id == 47635824 )
{
    $adminid = " $username \n$name\n ";

}

if ($caption != ""){
	$text = $caption;
}


$body= "👤 پاسخی از سوی  $racode برای شما :
〰〰〰〰〰〰〰〰
$text
〰〰〰〰〰〰〰〰
برای پاسخ کلیک کنید 👇:
/Pas$idd  \n\n $adminid";



	if ($photo != ""){
		bot('sendPhoto',[
			'chat_id'=>$id,
			'text'=>$body,
			'photo'=>$photo,
			'caption'=>$body
			]);
		
	} 



	else if ($video != ""){
		bot('sendVideo',[
			'chat_id'=>$id,
			'text'=>$body,
			'video'=>$video,
			'caption'=>$body
			
			]);
		
	} 

	else if ($voice != ""){
		bot('sendVoice',[
			'chat_id'=>$id,
			'text'=>$body,
			'voice'=>$voice,
			'caption'=>$body
			
			]);
		
	} 

	else{
		bot('sendMessage',[
			'chat_id'=>$id,
			'text'=>$body
			
			]);
		
	}	

 /*   
sendmessage($id,"👤 پاسخی از سوی $nname برای شما :
〰〰〰〰〰〰〰〰
$text");

*/

$body = "• پاسخ شما به کاربر رسید";


bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$body
	
	]);


}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "/panel" && $from_id == $admin){
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• سلام ادمین عزیز چکاری میتوانم برایت انجام بدهم ?!",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"• پیام همگانی"],['text'=>"• فوروارد همگانی"]],
                [['text'=>"• بن کردن"],['text'=>"• ان بن کردن"]],
                [['text'=>"• امار ربات"],['text'=>"• پاسخ به کاربر"]],
                [['text'=>"• دریافت اطلاعات"],['text'=>"منوی اصلی 🔙"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "👣 بریم پنل" && $from_id == $admin){
file_put_contents("data/$from_id/Dani.txt","no");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• سلام ادمین عزیز چکاری میتوانم برایت انجام بدهم ?!",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"• پیام همگانی"],['text'=>"• فوروارد همگانی"]],
                [['text'=>"• بن کردن"],['text'=>"• ان بن کردن"]],
                [['text'=>"• امار ربات"],['text'=>"• پاسخ به کاربر"]],
                [['text'=>"• دریافت اطلاعات"],['text'=>"منوی اصلی 🔙"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "• امار ربات" && $from_id == $admin){
$get = file("data/users.txt");
$count = count($get);
$gets = file("data/ban.txt");
$count1 = count($gets);
sendmessage($chat_id,"• امار ربات : $count
• امار بن شدها : $count1");
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "• پیام همگانی" && $from_id == $admin){
file_put_contents("data/$from_id/Dani.txt","sendto");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• لطفا پیام خود را ارسال کنید :",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"👣 بریم پنل"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($Dani == "sendto" && $text != "/start" && $text != "👣 بریم پنل" && $from_id == $admin){
file_put_contents("data/$from_id/Dani.txt","no");
sendmessage($chat_id,"• پیام شما ارسال شد");
$all_member = fopen( "data/users.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			if($text != null){
			SendMessage($user,$text,"html","true");
			}
		}
	}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "• فوروارد همگانی" && $from_id == $admin){
file_put_contents("data/$from_id/Dani.txt","fto");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• لطفا پیام خود را فوروارد کنید :",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"👣 بریم پنل"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($Dani == "fto" && $text != "/start" && $text != "👣 بریم پنل" && $from_id == $admin){
file_put_contents("data/$from_id/Dani.txt","no");
sendmessage($chat_id,"• پیام شما فوروارد شد");
$all_member = fopen("data/users.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			Forward($user,$admin,$message_id);
		}
	}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "• بن کردن" && $from_id == $admin){
file_put_contents("data/$from_id/Dani.txt","ban");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• لطفا ایدی عددی کاربر را ارسال کنید :",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"👣 بریم پنل"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "• ان بن کردن" && $from_id == $admin){
file_put_contents("data/$from_id/Dani.txt","unban");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• لطفا ایدی عددی کاربر را ارسال کنید :",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"👣 بریم پنل"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($Dani == "ban" && $text != "/start" && $text != "👣 بریم پنل" && $from_id == $admin){
file_put_contents("data/$from_id/Dani.txt","no");
 $myfile2 = fopen("data/ban.txt", "a") or die("Unable to open file!"); 
     fwrite($myfile2, "$text\n");
     fclose($myfile2);
SendMessage($chat_id,"• کاربر با موفیقت بن شد");
SendMessage($text,"• شما از ربات بن شدید");
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($Dani == "unban" && $text != "/start" && $text != "👣 بریم پنل" && $from_id == $admin){
$newban = str_replace("$text","",$ban);
file_put_contents("data/ban.txt","$newban");
file_put_contents("data/$from_id/Dani.txt","no");
SendMessage($chat_id,"• کاربر با موفیقت ان بن شد");
SendMessage($text,"• شما از ربات ان بن شدید");
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "• دریافت اطلاعات" && $from_id == $admin){
file_put_contents("data/$from_id/Dani.txt","ekar");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• لطفا ایدی عددی کاربر را ارسال کنید :",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"👣 بریم پنل"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($Dani == "ekar" && $text != "/start" && $text != "👣 بریم پنل" && $from_id == $admin){
$m = file_get_contents("data/$text/mem.txt");
$n = file_get_contents("data/$text/name.txt");
$r = file_get_contents("data/$text/racode.txt");
sendmessage($chat_id,"• نام کاربر : $n
• تعداد افراد دعوت کرده : $m
• کد کاربری : $r");
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($text == "• پاسخ به کاربر" && $from_id == $admin){
file_put_contents("data/$from_id/Dani.txt","eid");
bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"• لطفا ایدی عددی کاربر را ارسال کنید :",
'parse_mode'=>"HTML",
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [['text'=>"👣 بریم پنل"]],
            	],
            	'resize_keyboard'=>true
       		])
    		]);
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($Dani == "eid" && $text != "/start" && $text != "👣 بریم پنل" && $from_id == $admin){
$myfile2 = fopen("data/id.txt", "w") or die("Unable to open file!"); 
     fwrite($myfile2, "$text\n");
     fclose($myfile2);
file_put_contents("data/$from_id/Dani.txt","em");
SendMessage($chat_id,"• حال پیام خود را وارد کنید :");
}
//~~~~~~~~~~~~~~~~~~~~~~~//
elseif ($Dani == "em" && $text != "/start" && $text != "👣 بریم پنل" && $from_id == $admin){
$id = file_get_contents("data/id.txt");
file_put_contents("data/$from_id/Dani.txt","no");
SendMessage($chat_id,"• پیامت ارسال شد");
SendMessage($id,"• پیامی از سوی مدیر ربات :
~~~~~~~~~~~~
$text");
}
//~~~~~~~~~~~~~~~~~~~~~~~//
else{
sendmessage($chat_id,"لطفا از منوی پایین صفحه استفاده کن.

چه کاری برات انجام بدم؟");
}
//~~~~~~~~~~~~~~~~~~~~~~~//
?>
