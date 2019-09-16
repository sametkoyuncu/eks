<?php 
	function seo($s){
		$tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','ç','Ç','(',')','/',' ',',','?');
		$eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','');
		$s = str_replace($tr, $eng, $s);
		$s = strtolower($s);
		$s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
		$s = preg_replace('/\s+/', '-', $s);
		$s = preg_replace('|-+|', '-', $s);
		$s = preg_replace('/#/', '', $s);
		$s = preg_replace('.', '', $s);
		$s = trim($s, '-');
		return $s;
	}

	function tarih_cevir($tarih){
		$tar = explode("-", $tarih);
		$tarih_degisik = $tar[2]."-".$tar[1]."-".$tar[0];
		return $tarih_degisik;
	}
 ?>