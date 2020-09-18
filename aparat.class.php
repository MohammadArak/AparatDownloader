<?php

	class aparatDownloader
	{
		public function isAparatLink($link)
		{
			$link = parse_url($link);
			if(isset($link['host']))
			{
				if(strpos($link['host'], 'aparat.com') !== false and strpos($link['path'], '/v/') !== false)
					return true;
				else
					return false;
			}
			else if(isset($link['path']))
			{
				if(strpos($link['path'], 'aparat.com/v/') !== false)
					return true;
				else
					return false;
			}
			return false;
		}
		public function getVideo($videoLink)
		{
			if($this->isAparatLink($videoLink))
			{
				$data = file_get_contents($videoLink);
				// Title
				preg_match('"<meta property=\"og:title\" content=\"(.*?)\"/>"si', $data, $title);
				// Title
	
				// Description
				preg_match('"<meta property=\"og:description\" content=\"(.*?)\"/>"si', $data, $description);
				// Description
	
				// DL Links
				preg_match('"<span class=\"tooltip tooltip-dark tooltip-b tooltip-center tooltip-line tooltip-small\">دانلود ویدیو</span>
</div></div>
    <div class=\"dropdown-content\"><div  class=\"menu-wrapper\">
        <ul class=\"menu-list\">(.*)</ul>"si', $data, $link);
				preg_match_all('"<li class=\"menu-item-link link\">
                        <a  href=\"(.*?)\" target=\"_blank\""si', $link[1], $link);
				// DL Links
	
				// Poster
				preg_match('"<meta property=\"og:image\" content=\"(.*?)\"/>"si', $data, $poster);
				// Poster
				
				// Keyword
				preg_match('"<meta name=\"keywords\" content=\"(.*?)\"/>"si', $data, $keywords);
				// Keyword
					
				$result = array();
				$result['title'] = $title[1];
				$result['description'] = $description[1];
				$result['poster'] = $poster[1];
				$result['downloadable'] = false;
				if(!empty($keywords[1]))
					$result['keywords'] = explode(',', $keywords[1]);
				if(!empty($link[1]))
				{
					$result['downloadable'] = true;
					$qualities = array('144p', '240p', '360p', '480p', '720p', '1080p');
					for($i = 0; $i < count($link[1]); $i++)
					{
						foreach($qualities as $quality)
						{
							if(strpos($link[1][$i], $quality) !== false)
							{
								$result['links'][$i]['_'] = $link[1][$i];
								$result['links'][$i]['quality'] = $quality;
								break;
							}
						}
					}
				}
				return $result;
			}
			else
				return false;
		}
	}
?>