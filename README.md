# Aparat Downloader
A simple php class to download videos from aparat and fetch information about them.
## What this Script does?
It is just a simple script written with *PHP* to get video links from Aparat
You gives the script, URLS; and it will give you video information + video download links.

## How to use?
```
include 'aparat.class.php';
$aparat = new aparatDownloader();
$result = $aparat->getVideo("https://www.aparat.com/v/w4IbJ");
```

## Attention
1. Not all aparat videos are downloadable! This script will get download links only if they are available.
You can check it with `$result['downloadable']` value.
2. Don't change content of aparat.class.php, It is so sensitive.
