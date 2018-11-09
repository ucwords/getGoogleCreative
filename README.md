# googlecreative
这是一个通过一个合法的app包名，获取该app在Google store上的素材等。

html代码必须是utf-8编码字符，如果不是请转成utf-8。


# Basic usage
	<?php
		use \Kernel\cURL;
		require 'vendor/autoload.php';
    	$package_name = 'com.tencent.mm';
		$h1= 'en';
    	$url = 'https://play.google.com/store/apps/details?id=' . $package_name . '&hl='.$h1;
    	$html = cURL::curlInit($url);
    	$dom = new \Kernel\HtmlDom($html);

    	$info = [];
    	$info['app_name'] = $dom->find('h1[itemprop="name"]',0)->getPlainText();
		$info['des'] = $dom->find('[itemprop="description"]',0)->getAttr('content');
		$info['icon'] = $dom->find('img[itemprop="image"]',0)->getAttr('src');
		$tmp = $dom->find('a[itemprop="genre"]',0)->getAttr('href');
		$tmp = explode('/',$tmp);
		$info['category'] = end($tmp);
		if(is_array($j["screenshotUrls"])){
			foreach($j["screenshotUrls"] as $src){
				$info['screenshot'][]=["size"=>[174,310],"url"=>$src];
			}
		}
		
		var_dump($info);
