<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class impeesaTemplate
{
	private static $instance = NULL;
	
	protected	$templateFile;
	protected	$templateFolder;
	protected	$template;
	protected	$templateExtension;
	protected	$templateLoad;
	protected	$leftDelimiter = "{";
	protected	$rightDelimiter = "}";
	protected	$cachePath;
	private		$cacheFile;
	public		$vars;
	public		$globalVars;
	
	public		$css;
	public		$js;
	
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
		$this->templateFolder		= PATH_MAIN.siteConfig::get("tplFolder");
		$this->templateExtension	= str_replace(".", "", siteConfig::get("tplExtension"));
		$this->cachePath			= PATH_TPL.siteConfig::get("tplCacheDir");
	}
	
	public function load($tplFile, $output=1, $tplFolder="")
	{
		if(empty($tplFolder))
		{
			$tplFolder	= $this->templateFolder;
		}
		
		return $this->getTemplate($tplFile, $tplFolder, $output);
	}
	
	private function getTemplate($tplName, $tplFolder, $output)
	{
		$this->templateFile	= $tplName . "." . $this->templateExtension; 
		$template			= $tplFolder . $tplName . "." . $this->templateExtension;

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
		$this->templateLoad	= @implode("", file($template));
		
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
			$this->globalVars["$name"]	= $value;
		}
		else
		{
		$this->vars["$name"] = $value;	
		}		
	}
	
	private function replace()
	{
		$this->replace_vars();
	}
	
	private function replace_vars()
	{
		if(!empty($this->vars))
		{
			$array_key		= array_keys($this->vars);
			$array_value	= array_values($this->vars);
		
			for($x=0;$x<count($array_key);$x++)
			{
				$this->templateLoad	= str_replace($this->leftDelimiter.$array_key[$x].$this->rightDelimiter, $array_value[$x], $this->templateLoad);
			}
		}
	}
	
	private function caching($output)
	{
		$this->cacheFile	= $this->cachePath.str_replace("/", "_", $this->templateFile);
			
		$templateFile	= fopen($this->cachePath.str_replace("/", "_", $this->templateFile),"w");
		$cacheFile		= fwrite($templateFile, $this->templateLoad);
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
	
	public function addCss($file)
	{
		$this->css[]	= LINK_MAIN . $file;
	}
	
	public function addJs($file)
	{
		$this->js[]		= LINK_MAIN . $file;
	}
}