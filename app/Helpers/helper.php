<?php
function debug($array=[],$exit=0){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	if($exit){
		exit();
	}
}
function languageSet($language){
	$sessionValue = Session::get('lang');
	if(($sessionValue == '' || $sessionValue == 'en') && $language == 'en'){
		return 'selected="selected"';
	}else{
		if($language == $sessionValue){
			return 'selected="selected"';
		}
	}
	//if()
}
function dictionary($lang){
	$arr = [];
	$arr['us'] = ['top_text'=>'An easy to use ringtone maker for you to create unlimited ringtones free!','on_girl_text'=>'This ringtone creator is easy to use, simply follow the instructions','step1'=>'First, click “Upload” select audio files of your choice. (Make sure the Music file formats are of the following formats; AAC, FLAC, M4, PM3, WAV, VWM)','step2'=>'Second, adjust the makers to set the duration and length of audio file.','step3'=>'Third, press “Play” to listen the marked audio file','step4'=>'Fourth, choose in which format you want to convert your ringtone into, M4R is for IPhone and MP3 is for Android and most of the other mobile phones.','step5'=>'Fifth, “Click” make ringtone to create the ringtone for your phone.','step6'=>'Finally, enjoy your favourite music. Or repeat the process to create more.'];
	
	$arr['zh'] = ['top_text'=>'个易于使用的铃声制造商为您创造无限的铃声免费','on_girl_text'=>'这个铃声创造者易于使用, 只需按照说明','step1'=>'首先, 单击 &quot;上载&quot; 选择您选择的音频文件。(请确保音乐文件格式具有以下格式;aac, flac, M4, PM3, wav,

VWM)','step2'=>'第二, 调整制作者设置音频文件的持续时间和长度。','step3'=>'第三, 按 &quot;播放&quot; 收听已标记的音频文件','step4'=>'4, 选择你要转换的格式, 你的铃声成, M4R 是为 iphone 和 mp3/mp4 是为 android 和大多数其他移动电话。','step5'=>'5, &quot;点击&quot; 制作铃声, 创建手机铃声。','step6'=>'最后, 享受你最喜爱的音乐。或重复此过程以创建更多。'];


	$arr['es'] = ['top_text'=>'Un sencillo de usar Ringtone Maker para crear tonos de llamada ilimitados gratis','on_girl_text'=>'Este creador de tonos es fácil de usar, simplemente siga las instrucciones','step1'=>'En primer lugar, haga clic en "Upload" seleccionar archivos de audio de su elección. (Asegúrese de que los formatos de archivo de música son de los siguientes formatos;) AAC, FLAC, M4, PM3, WAV, VWM)','step2'=>'En segundo lugar, ajuste los makers para fijar la duración y la longitud del archivo de audio.','step3'=>'En tercer lugar, pulse "Play" para escuchar el archivo de audio marcado','step4'=>'Cuarto, elija en qué formato desea convertir su tono de llamada en, M4R es para el iPhone y MP3 es para Android y la mayoría de los otros teléfonos móviles.','step5'=>'Quinto, "haga clic" haga ringtone para crear el ringtone para su teléfono.','step6'=>'Finalmente, disfrute de su música favorita. O repita el proceso para crear más.'];
	
	$arr['pt'] = ['top_text'=>'Um fabricante de toque fácil de usar para você criar ringtones ilimitado Grátis','on_girl_text'=>'Este ringtone creator é fácil de usar, basta seguir as instruções','step1'=>'Primeiro, clique em "Upload" selecionados arquivos de áudio de sua escolha. (Certifique-se que os formatos de ficheiros de música são dos seguintes formatos; AAC, FLAC, M4, PM3, WAV, VWM)','step2'=>'Em segundo lugar, ajuste os fabricantes para definir a duração e arquivo de áudio.','step3'=>'Em terceiro lugar, aperte "Play" para ouvir o ficheiro áudio marcado','step4'=>'Em quarto lugar, escolher em qual formato você quer converter seu toque em, M4Ré para IPhone e MP3 é para Android e a maioria dos outros telefones celulares.','step5'=>'Em quinto lugar, "Clique em" fazer toque para criar o ringtone para o seu celular.','step6'=>'Finalmente, desfrute da sua música favorita. Ou repita o processo para criar mais.'];
	
	$arr['ru'] = ['top_text'=>'Простой в использовании Мелодия maker для создания неограниченного рингтоны бесплатно','on_girl_text'=>'Этот рингтон создатель является простым в использовании, просто следуйте инструкциям','step1'=>'Во-первых нажмите кнопку «Загрузить» выберите аудио файлы по вашему выбору. (Убедитесь, форматов музыкальных файлов следующих форматов; AAC, FLAC, M4, PM3, WAV, VWM)','step2'=>'Во-вторых Отрегулируйте создателей установить продолжительность и длина аудио файла.','step3'=>'В-третьих нажмите «Play» слушать заметно аудио файлов','step4'=>'В-четвертых, выбрать, в какой вы хотите преобразовать ваш рингтон в формате M4R предназначен для IPhone и MP3 для Android и большинство других мобильных телефонов.','step5'=>'В-пятых «Нажмите кнопку» сделать рингтон для создания рингтона для своего телефона.','step6'=>'Наконец Слушайте любимую музыку. Или повторить этот процесс для созданиябольше.'];
	
	$arr['id'] = ['top_text'=>'Mudah digunakan ringtone maker untuk Anda untuk buat unlimited Ringtone gratis','on_girl_text'=>'Pencipta ringtone ini mudah digunakan, cukup ikuti petunjuk','step1'=>'Pertama, klik "Upload" Pilih file pilihan Anda. (Pastikan format file musik dari formatberikut; AAC, FLAC, M4, PM3, WAV, VWM)','step2'=>'Kedua, menyesuaikan pembuat menyetel durasi dan panjang audio file.','step3'=>'Ketiga, tekan "Play" mendengarkan file audio yang ditandai','step4'=>'Keempat, memilih dalam format yang Anda ingin mengkonversi ringtone Anda ke,M4R adalah untuk IPhone dan MP3 untuk Android dan sebagian besar ponsel lainnya.','step5'=>'Kelima, "Klik" membuat ringtone untuk menciptakan nada dering untuk telepon Anda.','step6'=>'Akhirnya, menikmati musik favorit. Atau Ulangi proses untuk menciptakan lebih banyak.'];
	
	$arr['fr'] = ['top_text'=>'Un fabricant de sonnerie facile à utiliser pour vous de créer des sonneries illimité gratuit','on_girl_text'=>'Ce créateur de sonnerie est facile à utiliser, il suffit de suivre les instructions','step1'=>'Tout d’abord, cliquez sur « Upload » sélectionnez des fichiers audio de votre choix.(Assurez-vous que les formats de fichiers de musique sont des formats suivants ; AAC, FLAC, M4, PM3, WAV, VWM)','step2'=>'Deuxièmement, régler les décideurs pour définir la durée et la longueur du fichier audio.','step3'=>'En troisième lieu, appuyez sur « Play » pour écouter le fichier audio marqué','step4'=>'Quatrièmement, choisir dans quel format vous voulez convertir votre sonnerie dans,M4R pour IPhone et MP3 pour Android et la plupart des autres téléphones mobiles.','step5'=>'Cinquièmement, « Cliquez sur » faire des sonneries pour créer la sonnerie pour votre téléphone.','step6'=>'Enfin, profitez de votre musique préférée. Ou répéter le processus pour créer d’autres.'];
	
	$arr['de'] = ['top_text'=>'Ein einfach zu bedienende Ringtone Maker für Sie zu schaffen unbegrenzte Klingeltöne kostenlos','on_girl_text'=>'Dieser Klingelton Creator ist einfach zu bedienen, befolgen Sie einfach die Anweisungen','step1'=>'Zuerst klicken Sie auf "hochladen" wählen Sie Audiodateien Ihrer Wahl. (stellen Sie sicher, dass die Musik-Dateiformate von den folgenden Formaten sind;) AAC, FLAC, M4, PM3, WAV, vWM','step2'=>'Zweitens stellen Sie die Entscheidungsträger ein, um die Dauer und die Länge der Audiodatei einzustellen.','step3'=>'Drittens drücken Sie "Play", um die markierte Audiodatei anzuhören.','step4'=>'Viertens, wählen Sie in welchem Format Sie Ihre Ringtone umwandeln möchten in, M4R ist für iPhone und MP3 ist für Android und die meisten der anderen Mobiltelefone.','step5'=>'Fünfter, "klicken Sie" Make Ringtone, um den Klingelton für Ihr Telefon zu erstellen.','step6'=>'Schließlich genießen Sie Ihre Lieblingsmusik. Oder wiederholen Sie den Vorgang, um mehr zu erstellen.'];
	
	
	$arr['ja'] = ['top_text'=>'あなたが無制限の着信音を無料で作成するための使いやすい着メロメーカー','on_girl_text'=>'この着メロの作成者は、単に指示に従って、使いやすいです。','step1'=>'まず、クリックして "アップロード" お好みのオーディオファイルを選択します。(音楽ファイル形式が次の形式であることを確認してください。aac、flac、m4、VWM、wav ファイル、','step2'=>'次に、オーディオファイルのデュレーションと長さを設定するようにメーカーを調整します。','step3'=>'第三に、"再生" は、マークされたオーディオファイルを聞くために押す','step4'=>'第四に、あなたの着信音に変換したい形式を選択し、m4r は、iphone と mp3 用ですアンドロイドと他の携帯電話のほとんどです。','step5'=>'第五に、"クリック" あなたの携帯電話の着信音を作成する着信音を確認します。','step6'=>'最後に、あなたのお気に入りの音楽をお楽しみください。または、詳細を作成するプロセスを繰り返します。'];
	
	
	$arr['nl'] = ['top_text'=>'Een makkelijk te gebruiken ringtone maker voor het maken van onbeperkt ringtones gratis','on_girl_text'=>'Deze ringtone creator is eenvoudig te gebruiken, volg gewoon de instructie','step1'=>'Klik eerst op "Upload" Selecteer audio bestanden van uw keuze. (Zorg ervoor dat demuziek-bestandsindelingen zijn van de volgende indelingen; AAC, FLAC, M4, PM3,WAV, VWM)','step2'=>'Ten tweede, pas de makers als de duur en de lengte van audio-bestand wilt instellen.','step3'=>'Ten derde, druk op "Play" om te luisteren van de gemarkeerde audiobestand','step4'=>'Ten vierde, kiezen in welk formaat u wilt uw ringtone in converteren, M4R is voor IPhone en MP3 is voor Android en de meeste van de andere mobiele telefoons.','step5'=>'Ten vijfde Maak "Klik op" ringtone maken de ringtone voor uw telefoon.','step6'=>'Tot slot, geniet van uw favoriete muziek. Of herhaal het proces om te maken meer.'];
	
	$arr['pl'] = ['top_text'=>'Łatwe w obsłudze dzwonek dla Ciebie stworzyć nieograniczoną Darmowe dzwonki na telefon','on_girl_text'=>'Ten Twórca dzwonek jest łatwy w użyciu, po prostu postępuj zgodnie z instrukcjami','step1'=>'Po raz pierwszy kliknij przycisk "Prześlij" Wybierz pliki audio do wyboru. (Upewnijsię, są formaty plików muzycznych z następujących formatów; AAC, FLAC, M4, PM3,WAV, VWM)','step2'=>'Po drugie dostosować twórców, aby ustawić długość i długość pliku audio.','step3'=>'Po trzecie naciśnij "Play", aby słuchać oznaczony plik audio','step4'=>'Po czwarte, wybrać, w którym formacie należy skonwertować dzwonek do M4R jestdla IPhone i MP3 jest dla systemu Android i większość innych telefonów komórkowych.','step5'=>'Po piąte "Kliknij" zrobić dzwonek stworzyć dzwonek do telefonu.','step6'=>'Wreszcie cieszyć się twój ulubieniec muzyka. Lub Powtórz proces, aby utworzyć więcej.'];
	
	
	$arr['tr'] = ['top_text'=>'Kolay ringtone maker ücretsiz sınırsız zil sesleri oluşturmak için','on_girl_text'=>'Bu ringtone creator kolay, sade bir şekilde izlemek belgili tanımlık öğretim','step1'=>'Önce "Upload" select ses dosyaları seçtiğiniz tıklatın. (Müzik dosyası formatlarını aşağıdaki biçimlerini olduğundan emin olun; AAC, FLAC, M4, 3, WAV, VWM)','step2'=>'İkinci olarak, süresi ve ses dosyasının uzunluğu ayarlamak için ve yapımcıları ayarlayın.','step3'=>'Üçüncü olarak, işaretli radyo sinyalleriyle iletilen eğe dinlemek için "Play" tuşuna basın','step4'=>'Dördüncü olarak, sizin ringtone içine dönüştürmek istediğiniz hangi biçimde M4R için IPhone seçmek ve MP3 Android ve en-in hareket eden telefon için.','step5'=>'Beşinci olarak, "Click" telefonunuz için zil sesi oluşturmak için zil sesi yap.','step6'=>'Son olarak, en sevdiğiniz müziğin keyfini çıkarın. Ya da daha fazla oluşturmak için işlemi yineleyin.'];
	
	$arr['ko'] = ['top_text'=>'당신이 무제한 벨소리를 무료로 만들 수 있는 벨소리 메이커를 사용 하기 쉬운','on_girl_text'=>'이 벨소리 크리에이터를 사용 하기 쉽고, 간단 하 게 지침을 따르십시오','step1'=>'먼저, "업로드"를 클릭 하 여 선택의 오디오 파일을 선택 합니다. (음악 파일 형식은 다음과 같은 형식으로 되어 있는지 확인 합니다. aac, flac, m4, m a 4, wav, wm)','step2'=>'둘째로, 제작자를 조정 하는 오디오 파일의 내구 그리고 길이를 놓기 위하여.','step3'=>'셋째, "재생"을 누르면 표시 된 오디오 파일이 들어','step4'=>'넷째, 어떤 형식으로 귀하의 벨소리를 변환 하려는 선택, m4r는 아이폰과 m p 3에 대 한 안 드 로이드와 다른 휴대 전화의 대부분입니다.','step5'=>'다섯째, "클릭" 벨소리 귀하의 휴대 전화에 대 한 벨소리를 만들 수 있습니다.','step6'=>'마지막으로, 좋아하는 음악을 즐길 수 있습니다. 또는 프로세스를 반복 하 여 더 만듭니다.'];
	
	$arr['it'] = ['top_text'=>'Un facile da usare Ringtone Maker per creare suonerie illimitate gratis','on_girl_text'=>'Questo creatore suoneria è facile da usare, basta seguire le istruzioni','step1'=>'In primo luogo, fare clic su "upload" selezionare i file audio di vostra scelta. (assicurarsi che i formati di file musicali siano dei seguenti formati; AAC, FLAC, M4, PM3, WAV, VWM)','step2'=>'In secondo luogo, regolare i creatori per impostare la durata e la lunghezza del file audio.','step3'=>'In terzo luogo, premere "Play" per ascoltare il file audio marcato','step4'=>'In quarto luogo, scegliere in quale formato si desidera convertire la suoneria in, M4R è per iPhone e MP3 è per Android e la maggior parte degli altri telefoni cellulari.','step5'=>'Quinto, "fare clic su" suoneria per creare la suoneria per il telefono.','step6'=>'Infine, goditi la tua musica preferita. O ripetere il processo per creare più.'];
	
	//$arr['vi'] = ['top_text'=>'','on_girl_text'=>'','step1'=>'','step2'=>'','step3'=>'','step4'=>'','step5'=>'','step6'=>''];
	
	$sessionValue = Session::get('lang');
	if(isset($sessionValue) && $sessionValue != '' && isset($arr[$sessionValue])){
		return $arr[$sessionValue];
	}else{
		return $arr['us'];
	}
	
}