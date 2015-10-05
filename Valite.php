<?php

define('WORD_WIDTH',8);
define('WORD_HIGHT',12);
define('OFFSET_X',5);
define('OFFSET_Y',5);
define('WORD_SPACING',1);

class valite
{
	public function setImage($Image)
	{
		$this->ImagePath = $Image;
	}
	public function getData()
	{
		return $data;
	}
	public function getResult()
	{
		return $DataArray;
	}
	public function getHec()
	{
		$res = imagecreatefromgif($this->ImagePath);
		$size = getimagesize($this->ImagePath);
		$data = array();
		for($i=0; $i < $size[1]; ++$i)
		{
			for($j=0; $j < $size[0]; ++$j)
			{
				$rgb = imagecolorat($res,$j,$i);
				$rgbarray = imagecolorsforindex($res, $rgb);
				if($rgbarray['red'] < 125 || $rgbarray['green'] < 125
				|| $rgbarray['blue'] < 125)
				{
					$data[$i][$j]=1;
				}else{
					$data[$i][$j]=0;
				}
			}
		}
		$this->DataArray = $data;
		$this->ImageSize = $size;
	}
	public function run()
	{
		$result="";
		// 查找4个数字
		$data = array("","","","");
		for($i=0;$i<5;++$i)
		{
			$x = ($i*(WORD_WIDTH+WORD_SPACING))+OFFSET_X;
			$y = OFFSET_Y;
			for($h = $y; $h < (OFFSET_Y+WORD_HIGHT); ++ $h)
			{
				for($w = $x; $w < ($x+WORD_WIDTH); ++$w)
				{
					$data[$i].=$this->DataArray[$h][$w];
				}
			}
			
		}

		// 进行关键字匹配
		foreach($data as $numKey => $numString)
		{
			$max=0.0;
			$num = 0;
			foreach($this->Keys as $key => $value)
			{
				$percent=0.0;
				similar_text($value, $numString,$percent);
				if(intval($percent) > $max)
				{
					$max = $percent;
					$num = $key;
					if(intval($percent) > 95)
						break;
				}
			}
			$result.=$num;
		}
		$this->data = $result;
		// 查找最佳匹配数字
		return $result;
	}

	public function Draw()
	{
		for($i=0; $i<$this->ImageSize[1]; ++$i)
		{
	        for($j=0; $j<$this->ImageSize[0]; ++$j)
		    {
			    echo $this->DataArray[$i][$j];
	        }
		    echo "\n";
		}
	}
	public function __construct()
	{
		$this->Keys = array(
		'0'=>'001111000111111011100111110000111100001111000011110000111100001111000011111001110111111000111100',
		'1'=>'000011000001110000111100011011000100110000001100000011000000110000001100000011000000110000001100',
		'2'=>'001111000111111011100011110000110000001100000110000011100001110000111000011000001111111111111111',
		'3'=>'001111100111111111000011000000110001111000011110000001110000001111000011111001110111111000111100',
		'4'=>'000001100000111000001110000111100011011000110110011001101100011011111111111111110000011000000110',
		'5'=>'011111100111111001100000111000001111110011111110110001110000001111000011111001110111111000111100',
		'6'=>'001111100111111101100011110000001101110011111110111001111100001111000011011000110111111000111100',
		'7'=>'111111111111111100000110000011000000110000011000000110000001100000111000001100000011000000110000',
		'8'=>'001111000111111011000011110000111100001101111110011111101100001111000011110000110111111000111100',
		'9'=>'001111000111111011000110110000111100001111100111011111110011101100000011110001101111111001111100',
	);
	}
	protected $ImagePath;
	protected $DataArray;
	protected $ImageSize;
	protected $data;
	protected $Keys;
	protected $NumStringArray;

}
?>