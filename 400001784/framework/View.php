<?php

class View implements Observer
{
	 private $vars = array();
     private $tpl = "";
     private $obsData;

	public function setTemplate($filename)
	{
		$this->tpl = $filename;
	}

	public function getTemplate():string
	{
		return $this->tpl;
	}

	public function getObsData():array
	{
		return $this->obsData;
	}

	public function display():void
	{
		if($this->vars != array())
		{
			extract($this->vars);
		}
		$this->obsData;
        require $this->tpl;
	}

	public function addVar($name,$value):void
	{
		 $this->vars[$name] = $value;
	}

	public function getVars(): array
	{
		return $this->vars;
	}

	public function update(Observable $observable)
	{
		if(!is_array($this->obsData))
		{
			$this->obsData[] = $observable->getData();
		}
		else{
			array_push($this->obsData,$observable->getData());
		}
	}
}