<?php

namespace Hcode;

use Rain\Tpl;

class Page 
{
	private $tpl;
	private $options=[];
	private $defaults=["data"=>[]];

	public function __construct($opts=array()){//se não vir nada será um array

		$this->options=array_merge($this->defaults, $opts);//havendo conflito prevalece a var $opts

		$config=array(
			"tpl_dir"		=>$_SERVER["DOCUMENT_ROOT"]."/proj/views/", //Usa a variável d ambiente "DOCUMENT_ROOT", q trará a pasta onde está o diretório root
			"cache_dir"		=>$_SERVER["DOCUMENT_ROOT"]."/proj/views-cache/",
			"debug"			=>false // o modo debug não é utilizado, logo se tira ou deixa com "false"
		);

		Tpl::configure($config);//passa as configurações para o tpl

		$this->tpl=new Tpl;

		$this->setData($this->options["data"]);

		$this->tpl->draw("header");
		
	}

	private function setData($data=array()){

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}
	}

	public function setTpl($name,$data=array(), $returnHTML=false){//insere o conteúdo da página

		$this->setData($data);
		return $this->tpl->draw($name,$returnHTML);

	}

	public function __destruct(){
		
		$this->tpl->draw("footer");
	}
}

?>