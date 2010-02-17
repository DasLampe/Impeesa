<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding: UTF-8 |
// +----------------------------------------------------------------------+
class impeesaTemplate
{
	private static $instance = NULL;
	 
	protected $templateFile;
	protected $templateFolder;
	protected $template;
	protected $templateExtension;
	protected $templateLoad;
	protected $leftDelimiter = "{";
	protected $rightDelimiter = "}";
	protected $cachePath;
	private $cacheFile;
	public $vars;
	public $globalVars;
	 
	public $css;
	public $js;
 
	public static function getInstance()
	{
		if(null === self::$instance)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}
	 
	public function __construct()
	{
		$this->templateFolder		= PATH_MAIN.impeesaConfig::get("tplFolder");
		$this->templateExtension	= str_replace(".", "", impeesaConfig::get("tplExtension"));
		$this->cachePath			= PATH_TPL.impeesaConfig::get("tplCacheDir");
	}
	 
	public function load($tplFile, $output=1, $tplFolder="")
	{
		if(empty($tplFolder))
		{
			$tplFolder = $this->templateFolder;
		}		 
		return $this->getTemplate($tplFile, $tplFolder, $output);
	}
	 
	private function getTemplate($tplName, $tplFolder, $output)
	{
		$this->templateFile = $tplName . "." . $this->templateExtension;
		$template = $tplFolder . $tplName . "." . $this->templateExtension;
		 
		//Wenn Template von Externem Server
		if($this->externTemplate($tplFolder) === true)
		{
			echo '[Error] Es können keine Templates von externen Servern geladen werden!';
			return false;
		}
		 
		//Wenn Template Datei nicht exisiert
		if(!file_exists($template))
		{
			echo '[Error] Template Datei: '.$template.' konnte nicht geladen werden!';
			return false;
		}
		 
		//Lade Template Datei
		$this->templateLoad = @implode("", file($template));
		 
		if($this->templateLoad === false)
		{ //Laden der Template Datei fehlgeschlagen
			echo '[Error] Template Datei: '.$template.' konnte nicht geladen werden!';
			return false;
		}
		 
		//Ersetzen von Variablen
		$this->replace();
		 
		return $this->caching($output);
	}
	 
	private function externTemplate($tplFolder)
	{
		if(preg_match("/^(http|https|ftp):\/\//si", $tplFolder))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	 
	public function vars($name, $value, $global=0)
	{
		if($global==1)
		{
			$this->globalVars["$name"] = $value;
		}
		else
		{
			$this->vars["$name"] = $value;
		}
	}
		 
	private function replace()
	{
		$this->replace_ifs();
		$this->replace_vars();
	}
	 
	private function replace_vars()
	{
		if(!empty($this->vars))
		{
			$array_key = array_keys($this->vars);
			$array_value = array_values($this->vars);
	 
			for($x=0;$x<count($array_key);$x++)
			{
				$this->templateLoad = str_replace($this->leftDelimiter.$array_key[$x].$this->rightDelimiter, $array_value[$x], $this->templateLoad);
			}
		}
	}
	 
	private function replace_vars_if($var)
	{
		$var = trim($var);
		$anhang = preg_split('/'.$this->leftDelimiter.'(.*)'.$this->rightDelimiter.'/i', $var);
	 
		$var = str_replace(array($this->rightDelimiter, $this->leftDelimiter, $anhang[1]), "", $var);
		$return = "\$this->vars['".$var."']".$anhang[1];
	 
		return $return;
	}
	 
	private function replace_ifs()
	{
		$this->templateLoad = preg_replace_callback('/'.$this->leftDelimiter.'if'.$this->rightDelimiter.'(.*)'.$this->leftDelimiter.'\/if'.$this->rightDelimiter.'/i', array(&$this, 'controlStructur'), $this->templateLoad);
		$this->templateLoad = preg_replace('/'.$this->leftDelimiter.'\/endif'.$this->rightDelimiter.'/i', '<?php } ?>', $this->templateLoad);
	}
	 
	private function controlStructur($arg)
	{
		return "<?php if(".$this->replace_vars_if($arg[1]).") { ?>";
	}
	 
	private function caching($output)
	{
		$this->cacheFile = $this->cachePath.str_replace("/", "_", $this->templateFile);
	 
		$templateFile = fopen($this->cachePath.str_replace("/", "_", $this->templateFile),"w");
		$cacheFile = fwrite($templateFile, $this->templateLoad);
		fclose($templateFile);
	 
		return $this->output($this->cacheFile, $output);
	}
	 
	private function output($file, $output)
	{
		if($output == 1)
		{
			include($file);
		}
		else
		{
			ob_start();
			include($file);
			$return = ob_get_contents();
			ob_end_clean();
			return $return;
		}
	 
		return false;
	}
	 
	public function addCss($file, $linkMain=1)
	{
		if($linkMain == 1)
		{
			$this->css[] = LINK_CSS . $file;
		}
		else
		{
			$this->css[] = $file;
		}
	}
	 
	public function addJs($file, $important=0, $linkMain=1)
	{
		if($linkMain == 1)
		{
			$this->js[] = array(
								"file" => LINK_CSS . $file,
								"important" => $important
								);
		}
		else
		{
			$this->js[]	= array(
								"file"		=> $file,
								"important"	=> $important);
		}
	}
}