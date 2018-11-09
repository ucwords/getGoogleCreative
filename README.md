# googlecreative
	这是一个通过一个合法的app包名，获取该app在Google store上的素材等。

	* html代码必须是utf-8编码字符，如果不是请转成utf-8。


# example

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
		
# Basic usage

		// 查找所有a标签
		$ret = $dom->find('a');

		// 查找a标签的第一个元素
		$ret = $dom->find('a', 0);

		// 查找a标签的倒数第一个元素
		$ret = $dom->find('a', -1); 

		// 查找所有含有id属性的div标签
		$ret = $dom->find('div[id]');

		// 查找所有含有id属性为foo的div标签
		$ret = $dom->find('div[id=foo]'); 

		// 查找所有id=foo的元素
		$ret = $dom->find('#foo');

		// 查找所有class=foo的元素
		$ret = $dom->find('.foo');

		// 查找所有拥有 id属性的元素
		$ret = $dom->find('*[id]'); 

		// 查找所有 anchors 和 images标记 
		$ret = $dom->find('a, img'); 

		// 查找所有有"title"属性的anchors and images 
		$ret = $dom->find('a[title], img[title]');
	
 # Advanced usage
 
		// Find all <li> in <ul> 
		$es = $html->find('ul li');

		// Find Nested <div> tags
		$es = $html->find('div div div'); 

		// Find all <td> in <table> which class=hello 
		$es = $html->find('table.hello td');

		// Find all td tags with attribite align=center in table tags 
		$es = $html->find('table td[align=center]'); 
